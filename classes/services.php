<?php

include "classes/SearchClient.php";

class ITunesMusicService {

  public static $URL = 'https://itunes.apple.com/search';

  public static function getResults($query) {
    $params = array('term' => $query, 'entity' => 'musicTrack');
    $results = SearchClient::searchTerm(self::$URL, $params)['results'];
    return array_map('self::formatResult', $results);
  }

  private static function formatResult($object) {
    return array('name' => $object['trackName'] ." - ". $object['artistName'] ." ", 
    'origin' => 'iTunes music');
  }

}

class ITunesMovieService {

  public static $URL = 'https://itunes.apple.com/search';

  public static function getResults($query) {
    $params = array('term' => $query, 'entity' => 'movie');
    $results = SearchClient::searchTerm(self::$URL, $params)['results'];
    return array_map('self::formatResult', $results);
  }

  private static function formatResult($object) {
    return array('name' => $object['trackName'] ." - ". $object['artistName'] ." ", 
    'origin' => 'iTunes movie');
  }

}

class TvMazeService {

  public static $URL = 'http://api.tvmaze.com/search/shows';

  public static function getResults($query) {
    $params = array('q' => $query);
    $results = SearchClient::searchTerm(self::$URL, $params);
    return array_map('self::formatResult', $results);
  }

  private static function formatResult($object) {
    return array('name' => $object['show']['name'], 
    'origin' => 'TV Maze');
  }

}

class PeopleService {

  public static $URL = 'http://www.crcind.com/csp/samples/SOAP.Demo.cls';

  public static function getResults($query) {
    $params = array('soap_method' => 'GetByName', 'name' => $query);
    $result = SearchClient::searchTerm(self::$URL, $params);
    return array('name' => $result, 'origin' => 'SOAP demo');
  }

}