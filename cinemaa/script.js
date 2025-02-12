const arrows = document.querySelectorAll(".arrow");
const movielist = document.querySelectorAll(".movie-list")

$('#searchInput').on('input', function() {
    var searchQuery = $(this).val();
    console.log("Input detected: ", searchQuery);  // Logs input to ensure the event is firing
    if (searchQuery.length > 1) {
        console.log("Sending AJAX request for: ", searchQuery);
        $.ajax({
            url: 'search_movies.php',
            type: 'GET',
            data: { movie_name: searchQuery },
            success: function(data) {
                console.log("AJAX call successful: ", data);
                $('#autoCompleteList').html(data);
                $('#autoCompleteList').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX call failed: ", textStatus, errorThrown);
            }
        });
    } else {
        $('#autoCompleteList').hide();
    }
});



arrows.forEach((arrow,i) => {
    const itemnumber = movielist[i].querySelectorAll("img").length;
    let clickcounter = 0;
    arrow.addEventListener("click",() =>{
        clickcounter++;
        if (itemnumber - (4 + clickcounter) >= 0)
        {
        movielist[i].style.transform = `translateX(${
            movielist[i].computedStyleMap().get("transform")[0].x.value
            -300}px)`;
        }
        else 
        {
            movielist[i].style.transform = "translateX(0)"
            clickcounter = 0;
        }
        });
        console.log(movielist[i].querySelectorAll("img").length);
});