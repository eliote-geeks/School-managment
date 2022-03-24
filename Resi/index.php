<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');

?>
<?php
$mati = $bdd->query("SELECT * FROM matiere ORDER BY id DESC");
$menu = $bdd->query("SELECT * FROM menu");
 $social = $bdd->query("SELECT * FROM social ORDER BY id DESC"); 
 $setting = $bdd->query("SELECT * FROM settings");
 $check = $bdd->query("SELECT * FROM check_up");
 $s = $setting->fetch();

 if (isset($_REQUEST['deco'])) {
   $_SESSION = array();
   session_destroy();
   header('Location:index.php');
 }
 ?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Centre</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">CFPAM </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!--  <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="politique.php">Privacy Politicy</a></li>
          <?php while($cm = $menu->fetch()){ ?>
          <li><a class="nav-link scrollto" href="#services"><?=$cm['nom']?></a></li>
          <?php } ?>
          <li class="dropdown"><a href="#"><span>Connexion</span> <i class="bi bi-chevron-down"></i></a>
            <ul>

            <?php if($s['affiche_etudiant'] == 1){ ?>
            <li><a class="nav-link scrollto" href="http://localhost/niceAdmin/profil/connexion.php">Espace etudiant</a></li>        
            <?php } ?>  

            <?php if($s['affiche_enseignant'] == 1){ ?>      
            <li><a class="nav-link scrollto " href="http://localhost/niceAdmin/enseignant/learn.php">Espace enseignant</a></li>  
            <?php } ?>  

            <?php if($s['affiche_admin'] == 1){ ?>
             <li><a class="nav-link scrollto" href="http://localhost/niceAdmin/login.php">Administrateur</a></li> <?php } ?>

            <?php if($s['affiche_admin'] == 0){ ?>
             <li><a class="nav-link scrollto" href="">Vous ne pouvez pas vous connecter..</a></li> <?php } ?>
             <?php if(isset($_SESSION['id'])){ ?>
              <li><a class="nav-link scrollto" href="index.?deco=deco">Deconnexion</a></li>
             <?php } ?>

            </ul>
          </li>
          <li><a class="getstarted scrollto" href="http://localhost/niceAdmin/profil/menbre.php">S'inscrire</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-2 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1><?=$s['titre'] ?></h1>
          <ul>
            <?php while($c = $check->fetch()){ ?>
            <li><i class="ri-check-line"></i><?= $c['nom']?></li>
            <?php } ?>
          </ul>
          <div class="mt-3">
            <a href="about.php" class="btn-get-started scrollto">En savoir plus</a>
          <?php if($s['affiche_admin'] == 0){ ?>
             <li><a class="btn btn-quote" href="">Vous ne pouvez pas vous connecter..</a></li>
           <?php }else{ ?>
            <a href="connexion.php" class="btn-get-quote">Connexion</a>
          <?php } ?>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="assets/img/services.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

<main id="main">
      <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$s['n_1'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><?=$s['n_name1']?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-sort-numeric-up-alt"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$s['n_2'] ?>" data-purecounter-duration="3" class="purecounter"></span>
              <p><?=$s['n_name2']?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-sun"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$s['n_3'] ?>" data-purecounter-duration="3" class="purecounter"></span>
              <p><?=$s['n_name3']?></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?=$s['n_4'] ?>" data-purecounter-duration="3" class="purecounter"></span>
              <p><?=$s['n_name4']?></p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->


</main>
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>CFPAM</h3>
            <p>
              <?=$s['localisation']?><br>
              Cameroun <br><br>
              <strong>Phone:</strong> <?=$s['phone']?><br>
              <strong>Email:</strong><?=$s['email']?><br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <?php while($m = $menu->fetch()){ ?>
              <li><i class="bx bx-chevron-right"></i> <a href="#"><?= $m['nom']?></a></li>
                <?php } ?>
              <li><i class="bx bx-chevron-right"></i> <a href="politique.php">Termes et politiques de confidentialites du CFPAM</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Nos specialites</h4>
            <ul>
              <?php while($m = $mati->fetch()){ ?>
              <li><i class="bx bx-chevron-right"></i> <a href="#"><?= $m['matiere']?></a></li>
              <?php } ?>
            </ul>
          </div>
<?php if($s['newsletter'] == 1){ ?>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Joindre notre courrier</h4>
            <p>Laisser nous votre addresse email pour recevoir plus d'informations</p>
            <form id="services" action="" method="post">
              <input type="email" name="email"><input type="submit" value="Souscrire">
            </form>
          </div>
        <?php } ?>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy;<?= $s['copy']?>
        </div>
        <div class="credits">
           <a href="https://blog.com/">Paul</a>
        </div>
      </div>
<!--       <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/pg/CFPAM/posts/" class="facebook"><i class="bx bxl-facebook"></i></a>  
        <a href="#" class="google-plus"><i class="bx bxl-yahoo"></i></a> -->
        <?php while($logo = $social->fetch()){ ?>  
         <a style="font-size: 39px;" href="<?=$logo['liens'] ?>" class="<?= $logo['nom']?>"><i class="bx bxl-<?=$logo['nom']?>"></i></a>
         <?php }?>
     </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>