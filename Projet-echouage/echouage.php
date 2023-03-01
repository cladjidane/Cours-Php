<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
  if(file_exists(__DIR__.'/class/' . $class . '.class.php')) include __DIR__.'/class/' . $class . '.class.php';
});

include(__DIR__.'/content.php');

$db = new Database();
$echouage = $db->getOneEchouage($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CIR2 - Détails échouage</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico"><!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="/css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container px-4"><a class="navbar-brand" href="/">ECHOUAGE</a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="#echouage">Liste des échouages</a></li>
        </ul>
      </div>
    </div>
  </nav><!-- Header-->
  <header class="bg-primary bg-gradient text-white">
    <div class="container px-4 text-center">
      <h1 class="fw-bolder"><?php echo $echouage->espece;?></h1>
      <a href="echouage-form.php" class="mt-2 btn btn-light">Déclarer un échouage</a>
    </div>
  </header>

  <section class="bg-light" id="echouages">
    <div class="container px-4">
      <div class="row">
        <div class="col-8">
          <div class="alert alert-primary">
            <h5>Zone : <?php echo $echouage->zone;?></h5>
            <h5>Année : <?php echo $echouage->date;?></h5>
          </div>
          <div class="p-3">
            <h3><?php echo $echouage->espece;?></h3>

            <?php
              $words = explode(' ', $echouage->espece);
              $results = array();
              foreach ($words as $key => $word) {
                if(strlen($word) > 3 && $results == null) {
                  $results = preg_grep('/'.$word.'/i', $contentCommon);
                }
              }
            ?>

            <?php if(!empty($results)) : ?>
              <?php foreach ($results as $key => $value) : ?>
                <h4>Description <?php echo $key+1; ?></h4>
                <p><?php echo $value; ?></p>
              <?php endforeach; ?>
            <?php else : ?>
              <p>Aucune description pour cette espèce</p>
            <?php endif; ?>

          </div>
        </div>
        <div class="col-4">
        <div class="alert alert-secondary">
          <?php echo getImages($echouage->espece); ?>
        </div>
      </div>
    </div>
  </section><!-- Contact section-->


  <footer class="py-5 bg-dark">
    <div class="container px-4">
      <p class="m-0 text-center text-white">Copyright &copy; CIR2 2022</p>
    </div>
  </footer><!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script><!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>
