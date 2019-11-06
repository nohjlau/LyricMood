<?php
require_once('indexHelper.php');

$randomArray = feelLucky();
$len = sizeof($randomArray);
$rand = rand(0,$len);
$url_format = $randomArray[$rand][URL];
$text_format = str_replace(" ", "+", $randomArray[$rand][TEXT]);
header('Location: lyrics.php?song='.$url_format.'&title='.$text_format);
?>