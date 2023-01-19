<?php
    $json = file_get_contents("movies.json");
    $movies = json_decode($json, true);
    include("templates/header.php");

    function FormatTitle($movie) {
        return str_replace(" ","-", strtolower($movie['title']));
    }
?>
    <div class="movies">
    <?php
    
    foreach ($movies as $movie) {
        $listGenres = $movie["genres"];
        ?>
            <div class="movie">
                <img src="img/poster/<?= FormatTitle($movie)?>.jpg" alt="poster_film">
                <h2 class="movie_title">
                    <a href="movie.php?id=<?= $movie["id"] ?>"><?= $movie["title"]?></a>
                </h2>
                <p class="movie_genres">
                    <?= implode(", ", $movie["genres"]) ?>
                </p>
            </div>
        <?php
    }
    ?>
    </div>
<?php



    include("templates/footer.php");  
?>

