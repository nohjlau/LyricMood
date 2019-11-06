<?php
require_once('indexHelper.php');
$errorQuery = false;
if(isset($_GET['q'])) {
    $errorQuery = true;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <title>LyricMood - Home</title>
  </head>
  
  <body class="text-center container">
    <div class="col-12">
    <?php if($errorQuery) { ?>
      <div class="alert alert-danger" role="alert">
          <strong>Danger!</strong> You haven't entered a song title or artist!
      </div>
    <?php } ?>
    </>
    <div class="col-12">
      <form class="form-search" action="search.php" method="get">
        <h1 class="h1 mb-3 font-weight-normal">LyricMood</h1>
        <h3 class="h3 mb-3 font-weight-normal">Lexicon Sentiment Analysis</h3>
        <input name="q" type="search" id="inputSearch" class="form-control" placeholder="Type song title or artist" required autofocus>
        <button class="btn btn-primary" type="submit">Search</button>
        <a href="lucky.php"><span class="btn btn-secondary" type="submit">I'm Feeling Lucky</span></a>
        <p class="mt-5 mb-3 text-muted">Popular Artists:<br/>
        <?php
          $popartists = getPopularArtists(10);
          $printArtists = "";
          for($i = 1; $i < sizeof($popartists); $i++) {
              $printArtists .= "<a href='search.php?q=".str_replace(" ", "+", $popartists[$i])."'>".$popartists[$i]."</a>, ";
          }
          echo $printArtists;
          
          ?>
        </form>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body
</html>