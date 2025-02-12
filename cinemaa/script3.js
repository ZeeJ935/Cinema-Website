$(document).ready(function() {
    // AJAX search functionality
    $('#searchInput').on('input', function() {
        var searchQuery = $(this).val();
        if (searchQuery.length > 1) {
            $.ajax({
                url: 'search_movies.php',
                type: 'GET',
                data: { movie_name: searchQuery },
                success: function(data) {
                    $('#autoCompleteList').html(data).show();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX call failed: ", textStatus, errorThrown);
                }
            });
        } else {
            $('#autoCompleteList').hide();
        }
    });

    // Event delegation to handle clicks on dynamic search result items
    $(document).on('click', '.search-result-item', function() {
        window.location.href = $(this).attr('data-href'); // Use the data-href attribute to redirect
    });

    // Original arrow and movie list navigation functionality
    const arrows = document.querySelectorAll(".arrow");
    const movieLists = document.querySelectorAll(".movie-list");

    arrows.forEach((arrow, i) => {
        const itemNumber = movieLists[i].querySelectorAll("img").length;
        let clickCounter = 0;
        arrow.addEventListener("click", () => {
            clickCounter++;
            if (itemNumber - (4 + clickCounter) >= 0) {
                movieLists[i].style.transform = `translateX(${movieLists[i].computedStyleMap().get("transform")[0].x.value - 300}px)`;
            } else {
                movieLists[i].style.transform = "translateX(0)";
                clickCounter = 0;
            }
        });
    });
});
