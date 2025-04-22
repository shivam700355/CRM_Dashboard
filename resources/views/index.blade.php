<!DOCTYPE html>
<html lang="en">
<!-- =======================================================
  * Name: Chandan
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * URL: #
  ======================================================== -->

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <!-- <link href="assets1/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets1/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets1/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets1/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets1/css/style.css" rel="stylesheet">
 

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
  $(document).ready(function() {
    // Enable Carousel Auto-Cycle
    $('#carouselExample').carousel({
      interval: 4000 // Time in milliseconds (5 seconds)
    });
  });
</script>

<body>
  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:info@upicon.in">info@upicon.in</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>0522 – 423-3727</span></i>
      </div>
      <div class="cta d-none d-md-flex align-items-center">
        <a href="#about" class="scrollto">Get Started</a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">
        <h1><a href="#">UPICON DASHBOARD</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">About</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">About</a></li> -->
          <li><a class="nav-link scrollto" href="#services">Project</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="{{route('login')}}">Training</a></li>
          <!-- <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
          <li><a href="blog.html">Blog</a></li> -->
          <!-- <li><a class="nav-link scrollto" href="#faq">FAQ</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <!-- <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container" data-aos="fade-in">
      <h1>Welcome to UPICON Dashboard</h1>
      <h2>We are a team of skilled individuals dedicated to helping your business achieve its goals.</h2>
      <div class="d-flex align-items-center">
        <i class="bx bxs-right-arrow-alt get-started-icon"></i>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
      </div>
    </div>
  </section>End Hero -->

  <main id="main">
    <!-- ======= Why Us Section ======= -->
    <section class="mt-5">
      <div id="carouselExample" class="carousel slide" data-interval="5000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <div class="text">
                    <h1>We Provide <span>Medical</span> Services That You Can <span>Trust!</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl
                      pellentesque, faucibus libero eu, gravida quam.</p>
                    <div class="button">
                      <a href="#" class="btn btn-primary">Get Appointment</a>
                      <a href="#" class="btn btn-secondary">Learn More</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style="background-image:url('img/pexels-andrea-piacquadio-845451.jpg');background-size: cover;">
                  <!-- Empty div for background image -->
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <!-- Repeat the structure for additional slides -->
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <div class="text">
                    <h1>Lorem, ipsum. <span>Medical</span> Services That You Can <span>Trust!</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl
                      pellentesque, faucibus libero eu, gravida quam.</p>
                    <div class="button">
                      <a href="#" class="btn btn-primary">Get Appointment</a>
                      <a href="#" class="btn btn-secondary">About Us</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style="background-image:url('img/pexels-andrea-piacquadio-927022.jpg');background-size: cover;">
                  <!-- Empty div for background image -->
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <!-- Repeat the structure for additional slides -->
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <div class="text">
                    <h1>Lorem, ipsum. <span>Medical</span> Services That You Can <span>Trust!</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl
                      pellentesque, faucibus libero eu, gravida quam.</p>
                    <div class="button">
                      <a href="#" class="btn btn-primary">Get Appointment</a>
                      <a href="#" class="btn btn-secondary">About Us</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style="background-image:url('img/pexels-andrea-piacquadio-927451.jpg');background-size: cover;">
                  <!-- Empty div for background image -->
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <!-- Repeat the structure for additional slides -->
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <div class="text">
                    <h1>Lorem, ipsum. <span>Medical</span> Services That You Can <span>Trust!</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl
                      pellentesque, faucibus libero eu, gravida quam.</p>
                    <div class="button">
                      <a href="#" class="btn btn-primary">Get Appointment</a>
                      <a href="#" class="btn btn-secondary">About Us</a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6" style="background-image:url('img/pexels-fox-1595385.jpg');background-size: cover;">
                  <!-- Empty div for background image -->
                </div>
              </div>
            </div>
          </div>

          <!-- Repeat this block for each additional slide -->

        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>

    <!-- <section id="why-us" class="why-us">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5" data-aos="fade-up">
            <div class="content">
              <h3>Why Choose UPICON for your company</h3>
              <p>At UPICON, we stand out as your ideal partner for several compelling reasons: When you choose UPICON, you're not just selecting a service provider – you're choosing a strategic ally dedicated to propelling your company towards excellence.</p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-lg-7 d-flex">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon-box mt-4 mt-xl-0">
                  <i class="bx bx-receipt"></i>
                  <h4>Expertise that Drives Results</h4>
                
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Innovation at the Core</h4>
                  
                </div>
                <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Collaborative Partnership</h4>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <section id="services" class="services section-bg">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>Projects</h2>

        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6" data-aos="fade-up">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="https://gis.upicondashboard.in/">Geo TAGGING</a></h4>
              <p class="description">The geo-tagging for surveying power looms in U.P. revolutionizes the monitoring process. By capturing geolocation data, it provides precise locations of power looms.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="https://upmissionshakti.in/">Mission Shakti</a></h4>
              <p class="description">Mission Shakti 2.0 is a visionary initiative with a clear objective: to raise awareness about safety and security, establish a secure environment for women, and empower.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="https://upmsmemart.com/">UPMSME MART</a></h4>
              <p class="description">UP MSME Mart aims at offering the choicest range of traditional gifting solutions sourced directly from the extremely talented artisans and craftsmen of UP.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-binoculars"></i></div>
              <h4 class="title"><a href="#">DAYLOGS</a></h4>
              <p class="description">DayLogs is an attendance management app developed by UPICON. it's helps enterprises with distributed workforces record & track attendance of their employees or agents.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-brightness-high"></i></div>
              <h4 class="title"><a href="http://rozzgaar.in/login">CRM - Banking</a></h4>
              <p class="description">Our CRM (Customer Relationship Management) system is specifically designed to provide seamless support to banking correspondents (BC) across India.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-calendar4-week"></i></div>
              <h4 class="title"><a href="#">V-CREDIL</a></h4>
              <p class="description">The V-CREDIL is a transformative Payment & Loan Processing Application designed specifically for rural communities providing convenient & accessible financial services.</p>
            </div>
          </div>
        </div>
      </div>
    </section>End Services Section


    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title">
          <h2 data-aos="fade-up">Portfolio</h2>

        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-web">Web</li>

            </ul>
          </div>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/daylogs.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Daylogs</h4>
              <p>App</p>
              <a href="assets/img/portfolio/daylogs.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 portfolio-item filter-web">
            <img src="assets/img/portfolio/mission_shakti.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Mission Shakti</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/mission_shakti.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="https://upmissionshakti.in/" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/mission_shakti.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Mission Shakti</h4>
              <p>App</p>
              <a href="assets/img/portfolio/mission_shakti.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Magazine 2</h4>
              <p>Magazine</p>
              <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div> -->

          <div class="col-lg-2 col-md-3 portfolio-item filter-web">
            <img src="assets/img/portfolio/gis.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Gis Tagging</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/gis.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/gis.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Gis Tagging</h4>
              <p>App</p>
              <a href="assets/img/portfolio/gis.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <!-- <div class="col-lg-2 col-md-3 portfolio-item filter-card">
            <img src="assets/img/portfolio/credel.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Magazine 1</h4>
              <p>Magazine</p>
              <a href="assets/img/portfolio/credel.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div> -->
          <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Magazine 3</h4>
              <p>Magazine</p>
              <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div> -->

          <div class="col-lg-2 col-md-3 portfolio-item filter-web">
            <img src="assets/img/portfolio/msmemart.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>UP MSME MART</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/msmemart.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/msmemart.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>UP MSME MART</h4>
              <p>App</p>
              <a href="assets/img/portfolio/msmemart.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/vsurvey.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>V-SURVEY</h4>
              <p>App</p>
              <a href="assets/img/portfolio/vsurvey.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 portfolio-item filter-web">
            <img src="assets/img/portfolio/crm.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Banking CRM</h4>
              <p>Web</p>
              <a href="assets/img/portfolio/crm.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 portfolio-item filter-app">
            <img src="assets/img/portfolio/crm.png" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>CRM</h4>
              <p>App</p>
              <a href="assets/img/portfolio/crm.png" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= F.A.Q Section ======= -->
    <!--<section id="faq" class="faq section-bg">
      <div class="container">
        <div class="section-title">
          <h2 data-aos="fade-up">F.A.Q</h2>
          <p data-aos="fade-up">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>
            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>--><!-- End F.A.Q Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>UPICON DASHBOARD</h4>
            <div class="social-links text-lg-right pt-3 pt-lg-0">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
            <br><br>
            <p>
              <strong>Phone:</strong> 0522 – 423-3727<br>
              <strong>Email:</strong> info@upicon.in<br>
            </p>
          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <!-- <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li> -->
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Projects</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Portfolio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Faq's</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Service</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">App Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Banking</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Corporate Address</h4>
            <p>Summit Building, Gomti Nagar, Lucknow<br>Uttar Pradesh<br></p>
            <h4>Registered Address</h4>
            <p>Kabir Bhawan, G.T. Road, Kanpur<br>Uttar Pradesh<br></p>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-lg-flex py-4">
      <div class="me-lg-auto text-center text-lg-start">
        <div class="copyright">
          &copy; Copyright <strong><span>UPICON DASHBOARD - </span></strong>All Rights Reserved.
        </div>
      </div>
      <!-- <div class="social-links text-center text-lg-right pt-3 pt-lg-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="assets1/vendor/aos/aos.js"></script>
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets1/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets1/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>
</body>

</html>