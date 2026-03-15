<?php
include("../Assets/Connection/Connection.php");
include("SessionValidation.php");


$selQry="select * from tbl_lab where lab_id='".$_SESSION['lid']."'";
$res=$Conn->query($selQry);
$data=$res->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LabFinder</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../Assets/Templates/Main/assets/img/L-mini.png" rel="icon">
  <link href="../Assets/Templates/Main/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../Assets/Templates/Main/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Assets/Templates/Main/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../Assets/Templates/Main/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../Assets/Templates/Main/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../Assets/Templates/Main/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../Assets/Templates/Main/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../Assets/Templates/Main/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="https://mail.google.com/mail/?view=cm&fs=1&to=labfinder@gmail.com" target="_blank">labfinder@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+91 7012054735, +91 9207806601</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://x.com/YADUCZ?t=nHrE_jpoAUk1A87YDoEofQ&s=09" target="_blank" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://www.facebook.com/share/1GHeRDEXF3/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/n.av_i?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/in/navi-sooraj" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="HomePageL.php" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="../Assets/Templates/Main/assets/img/L-logo.png" alt="">
          <h1 class="sitename">LabFinder</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="HomePageL.php" class="active">Home<br></a></li>
            <li><a href="HomePageL.php#about" >About</a></li>
            <li><a href="ViewAppointment.php">View Appointments</a></li>
            <li class="dropdown"><a><span>Advertisement</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="Advertisement.php">Add Advertisement</a></li>
                <li><a href="Ads.php">Ads Page</a></li>
              </ul>
            </li>
            <li><a href="ComplaintViewL.php">View Complaints</a></li>
            <li><a href="Service.php">Services</a></li>
            <li><a href="Timing.php">Timing</a></li>   
            <li><a href="HomePageL.php#contact">Contact</a></li>
            <li class="dropdown"><a class="cta-btn d-none d-sm-block"><span><?php echo $data['lab_name']?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="MyProfile.php">Profile</a></li>
                <li><a href="../Guest/Logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <main class="main">

  <br>
  <br>
  <br>