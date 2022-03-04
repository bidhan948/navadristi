<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <!-- Css Include -->
    <link rel="stylesheet" href="{{ asset('neuro/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('neuro/vendor/fontawesome/css/all.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('neuro/vendor/owlcarousel/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('neuro/vendor/owlcarousel/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('neuro/vendor/lightbox/css/lightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('neuro/css/main.css') }}" />
</head>

<body>
    @include('sweetalert::alert')
    <!-- !::Top Header -->
    <div class="top_header" id="top_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="top_info">
                        <ul>
                            <li>
                                <i class="fa-solid fa-phone-flip"></i>
                                <span> +977 9824367788 </span>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <span> info@neurohospital.com.np </span>
                            </li>
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <span> Jahada Road, Biratnagar-10, Nepal </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 top_social_icon">
                    Connect With Us : &nbsp

                    <!-- <a href="#"> <i class="fa-brands fa-youtube"></i> </a> -->
                    <a href="#" class="top_icon facebook"> <i class="fa-brands fa-facebook-f"></i> </a>
                    <a href="#" class="top_icon twitter"> <i class="fa-brands fa-twitter"></i> </a>
                    <a href="#" class="top_icon linkedin"> <i class="fa-brands fa-linkedin-in"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Marquee =====-->
    <marquee behavior="scroll" direction="left">Website is Under Maintenance. We are working on the full version of our new site and will be back soon...</marquee>
    <!-- !::Header Section -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('neuro/images/Neuro-Hospital-Logo-1-768x150.png') }}" alt="Neuro" />
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header__right">
                        <div class="email">
                            <a href="mailto:info@neurohospital.com.np">
                                <img src="{{ asset('neuro/images/email.png') }}" alt="" />
                            </a>
                        </div>
                        <!-- search box -->
                        <div class="search__box">
                            <input type="text" class="input" placeholder="What are you looking for?" />
                            <div class="searchbtn"><i class="fas fa-search"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
