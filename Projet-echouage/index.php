<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
  include 'class/' . $class . '.class.php';
});

$db = new Database('cir2', 'cir2', 'cir2', 'localhost');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CIR2</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico"><!-- Core theme CSS (includes Bootstrap)-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="/css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container px-4"><a class="navbar-brand" href="#page-top">ECHOUAGE</a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
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
      <h1 class="fw-bolder">Echouage de cétacés</h1>
      <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <br />At eaque maxime ratione perferendis hic totam modi.</p><a class="btn btn-lg btn-light" href="#echouage">Liste</a>
    </div>
  </header>

  <section class="bg-light" id="echouage">
    <div class="container px-4">
      <div class="row gx-4 justify-content-center">
        <div class="col-lg-8">
          <h2>Liste échouages</h2>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>

          <form class="row g-3" method="POST">

            <div class="col-auto">
              <select class="form-select" aria-label="Choisir une date" name="date">
                <option selected value="">Année</option>
                <?php for ($i = 1990; $i < 2020; $i++) : ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>

            <div class="col-auto">
              <select class="form-select" aria-label="Chosisir une espèce" name="espece">
                <option selected value="">Espèce</option>
                <?php
                $especesByType = $db->getEspecesByType();
                foreach ($especesByType as $espece) : ?>
                  <option value="<?php echo $espece->getEspece(); ?>"><?php echo $espece->getEspece(); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-auto">
              <select class="form-select" aria-label="Chosisir une zone" name="zone">
                <option selected value="">Zone</option>

                <?php
                $zonesEchouage = $db->getZonesEchouage();
                foreach ($zonesEchouage as $zone) : ?>
                  <option value="<?php echo $zone->getZone(); ?>"><?php echo $zone->getZone(); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-auto ms-auto me-0">
              <button type="submit" class="btn btn-primary mb-3">Filtrer</button>
            </div>
          </form>

          <table class="table table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col" class="id">N°</th>
                <th scope="col" class="Date">Date</th>
                <th scope="col" class="label">Espece</th>
                <th scope="col" class="label">Zone</th>
                <th scope="col" class="label">Nombre</th>
              </tr>
            </thead>
            <tbody style="border: 1px solid black;">

              <?php
              $echouages = $db->getEchouages($_POST);
              foreach ($echouages as $echouage) : ?>
                <tr style="border: 1px solid black;">
                  <td class="id"><?php echo $echouage->getId(); ?></td>
                  <td class="id"><?php echo $echouage->getDate(); ?></td>
                  <td class="label"><?php echo $echouage->getEspece(); ?></td>
                  <td class="label"><?php echo $echouage->getZone(); ?></td>
                  <td class="label"><?php echo $echouage->getNombre(); ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>

            <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#"><<</a></li>

              <?php $nbPages = $db->getTotalPages(); ?>
              <?php for ($i=0; $i < $nbPages; $i++) : ?>
              <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>#echouages"><?php echo $i+1; ?></a></li>
              <?php endfor; ?>

              <li class="page-item"><a class="page-link" href="#">>></a></li>
            </ul>
            </nav>

        </div>
      </div>
    </div>
  </section><!-- Contact section-->


  <footer class="py-5 bg-dark">
    <div class="container px-4">
      <p class="m-0 text-center text-white">Copyright &copy; CIR2 2023</p>
    </div>
  </footer><!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script><!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>