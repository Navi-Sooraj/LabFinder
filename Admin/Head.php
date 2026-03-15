<?php
include("SessionValidation.php");

?>  

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LabFinder Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../Assets/Templates/Admin/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../Assets/Templates/Admin/assets/images/L-miniA.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a href="HomePageA.php">
          <img src="../Assets/Templates/Admin/assets/images/L-miniA.png" alt="logo" />
          <b style="color: #ffffffff;";>LabFinder</b>      
        </a>
        <a class="sidebar-brand brand-logo-mini" href="HomePageA.php"><img
            src="../Assets/Templates/Admin/assets/images/L-miniA.png" alt="logo" /></a>
      </div>
      <ul class="nav">

        <!-- <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li> -->
        <li class="nav-item menu-items">
          <a class="nav-link" href="HomePageA.php">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-image-multiple"></i>
            </span>
            <span class="menu-title">Advertisement</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="Advertisement.php">Add Advertisement</a></li>
              <li class="nav-item"> <a class="nav-link" href="Ads.php">Ads Page</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="LabList.php">
            <span class="menu-icon">
              <i class="mdi mdi-shield-check"></i>
            </span>
            <span class="menu-title">Lab Verification</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="ComplaintViewA.php">
            <span class="menu-icon">
              <i class="mdi mdi-emoticon-sad-outline"></i>
            </span>
            <span class="menu-title">View Complaints</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="FeedbackViewA.php">
            <span class="menu-icon">
              <i class="mdi mdi-star-outline"></i>
            </span>
            <span class="menu-title">View Feedback</span>
          </a>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-map-marker"></i>
            </span>
            <span class="menu-title">Location</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="District.php">District</a></li>
              <li class="nav-item"> <a class="nav-link" href="Place.php">Place</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="Days.php">
            <span class="menu-icon">
              <i class="mdi mdi-calendar-plus"></i>
            </span>
            <span class="menu-title">Add Days</span>
          </a>
        </li>
       
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="HomePageA.php"><img
              src="../Assets/Templates/Admin/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        
        <?php
        $SelQry = "SELECT * FROM tbl_admin WHERE admin_id='".$_SESSION['aid']."'";
        $res=$Conn->query($SelQry);
        $data=$res->fetch_assoc();

        ?>

        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">




            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="../Assets/Files/Admin/Photo/<?php echo $data['admin_photo'] ?>" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $data['admin_name'] ?></p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="profileDropdown">


                <div class="dropdown-divider"></div>
                <a href="../Guest/Logout.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>

              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
      
      <br>
      <br>
