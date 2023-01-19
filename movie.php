<?php
function FormatTitle($movie) {
    return str_replace(" ","-", strtolower($movie['title']));
}

function FormatTime($time) {
    $h = 0;
    while ($time > 60) {
        $time = $time - 60;
        $h++;
    }
    return $h . "h " . $time . "min";
}

$find = false;
$data = array("name" => "Film introuvable");
if (isset($_GET["id"])) {
    $json = file_get_contents("movies.json");
    $movies = json_decode($json, true);

    foreach ($movies as $movie) {
        if ($_GET["id"] == $movie["id"]) {
            $find = true;
            $data = $movie;
        }
    }
}

include("templates/header.php");

?>
<div>
    <div class="movie_wrapper">
        <div class="movie_poster movie">
<?php
if ($find) {
    $date = date_create($data["releaseDate"]);
    $time = date_create($data["duration"]);
?> 
            <img src="img/poster/<?= FormatTitle($data)?>.jpg" alt="poster_film">
        </div>
        <div class="movie_infos">
            <p class="date-style"> <?= date_format($date, "Y") ?> </p>
            <h2 class="movie_title_big"> <?= $data["title"] ?> </h2>
            <p class="movie_description"> <?= $data["description"] ?> </p>
            <p class="movie_genre"> <?= implode(", ", $data["genres"]) ?> </p>
            <p class="movie_duration"> <?= FormatTime($data["duration"]) ?> - <?= date_format($date, "d/m/Y") ?> </p>
            <!-- <p><?=FormatTime($data["duration"])?></p> -->
            <div class="btn-ba">
                <a href=" <?= $data["video"] ?> ">Bande annonce</a>
            </div>
<?php
}

?>           
        </div>
    </div>
</div>
<?php
include("templates/footer.php");
?>