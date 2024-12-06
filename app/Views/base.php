<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
  <?php

            use Config\Contact;

 $this->renderSection('title') ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="keywords" content="ecommerce,fashion,store">

  <meta 
   name="description" 
   content="Création, vente de chapeaux, sacs et bijoux au cameroun et yaoundé en particulier."
  >

  <!-- BOOTSTRAP  -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-reboot.min.css" />
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-utilities.min.css" />
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">

  <!-- FONT AWESOME  -->
  <link rel="stylesheet" href="/assets/vendor/fontawesome-free-6.5.2/css/all.min.css">

  <!-- OWN CSS  -->
  <link rel="stylesheet" type="text/css" href="/assets/css/vendor.css">
  <link rel="stylesheet" href="/assets/vendor/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
  <link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Marcellus&display=swap"
    rel="stylesheet">
</head>

<body class="homepage">
  <?= $this->include('Parts/svg-info') ?>
  <?= $this->include('Parts/preloader') ?>
  <?= $this->include('Parts/admin-navbar') ?>
  <?= $this->include('Parts/navbar') ?>

  <?= $this->renderSection('content') ?>

  <?= $this->include('Parts/footer') ?>

  <?= $this->include('Parts/call-us-btn') ?>

  <?= $this->include('Parts/cookies-info') ?>
  <?= $this->include('Parts/enlarge-wall') ?>

  <script src="/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/assets/js/plugins.js"></script>
  <script src="/assets/js/SmoothScroll.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets/vendor/validate.js/validate.min.js"></script>

  <script src="/assets/js/script.min.js"></script>
  <script src="/assets/js/main.js"></script>

  <?= $this->renderSection('script') ?>
</body>

</html>