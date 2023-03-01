<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
  if(file_exists(__DIR__.'/class/' . $class . '.class.php')) include __DIR__.'/class/' . $class . '.class.php';
});

$db = new Database();

if(isset($_POST) && !empty($_POST)){
  if($_POST['id']) $isUp = $db->updateEchouage();
  else $isAdd = $db->addEchouage();
}

if(isset($_GET['id'])) {
  $echouage = $db->getOneEchouage($_GET['id']);
}

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
      <h1 class="fw-bolder">Déclarer l'échouage d'un mammifère marin</h1>
    </div>
  </header>

  <section class="bg-light" id="echouages">
    <div class="container px-4">
      <div class="row">
        <div class="col-8">
          <h3>Déclaration</h3>
          <?php if(isset($isAdd) && $isAdd) : ?>
            <div class="alert alert-danger">
              <p>Ajout effectué !</p>
            </div>
          <?php endif; ?>
          <?php if(isset($isUp) && $isUp) : ?>
            <div class="alert alert-danger">
              <p>Fiche modifiée !</p>
            </div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label for="espece">Espèce</label>
              <select class="form-select" aria-label="Chosisir une espèce" name="espece">
                <option value="">Espèce</option>
                <?php
                $especesByType = $db->getEspecesByType();
                foreach ($especesByType as $espece) : ?>
                  <option value="<?php echo $espece->getEspece(); ?>" <?php echo $espece->getEspece() == $echouage->espece ? 'selected="selected"': ''; ?>><?php echo $espece->getEspece(); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <labelclass="form-control"  for="nombre">Nombre</label>
              <input class="form-control" type="number" name="nombre" placeholder="Veuillez indiquer le nombre de mamifères échoués" value="<?php echo isset($echouage->nombre) ? $echouage->nombre: ''; ?>" />
            </div>
            <div class="mb-3">
              <label for="date">Date</label>
              <input class="form-control" type="text" name="date" placeholder="Veuillez indiquer seulement l'année. Ex : 2023" value="<?php echo isset($echouage->date) ? $echouage->date: ''; ?>" />
            </div>
            <div class="mb-3">
              <label for="zone">Zone</label>
              <select class="form-select" aria-label="Chosisir une zone" name="zone">
                <option selected value="">Zone</option>

                <?php
                $zonesEchouage = $db->getZonesEchouage();
                foreach ($zonesEchouage as $zone) : ?>
                  <option value="<?php echo $zone->getZone(); ?>" <?php echo $zone->getZone() == $echouage->zone ? 'selected="selected"': ''; ?>><?php echo $zone->getZone(); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <?php if(isset($_GET['id'])) : ?>
              <input type="hidden" name="id" value="<?php echo $echouage->id; ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Envoyer</button>
          </form>
        </div>
        <div class="col-4">
        <div class="alert alert-secondary">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos sequi quaerat cum. Architecto velit nihil, rerum nulla ad odio corporis sapiente labore aspernatur quasi eligendi tenetur amet. Voluptatum, similique quasi.</p>
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
