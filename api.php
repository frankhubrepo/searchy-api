<?php

include "classes/services.php";

if(isset($_POST['term'])){

    $results = array();

    $term = $_POST['term'];

    $iTunesMusic = ITunesMusicService::getResults($term);
    $iTunesMovie = ITunesMovieService::getResults($term);
    $tvMaze = TvMazeService::getResults($term);
    $people = PeopleService::getResults($term);

    $results = array_merge($results, $iTunesMusic);
    $results = array_merge($results, $iTunesMovie);
    $results = array_merge($results, $tvMaze);
    array_push($results, $people);

  echo json_encode($results);

}

?>