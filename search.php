<?php
require_once('./searchHelper.php');
if(!isset($_GET['q'])) {
  header('Locatoin: index.php?q');
} else {
  $search = getSearchRaw(composeURL($_GET['q']));
  $lyrics = getSearchLyrics($search);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/lyric.css">
    <link rel="stylesheet" href="css/form.css">
    <title>LyricMood - Search</title>
</head>
<body>
<nav class="navbar fixed-top navbar-light bg-light">
        <a class="navbar-brand" href="./index.php">LyricMood</a>
    </nav>

    <div class="container">
      <h4><a href="index.php">[Start Over]</a></h4>
        <table class="table table-hover table-responsive">
           <thead>
        <tr>  
     <th><h2>Music Search</h2></th>
            </tr>
          </thead>
          <tbody>
          <?php
          for($i = 0; $i < sizeof($lyrics); $i++) {
            echo "
            <tr>
              <td><a href='lyrics.php?song=".$lyrics[$i][URL]."&title=".$lyrics[$i][TEXT]."'>". $lyrics[$i][TEXT] ."</a></td>
            </tr>
            ";
          }?>
          </tbody>
        </table>
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>