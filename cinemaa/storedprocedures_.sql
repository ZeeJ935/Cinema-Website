from table Movie:


from table User:

1.check  of cnic format
CREATE FUNCTION fn_validate_cnic_format(@cnic VARCHAR(16))
RETURNS BIT
AS
BEGIN
	DECLARE @result BIT = 0
	IF @cnic LIKE '[0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9]-[0-9]' 
	BEGIN
		SET @result = 1
	END
	RETURN @result
END 


2. check that account exists or NOT
CREATE TRIGGER tr_check_account_exists
BEFORE INSERT ON userinfo
FOR EACH ROW
BEGIN
    DECLARE account_count INT;
    SELECT COUNT(*) INTO account_count FROM userinfo WHERE email = NEW.email;
    IF account_count > 0 THEN
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'An account already exists with this email address.';
    END IF;
END;




3. check of phone no format
CREATE FUNCTION fn_validate_phone_number_format(@phone VARCHAR(11))
RETURNS BIT
AS
BEGIN
	DECLARE @result BIT = 0
	IF @phone LIKE '[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9][0-9]' 
	BEGIN
		SET @result = 1
	END
	RETURN @result
END



4.check passwod and confirm password match 
CREATE PROCEDURE sp_insert_userinfo (
    IN p_username VARCHAR(50),
    IN p_password VARCHAR(50),
    IN p_confirm_password VARCHAR(50),
    IN p_email VARCHAR(50),
    IN p_age INT,
    IN p_cnic VARCHAR(16),
    IN p_phone_no VARCHAR(11)
)
BEGIN
    IF p_password <> p_confirm_password THEN
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = 'Password and Confirm Password do not match.';
    ELSE
        INSERT INTO userinfo (username, password, confirm_password, email, age, cnic, phone_no)
        VALUES (p_username, p_password, p_confirm_password, p_email, p_age, p_cnic, p_phone_no);
    END IF;
END;



5. User chk_status
CREATE VIEW vw_users_by_status
AS
SELECT [user_id], Username, Age, Contact_number, CNIC, Gender, Customer_status, Cine_points
FROM [User]
WHERE Customer_status = 'blocked'


6. new user added
Trigger to update Cine points when a new user is added:
CREATE TRIGGER tr_new_user_added
ON [User]
AFTER INSERT
AS
BEGIN
	UPDATE [User]
	SET Cine_points = 100
	WHERE [user_id] IN (SELECT [user_id] FROM inserted)
END

7. password < 8
CREATE FUNCTION fn_check_password_length(password VARCHAR(50))
RETURNS BOOLEAN
BEGIN
    IF LENGTH(password) > 8 THEN
        RETURN FALSE;
    ELSE
        RETURN TRUE;
    END IF;
END;


from table admin:

1.agetrigger
Before insert
BEGIN
    IF NEW.age <= 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Age must be greater than 0';
    END IF;
END

2.password Trigger
Before insert
BEGIN
    IF LENGTH(NEW.password) < 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Password must have at least 8 characters';
    END IF;
END
3.phone Trigger
Before insert
BEGIN
    DECLARE phone_prefix CHAR(4);
    DECLARE phone_suffix CHAR(7);
    SET phone_prefix = SUBSTRING(NEW.phoneno, 1, 4);
    SET phone_suffix = SUBSTRING(NEW.phoneno, 6, 7);
    IF LENGTH(NEW.phoneno) != 12 OR SUBSTRING(NEW.phoneno, 5, 1) != '-' OR phone_prefix NOT REGEXP '^[0-9]+$' OR phone_suffix NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid phone number';
    END IF;
END

4.cnic Trigger
Before insert
BEGIN
    DECLARE cnic_prefix CHAR(5);
    DECLARE cnic_suffix CHAR(7);
    SET cnic_prefix = SUBSTRING(NEW.cnic, 1, 5);
    SET cnic_suffix = SUBSTRING(NEW.cnic, 7, 7);
    IF LENGTH(NEW.cnic) != 15 OR SUBSTRING(NEW.cnic, 6, 1) != '-' OR SUBSTRING(NEW.cnic, 14, 1) != '-' OR SUBSTRING(NEW.cnic, 15, 1) NOT IN ('0', '1', '2', '3', '4', '5', '6', '7', '8', '9') OR cnic_prefix NOT REGEXP '^[0-9]+$' OR cnic_suffix NOT REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid CNIC number';
    END IF;
END

from table blocked:
1. all user info 
create view blocky
as 
select * from userinfo 

from table Movieadmin:
1.all movies info
create view moviedetail
as 
select * from Movieadmin  

from table Trending:
1.all movies info
create view Trendingmovies
as 
select * from Trending  

from table ComingSoon:
1.all movies info
create view Comingsoonmovie
as 
select * from ComingSoon  

from table reservations:
create view seatdetail
as 
select * from reservations

from table Booking_Payment
1. for validation
CREATE TRIGGER validate_card_info_trigger
BEFORE INSERT OR UPDATE ON user_info
FOR EACH ROW
BEGIN
    IF NOT REGEXP_LIKE(NEW.cardnum, '^\d{4} \d{4} \d{4} \d{4}$') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Card number should be in the format: 1234 1234 1234 1234';
    END IF;
    IF NOT REGEXP_LIKE(NEW.cvc, '^\d{3}$') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'CVC should be 3 digits.';
    END IF;
    IF NOT STR_TO_DATE(CONCAT('01-', NEW.expdate), '%d-%m-%Y') > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Your Card is expired.';
    END IF;
END;

2.to check he has an account or not
DELIMITER //
CREATE PROCEDURE check_user_exists(IN email VARCHAR(50), OUT user_exists INT)
BEGIN
  DECLARE num_rows INT DEFAULT 0;
  SELECT COUNT(*) INTO num_rows FROM userinfo WHERE email = email;
  IF num_rows = 0 THEN
    SET user_exists = 0;
  ELSE
    SET user_exists = 1;
  END IF;
END//
DELIMITER ;






