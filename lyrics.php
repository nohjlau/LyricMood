<?php
require_once('./lyricsHelper.php');

if(!isset($_GET['song'])) {
    header('Location: index.php?q');
}
$url = BASE_URL.$_GET['song'];
$string = getSongLyrics($url);
$dictionary = getDictionary(DICTIONARY_AFINN);
$map = mapScore($string, $dictionary);
$pos_score = getPositiveScore($map);
$neg_score = getNegativeScore($map);
$total = $pos_score + abs($neg_score);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="css/lyric.css"/>
    <title>LyricMood - Song</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">LyricMood</a>
    </nav>

    <div class="container">
      <div class="lyrics-top">
        <h4><a href="index.php">[Start Over]</a></h4>
        <h1><?php echo $_GET['title'] ?></h1>
      </div>
      <div class="lyrics-summary">
        <table class="table table-bordered">
          <tr>
            <th></th>
            <th>Score</th>
            <th></th>
          <tr>
            <th>Positive</th>
            <td><?php echo $pos_score;?></td>
            <td><?php //echo implode(', ', getPositiveWords($map));
              showWordAndScore($map,1); ?>
          </tr>
          <tr>
            <th>Negative</th>
            <td><?php echo $neg_score;?></td>
            <td><?php showWordAndScore($map,-1);
                ?>
          </tr>
          <tr>
            <th>Difference</th>
            <td><?php echo ($pos_score+$neg_score);?></td>
            <td><?php if(($pos_score+$neg_score) > 0) {echo "<b>Positive Valence</b>";} else if (($pos_score+$neg_score) <0) {echo "<b>Negative Valence</b>";}?></td>
          </tr>
        </table>
      </div>
      <div class="progress" style="margin-top: 25px; margin-bottom: 25px">
        <?php
        if($total==0){$pos_bar=0;}else{ $pos_bar = round(($pos_score/$total)*100,2);}
        ?>
        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $pos_bar?>%" aria-valuenow="<?php echo $pos_bar?>" aria-valuemin="0" aria-valuemax="100"><?php echo $pos_bar?>%</div>
        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo 100-$pos_bar?>%" aria-valuenow="<?php echo 100-$pos_bar?>" aria-valuemin="0" aria-valuemax="100"><?php echo 100-$pos_bar?>%</div>
      </div> 
        
      <div id="lyrics">

        <?php
        parseLyrics($string, $dictionary);
      ?>
      </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </div>
</body>
</html>
</body>
</html>