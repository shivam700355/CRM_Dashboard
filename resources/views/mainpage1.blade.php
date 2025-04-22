<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DAYLOGS - Human Resourse Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link rel="icon" type="image/png" href="{{ url('assets/img/site.png') }}">
  <link href="{{ url('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="{{ url('assets/css/all.css') }}" rel="stylesheet">
</head>
 
<body class="index-page" id="home">
<div class="overlay"></div>
<!-- Preloader -->
<div id="preloader">
  <div></div>
  <div></div>
  <div></div>
  <div></div>
</div>
<!-- ======= Header ======= -->
<header class="header d-flex align-items-center sticky-top" id="header">
  <div class="container-fluid d-flex align-items-center justify-content-between pe-lg-5 ps-lg-5 pe-2 ps-2"> <a class="logo d-flex align-items-center me-auto me-xl-0" href="{{ route('mainpage') }}"><img src="{{ url('assets/img/black_bg.png') }}"  class="logo1" alt="" title=""> <img src="{{ url('assets/img/white_bg.png') }}" class="logo2" alt="" title=""></a>
    <!-- Nav Menu -->
    <nav id="navmenu" class="navmenu">
      <div class="menu-3-line">
        <button id="sidebarCollapse" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="bg-primary border-0"><img src="{{ url('assets/img/menu-3-line.svg') }}" alt="" title=""></button>
      </div>
    </nav>
    <!-- End Nav Menu -->
  </div>
</header>
<!-- End Header -->
<main id="main" class="wrapper">
  <!-- Sidebar  -->
  <nav id="sidebar">
    <div id="dismiss"><i class="bi bi-arrow-left"></i></div>
    <div class="sidebar-header">
      <h3 class="text-uppercase mb-0 p-0">DAYLOGS</h3>
    </div>
    <ul class="list-unstyled components">
      <!-- <li><a href="#homeSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-bs-toggle"> Home<i class="bi bi-chevron-down text-white position-absolute end-0 me-4"></i></a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
          <li> <a href="#home">Home</a></li>
        </ul>
      </li> -->
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#mobile-app">Mobile App</a></li>
      <li><a href="#trusted-partner">Trusted Partner</a></li>
      <li><a href="#work-flow">Work Flow</a></li>
      <li><a href="#testimonials">Testimonial</a></li>
      <li><a href="#blog">Blog</a></li>
      <li><a href="#contact">Contact</a></li>
      <li><a href="{{ route('login') }}">Login</a></li>
    </ul>
  </nav>
  <section class="slideshow" id="js-header">
    <div class="slideshow__slide js-slider-home-slide is-current" data-slide="1">
      <div class="slideshow__slide-background-parallax background-absolute js-parallax" data-speed="-1" data-position="top" data-target="#js-header">
        <div class="slideshow__slide-background-load-wrap background-absolute">
          <div class="slideshow__slide-background-load background-absolute">
            <div class="slideshow__slide-background-wrap background-absolute">
              <div class="slideshow__slide-background background-absolute">
                <div class="slideshow__slide-image-wrap background-absolute">
                <div class="slideshow__slide-image background-absolute" style="background-image: url('assets/img/banner/three_3.jpg?auto=compress&amp;cs=tinysrgb&amp;h=1080&amp;w=1920');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slideshow__slide-caption">
        <div class="slideshow__slide-caption-text">
          <div class="container container2 js-parallax" data-speed="2" data-position="top" data-target="#js-header">
          <h2>Elevating HR Management</h2>
          <h1 class="slideshow__slide-caption-title">Workforce<span class="text-primary">Solutions</span></h1><br>
          <p>Seamlessly manage & organize all employee information in one secure & centralized location.</p>
          <a class="slideshow__slide-caption-subtitle -load o-hsub -link" href="#"><span class="slideshow__slide-caption-subtitle-label">Read More</span></a></div>
        </div>
      </div>
    </div>
    <div class="slideshow__slide js-slider-home-slide is-next" data-slide="2">
      <div class="slideshow__slide-background-parallax background-absolute js-parallax" data-speed="-1" data-position="top" data-target="#js-header">
        <div class="slideshow__slide-background-load-wrap background-absolute">
          <div class="slideshow__slide-background-load background-absolute">
            <div class="slideshow__slide-background-wrap background-absolute">
              <div class="slideshow__slide-background background-absolute">
                <div class="slideshow__slide-image-wrap background-absolute">
                  <div class="slideshow__slide-image background-absolute" style="background-image: url('assets/img/banner/two_2.jpg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=1080&amp;w=1920');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slideshow__slide-caption">
        <div class="slideshow__slide-caption-text">
          <div class="container container2 js-parallax" data-speed="2" data-position="top" data-target="#js-header">
            <h2>Digital Solution</h2>
            <h1 class="slideshow__slide-caption-title">Attendance <span class="text-primary">Management</span></h1><br>
            <p>Effortlessly track attendance, manage leave requests</p>
            <a class="slideshow__slide-caption-subtitle -load o-hsub -link" href="#"> <span class="slideshow__slide-caption-subtitle-label">Read More</span> </a> </div>
        </div>
      </div>
    </div>
    <div class="slideshow__slide js-slider-home-slide is-prev" data-slide="3">
      <div class="slideshow__slide-background-parallax background-absolute js-parallax" data-speed="-1" data-position="top" data-target="#js-header">
        <div class="slideshow__slide-background-load-wrap background-absolute">
          <div class="slideshow__slide-background-load background-absolute">
            <div class="slideshow__slide-background-wrap background-absolute">
              <div class="slideshow__slide-background background-absolute">
                <div class="slideshow__slide-image-wrap background-absolute">
                  <div class="slideshow__slide-image background-absolute" style="background-image: url('assets/img/banner/one_1.jpg?auto=compress&amp;cs=tinysrgb&amp;h=1080&amp;w=1920');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="slideshow__slide-caption">
        <div class="slideshow__slide-caption-text">
          <div class="container container2 js-parallax" data-speed="2" data-position="top" data-target="#js-header">
            <h2>ABOUT US</h2>
            <h1 class="slideshow__slide-caption-title"><span class="text-primary">Empower.</span> Engage. Evolve</h1><br>
            <p>We believe that a well-organized & engaged workforce is the cornerstone of every successful business.</p>
            <a class="slideshow__slide-caption-subtitle -load o-hsub -link" href="#"> <span class="slideshow__slide-caption-subtitle-label">Read More</span> </a> </div>
        </div>
      </div>
    </div>
    <div class="c-header-home_footer">
      <div class="container container2">
        <div class="c-header-home_controls -nomobile o-button-group">
          <div class="js-parallax is-inview" data-speed="1" data-position="top" data-target="#js-header">
            <button class="o-button -white -square -left js-slider-home-button js-slider-home-prev" type="button"> <span class="o-button_label">
            <svg class="o-button_icon" role="img">
              <use xmlns:xlink="#" xlink:href="#arrow-prev"></use>
            </svg>
            </span> </button>
            <button class="o-button -white -square js-slider-home-button js-slider-home-next" type="button"> <span class="o-button_label">
            <svg class="o-button_icon" role="img">
              <use xmlns:xlink="#" xlink:href="#arrow-next"></use>
            </svg>
            </span> </button>
          </div>
        </div>
      </div>
    </div>
    <svg xmlns="#">
      <symbol viewBox="0 0 18 18" id="arrow-next">
        <path id="arrow-next-arrow.svg" d="M12.6,9L4,17.3L4.7,18l8.5-8.3l0,0L14,9l0,0l-0.7-0.7l0,0L4.7,0L4,0.7L12.6,9z"/>
      </symbol>
      <symbol viewBox="0 0 18 18" id="arrow-prev">
        <path id="arrow-prev-arrow.svg" d="M14,0.7L13.3,0L4.7,8.3l0,0L4,9l0,0l0.7,0.7l0,0l8.5,8.3l0.7-0.7L5.4,9L14,0.7z"/>
      </symbol>
    </svg>
  </section>
  <!-- partial -->
  <!-- About Section -->
  <div class="about-sec">
    <section id="about" class="about">
      <div class="container">
        <div class="row align-items-xl-center gy-5">
          <div class="col-xl-6 text-center" data-aos="flip-left" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="position-relative about-image">
              <div class="bi-play-fill-css">
                <div class="sonar-wrapper">
                  <div class="sonar-emitter sonar-emitter2">
                    <div class="sonar-wave sonar-wave2"> </div>
                    <a href="#" class="glightbox "> <i class="bi bi-play-fill"></i></a> </div>
                </div>
              </div>
              <img src="assets/img/about-imageu.png" class="img-fluid" alt="" title=""> </div>
          </div>
          <div class="col-xl-6 content" data-aos="flip-right" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="heading">
              <h5 class="mb-2 fw-normal text-primary text-uppercase">About us</h5>
              <h2 class="mb-md-5 mb-4"> Our Service will Help You <br>Stand Out.</h2>
            </div>
            <div>
              <h3 class="mb-4">Be a Creative & Proffesional</h3>
              <p>Welcome to DAYLOGS, a pioneering name in Human Resource Management Systems (HRMS) dedicated to reshaping the way organizations manage their most valuable asset - their people. </p>
              <p>At DAYLOGS, we believe that a well-organized and engaged workforce is the cornerstone of every successful business. Our HRMS platform is meticulously crafted to streamline HR processes, foster employee satisfaction, and drive organizational growth.</p>
              <a href="#" class="btn d-inline-block btn-hover-2 color-8 mb-lg-5 mb-0 mt-3">Learn More</a> </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- End About Section -->
  <!--our-Projects-->
  <section class="services mt-0 pt-0" id="services">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="heading">
            <h5 class="text-white mt-5 text-uppercase">Services</h5>
            <h2 class="text-white"> Our Services<br> Include. </h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="p-md-3 p-0">
            <p>Whether you're a small business looking to streamline HR tasks or a growing enterprise in need of a scalable HRMS, DAYLOGS is here to elevate your human resource management experience. Explore the future of HR technology with us - a future where efficiency, engagement, and success intersect.</p>
            <a href="#" class="btn d-inline-block btn-hover mb-5  mt-3 color-7">Learn More</a></div>
        </div>
      </div>
      <div class="swiper our-services">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="shadow2 p-md-5 p-3"> <img src="assets/img/icon-1.png" alt="" title="">
              <h4 class="text-primary mt-5"> Innovation in HRMS</h4>
              <h4 class="mb-3">Technology</h4>
              <p> DAYLOGS stands at the forefront of HR technology, incorporating the latest advancements to bring you a cutting-edge and future-ready for the HRMS solution.</p>
              <a href="#" class="text-dark arrow-1"><i class="bi bi bi-arrow-right"></i></a> </div>
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="shadow2 p-md-5 p-3"> <img src="assets/img/icon-2.png" alt="" title="">
              <h4 class="text-primary mt-5"> User-Centric </h4>
              <h4 class="mb-3">Approach</h4>
              <p> We prioritize user experience, ensuring that our platform is not only feature-rich but also intuitive and easy to navigate for both HR professionals and employees.</p>
              <a href="#" class="text-dark arrow-1"><i class="bi bi-arrow-right"></i></a> </div>
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="shadow2 p-md-5 p-3"> <img src="assets/img/icon-1.png" alt="" title="">
              <h4 class="text-primary mt-5"> Scalability for Growth</h4>
              <h4 class="mb-3">Android/iOS</h4>
              <p>As your organization evolves, so do your HR needs. DAYLOGS is built to scale seamlessly, accommodating your growth and evolving requirements without compromising performance.</p>
              <a href="#" class="text-dark arrow-1"><i class="bi bi-arrow-right"></i></a> </div>
          </div>
          <div class="swiper-slide" data-aos="zoom-in" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="shadow2 p-md-5 p-3"> <img src="assets/img/icon-1.png" alt="" title="">
              <h4 class="text-primary mt-5"> Dedicated Support </h4>
              <h4 class="mb-3">Team</h4>
              <p> Our commitment to your success extends beyond the platform. DAYLOGS provides dedicated customer support to assist you at every stage of implementation and use.</p>
              <a href="#" class="text-dark arrow-1"><i class="bi bi-arrow-right"></i></a> </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <section class="mobile-app position-relative">
    <div id="mobile-app" class="position-absolute" style="top:-200px;"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="position-relative w-100 text-center" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="mobile mb-md-0 mb-5">
              <div class="mobile-in">
                <div class="swiper mobile-sceen">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide text-center"><img src="assets/img/app.jpg" class="img-fluid" alt="" title=""></div>
                    <div class="swiper-slide text-center"><img src="assets/img/app.jpg" class="img-fluid" alt="" title=""></div>
                    <div class="swiper-slide text-center"><img src="assets/img/app.jpg" class="img-fluid" alt="" title=""></div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
            <div class="box one"><a href="#"><img src="assets/img/video-1.png" alt="" title=""></a></div>
            <div class="box two"><a href="#"><img src="assets/img/wifi.png" alt="" title=""></a></div>
            <div class="box three"><a href="#"><img src="assets/img/report.png" alt="" title=""></a></div>
            <div class="box four"><a href="#"><img src="assets/img/ca.png" alt="" title=""></a></div>
            <div class="box five"><a href="#" class="glightbox"> <img src="assets/img/mail.png" alt="" title=""></a></div>
          </div>
        </div>
        <div class="col-md-6" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <h4 class="mb-4 display-5 fw-semibold"> Download Our New<br>
            Mobile App</h4>
          <div class="fs-18">
            <p class="mb-0"> Discover the future of convenience with our new app! Download now from the Play Store to access a world of possibilities at your fingertips. Seamlessly navigate through features designed to simplify your life, enhance productivity, and keep you connected. Don't miss out on the next level of mobile experience – click download and join the evolution today!</p>
            <div class="mt-lg-5 mt-2">
              <div class="row">
                <div class="col-5"><a href="https://play.google.com/store/apps/details?id=com.upicon.daylogs&hl=en-IN" class="d-inline-block"><img src="assets/img/google-play.png" class="img-fluid" alt="" title=""></a></div>
                <!-- <div class="col-5"><a href="#" class="d-inline-block"><img src="assets/img/app-store.png" class="img-fluid" alt="" title=""></a> </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="trusted-partner" id="trusted-partner">
    <div class="container">
      <div class="row">
        <div class="col-md-7 pe-4 mb-4">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-1.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-2.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-3.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-4.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-5.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-lg-4 mb-2" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="boder-animation draw"><img src="assets/img/clients/logo-6.jpg" class="shadow-sm img-fluid w-100" alt="" title=""></div>
            </div>
          </div>
        </div>
        <div class="col-md-5" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="heading">
            <h5 class="mb-2 text-primary text-uppercase">Trusted Partner</h5>
            <h2 class="fw-medium mb-3"> Save Hours and Build <br>
              Better Business. </h2>
          </div>
          <p>Enhance your HR processes, foster employee engagement, and drive organizational success with DAYLOGS. Schedule a demo today and discover the transformative power of our HRMS platform. </p>
          <a href="#" class="btn d-inline-block mb-5  mt-3  btn-hover color-7">Learn More</a> </div>
      </div>
    </div>
  </section>
  <section class="our-client" id="work-flow">
    <div class="container" id="testimonials">
      <div class="justify-content-center row">
        <div class="col-lg-8">
          <div class="customer">
            <div class="swiper testimonial-swiper" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
              <div class="swiper-wrapper" data-aos="fade-down">
                <div class="swiper-slide text-center animation-boder">
                  <div class="p-lg-5 p-3">
                    <h5 class="mb-2 text-primary fw-light text-uppercase"> customer feedback</h5>
                    <h2 class="display-6 fw-semibold mb-3"> What‘s Our Client Say</h2>
                    <p class="poppins">DAYLOGS has truly revolutionized our HR management. The customization options have made DAYLOGS a perfect fit for our unique needs. The exceptional support from the DAYLOGS team has made the transition seamless. It's more than a service; it's a partnership that continues to exceed our expectations.</p>
                    <div class="text-center mb-3"> <img src="assets/img/blog-img.jpg" class="rounded-circle" alt="" title=""></div>
                    <p class="fs-18 mb-0">Deepak Singh</p>
                    <p class="fs-18 text-primary mb-0">Customer</p>
                  </div>
                </div>
                <div class="swiper-slide text-center animation-boder">
                  <div class="p-lg-5 p-3">
                    <h5 class="mb-2 text-primary fw-light text-uppercase"> customer feedback</h5>
                    <h3 class="display-6 fw-medium mb-3"> What‘s Our Client Say</h3>
                    <p class="poppins">Choosing DAYLOGS for our HR needs has been a game-changer. The platform's user-friendly design, coupled with its powerful features, has brought efficiency and transparency to our HR operations. Highly recommended for businesses seeking a modern and effective HRMS solution.</p>
                    <div class="text-center mb-3"> <img src="assets/img/blog-img.jpg" class="rounded-circle" alt="" title=""></div>
                    <p class="fs-18 mb-0">Amit Gupta</p>
                    <p class="fs-18 text-primary mb-0">Customer</p>
                  </div>
                </div>
                <div class="swiper-slide text-center animation-boder">
                  <div class="p-lg-5 p-3">
                    <h5 class="mb-2 text-primary fw-light text-uppercase"> customer feedback</h5>
                    <h3 class="display-6 fw-medium mb-3"> What‘s Our Client Say</h3>
                    <p class="poppins">DAYLOGS has been instrumental in transforming our HR processes. The platform's adaptability to our unique requirements, coupled with its robust security features, has provided us with a reliable and efficient HRMS solution. DAYLOGS goes beyond being a service provider; they are our strategic partner in HR innovation. A remarkable solution for businesses aspiring to elevate their HR management.</p>
                    <div class="text-center mb-3"> <img src="assets/img/blog-img.jpg" class="rounded-circle" alt="" title=""></div>
                    <p class="fs-18 mb-0">Mohd Ahamad</p>
                    <p class="fs-18 text-primary mb-0">Customer</p>
                  </div>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container box-155">
      <div class="heading" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
        <h5 class="mb-2 fw-light text-uppercase text-yellow">Work Flow</h5>
        <h2 class="mb-3 text-white"> See Our Workflow <br>
          Process.</h2>
      </div>
      <div class="row g-2 g-lg-5 justify-content-center">
        <div class="col-lg-4 col-md-12" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="bg-white p-lg-5 p-3 shadow-sm boder-animation draw"> <img src="assets/img/Idea-brainstorm.png" alt="" title="" class="img-fluid mb-lg-5 mb-2">
            <h3>Idea & Brainstorm</h3>
            <p class="m-0">Embrace the power of collaborative thinking, creative ideation, & effective project planning.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-12" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="bg-white p-lg-5 p-3 shadow-sm boder-animation draw"> <img src="assets/img/sketch-design.png" class="img-fluid  mb-lg-5 mb-2" alt="" title="">
            <h3>Sketch & Design</h3>
            <p class="m-0">Elevate visual storytelling, amplify design, & transform your ideas into captivating visuals with us.</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-12" data-aos="fade" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="bg-white p-lg-5 p-3 shadow-sm boder-animation draw"> <img src="assets/img/completed.png" class="img-fluid  mb-lg-5 mb-2" alt="" title="">
            <h3>Completed</h3>
            <p class="m-0">Join the community of creatives shaping the future of design. Start sketching, designing, creating today</p>
          </div>
        </div>
      </div>
      <div></div>
    </div>
  </section>
  <section id="blog">
    <div class="blog">
      <div class="container">
        <div class="heading">
          <h5 class="mb-0  mt-5 text-uppercase" data-aos-duration="1000" data-aos-easing="ease-in-sine"> <span class="text-primary fw-normal">Blog</span> </h5>
          <h2 class="display-5 fw-medium mb-md-5 mb-4" data-aos-duration="1000" data-aos-easing="ease-in-sine"> Our Company News.</h2>
        </div>
        <div class="swiper our-company-news" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="swiper-wrapper">
            <div class="swiper-slide"> <a href="blog-list.html"><img src="assets/img/our-blog/our-blog1.jpg" class="img-fluid" alt="" title=""></a>
              <div class="p-3 position-absolute bottom-0 bg-gradient-css">
                <p>May 24, 2023</p>
                <p class="fs-6 fst-normal mb-2 fw-medium">Transforming Workforce Management.</p>
                <p class="p-0 fs-6"> Explore the dynamic features of DAYLOGS HRMS, streamlining HR processes from onboarding to performance management.</p>
                <a href="blog-list.html" class="text-dark bg-primary arrow-1 mb-2"><i class="bi bi bi-arrow-right"></i></a> </div>
            </div>
            <div class="swiper-slide"> <a href="blog-list.html"><img src="assets/img/our-blog/our-blog2.jpg" class="img-fluid" alt="" title=""></a>
              <div class="p-3 position-absolute bottom-0 bg-gradient-css">
                <p>August 16, 2023</p>
                <p class="fs-6 fst-normal mb-2 fw-medium">Navigating HR with DAYLOGS.</p>
                <p class="p-0 fs-6"> Learn how comprehensive solution optimizes attendance tracking, leave management, & employee engagement HR environment.</p>
                <a href="blog-list.html" class="text-dark bg-primary arrow-1 mb-2"><i class="bi bi bi-arrow-right"></i></a> </div>
            </div>
            <div class="swiper-slide"> <a href="blog-list.html"><img src="assets/img/our-blog/our-blog3.jpg" class="img-fluid" alt="" title=""></a>
              <div class="p-3 position-absolute bottom-0 bg-gradient-css">
                <p>November 19, 2023</p>
                <p class="fs-6 fst-normal mb-2 fw-medium">Your Strategic HR Partner.</p>
                <p class="p-0 fs-6">From customizable solutions to scalability and dedicated support, learn how DAYLOGS becomes more than a service.</p>
                <a href="blog-list.html" class="text-dark bg-primary arrow-1 mb-2"><i class="bi bi bi-arrow-right"></i></a> </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="newsletter">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="contact-us" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
            <div class="heading">
              <h5 class="text-center text-white text-uppercase mb-3">Contact us</h5>
            </div>
            <h2 class="text-center text-white display-6  fw-bold">Our Experts are here to help.</h2>
            <h4 class="text-center text-yellow display-6  fw-bold">24x7 And 365 days</h4>
            <h5 class="text-center text-white display-6  fw-bold">Call us : +91 809-027-0208</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12" >
          <div class="heading">
            <h5 class="text-primary mb-3 text-uppercase">Newsletter</h5>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <h2 class="text-white display-5 fw-medium"> Get update by signup 
            Newsletter..</h2>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
          <div class="input-group mb-3 mt-4 input-group2">
            <input type="text" class="form-control fs-18" onFocus="this.value=''" value="Enter Your Email Address">
            <button class="btn btn-primary border-rad fs-lg-5 fs-6 fw-medium" type="button" id="button-addon2"> Join Now <i class="bi bi bi-arrow-right fs-lg-4 fs-6 float-end ms-lg-3 ms-2"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about"> <a href="{{ route('mainpage') }}" class="logo d-flex align-items-center"> <img src="assets/img/white_bg.png" alt="" title="" class="img-fluid"> </a>
        <div class="col-8"  data-aos="fade">
          <ul>
            <li><a href="#"><i class="bi bi-geo-alt"></i>7th floor, Summit Building<br>
              Gomti Nagar, Lucknow<br>
              Uttar Pradesh </a></li>
            <li><a href="#"><i class="bi bi-envelope"></i> info@daylogs.in</a></li>
            <li><i class="bi bi-telephone"></i> <a href="#">+91 809 027-0208</a><br>
              <a href="#">+91 615-790-1004</a> </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 footer-links"  data-aos="fade">
        <h4>Company</h4>
        <ul>
          <li><a href="#">About</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Terms of Service</a></li>
          <li><a href="#">Privacy policy</a></li>
          <li><a href="#">Sitemap</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 footer-links"  data-aos="fade">
        <h4>Product</h4>
        <ul>
          <li><a href="#">Attendance</a></li>
          <li><a href="#">Report</a></li>
          <li><a href="#">Payroll</a></li>
          <li><a href="#">Field data</a></li>
          <li><a href="#">Record</a></li>
          <li><a href="#">Approval</a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-6 footer-links"  data-aos="fade">
        <h4>Explore</h4>
        <ul>
          <li><a href="#">Marketplace</a></li>
          <li><a href="#">Libraries</a></li>
          <li><a href="#">BETA</a></li>
          <li><a href="#">Apps</a></li>
          <li><a href="#">Hire an Expert</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p class="m-0 p-0 text-white text-md-start text-center">© 2023 UPICON. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-md-end text-center social-media"><a href="#"><i class="bi bi-facebook"></i></a> <a href="#"><i class="bi bi-twitter"></i></a></div>
    </div>
  </div>
</div>
<!-- End Footer -->
<!-- Scroll Top Button -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Bootstrap -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- glightbox -->
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<!--purecounter-->
<script src="assets/vendor/purecounter/purecounter_vanilla.html"></script>
<!--swiper-bundle-->
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<!--aos-->
<script src="assets/vendor/aos/aos.js"></script>
<!--sidebar-->
<script src="assets/vendor/sidebar/jquery-3.3.1.slim.min.js"></script>
<script src="assets/vendor/sidebar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<!-- Swiper -->
<script src="assets/js/all.js"></script>
<!-- Swiper -->
<script src="assets/vendor/aos/aos-2.js"></script>
<!-- typed -->
<script src='assets/vendor/typing-test/jquery.min.html'></script>
<script src='assets/vendor/typing-test/typed.min.js'></script>
<script  src="assets/vendor/typing-test/script.js"></script>
<script  src="assets/vendor/parallax-slideshow/script.js"></script>
</body>
</html>