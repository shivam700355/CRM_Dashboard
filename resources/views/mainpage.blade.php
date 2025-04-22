<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>UPICONDASHBOARD | Home</title>

    <!--Meta Data-->
   <title>UPICONDASHBOARD | Project Progress | Client Engagements | Key Performance Indicators | Consultancy Services | Learning Management Systems | Portfolio Management</title>
   <meta charset="UTF-8">
   <meta name="description" content="UPICONDASHBOARD portals serve as centralized platforms that cater to the unique needs and requirements of specific industries, empowering organizations with actionable insights and data-driven decision-making capabilities to drive growth and success.">
   <meta name="keywords" content="UPICONDASHBOARD,upicondashboard, upicon dashboard, UPICON, U.P Industrial Consultants Limited, UPICON Lucknow, U.P Industrial Consultants Limited">
   <meta name="robots" content="index, follow" />
   <meta name="revisit-after" content="21 days" />
   <link rel="alternate" href="https://upicondashboard.in" hreflang="en-in" />
   <meta name="author" content="U.P Industrial Consultants Limited (UPICON)" />
   <meta name="City" content="Lucknow" />
   <meta name="State" content="Uttar Pradesh" />
   <meta name="country" content="India (IN)" />
   <meta name="zip code" content="226010" />
   <meta name="subject" content="UPICONDASHBOARD" />
   <meta name="owner" content="U.P Industrial Consultants Limited" /> 
   <meta http-equiv="reply-to" content="info@upicon.in" />
   <meta name="language" content="English, Hindi" />
   <meta name="og:image" src="{{ asset('assets/img/upicon.png') }}" />
   <meta name="og:description" content="UPICONDASHBOARD portals serve as centralized platforms that cater to the unique needs and requirements of specific industries, empowering organizations with actionable insights and data-driven decision-making capabilities to drive growth and success."/>
   <meta name="og:url" content="https://upicondashboard.in" />
   <meta name="og:site_name" content="UPICONDASHBOARD" />
   <meta name="og:email" content="info@upicon.in" />
   <meta name="og:phone_number" content="0522 4233727" />
   <link rel="shortlink" href="https://upicondashboard.in" />
   <link rel="canonical" href="https://upicondashboard.in" />
   <meta name="url" content="https://upicondashboard.in" />
   <meta name="DC.title" content="UPICONDASHBOARD" />
   <meta name="geo.region" content="IN-UP" />
   <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="apple-mobile-web-app-capable" content="yes">
   <meta name="mobile-web-app-capable" content="yes">
   <meta name="HandheldFriendly" content="True">
   <meta name="MobileOptimized" content="320">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: linear-gradient(135deg, #fafefe, #fafafd, #fafbfc, #fafbfb, #fafaf9);
            background-size: 200% 200%;
            animation: animatedGradient 5s ease-in-out infinite;
        }

        @keyframes animatedGradient {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }


        /* Custom CSS for hover effect */
        .hoverable-div {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hoverable-div:hover {
            transform: scale(1.05);
            background-color: rgba(0, 72, 255, 0.61);
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            /* Add any other styles you want for the hover state */
            /* For example: box-shadow, etc. */
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .vertical-box {
            height: 80px;
            width: 200px;
            margin: 0.5rem 0 0.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: lightblue;
        }

        .upicon-logo {
            height: 50px;
            width: auto;
        }

        @media only screen and (max-width: 767px) {
            .upicon-logo {
                height: 40px;
                /* Adjust the height as needed for mobile devices */
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body style="">
    <header>
        <nav class="navbar navbar-expand-md shadow-sm py-1 py-md-0">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center justify-content-center" href="/">
                    <img src="{{ asset('assets/img/upicon.png') }}" class="d-inline-block align-top upicon-logo">
                    <span>&nbsp;&nbsp;</span>
                    <span class="h3 text-muted">Dashboard</span>
                </a>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2">
                    <span class="visually-hidden">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navcol-2">
                    <ul class="navbar-nav ms-auto d-flex align-items-center justify-content-center">
                        <li class="nav-item"><a class="nav-link active" href="https://upicon.in/">UPICON</a></li>                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main id="main" class="container-fluid p-2">
        <div class="container">
            <div class="row d-lg-flex align-items-center justify-content-center">
                <div class="col-12 col-lg-4">
                    <div class="row m-2">
                        <div class="col-12 text-center mb-3">
                            <span class="fw-bold h3 text-uppercase text-muted">Verticals</span>
                        </div>
                        @foreach (['Training', 'Consultancy', 'Retail', 'Finance', 'Human Resource'] as $item)
                            <a class="nav-link active" href="/login" aria-current="page">
                                <div class="col-12 border rounded hoverable-div vertical-box">
                                    <span class="fs-5">{{ $item }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="swiper mySwiper m-2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide rounded">
                                <img class="rounded sliderImage"
                                    src="https://images.unsplash.com/photo-1565598469107-2bd14ae7e7e4?q=80&w=1846&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                            </div>
                            <div class="swiper-slide rounded sliderImage">
                                <img class="rounded"
                                    src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                            </div>
                            <div class="swiper-slide rounded sliderImage">
                                <img class="rounded"
                                    src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <footer class="text-center pt-2" id="footer">
        <div class="container text-muted">
            <ul class="list-inline">
                <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                        height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                        </path>
                    </svg></li>
                <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                        height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                        <path
                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z">
                        </path>
                    </svg></li>
                <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z">
                        </path>
                    </svg></li>
            </ul>
            <p class="mb-0">Copyright © 2024 UPICON</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            direction: "horizontal",
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>
