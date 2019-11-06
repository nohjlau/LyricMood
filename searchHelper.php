<?php
/*
USAGE:
Data is retrieved in the format of $array['text'] and $array['url'] stored in our get functions.
  Example:
  $search = getSearchRaw(composeURL("taylor swift"));
  $artists = (getArtists($search));
  print_r($artists);
  echo $artists[$i]['text'];
  echo $artists[$i]['url'];
*/

require_once('./scrapper/simple_html_dom.php');
require_once('./constants.php');

/* START OF SEARCH DATA DEPENDENT VARIABLES
These numbers should only be modified if the website we scrap data from changes. */
define("LYRIC_INDEX_START", 0);
define("LYRIC_INDEX_END", 5);
define("ARTIST_INDEX_START", 6);
define("ARTIST_INDEX_END", 11);
/* END OF DATA DEPENDENT VARIABLES */

function composeURL($input) {
  $url = BASE_SEARCH_URL;
  return BASE_SEARCH_URL . preg_replace('/\s+/', '+', $input);
}

function getSearchRaw($url) {
  //<url class="search" -> <li></li>...
  $c = 0;
  $html = file_get_html($url);
  foreach($html->find('ul[class=search]',0)->find('li') as $element) {
    foreach($element->find('a') as $next) {
      $data[$c][TEXT] = $next->innertext;
      $data[$c][URL] = $next->href;
      $c++;
      //echo $next->href . ' - ' . $next->innertext. '<br>';
    }
  }
  return $data;
}

function getSearchLyrics($data) { // Return a nested array w/ title & urls.
  $c = 0;
  $max = sizeof($data);
  if($max > LYRIC_INDEX_END)
    $max = LYRIC_INDEX_END;
  for($i = LYRIC_INDEX_START; $i < $max; $i++) {
    $lyrics[$c][TEXT] = $data[$i][TEXT];
    $lyrics[$c][URL] = $data[$i][URL];
    $c++;
  }
  return $lyrics;
}

function getSearchArtists($data) {
  $c = 0;
  for($i = ARTIST_INDEX_START; $i < ARTIST_INDEX_END; $i++) {
    $artists[$c][TEXT] = $data[$i][TEXT];
    $artists[$c][URL] = $data[$i][URL];
    $c++;
  }
  return $artists;
}
?>