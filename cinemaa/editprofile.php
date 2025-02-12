<style>
    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 5px;
    }
    input[type=text], textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        resize: none;
    }
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=submit]:hover {
        background-color: #45a049;
    }
</style>

<form action="insertdata.php" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio" rows="4"></textarea>

    
    <label for="facebook">Facebook:</label>
    <input type="text" id="facebook" name="facebook">
    
    <label for="twitter">Twitter:</label>
    <input type="text" id="twitter" name="twitter">
    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo">
    
    <input type="submit" value="Submit">
</form>
