<?php
include("../Assets/Connection/Connection.php");
include("SessionValidation.php");

$sel="select * from tbl_user where user_id='".$_SESSION['uid']."'";
$res=$Conn->query($sel);
$data=$res->fetch_assoc();

// Total Labs
$selLab = "SELECT count(*) as lab_count FROM tbl_lab WHERE lab_status = 1";
$resLab = $Conn->query($selLab);
$dataLab = $resLab->fetch_assoc();
$labCount = $dataLab['lab_count'];
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

  <!-- Font Style, Heading color -->
    
    <style>
      .he{
          color: #ffffffff;
        }
    </style>
  
  <!-- /Style -->
  

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
        <a href="Homepage.php" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <img src="../Assets/Templates/Main/assets/img/L-logo.png" alt="">
          <h1 class="sitename">LabFinder</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="Homepage.php" class="active">Home<br></a></li>
            <li><a href="#about">About</a></li>
            <li><a href="MyAppointments.php">View Appointments</a></li>
            <li><a href="Ads.php">Advertisement</a></li>
            <li><a href="Lablist.php">Lab list</a></li>
            <!-- <li class="complaint"><a href="#"><span>Complaint</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="">Complaint</a></li> -->
                <li class="dropdown"><a><span>Complaint</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                    <li><a href="Complaint.php">Register Complaint</a></li>
                    <li><a href="ComplaintView.php">View Complaints</a></li>
                  </ul>
                </li>   
              <!-- </ul> -->
            </li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown"><a class="cta-btn d-none d-sm-block"><span><?php echo $data['user_name']?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="Myprofile.php">Profile</a></li>
                <li><a href="../Guest/Logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- <a class="cta-btn d-none d-sm-block" href=""><?php echo $data['user_name']?></a> -->

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="../Assets/Templates/Main/assets/img/lab/lab2.jpeg" alt="" data-aos="fade-in">

      <div class="container position-relative">  

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2 class="he">Welcome to LabFinder</h2>
          <!-- <p>We are team of talented designers making websites with Bootstrap</p> -->
        </div><!-- End Welcome -->

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Why Choose LabFinder?</h3>
              <p>
                LabFinder was founded on the belief that health information should be transparent and accessible. Our vision is to be the central hub where every patient can quickly and confidently find the best laboratory option that fits their medical and financial needs. We're not just a directory; we're your partner in preventative and diagnostic health.
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-award"></i>
                    <h4>Certified Lab Quality</h4>
                    <p>Verified, Accredited Labs We partner exclusively with certified, high-quality diagnostic centers. Book with confidence knowing your results will be accurate and reliable.</p>
                  </div>
                </div><!-- End Icon Box -->
                
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-calendar-check"></i>
                    <h4>Book Appointments Quickly</h4>
                    <p>Instant, Easy Booking Find labs by location, test type, or availability. Secure your appointment in just three clicks and receive immediate confirmation.</p>
                  </div>
                </div><!-- End Icon Box -->
                
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-file-earmark-medical"></i>
                    <h4>Fast Digital Reports</h4>
                    <p>Access your secure results online instantly without returning to the lab. View, store, and share reports directly from your device.</p>
                  </div>
                </div><!-- End Icon Box -->
                
              </div>
            </div>
          </div>
        </div><!-- End  Content-->
        
      </div>
      
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="../Assets/Templates/Main/assets/img/L.jpg" class="img-fluid" alt="">
            
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>About Us</h3>
            <p>
              Our mission is simple: to be the most trusted and easy-to-use resource for connecting patients with certified diagnostic labs. We empower you to effortlessly search, compare, and book the lab tests you need, giving you clarity and control over your healthcare choices.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-shield-halved"></i>
                <div>
                  <h5>Unwavering Accuracy and Trust</h5>
                  <p>We are committed to partnering only with accredited and high-quality laboratories. </p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <div>
                  <h5>Transparent Pricing and Value</h5>
                  <p>See self-pay and insurance prices upfront for best value.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-clock-rotate-left"></i>
                <div>
                  <h5>Maximum Convenience and Speed</h5>
                  <p>Instant online booking and secure digital results maximize your convenience</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <!-- <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user-doctor"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
              <p>Doctors</p>
            </div>
          </div>End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-regular fa-hospital"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>Departments</p>
            </div>
          </div>End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-flask"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $labCount; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Research Labs</p>
            </div>
          </div><!-- End Stats Item -->

          <!-- <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-award"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
              <p>Awards</p>
            </div>
          </div>End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->


    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
      <h3 class="he3" align="center"><u>Feedback</u></h3>
      <br>

      <div class="container">

        <div class="row align-items-center">

          <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
            <h3>Testimonials</h3>
            <p>
              LabFinder is an absolute game-changer for managing my family's health. I was able to find a CLIA-certified lab near my office, compare the self-pay price right there on the screen, and book an appointment for the very next day.
            </p>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
              <div class="swiper-wrapper">

                <?php
                  // This query joins the feedback and user tables to get the necessary data.
                  $selQry = "SELECT * FROM tbl_feedback f INNER JOIN tbl_user u ON u.user_id = f.user_id";
                  $res = $Conn->query($selQry);
                           
                  // The loop will create a new testimonial slide for each feedback entry.
                  while ($data = $res->fetch_assoc()) {
                ?>
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <div class="d-flex">
                            <img src="../Assets/Files/User/Photo/<?php echo $data['user_photo']; ?>" class="testimonial-img flex-shrink-0" alt="">
                            <div>
                                <h3><?php echo $data['user_name']; ?></h3>
                                <h4>User</h4>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>
                                <?php echo $data['feedback_content']; ?>
                            </span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div>
                <?php
                  }
                ?>

              </div>
              
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </div>

      </div>

      

    </section><!-- /Testimonials Section -->

    <!-- Feedback Section -->
      <br>
      <?php
        include("Feedback.php"); 
                
      ?>

    <!-- /Feedback Section -->

    
    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/1.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/1.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/g-2.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/g-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/g-3.jpg" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/g-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/4.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/4.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/5.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/5.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/6.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/6.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/7.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/7.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="../Assets/Templates/Main/assets/img/gallery/8.png" class="glightbox" data-gallery="images-gallery">
                <img src="../Assets/Templates/Main/assets/img/gallery/8.png" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8942891443185!2d76.56535447450881!3d10.025581572595074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b07e73efa8a2e13%3A0x8b9b03abc39dbf5!2sILAHIA%20College%20of%20Arts%20and%20Science%2C%20Muvattupuzha%20686673!5e0!3m2!1sen!2sin!4v1759939130551!5m2!1sen!2sin" width="100%" height="370px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <!-- <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Location</h3>
                <p>Pezhakkappilly, East Paipra Road, Muvattupuzha, Kerala 686674</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+91 7012054735, +91 9207806601</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=labfinder@gmail.com" target="_blank" style="color: #2a2a2ac6">labfinder@gmail.com</a>
              </div>
            </div><!-- End Info Item -->
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="HomePage.php" class="logo d-flex align-items-center me-auto">
            <img src="../Assets/Templates/Main/assets/img/L-logo.png" alt="">
            <span class="sitename">LabFinder</span>
          </a>
          <div class="social-links d-none d-md-flex align-items-center">
            <a href="https://x.com/YADUCZ?t=nHrE_jpoAUk1A87YDoEofQ&s=09" target="_blank" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.facebook.com/share/1GHeRDEXF3/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/n.av_i?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/navi-sooraj" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="HomePage.php#about">About us</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li>Lab and Testing Center Locator</li>
            <li>Appointment Scheduling</li>
            <li>Secure Patient Portal</li>
            <li>Listing & Profile Management</li>
            <li>Result Delivery</li>
          </ul>
        </div>

        <!-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div> -->

      </div>
    </div>

    <!-- <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
      <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
      </div> -->
    <!-- </div> -->

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../Assets/Templates/Main/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../Assets/Templates/Main/assets/vendor/php-email-form/validate.js"></script>
  <script src="../Assets/Templates/Main/assets/vendor/aos/aos.js"></script>
  <script src="../Assets/Templates/Main/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../Assets/Templates/Main/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../Assets/Templates/Main/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="../Assets/Templates/Main/assets/js/main.js"></script>

</body>

</html>