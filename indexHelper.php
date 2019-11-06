<?php
require_once('./scrapper/simple_html_dom.php');
require_once('./constants.php');

function feelLucky() { //grab the top 100 and randomly push one.
  $url = "https://www.lyricsmania.com/toplyrics.html";
  $c = 0;

  $html = file_get_html($url);
  foreach($html->find('ul[class=charts]',0)->find('li') as $element) {
    foreach($element->find('a') as $next) {
      $data[$c][TEXT] = $next->title;
      $data[$c][URL] = $next->href;
      $c++;
    }
  }
  return $data;
}

function getPopularArtists($num) {
  //Fixed url
  $url = "https://www.lyricsmania.com/topartists.html";
  $c = 0;
  $html = file_get_html($url);
  foreach($html->find('ul[class=charts]',0)->find('li') as $element) {
    foreach($element->find('a') as $next) {
      $data[$c] = substr($next->title,0,-7);
      $c++;
      if($c > $num) {
        return $data;
      }
    }
  }
}
