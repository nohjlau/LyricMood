<?php
/*
USAGE: 
$map = mapScore($string, $dictionary);
$score = getTotalScore($map);
$comp_score = getComaprativeScore($score, strlen($string));
print_r(getPositiveWords($map));
$pos_score = getPositiveScore($map);
print_r(getNegativeWords($map));
$neg_score = getNegativeScore($map);
*/

require_once('./scrapper/simple_html_dom.php');
require_once('./constants.php');

function getSongLyrics($url) {
  // clean our lyrics up.
  $html = file_get_html($url);
  $lyrics = $html->find('div[class=lyrics-body]',0)->innertext;
  $lyrics = explode("</div>", $lyrics);
  switch(sizeof($lyrics)) {
    case 3:
      return $lyrics[0];
    case 4:
      return $lyrics[1];
    default:
      return '<div class="alert alert-danger" role="alert">
          <strong>Danger!</strong> LyricMood can\'t fetch these lyrics right now. Try another song!
      </div>';
  }
}

function getDictionary($file) {
  $raw = file_get_contents($file);
  $json_a = json_decode($raw, true);

  foreach($json_a as $dictionary_key => $dictionary_data) {
    $data[$dictionary_key] = $dictionary_data;
  }
  return $data;
}

function parseLyrics($string, $dictionary) {
  $string = preg_replace('#(<br */?>\s*)+#i', ' <br/> ', $string);
  
  $string = explode(" ", $string);
  for($i = 0; $i < sizeof($string); $i++) {
    $sanitizedString = preg_replace("/[^A-za-z]/", '', $string[$i]);
    
    if(array_key_exists($sanitizedString, $dictionary)) {
      $btnStyle = "";
      if($dictionary[$sanitizedString] > 0) {
        $btnStyle = "btn-success";
      } else if ($dictionary[$sanitizedString] < 0) {
        $btnStyle = "btn-danger";
      }
      echo "<button type='button' class='btn btn-sm ".$btnStyle."'>".$string[$i]."</button>";
    } else {
      echo $string[$i]." ";
    }
  }
}

function mapScore($string, $dictionary) { 
  $word_map = [];
  $string = preg_replace('#(<br */?>\s*)+#i', ' <br/> ', $string); 
  $string = explode(" ", $string);

  for($i = 0; $i < sizeof($string); $i++) {
    $sanitizedString = preg_replace("/[^A-za-z]/", '', $string[$i]);

    if(array_key_exists($sanitizedString, $dictionary)) {
      $value = $dictionary[$sanitizedString];
      $word_map[$sanitizedString][] = $dictionary[$sanitizedString];
    }
  }
  return $word_map;
}

function getTotalScore($map) {
  $sum_score = 0;
  foreach($map as $key => $value)
    $sum_score += array_sum($value);
  return $sum_score;
}

function getCompareScore($score, $size) {
  return $comp_score = $score/$size;
}

function getPositiveWords($map) {
  $words = [];
  foreach($map as $key => $value) {
    if(array_sum($value) > 0)
      $words[] = $key;
  }
  return $words;
}

function getPositiveScore($map) {
  $pos_score = 0;
  foreach($map as $key => $value) {
    if(array_sum($value) > 0)
      $pos_score += array_sum($value);
  }
  return $pos_score;
}

function getNegativeWords($map) {
  $words = [];
  foreach($map as $key => $value) {
    if(array_sum($value) < 0)
      $words[] = $key;
  }
  return $words;
}

function getNegativeScore($map) {
  $neg_score = 0;
  foreach($map as $key => $value) {
    if(array_sum($value) < 0)
    $neg_score += array_sum($value);
  }
  return $neg_score;
}

function showWordAndScore($map, $which) {
  foreach($map as $key => $value) {
    if($which == 1){
      if($value[0] > 0)
        echo $key."(".$value[0]."x".sizeof($value)."), ";
    }
    
    if($which == -1) {
      if($value[0] < 0)
        echo $key."(".$value[0]."x".sizeof($value)."), ";
    }
  }
}
?>