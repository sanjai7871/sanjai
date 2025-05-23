<?php 
/* 
    Template Name: home page1
*/

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="https://maktab.info/wp-content/themes/maktab/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    
<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<!-- Slick JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5T4292XF');</script>
<!-- End Google Tag Manager -->
    
 <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5T4292XF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div class="header-container">
<div class="container mb-container">
<header class="mb-header animate-in">
        
    <div class="site-branding">
        <?php
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
            echo '<h1>' . get_bloginfo('name') . '</h1>';
        }
        ?>
    </div>
    <nav class="main-navbar-mb">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
        ));
        ?>
    </nav>
    <i class="bi bi-list toggle-navbar"></i>
    <!--<i class="bx bx-menu toggle-navbar"></i>-->
</header>
</div>
</div>


<script>
    // Select elements from the DOM
    const toggleNavbar = document.querySelector('.toggle-navbar');
    const mainNavbar = document.querySelector('.main-navbar-mb');

    // Toggle the navbar on click
    toggleNavbar.addEventListener('click', function () {
        if (window.innerWidth < 992) {
            mainNavbar.classList.toggle('show'); // Toggle 'show' class for the navbar

            // Toggle between 'bi-list' and 'bi-x' icon
            if (mainNavbar.classList.contains('show')) {
                this.classList.replace('bi-list', 'bi-x'); // Change to 'x' icon
            } else {
                this.classList.replace('bi-x', 'bi-list'); // Change back to 'list' icon
            }
        }
    });

    // Close the menu if any item is clicked (for better UX on mobile)
    document.querySelectorAll('.menu a').forEach(function (menuItem) {
        menuItem.addEventListener('click', function () {
            if (window.innerWidth < 992) {
                mainNavbar.classList.remove('show'); // Close the navbar after clicking a link
                toggleNavbar.classList.replace('bi-x', 'bi-list'); // Reset icon to 'list'
            }
        });
    });

</script>






 <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"); 
    
    .animate-left,
    .animate-right {
      will-change: transform, opacity;
    }
    
    /* Common base animation style */
    .animate-left,
    .animate-right {
      opacity: 0;
      transition: opacity 2s ease-out, transform 2s ease-out;
    }
    
    /* Slide in from left */
    .animate-left {
      transform: translateX(-80px);
    }
    
    /* Slide in from right */
    .animate-right {
      transform: translateX(80px);
    }
    
    /* Show final position */
    .animate-left.show,
    .animate-right.show {
      opacity: 1;
      transform: translateX(0);
    }
    
    
    
    
    /*hero section s*/
    
    .hero-section #head {
      font-size: clamp(2rem, 8vw, 4.375rem); /* min 32px, responsive up to 70px */
      margin-top: 5vw;
      width: 90%;
      max-width: 950px;
      margin-left: auto;
      margin-right: auto;
      text-align: center; /* optional for centering text */
    }
    
    
    nav.main-navbar-mb {
         gap: 20px;
        align-items: center;
    
    }
    
    
        #intro-video {
            border-radius: 20px;
            background-image: url('https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            min-height: 725px;
            display: flex;
            justify-content: center;
            align-items: center;
    
            margin:
                10px;
            box-shadow: 0 10px 20px rgba(160, 202, 0, 0.59);
    
        }
    
        .promo-video {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #a0ca00;
            animation: pulse 2s infinite;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
    
        .waves-block {
            position: absolute;
            top: -25px;
            left: -25px;
            width: 150px;
            height: 150px;
            z-index: 0;
            pointer-events: none;
        }
    
        .waves {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid #a0ca00;
            border-radius: 50%;
            animation: ripple 2s infinite;
            opacity: 0;
        }
    
        .wave-1 {
            animation-delay: 0s;
        }
    
        .wave-2 {
            animation-delay: 0.5s;
        }
    
        .wave-3 {
            animation-delay: 1s;
        }
    
        @keyframes ripple {
            0% {
                transform: scale(0.7);
                opacity: 0.6;
            }
    
            100% {
                transform: scale(1.6);
                opacity: 0;
            }
        }
    
        .promo-video .fa-play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 30px;
            z-index: 1;
        }
    
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }
    
        /* Responsive Video */
        .custom-video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
    
        .custom-video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    
        @media (max-width: 576px) {
            #intro-video {
                min-height: 300px;
            }
    
            .promo-video {
                width: 70px;
                height: 70px;
            }
    
            .promo-video .fa-play {
                font-size: 20px;
            }
    
            .custom-video-wrapper {
                position: relative;
                width: 80%;
                /* or any fixed value like 800px */
                height: 600px;
                margin: 0 auto;
                /* centers horizontally */
            }
    
            .player-control-overlay {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                touch-action: manipulation;
            }
    
        }
    
        .feature-icon i {
            color: #a0ca00 !important;
            background:
                #e8fba0;
            height: 60px;
            width: 60px;
            border-radius:
                30px;
        }
    
        #intro-video h1 {
            color: rgb(0, 0, 0) !important;
            font-size: 3rem;
            margin-bottom: 5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }
    
        .text-white {
            --bs-text-opacity: 1;
            color: rgb(0, 0, 0) !important;
        }
    
    
    
    
    
    
    
        /*img*/
    
    
        .marquee-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
            overflow: hidden;
        }
    
        .marquee {
            width: 100%;
            overflow: hidden;
            background-color: #fff;
            padding: 30px 0;
            border-radius: 20px;
            position: relative;
        }
    
    @media (max-width: 600px) {
      .marquee {
        width: 95%;
      }
      #primary-menu{
          left:30px;
      }
      .panel-0017{
          width:100%;
      }
    }
    
        .marquee-content {
            display: flex;
            width: max-content;
            animation-duration: 40s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
    
        .marquee-left .marquee-content {
            animation-name: scroll-left;
        }
    
        .marquee-right .marquee-content {
            animation-name: scroll-right;
        }
    
        @keyframes scroll-left {
            0% {
                transform: translateX(0%);
            }
    
            100% {
                transform: translateX(-50%);
            }
        }
    
        @keyframes scroll-right {
            0% {
                transform: translateX(-50%);
            }
    
            100% {
                transform: translateX(0%);
            }
        }
    
        .marquee-content img {
            width: 320px;
            height: 200px;
            object-fit: cover;
            margin: 0 30px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }
    
        section#solution {
            background: #fff;
            padding-bottom: 240px;
        }
    
    
    
        /*div plan*/
    
    
        .card2 {
            height: 500px;
            border-radius: 1rem;
            padding: 20px;
        }
    
        .btn-outline-dark {
            border-radius: 30px;
        }
    
        .btn-success {
            border-radius: 30px;
        }
    
        .price {
            font-size: 2.5rem;
            font-weight: bold;
        }
    
        .plan-title {
            font-weight: 600;
            font-size: 1.2rem;
        }
    
        .pro {
            color: #28a745;
        }
    
        .enterprise {
            color: #32cd32;
        }
    
        .card ul {
            padding-left: 0;
        }
    
        .card ul li {
            list-style: none;
            margin-bottom: 6px;
        }
    
        .btn-success:hover {
            color: #fff;
            /* Text color on hover */
            background-color: #a0ca00;
            /* New background on hover */
            border-color: #a0ca00;
            /* New border on hover */
        }
    
        .btn-success {
            color: #fff;
            /* Text color on hover */
            background-color: #a0ca00;
            /* New background on hover */
            border-color: #a0ca00;
            /* New border on hover */
        }
    
    
    /*#scrollN*/
    
    #scrollN > div > div {
        height: 537.6px; /* Converted from 70vh */
        width: 400px; /* Remains the same */
        background-image: url('https://maktab.info/wp-content/uploads/2025/04/Frame-5-scaled.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: center;
        text-align: justify;
        gap: 10px;
        padding: 40px 30px;
       background-image: linear-gradient(180deg, #18400108 0%, #FFFFFF 50%, #FFFFFF 100%);
    
    
    }
    
    #scrollN > div {
        display: flex;
        
        flex-direction: row;
        justify-content: center;
        align-items: center;
        position: sticky;
        top: 260px; /* Converted from 30vh */
        gap: 30px;
        background-image: url('https://maktab.info/wp-content/uploads/2025/04/Frame-5-scaled.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    #scrollN > div:first-child {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: sticky;
        top: 40px; /* Remains the same, as 0vh = 0px */
        height: 230.4px; /* Converted from 30vh */
    }
    
    #scrollN > div > nav > ul {
        display: flex;
        flex-direction: row;
        list-style-type: none;
    }
    
    #scrollN img {
        height: 150px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease, opacity 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    #scrollN img:hover {
        transform: scale(1.05);
        opacity: 0.9;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    
    @media (max-width: 768px) {
        #scrollN > div {
            position: static !important;
            padding: 20px 15px; /* Half of 40px 30px */
            flex-direction: column; /* Optional: Stack cards vertically on smaller screens */
        }
    
        #scrollN > div > div {
            height: auto; /* Optional: let height adapt naturally on small screens */
            width: 100%; /* Full width on small screens */
            padding: 20px 15px; /* Half padding */
            position: static !important;
        }
    
        #scrollN > div:first-child {
            position: static !important;
            height: auto; /* Let it resize naturally */
            flex-direction: column; /* Stack text content */
            padding: 20px 15px;
        }
    }
    
    .frame022{
        /*padding: 0px 10px 10px 10px !important;*/
        background: #ffffff !important;
        border-radius: 0px 0px 10px 10px;
    }
    
    
    
    
    
    
    
    
    /*scrollA*/
    
    
    
    
      body {
        font-family: sans-serif;
        overflow-x: hidden;
      }
    
      section.spacer-001 {
        height: 300px;
        width: 100%;
      }
    
      .sticky-top-section-002 {
        position: sticky;
        top: 60px;
        background: white;
        padding: 20px;
        z-index: 10;
        text-align: center;
      }
    
      .sticky-top-section-002 h1 {
        font-size: 40px;
        margin-bottom: 10px;
      }
    
      .sticky-top-section-002 p {
        font-size: 18px;
      }
    
      .outer-003 {
        display: flex;
        height: 60vh;
        position: relative;
        top:230px;
        justify-content: start;
      }
    
      .horizontal-scroll-004 {
        display: flex;
        height: 100%;
        width: max-content;
      }
    
      .panel-005 {
        display: flex;
        gap: 50px;
        padding: 0 20px;
        position: relative;
        top: 250px;
      }
    
      .panel-005 .card.hover-card {
        flex-shrink: 0;
        width: 400px;
        height:600px;
        gap: 20px;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform .3s, box-shadow .3s;
        text-align: center;
      }
    
      .panel-005 .card.hover-card img.screenshot-images {
        display: block;
        width: 100%;
        height: auto;
      }
    
      .panel-005 .card.hover-card h4 {
        margin: 10px 0 5px;
        font-size: 1rem;
      }
    
      .panel-005 .card.hover-card p {
        font-size: .9rem;
        padding: 0 10px 10px;
      }
    
      .panel-005 .card.hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      }
    
    
    
    
    /*ScrollB*/
    .a1{
        color: #a0ca00 !important;
    }
         * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }
          
    
        @media (max-width: 768px) {
           html, body {      
          overflow-x: hidden;   /* Hide overflow */
          margin: 0;          /* Remove default margin */
        }
    }
    
        section.spacer-0011 {
          height: 1000px;
          width: 100%;
        }
    
        .sticky-top-section-0012 {
          position: sticky;
          top: 60px;
          background: white;
          padding: 20px;
          z-index: 10;
          text-align: center;
        }
    
        .sticky-top-section-0012 h1 {
          font-size: 40px;
          margin-bottom: 10px;
        }
    
        .sticky-top-section-0012 p {
          font-size: 18px;
        }
    
        .outer-0012 {
          display: flex;
          height: 60vh;
          position: relative;
          top: 230px;
          justify-content: end;
        }
    
        .horizontal-scroll-0014 {
          display: flex;
          height: 100%;
          width: max-content;
        }
    
        .panel-0017 {
          display: flex;
          gap: 20px;
          /*padding: 0 20px;*/
          /*position: relative;*/
          /*top: 250px;*/
        }
    
        .panel-0017 .card.hover-card {
          flex-shrink: 0;
          width: 400px;
          height:600px;
          background: #fff;
          border-radius: 8px;
          overflow: hidden;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          transition: transform .3s, box-shadow .3s;
          text-align: center;
        }
    
        .panel-0017 .card.hover-card img.screenshot-images {
          display: block;
          width: 100%;
          height: auto;
        }
    
        .panel-0017 .card.hover-card h4 {
          margin: 10px 0 5px;
          font-size: 1rem;
        }
    
        .panel-0017 .card.hover-card p {
          font-size: .9rem;
          padding: 0 10px 10px;
        }
    
        .panel-0017 .card.hover-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 768px) {
      .horizontal-scroll-004,
      .horizontal-scroll-0014 {
        display: block !important;
        width: 100% !important;
        overflow-x: auto;
      }
    
      .panel-005,
      .panel-0017 {
        display: flex;
        flex-direction: column;
        gap: 50px;
      }
    
      .panel-005 .card,
      .panel-0017 .card {
        width: 100%;
      }
    }
    
    
    /*desktop mobile*/
    
    /* Default: Mobile content is hidden */
    .m1 {
      display: none;
    }
    
    /* Mobile Styles */
    @media (max-width: 768px) {
      .m1 {
        display: flex;
        flex-direction: column;  /* Stack children vertically */
        gap: 10px;  /* Add 10px gap between elements */
      }
    
      .d1 {
        display: none !important;  /* Hide desktop content on small screens */
      }
    
    }
    
    /*v1*/
    .v1{
        padding: 0px 30px;
        /*width: 50%;*/
        display: flex;
        flex-direction: column;
        gap: 30px;
        text-align:justify;
    }
    .iconc{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    
    @media (max-width: 768px) {
      .v1 { 
        display: none;
      }
      .container{
          padding:0px 30px !important;
      }
      .animate-left,
    .animate-right,.animate-in {
      transition: opacity .5s ease-out, transform .5s ease-out !important;
    }
    
    }
    
    
    /*c1*/
    
    
    @media (max-width: 768px) {
      .c1 {
      text-align: center;
     }
     .video-title {
        position: relative;
        bottom: 50px;
        width: 200%;
    }
     .pad{
         padding: 0px !important;
     }
    
    .card-wrapper {
         padding: 0px !important; 
    }
    }
    
    .c2 {
      text-align: center;
    }
    
    
    
    
    .cd1 > .card img{
      max-height: 460px !important;
      width: 230px !important; 
      /* Ensures the image stretches fully within its parent  */
      object-fit: cover !important;
       /* Optional: Makes the image cover the card area */
    }
    .cd1 > .card h1 {
      font-size: 22px;
    }
    .cd2 >.card img{
         width: 30% !important; 
    }
    
    
    .cd10 > .card img {
      max-height: 460px !important;
      width: 165px !important; 
      /* Ensures the image stretches fully within its parent  */
      object-fit: cover !important;
       /* Optional: Makes the image cover the card area */
    }
    .cd10 > .card h1 {
      font-size: 22px;
    }
    
    
    
    .dn1{
        display:none;
    }
    
    .language-options{
         padding: 20px;
        background: white;
        display: flex;
        justify-content: end;
        gap: 30px;
    }
    .language-options > .active {
      background-color: #a0ca00 !important;
      color: white !important;
    }
    .language-options > button{
      background-color: #fff !important;
      color:  #000 !important;
    }
    .rev{
        display: flex;
        flex-direction: column-reverse;
    }
    
    
    
    /*youtube video button*/
    
    
    .flexc{
     display:flex;
     flex-direction:column;
     gap:50px;
    }
    
    
    @media (min-width: 1200px) {
      /* Styles for desktops and larger devices */
    .h1-title {
        font-size:60px !important;
            
        }.v1 > h2 {
        font-size: 2.5rem !important;
    }
    
    .v1 > p {
        font-size: 1.4rem !important;
    }
    }
    
    
    
    
    /*btn*/
    
        .yt-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 30px;       /* smaller circle */
      height: 30px;      /* smaller circle */
      background-color: #a0ca00;
      color: white;
      font-size: 14px;   /* smaller play icon */
      border-radius: 50%;
      text-decoration: none;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      transition: background 0.3s ease;
    }
    
    .yt-btn:hover {
      background-color: #89b000;
    }
    
    
    
    
    
    
    
    
    .promo-video-inline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9em;
        background-color: #a0ca00;
        padding: 4px 8px;
        border-radius: 4px;
        margin-left: 10px;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    
    .promo-video-inline:hover {
        background-color: #a0ca00;
        color: #fff;
    }
    
    .promo-video-inline i {
        font-size: 1em;
    }
    
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    
        .custom-video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0; 
            overflow: hidden;
        }
    
        .custom-video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    
        /* Button size for smaller screens */
        @media (max-width: 576px) {
            .promo-video-inline {
                width: 30px;  /* Smaller button size on mobile */
                height: 30px;  /* Smaller button size on mobile */
            }
    
            .promo-video-inline .fa-play {
                font-size: 12px;  /* Smaller icon on mobile */
            }.laptop-frame > iframe{
                height:30vh !important;
            }
        }
    
        </style>
    <!--<script src="https://cdn.tailwindcss.com"></script>-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
    }

    .card-wrapper {
      padding: 20px;
      max-width: 1200px;
      margin: auto;
    }

    .card-list {
      width: 100%;
    }

    .card-item {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .card-item img {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
    }

    .card-item h4 {
      margin-top: 15px;
      font-size: 1.1rem;
    }
  </style>




<!--<div class="container">-->
<!--
<!--<?php echo do_shortcode('[automatic_youtube_gallery type="videos" videos="v_rBK9mBnL8,DsNfcQOl3ys,kyim8W-rgwY" per_page="3"]'); ?>-->

<!--	</div>-->



<!--<div class="container">-->
<!--<?php echo do_shortcode('[automatic_youtube_gallery playlist="PLsUGRuC33KcYKwZXIsPPxQdBfN4I0nfOU"]'); ?>-->
<!--	</div>-->


  <!-- FontAwesome for play icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  
  <style>


    .left-content {
      width: 60%; 
    }

    .right-content {
      width: 35%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: flex-end;
      gap: 20px;
    }

    .video-title {
      font-size: 40px;
      margin-bottom: 20px;
    }

    .video-link {
      display: flex;
      gap: 50px;
      margin-bottom: 20px;
    }

    .promo-video-inline021 {
      font-size: 25px;
      cursor: pointer;
    }

    #shared-video-container {
      margin-top: 20px;
      text-align: center;
    }

   .laptop-frame > iframe {
      width: 100%;
      height: 700px;
      border-radius: 8px;
    }
    
      /* Laptop-style frame */
  .laptop-frame {
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 40px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  }

.promo-video-inline021.active {
    padding: 0px 20px;
    background: #a0ca00;
    border-radius: 50px;
    color: white;
}
.f022{
    padding: 20px;
    background: #000;
}
.animate-in {
  opacity: 0;
  transform: translateY(50px);
  transition: opacity 2s ease-out, transform 2s ease-out;
}

.animate-in.show {
  opacity: 1;
  transform: translateY(0);
}
/*.animate-in1 {*/
/*  opacity: 0;*/
/*  transform: translateY(50px);*/
/*  transition: opacity 3s ease-out, transform 3s ease-out;*/
/*}*/

/*.animate-in1.show {*/
/*  opacity: 1;*/
/*  transform: translateY(0);*/
/*}*/


    .scrollB{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
    }

    .dislpayflex{
        display: flex;
    align-items: center;
    justify-content: center;
    gap: auto;
    margin: auto;
    gap: 30px;
    }
    .Maktab001{
        /*margin:100px 0px;*/
    }
    .maktab002{
        /*margin:100px 0px;*/
    }
    .gap002{
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding:30px;
    }.container{
        padding:30px;
    }
    
    
    .card-wrapper {
  position: relative;
  padding: 40px 0;
}

.card-hover {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  text-align: center;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: transform .3s, box-shadow .3s;
}

.card-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.screenshot-images {
  width: 100%;
  height: auto;
}

.swiper-button-prev,
.swiper-button-next {
  color: #a0ca00;
  background: rgba(255, 255, 255, 0.9);
  padding: 10px;
  border-radius: 50%;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

.swiper-pagination-bullet {
  background: #333;
}
@media (max-width: 1024px) {
  .tboff {
    display:none;
  }
  .tbon {
    display:block;
  }
  .txc{
   text-align: center !important; 
  }
  .column-reverse{
      flex-direction:column-reverse;
  }
  .w100{
      width:100%;
  }laptop-frame > iframe{
      height:50vh;
  }
    
}
    
    
    
    
</style>





<section class="hero-section animated-box animate-in">
    <div class="container flexc">
        <div id="head" class="hero-section-container ">
            <h1 class="h1-title">One Platform for Makatib, Madaris, and Niswan</h1>
            <!--<p class="para dn1">-->
            <!--    Our all-in-one solution streamlines operations, enhances communication, and optimizes learning.-->
            <!--    Apps for admins, teachers, and parents simplify attendance, student records, and class activities-->
            <!--    management.-->
            <!--</p>-->
            <!--<a href="https://maktab.info/contact-us/" class="hero-btn dn1">Get Started</a>-->
        </div>

        <div class="image-wrapper">


            <!-- ✅ Carousel -->
            <div id="carouselExampleDark" class="carousel carousel-dark slide hero-image-slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314633.png"
                            class="d-block w-100" alt="Slide 1" />
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image.png" class="d-block w-100"
                            alt="Slide 2" />
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png" class="d-block w-100"
                            alt="Slide 1" />
                    </div>
                    
                    

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        </div>
</section>

<section class="section-padding" id="features">

    <div class="container">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 c1">

            <div class="feature col-md-12 section-title animate-in">
                <h2 class="fs-2 text-body-emphasis c2 txc">Key <span class="solutin-highlight">Feature</span> for Maktab
                    Management</h2>
                <p class="txc">Streamline operations, enhance communication, and simplify attendance tracking with our all-in-one
                    digital solution.</p>
                <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                <!--  Explore More-->
                <!--  <i class="bi bi-arrow-right"></i>-->
                <!--</a>-->
            </div>
            <div class="feature col animate-in">
                <div class="card features animate-in">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-gear iconc"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Admin Control Panel</h3>
                    <p >A comprehensive admin app designed for maktab administrators, providing tools to manage
                        admissions, track attendance, update student records, and monitor tasks, ensuring a seamless
                        digital experience for every aspect of your institution.</p>
                    
                </div>
            </div>
            <div class="feature col animate-in">
                <div class="card features animate-in">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-phone iconc"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Teacher’s Mobile App</h3>
                    <p>Teachers can effortlessly manage their classes using our mobile app. With features like
                        attendance tracking, task assignments, and instant updates on student progress, educators can
                        focus more on teaching and less on paperwork.</p>
                    <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                    <!--Read More-->
                    <!--  <i class="bi bi-arrow-up-right"></i>-->
                    <!--</a>-->
                </div>
            </div>
            <div class="feature col animate-in">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-diagram-3 iconc"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Parent Dashboard</h3>
                    <p>Stay connected with your child’s learning journey through our parent app. Monitor attendance,
                        track task completion, and receive real-time updates on progress, ensuring transparency and
                        involvement in your child’s education.</p>
                    <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                    <!--Read More-->
                    <!--  <i class="bi bi-arrow-up-right"></i>-->
                    <!--</a>-->
                </div>
            </div>
            <div class="feature col animate-in">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-newspaper iconc"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Automated Attendance System</h3>
                    <p>Our system simplifies attendance management with digital records that can be updated in real-time
                        by teaching staff, making it easier to track student participation and reduce manual errors.</p>
                    <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                    <!--Read More-->
                    <!--  <i class="bi bi-arrow-up-right"></i>-->
                    <!--</a>-->
                </div>
            </div>
            <div class="feature col animate-in">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-search iconc"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Task Management & Progress Tracking</h3>
                    <p>Assign and manage tasks for students with ease. The platform allows teachers to track task
                        completion and performance, while parents receive instant updates, creating a collaborative
                        environment for student success.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="fullscreen-view" class="fullscreen hidden">
    <img id="fullscreen-image" src="" alt="Fullscreen Image">
</div>


 


<!--div 2 plan-->

<!--div2 -->


<!--solution-->
<!--Maktab001-->

<section  class="section-padding Maktab001" >
   
    <div class="container">
        <div class="row column-reverse g-4 py-5 pad">
             
            <div class="col-lg-6 col-md-12 animate-left">
                <img src="https://maktab.info/wp-content/uploads/2025/04/admin-screenshot.png" width="100%">
            </div>

            <div class="col-lg-5 col-md-12 animate-right" style="padding:0px 30px;">
                <h2 class="Solution-title txc">Maktab Admin Panel – For <span class="solutin-highlight">Makatib, Madaris &
                        Niswan</span></h2>
                <p class="solution-para txc">Efficiently manage students, teachers, classes, and records. Tailored for
                    Makatib, Madaris, and Niswan, this system supports traditional Islamic education with modern tools.
                </p>
            </div>
        </div>
    </div>



</section>



<!--container 002-->

<!--<div class="container">-->
<!--    <div id="scrollN" style="width: 100%;">-->
<!--        <div style="display: flex; flex-direction: column;">-->
<!--            <h1>Maktab Admin Panel</h1>-->
<!--            <p style="-->
<!--    text-align: center;-->
<!--">Efficiently manage students, teachers, classes, and records in one place. Tailored for Makatib, Madaris, and Niswan, the panel brings simplicity and speed to everyday operations.</p>-->
<!--        </div>-->

<!--        <div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-10-38-MAKTAB.png" alt="Dashboard Overview">-->
<!--                <h4>Dashboard Overview</h4>-->
<!--                <p>Summarizes all vital stats like student count, fee status, and activity logs. Everything is visualized for quick understanding and better decision-making.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-08-39-MAKTAB-2.png" alt="Student Profiles">-->
<!--                <h4>Student Profiles</h4>-->
<!--                <p>View and manage full student records, including attendance, academics, and personal info. Everything is securely organized and easy to access.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-12-59-MAKTAB.png" alt="Class Scheduling">-->
<!--                <h4>Class Scheduling</h4>-->
<!--                <p>Create schedules with automatic conflict checks. Assign classes to teachers and students with real-time updates across the platform.</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-18-18-MAKTAB1.png" alt="Teacher Management">-->
<!--                <h4>Teacher Management</h4>-->
<!--                <p>Assign classes, track workloads, and evaluate teacher performance. Keep all staff records up to date and accessible from anywhere.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-19-46-MAKTAB.png" alt="Fee Tracking">-->
<!--                <h4>Fee Tracking</h4>-->
<!--                <p>Manage fee collection, generate receipts, and send reminders. Get instant reports on pending, paid, and upcoming fee statuses.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-33-42-MAKTAB-1.png" alt="Exam Results">-->
<!--                <h4>Exam Results</h4>-->
<!--                <p>Publish and analyze student results with visual summaries. Archive past data and identify academic strengths and weaknesses.</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-30-42-MAKTAB.png" alt="Reports & Analytics">-->
<!--                <h4>Reports & Analytics</h4>-->
<!--                <p>Track trends in attendance, fees, and performance. Generate printable reports with graphs and insights for internal review.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-36-36-MAKTAB.png" alt="Announcements">-->
<!--                <h4>Announcements</h4>-->
<!--                <p>Post school-wide alerts, news, and updates instantly. Keep students and staff informed about important developments.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-37-59-MAKTAB.png" alt="Library System">-->
<!--                <h4>Library System</h4>-->
<!--                <p>Manage book inventory, checkouts, and returns. Maintain an organized catalog with automated lending history tracking.</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-42-00-MAKTAB1.png" alt="Attendance Tracking">-->
<!--                <h4>Attendance Tracking</h4>-->
<!--                <p>Log student and teacher attendance daily. Generate reports and alert admins for frequent or unusual absences quickly.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-42-49-MAKTAB.png" alt="Role Management">-->
<!--                <h4>Role Management</h4>-->
<!--                <p>Create custom roles and permissions for users. Secure the system by limiting access based on responsibilities.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-44-55-MAKTAB.png" alt="Document Center">-->
<!--                <h4>Document Center</h4>-->
<!--                <p>Store and manage official documents like certificates, syllabi, and forms. Secure access with download options for users.</p>-->
<!--            </div>-->
<!--        </div>-->

<!--        <div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png" alt="Event Calendar">-->
<!--                <h4>Event Calendar</h4>-->
<!--                <p>Plan and share upcoming events, holidays, and meetings. Sync important dates across the system for easy access.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-51-26-MAKTAB.png" alt="User Settings">-->
<!--                <h4>User Settings</h4>-->
<!--                <p>Allow users to edit their profile, change passwords, and set preferences. All changes update instantly across devices.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-33-42-MAKTAB-1.png" alt="Backup & Restore">-->
<!--                <h4>Backup & Restore</h4>-->
<!--                <p>Schedule automatic backups and restore data when needed. Ensure the safety and continuity of all system information.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
















<section class="section-padding" >
   <div class="container animate-in">
    <div id="scrollN" style="width: 100%;">
        <div>
            <h1>Maktab Admin Panel</h1>
            <p style="text-align: center;">Efficiently manage students, teachers, classes, and records in one place. Tailored for Makatib, Madaris, and Niswan, the panel brings simplicity and speed to everyday operations.</p>
        </div>

        <div>
            <div class="card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Dashboard Overview">
                <h4>Dashboard Overview</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal1">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Monitor real-time metrics like student count, fee status, and activity logs. Admins get a complete visual summary for quick oversight and action.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-10-38-MAKTAB.png" alt="Course">
                <h4>Course</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal2">
                    <i class="fa fa-play"></i> Watch Video 
                </span>
                <p>Admins can define, update, and organize course structures. Easily manage course offerings across years with clarity and control.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-08-39-MAKTAB-2.png" alt="Academic Year">
                <h4>Academic-Year</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal3">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Set and adjust academic year timelines. Control term dates and ensure proper data segregation across academic sessions.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-12-59-MAKTAB.png" alt="Session">
                <h4>Session</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal4">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Manage academic sessions efficiently. Configure start/end dates and ensure consistent records across all modules.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png" alt="Classes">
                <h4>Classes</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal5">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-18-18-MAKTAB1.png" alt="Time-Table">
                <h4>Time-Table</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal6">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-19-46-MAKTAB.png" alt="Student-Management">
                <h4>Student-Management</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal7">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Admins can add, update, and manage student records. Monitor admissions, statuses, and performance from one centralized panel.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-30-42-MAKTAB.png" alt="Student Dashboard">
                <h4>Student Dashboard</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal8">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>View detailed student summaries. Admins can access grades, attendance, and notes to support student progress.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-36-36-MAKTAB.png" alt="Enrollment">
                <h4>Enrollment</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal9">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Manage student enrollment records, including admission statuses and academic placements.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-08-MAKTAB.png" alt="Task Type">
                <h4>Task Type</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal10">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Define and manage various task types within the system to organize and track admin work.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-37-MAKTAB.png" alt="Task">
                <h4>Task</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal11">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Assign and track tasks related to classes, staff, and students to ensure smooth operation of the panel.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-39-26-MAKTAB.png" alt="Exam Grade">
                <h4>Exam Grade</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal12">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Grade exams and assignments, ensuring that all scores are tracked and recorded accurately.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-41-44-MAKTAB.png" alt="Exam Mark Enter">
                <h4>Exam Mark Enter</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal13">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Enter and manage exam marks within the system for efficient grade processing and report generation.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-40-43-MAKTAB.png" alt="Set">
                <h4>Set</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal14">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Configure and set various parameters across the system to ensure consistency and control.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-37-59-MAKTAB.png" alt="Graduate">
                <h4>Graduate</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal15">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Track student graduation and certification statuses within the system to facilitate graduation management.</p>
            </div>
        </div>

        <div>
            
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-42-49-MAKTAB-1.png" alt="Meetings">
                <h4>Meetings</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal16">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Schedule and log staff or administrative meetings. Ensure documentation and accountability across teams.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-44-55-MAKTAB.png" alt="Customfields">
                <h4>Customfields</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal17">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Add custom data fields to student or staff forms. Tailor the system to match institutional requirements.</p>
            </div>
             <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-43-45-MAKTAB.png" alt="Add New User">
                <h4>Add New User</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal18">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Admins can add new users to the system, manage roles, and grant specific permissions.</p>
            </div>
        </div>


    </div>
</div>

 

    
    
    <!--ScrollA-->
  <!-- Modal 1 -->
<div class="modal fade vm002" id="videoModal1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video1" class="f022 frame022" src="https://www.youtube.com/embed/dKaM14UywsM?rel=0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
       <div class="language-options">
  <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(1, 'en', event)">English</button>
  <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(1, 'hi', event)">Hindi/Urdu</button>
  <button class="btn btn-sm btn-secondary " onclick="changeVideoLanguage(1, 'ta', event)">Tamil</button>
</div>
        

        
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade vm002" id="videoModal2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video2" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(2, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(2, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(2, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 3 -->
<div class="modal fade vm002" id="videoModal3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video3" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(3, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(3, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(3, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 4 -->
<div class="modal fade vm002" id="videoModal4" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video4" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(4, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(4, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(4, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 5 -->
<div class="modal fade vm002" id="videoModal5" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video5" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(5, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(5, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(5, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 6 -->
<div class="modal fade vm002" id="videoModal6" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video6" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(6, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(6, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(6, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 7 -->
<div class="modal fade vm002" id="videoModal7" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video7" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(7, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(7, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(7, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 8 -->
<div class="modal fade vm002" id="videoModal8" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video8" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(8, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(8, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(8, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 9 -->
<div class="modal fade vm002" id="videoModal9" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video9" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(9, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(9, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(9, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 10 -->
<div class="modal fade vm002" id="videoModal10" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video10" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(10, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(10, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(10, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 11 -->
<div class="modal fade vm002" id="videoModal11" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video11" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(11, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(11, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(11, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 12 -->
<div class="modal fade vm002" id="videoModal12" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video12" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(12, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(12, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(12, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 13 -->
<div class="modal fade vm002" id="videoModal13" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video13" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(13, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(13, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(13, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 14 -->
<div class="modal fade vm002" id="videoModal14" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video14" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(14, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(14, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(14, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 15 -->
<div class="modal fade vm002" id="videoModal15" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video15" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(15, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(15, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(15, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

          <!-- Modal 16 -->
<div class="modal fade vm002" id="videoModal16" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video16" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(16, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(16, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(16, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 17 -->
<div class="modal fade vm002" id="videoModal17" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video17" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(17, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(17, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(17, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 18 -->
<div class="modal fade vm002" id="videoModal18" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video18" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(18, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(18, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(18, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

    
    
    
    
    
    
    
    
    
    
    
</div>
</section>
















<!--ScrollN-->

<section class="section-padding animate-in" >
   <div class="container ">
    <div id="scrollN" style="width: 100%;">
        <div>
            <h1>Maktab Admin Panel</h1>
            <p style="text-align: center;">Efficiently manage students, teachers, classes, and records in one place. Tailored for Makatib, Madaris, and Niswan, the panel brings simplicity and speed to everyday operations.</p>
        </div>
        <div>
            <div class="card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Dashboard Overview">
                <h4>Dashboard Overview</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal1">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Monitor real-time metrics like student count, fee status, and activity logs. Admins get a complete visual summary for quick oversight and action.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-10-38-MAKTAB.png" alt="Course">
                <h4>Course</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal2">
                    <i class="fa fa-play"></i> Watch Video 
                </span>
                <p>Admins can define, update, and organize course structures. Easily manage course offerings across years with clarity and control.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-08-39-MAKTAB-2.png" alt="Academic Year">
                <h4>Academic-Year</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal3">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Set and adjust academic year timelines. Control term dates and ensure proper data segregation across academic sessions.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-12-59-MAKTAB.png" alt="Session">
                <h4>Session</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal4">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Manage academic sessions efficiently. Configure start/end dates and ensure consistent records across all modules.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png" alt="Classes">
                <h4>Classes</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal5">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-18-18-MAKTAB1.png" alt="Time-Table">
                <h4>Time-Table</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal6">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-19-46-MAKTAB.png" alt="Student-Management">
                <h4>Student-Management</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal7">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Admins can add, update, and manage student records. Monitor admissions, statuses, and performance from one centralized panel.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-30-42-MAKTAB.png" alt="Student Dashboard">
                <h4>Student Dashboard</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal8">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>View detailed student summaries. Admins can access grades, attendance, and notes to support student progress.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-36-36-MAKTAB.png" alt="Enrollment">
                <h4>Enrollment</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal9">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Manage student enrollment records, including admission statuses and academic placements.</p>
            </div>
        </div> 

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-08-MAKTAB.png" alt="Task Type">
                <h4>Task Type</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal10">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Define and manage various task types within the system to organize and track admin work.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-37-MAKTAB.png" alt="Task">
                <h4>Task</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal11">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Assign and track tasks related to classes, staff, and students to ensure smooth operation of the panel.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-39-26-MAKTAB.png" alt="Exam Grade">
                <h4>Exam Grade</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal12">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Grade exams and assignments, ensuring that all scores are tracked and recorded accurately.</p>
            </div>
        </div>

        <div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-41-44-MAKTAB.png" alt="Exam Mark Enter">
                <h4>Exam Mark Enter</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal13">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Enter and manage exam marks within the system for efficient grade processing and report generation.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-40-43-MAKTAB.png" alt="Set">
                <h4>Set</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal14">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Configure and set various parameters across the system to ensure consistency and control.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-37-59-MAKTAB.png" alt="Graduate">
                <h4>Graduate</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal15">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Track student graduation and certification statuses within the system to facilitate graduation management.</p>
            </div>
        </div>

        <div>
            
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-42-49-MAKTAB-1.png" alt="Meetings">
                <h4>Meetings</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal16">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Schedule and log staff or administrative meetings. Ensure documentation and accountability across teams.</p>
            </div>
            <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-44-55-MAKTAB.png" alt="Customfields">
                <h4>Customfields</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal17">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Add custom data fields to student or staff forms. Tailor the system to match institutional requirements.</p>
            </div>
             <div class="card hover-card">
                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-43-45-MAKTAB.png" alt="Add New User">
                <h4>Add New User</h4>
                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal18">
                    <i class="fa fa-play"></i> Watch Video
                </span>
                <p>Admins can add new users to the system, manage roles, and grant specific permissions.</p>
            </div>
        </div>

    </div>
</div>

<!--    <div class="container m1 tbon">-->
<!--    <div style="width: 100%;">-->
<!--        <div id="scrollN" class="scrollB">-->
<!--            <h1>Maktab Admin Panel</h1>-->
<!--            <p style="text-align: center;">Efficiently manage students, teachers, classes, and records in one place. Tailored for Makatib, Madaris, and Niswan, the panel brings simplicity and speed to everyday operations.</p>-->
<!--        </div>-->
<!-- <div class="card-wrapper">-->
<!--    <div class="swiper card-list">-->
<!--      <div class="swiper-wrapper">-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Dashboard Overview">-->
<!--                <h4>Dashboard Overview</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal1">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Monitor real-time metrics like student count, fee status, and activity logs. Admins get a complete visual summary for quick oversight and action.</p>-->
<!--            </div>-->
            
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-10-38-MAKTAB.png" alt="Course">-->
<!--                <h4>Course</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal2">-->
<!--                    <i class="fa fa-play"></i> Watch Video -->
<!--                </span>-->
<!--                <p>Admins can define, update, and organize course structures. Easily manage course offerings across years with clarity and control.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-08-39-MAKTAB-2.png" alt="Academic Year">-->
<!--                <h4>Academic-Year</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal3">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Set and adjust academic year timelines. Control term dates and ensure proper data segregation across academic sessions.</p>-->
<!--            </div>-->
       
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-12-59-MAKTAB.png" alt="Session">-->
<!--                <h4>Session</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal4">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Manage academic sessions efficiently. Configure start/end dates and ensure consistent records across all modules.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png" alt="Classes">-->
<!--                <h4>Classes</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal5">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-18-18-MAKTAB1.png" alt="Time-Table">-->
<!--                <h4>Time-Table</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal6">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Create and assign timetables for classes and teachers. Admins can ensure no conflicts and maintain optimized schedules.</p>-->
<!--            </div>-->
     
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-19-46-MAKTAB.png" alt="Student-Management">-->
<!--                <h4>Student-Management</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal7">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Admins can add, update, and manage student records. Monitor admissions, statuses, and performance from one centralized panel.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-30-42-MAKTAB.png" alt="Student Dashboard">-->
<!--                <h4>Student Dashboard</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal8">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>View detailed student summaries. Admins can access grades, attendance, and notes to support student progress.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-36-36-MAKTAB.png" alt="Enrollment">-->
<!--                <h4>Enrollment</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal9">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Manage student enrollment records, including admission statuses and academic placements.</p>-->
<!--            </div>-->
  
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-08-MAKTAB.png" alt="Task Type">-->
<!--                <h4>Task Type</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal10">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Define and manage various task types within the system to organize and track admin work.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-35-37-MAKTAB.png" alt="Task">-->
<!--                <h4>Task</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal11">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Assign and track tasks related to classes, staff, and students to ensure smooth operation of the panel.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-39-26-MAKTAB.png" alt="Exam Grade">-->
<!--                <h4>Exam Grade</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal12">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Grade exams and assignments, ensuring that all scores are tracked and recorded accurately.</p>-->
<!--            </div>-->

<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-41-44-MAKTAB.png" alt="Exam Mark Enter">-->
<!--                <h4>Exam Mark Enter</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal13">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Enter and manage exam marks within the system for efficient grade processing and report generation.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-40-43-MAKTAB.png" alt="Set">-->
<!--                <h4>Set</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal14">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Configure and set various parameters across the system to ensure consistency and control.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-37-59-MAKTAB.png" alt="Graduate">-->
<!--                <h4>Graduate</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal15">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Track student graduation and certification statuses within the system to facilitate graduation management.</p>-->
<!--            </div>-->

            
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-42-49-MAKTAB-1.png" alt="Meetings">-->
<!--                <h4>Meetings</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal16">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Schedule and log staff or administrative meetings. Ensure documentation and accountability across teams.</p>-->
<!--            </div>-->
<!--            <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-44-55-MAKTAB.png" alt="Customfields">-->
<!--                <h4>Customfields</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal17">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Add custom data fields to student or staff forms. Tailor the system to match institutional requirements.</p>-->
<!--            </div>-->
<!--             <div class="card hover-card swiper-slide card-item">-->
<!--                <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/05/Screenshot-2025-04-07-at-19-43-45-MAKTAB.png" alt="Add New User">-->
<!--                <h4>Add New User</h4>-->
<!--                <span class="promo-video-inline" data-toggle="modal" data-target="#videoModal18">-->
<!--                    <i class="fa fa-play"></i> Watch Video-->
<!--                </span>-->
<!--                <p>Admins can add new users to the system, manage roles, and grant specific permissions.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="swiper-button-prev animate-right"></div>-->
<!--          <div class="swiper-button-next animate-left"></div>-->
<!--    </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
 

    
    
    <!--ScrollA-->
  <!-- Modal 1 -->
<div class="modal fade vm002" id="videoModal1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video1" class="f022 frame022" src="https://www.youtube.com/embed/dKaM14UywsM?rel=0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
       <div class="language-options">
  <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(1, 'en', event)">English</button>
  <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(1, 'hi', event)">Hindi/Urdu</button>
  <button class="btn btn-sm btn-secondary " onclick="changeVideoLanguage(1, 'ta', event)">Tamil</button>
</div>
        

        
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade vm002" id="videoModal2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video2" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(2, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(2, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(2, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 3 -->
<div class="modal fade vm002" id="videoModal3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video3" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(3, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(3, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(3, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 4 -->
<div class="modal fade vm002" id="videoModal4" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video4" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(4, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(4, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(4, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal 5 -->
<div class="modal fade vm002" id="videoModal5" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video5" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(5, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(5, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(5, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 6 -->
<div class="modal fade vm002" id="videoModal6" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video6" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(6, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(6, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(6, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 7 -->
<div class="modal fade vm002" id="videoModal7" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video7" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(7, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(7, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(7, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 8 -->
<div class="modal fade vm002" id="videoModal8" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video8" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(8, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(8, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(8, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 9 -->
<div class="modal fade vm002" id="videoModal9" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video9" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(9, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(9, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(9, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 10 -->
<div class="modal fade vm002" id="videoModal10" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video10" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(10, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(10, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(10, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 11 -->
<div class="modal fade vm002" id="videoModal11" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video11" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(11, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(11, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(11, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 12 -->
<div class="modal fade vm002" id="videoModal12" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video12" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(12, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(12, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(12, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 13 -->
<div class="modal fade vm002" id="videoModal13" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video13" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(13, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(13, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(13, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 14 -->
<div class="modal fade vm002" id="videoModal14" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video14" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(14, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(14, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(14, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 15 -->
<div class="modal fade vm002" id="videoModal15" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video15" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(15, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(15, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(15, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

          <!-- Modal 16 -->
<div class="modal fade vm002" id="videoModal16" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video16" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(16, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(16, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(16, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 17 -->
<div class="modal fade vm002" id="videoModal17" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video17" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(17, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(17, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(17, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 18 -->
<div class="modal fade vm002" id="videoModal18" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 rev">
        <div class="custom-video-wrapper">
          <iframe id="video18" class="f022 frame022" src="https://www.youtube.com/embed/VIDEO_ID_EN" allowfullscreen></iframe>
        </div>
        <div class="language-options">
          <button class="btn btn-sm btn-secondary active" onclick="changeVideoLanguage(18, 'en', event)">English</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(18, 'hi', event)">Hindi/Urdu</button>
          <button class="btn btn-sm btn-secondary" onclick="changeVideoLanguage(18, 'ta', event)">Tamil</button>
        </div>
      </div>
    </div>
  </div>
</div>

    
    
    
    
    
    
    
    
    
    
    
</div>
</section>
<!--control div-->




<!--Maktab002-->
   
   <section  class="section-padding Maktab001" >
        <div class="container">
       <div class="row g-4 py-5 pad">

            <div class="col-lg-5 col-md-12 animate-right" style="padding:0px 30px;">
                <h2 class="Solution-title txc">Maktab Staff Panel – Smart Tools for <span
                        class="solutin-highlight ">Attendance & Exam</span></h2>
                <p class="solution-para txc">Manage attendance, exams, schedules, and records efficiently. Built for
                    Makatib, Madaris, and Niswan, this platform simplifies educational tasks and enhances staff
                    productivity daily.</p>
                <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                <!--      Explore More-->
                <!--      <i class="bi bi-arrow-right"></i>-->
                <!--    </a>-->
            </div>




            <div class="col-lg-6 col-md-12 animate-left">
                <img src="https://maktab.info/wp-content/uploads/2025/04/admin-screenshot.png" width="100%">
            </div>

        </div>
    </div>
   </section>

    

<!--scrollA d1-->

    <section class="section-padding scrollB">
      <div class="container gap002">
    <!--<div class="sticky-top-section-0012">-->
  <h1>Maktab Parent Panel</h1>
  <p>
    A unified platform to oversee students, teachers, and schedules with ease.
    Built for Makatib, Madaris, and Niswan, it simplifies tasks and boosts daily
    productivity for your entire institution.
  </p>

    <!--<div class="sticky1-0017">-->
      <!--<div class="outer-0012">-->
        <!--<div class="horizontal-scroll-0014">-->
        


    <!--<div class="sticky1-0017">-->
      <!--<div class="outer-0012">-->
        <!--<div class="horizontal-scroll-0014">-->
        
  <div class="container">       
        
              <div class="card-wrapper">
    <div class="swiper card-list">
      <div class="swiper-wrapper">
          
          
         

<div class="card card-hover animate-left swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314629.png" 
        alt="Dashboard Overview">
   <h1>Dashboard Overview</h1>

   
</div>

<div class="card card-hover  animate-in swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/image-12-1.png" 
        alt="Student Profiles">
   <h1>Student Profiles</h1>

</div>

<div class="card card-hover  animate-right swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-13-52-16-MAKTAB.png" 
        alt="Class Scheduling">
   <h1>Class Scheduling</h1>

</div>

<div class="card card-hover  animate-left swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314629.png" 
        alt="Dashboard Overview">
   <h1>Dashboard Overview</h1>

   
</div>

<div class="card card-hover  animate-in swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/image-12-1.png" 
        alt="Student Profiles">
   <h1>Student Profiles</h1>

</div>

<div class="card card-hover  animate-right swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-13-52-16-MAKTAB.png" 
        alt="Class Scheduling">
   <h1>Class Scheduling</h1>

</div>

         </div>
          <!-- Navigation Buttons -->
          <div class="swiper-button-prev animate-right"></div>
          <div class="swiper-button-next animate-left"></div>
      </div>
      </div>

         </div>
      </div>
  </section>
  
  
  
<!--Maktab003-->

    <section  class="section-padding Maktab001" >
        <div class="container">
        <div class="row column-reverse g-4 py-5 pad">
            <div class="col-lg-6 col-md-12  animate-left">
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" width="100%">
            </div>
            <div class="col-lg-5 col-md-12 animate-right" style="padding:0px 30px;">
                <h2 class="Solution-title txc">Maktab Parent Panel – <span class="solutin-highlight">Easy Mobile Access
                    </span>for Students & Parents</h2>
                <p class="solution-para txc">Track attendance, results, and updates on your phone. Designed for Makatib,
                    Madaris, and Niswa, this tool keeps parents and students connected—anytime, anywhere.</p>
                <!--<a href="#" class="icon-link" contenteditab>-->
                <!--      Explore More-->
                <!--      <i class="bi bi-arrow-right"></i>-->

                <!--    </a>-->
            </div>
        </div>
    </div>
   </section>
    
    
    
<!--ScrollB m1-->

    <section class="section-padding scrollB">
      <div class="container gap002">
    <!--<div class="sticky-top-section-0012">-->
  <h1>Maktab Parent Panel</h1>
  <p>
    A unified platform to oversee students, teachers, and schedules with ease.
    Built for Makatib, Madaris, and Niswan, it simplifies tasks and boosts daily
    productivity for your entire institution.
  </p>

    <!--<div class="sticky1-0017">-->
      <!--<div class="outer-0012">-->
        <!--<div class="horizontal-scroll-0014">-->
        


    <!--<div class="sticky1-0017">-->
      <!--<div class="outer-0012">-->
        <!--<div class="horizontal-scroll-0014">-->
        
<div class="container">       
        
    <div class="card-wrapper">
        <div class="swiper card-list">
            <div class="swiper-wrapper">
          
          
         

<div class="card card-hover  swiper-slide card-item animate-left">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314629.png" 
        alt="Dashboard Overview">
   <h1>Dashboard Overview</h1>

   
</div>

<div class="card card-hover  animate-in swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/image-12-1.png" 
        alt="Student Profiles">
   <h1>Student Profiles</h1>

</div>

<div class="card card-hover  animate-right swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-13-52-16-MAKTAB.png" 
        alt="Class Scheduling">
   <h1>Class Scheduling</h1>

</div>

<div class="card card-hover swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314629.png" 
        alt="Dashboard Overview">
   <h1>Dashboard Overview</h1>

   
</div>

<div class="card card-hover swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/image-12-1.png" 
        alt="Student Profiles">
   <h1>Student Profiles</h1>

</div>

<div class="card card-hover swiper-slide card-item">
   <img class="screenshot-images" 
        src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-13-52-16-MAKTAB.png" 
        alt="Class Scheduling">
   <h1>Class Scheduling</h1>

</div>

         </div>
          <!-- Navigation Buttons -->
          <div class="swiper-button-prev animate-right"></div>
          <div class="swiper-button-next animate-left"></div>
      </div>
      </div>

         </div>
      </div>
  </section>
    





<!--video-->

    <section id="tutorial" class="section-padding section-padding animated-box animate-in " style="background:#F7F5F2;padding-top: 70px;" >
 <div class="container" style="display:flex;padding-top: 30px;">
    <div class="left-content">
      <h1 class="video-title Solution-title">Tutorial <span class="solutin-highlight">Videos</span></h1>
      
    </div>

    <div class="right-content">
      <!-- Language Selection Buttons -->
      <div class="video-link">
        <span class="promo-video-inline021 active" data-video-id="dKaM14UywsM" data-lang="en">
          English
        </span>
        <span class="promo-video-inline021" data-video-id="DjVF0-4T-fM" data-lang="hi">
          Hindi
        </span>
        <span class="promo-video-inline021" data-video-id="-s9EIlK1Uw4" data-lang="ta">
           Tamil
        </span>
      </div>
    </div>
  </div>

     <div class="container">
    <!-- Video Container -->
    <div class="laptop-frame" id="shared-video-container">
      <iframe src="https://www.youtube.com/embed/dKaM14UywsM?autoplay=1&rel=0" allow=" encrypted-media" allowfullscreen></iframe>
    </div>
           </div>
  </div>
  </section>
  
  
  
  
  
<!--pay ment-->
  

    <section  class="section-padding Maktab001 bg-white py-5" >
    <div class="container text-center">
        <h2 class="fw-bold mb-3 animate-in">Flexible pricing</h2>
        <p class="text-muted mb-4 animate-in">
            Choose a plan that fits your event integration needs. Pricing is per connection, there is no limit of how
            many connections you can have.
            <a href="#" class="text-success text-decoration-underline animate-in">Contact us</a>.
        </p>
        <hr class="mb-5">

        <div class="row row-cols-1 row-cols-md-3 g-4 column-reverse">


            <!-- Essential -->
<div class="col animate-left w100 position-relative">
    <!-- Popular Badge -->
    <div class="position-absolute top-0 end-0 m-3">
        <h1>Popular</h1>
    </div>

    <div class="card h-100 border rounded-4 shadow-sm">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-start fw-semibold">Plan Alif</h5>
            <div class="text-start mt-3">
                <span class="h5 text-muted align-top">₹</span>
                <span class="display-5 fw-bold">590</span>
                <div class="small text-muted">per month</div>
            </div>
            <hr>
            <ul class="text-start mb-4 small text-muted list-unstyled">
                <li>✔ Salah Tracker</li>
                <li>✔ Admission Management</li>
                <li>✔ Student Management</li>
                <li>✔ Attendance</li>
                <li>✔ Exam Management</li>
                <li>✔ Task Management</li>
            </ul>
            <a href="https://app.maktab.info/auth/bismillah" class="btn btn-success mt-auto rounded-pill">Choose Plan</a>
        </div>
    </div>
</div>

<div class="col animate-left w100 position-relative">
    <!-- Popular Badge (optional) -->
    <div class="position-absolute top-0 end-0 m-3 z-1">
            <span class="badge rounded-pill" style="background-color: #a0ca00; color: #fff;">
                Popular
            </span>
        </div>

    <div class="card h-100 border rounded-4 shadow-sm">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-start fw-semibold">Plan Ba</h5>
            <div class="text-start mt-3">
                <span class="h5 text-muted align-top">₹</span>
                <span class="display-5 fw-bold">1180</span>
                <div class="small text-muted">per month</div>
            </div>
            <hr>
            <ul class="text-start mb-4 small text-muted list-unstyled">
                <li>✔ Everything of Plan Alif</li>
                <li>✔ Hifz Management</li>
                <li>✔ Hostel Module</li>
                <li>✔ Medical Record</li>
            </ul>
            <a href="https://app.maktab.info/auth/bismillah" class="btn btn-success mt-auto rounded-pill">Choose Plan</a>
        </div>
    </div>
</div>



            <!-- Plus -->
            <!--<div class="col animate-right w100">-->
            <!--    <div class="card h-100 border rounded-4 shadow-sm">-->
            <!--        <div class="card-body d-flex flex-column">-->
            <!--            <h5 class="card-title text-start fw-semibold">Plus</h5>-->
            <!--            <div class="text-start mt-3">-->
            <!--                <span class="h5 text-muted align-top">$</span>-->
            <!--                <span class="display-5 fw-bold">25</span>-->
            <!--                <div class="small text-muted">/month/connection</div>-->
            <!--            </div>-->
            <!--            <p class="text-start text-muted mt-2 small">For all event types.</p>-->
            <!--            <hr>-->
            <!--            <ul class="text-start mb-4 small text-muted list-unstyled">-->
            <!--                <li>✔ All in Essential</li>-->
            <!--                <li>✔ Recurring events referencing</li>-->
            <!--                <li>✔ Multiple collection capability</li>-->
            <!--                <li>✔ Event series functionality</li>-->
            <!--            </ul>-->
            <!--            <button class="btn btn-secondary mt-auto rounded-pill disabled">Coming soon</button>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

        </div>
    </div>
</section>
  
  

<!--Scroll   img-->


    <section id="solution" class="section-padding" style="background:#fff;padding-bottom:240px;">



    <div class="marquee-wrapper">

        <!-- First Row: Left Scroll -->
        <div class="marquee marquee-left">
            <div class="marquee-content">
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314633.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png"
                    alt="Logo 5" />

                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314633.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png"
                    alt="Logo 5" />
            </div>
        </div>

        <!-- Second Row: Right Scroll -->
        <div class="marquee marquee-right">
            <div class="marquee-content">
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314633.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png"
                    alt="Logo 5" />
 
               <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Group-1321314633.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Pasted-image-3.png" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/05/MAKTAB.png"
                    alt="Logo 5" />
            </div>
        </div>

    </div>

</section>






<!-- GSAP and ScrollTrigger -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>-->
<!--<script>-->
<!--  gsap.registerPlugin(ScrollTrigger);-->

  <!--// Horizontal Scroll for the first section-->
<!--  const scrollContainer1 = document.querySelector(".horizontal-scroll-004");-->
<!--  const panelWrapper1 = document.querySelector(".panel-005");-->

<!--  function initHorizontalScroll1() {-->
<!--    gsap.to(scrollContainer1, {-->
<!--      x: () => -(scrollContainer1.scrollWidth - window.innerWidth) + "px", // Scroll to the left by the full width of the container-->
<!--      ease: "none",-->
<!--      scrollTrigger: {-->
<!--        trigger: ".outer-003",-->
<!--        start: "top top",-->
<!--        end: () => "+=" + scrollContainer1.scrollWidth,-->
<!--        scrub: true,-->
<!--        pin: true,-->
<!--        anticipatePin: 1,-->
<!--        onEnter: () => {-->
<!--          // Enable the horizontal scroll animation-->
<!--          gsap.to(scrollContainer1, { x: 0, ease: "none" });-->
<!--        },-->
<!--        onLeaveBack: () => {-->
<!--          // Disable horizontal scroll if you scroll back up-->
<!--          gsap.to(scrollContainer1, { x: 0, ease: "none" });-->
<!--        }-->
<!--      }-->
<!--    });-->
<!--  }-->

<!--  // Horizontal Scroll for the second section-->
<!--  const scrollContainer2 = document.querySelector(".horizontal-scroll-0014");-->
<!--  const panelWrapper2 = document.querySelector(".panel-0017");-->

<!--  function initHorizontalScroll2() {-->
<!--    gsap.to(scrollContainer2, {-->
<!--      x: () => scrollContainer2.scrollWidth - window.innerWidth + "px", // Scroll to the right by the full width of the container-->
<!--      ease: "none",-->
<!--      scrollTrigger: {-->
<!--        trigger: ".outer-0012",-->
<!--        start: "top top",-->
<!--        end: () => "+=" + scrollContainer2.scrollWidth,-->
<!--        scrub: true,-->
<!--        pin: true,-->
<!--        anticipatePin: 1,-->
<!--        onEnter: () => {-->
<!--          // Enable the horizontal scroll animation-->
<!--          gsap.to(scrollContainer2, { x: 0, ease: "none" });-->
<!--        },-->
<!--        onLeaveBack: () => {-->
<!--          // Disable horizontal scroll if you scroll back up-->
<!--          gsap.to(scrollContainer2, { x: 0, ease: "none" });-->
<!--        }-->
<!--      }-->
<!--    });-->
<!--  }-->

<!--  // Initialize on page load-->
<!--  window.addEventListener("load", () => {-->
<!--    initHorizontalScroll1();-->
<!--    initHorizontalScroll2();-->
<!--  });-->
<!--</script>-->





















  <!-- Script -->
<script>
  const videoButtons = document.querySelectorAll('.promo-video-inline021');
  const container = document.getElementById('shared-video-container');

  videoButtons.forEach(button => {
    button.addEventListener('click', function () {
      const videoId = this.getAttribute('data-video-id');
      const lang = this.getAttribute('data-lang');

      // Update iframe
      container.innerHTML = `
        <iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&cc_load_policy=1&cc_lang_pref=${lang}" 
                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;

      // Remove active from all, then add to clicked one
      videoButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });
</script>




<!--stop the video-->


<script>
  document.addEventListener('click', function (event) {
    document.querySelectorAll('.svc022').forEach(container => {
      const iframe = container.querySelector('iframe');
      if (!iframe || container.contains(event.target)) return;
      container.innerHTML = ''; // Remove iframe to stop video
    });
  });
</script>



<!--scrollA ScriptA-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>-->



<!--<!-button youtube--->
<script>
// Function to change the video based on selected language
function changeVideoLanguage(videoIndex, language) {
  var baseURL = 'https://www.youtube.com/embed/';
  
  // Mapping video IDs
var videoIds = {
  1: {
    'en': 'dKaM14UywsM',
    'hi': 'DjVF0-4T-fM',
    'ta': '-s9EIlK1Uw4'
  },
  2: {
    'en': 'VIDEO_ID_EN_2',
    'hi': 'Jmqd187H5Ls',
    'ta': 'VIDEO_ID_TA_2'
  },
  3: {
    'en': 'VIDEO_ID_EN_3',
    'hi': 'LLIRICPJXM4',
    'ta': 'VIDEO_ID_TA_3'
  },
  4: {
    'en': 'VIDEO_ID_EN_4',
    'hi': 'Y-gAza-Z3pQ',
    'ta': 'VIDEO_ID_TA_4'
  },
  5: {
    'en': 'VIDEO_ID_EN_5',
    'hi': 'mJdILHKIfNM',
    'ta': 'VIDEO_ID_TA_5'
  },
  6: {
    'en': 'VIDEO_ID_EN_6',
    'hi': 'hSiC71nyL38',
    'ta': 'VIDEO_ID_TA_6'
  },
  7: {
    'en': 'VIDEO_ID_EN_7',
    'hi': 'IzlBqhKp6u4',
    'ta': 'VIDEO_ID_TA_7'
  },
  8: {
    'en': 'VIDEO_ID_EN_8',
    'hi': 'pR8aA6PfXE',
    'ta': 'VIDEO_ID_TA_8'
  },
  9: {
    'en': 'VIDEO_ID_EN_9',
    'hi': 'NWjQeoc5v4E',
    'ta': 'VIDEO_ID_TA_9'
  },
  10: {
    'en': 'VIDEO_ID_EN_10',
    'hi': 'kLroMWbZYZk',
    'ta': 'VIDEO_ID_TA_10'
  },
  11: {
    'en': 'VIDEO_ID_EN_11',
    'hi': '1nPa17yWRkc',
    'ta': 'VIDEO_ID_TA_11'
  },
  12: {
    'en': 'VIDEO_ID_EN_12',
    'hi': 'r-j8qJH0OlQ',
    'ta': 'VIDEO_ID_TA_12'
  },
  13: {
    'en': 'VIDEO_ID_EN_13',
    'hi': 'ADFZht19N1I',
    'ta': 'VIDEO_ID_TA_13'
  },
  14: {
    'en': 'VIDEO_ID_EN_14',
    'hi': 'MqBcdNzAs6A',
    'ta': 'VIDEO_ID_TA_14'
  },
  15: {
    'en': 'VIDEO_ID_EN_15',
    'hi': 'Y9eNBpLIrjc',
    'ta': 'VIDEO_ID_TA_15'
  },
  16: {
    'en': 'VIDEO_ID_EN_16',
    'hi': 'r-j8qJH0OlQ',
    'ta': 'VIDEO_ID_TA_16'
  },
  17: {
    'en': 'VIDEO_ID_EN_17',
    'hi': 'AZtr5Et6jIc',
    'ta': 'VIDEO_ID_TA_17'
  },
  18: {
    'en': 'VIDEO_ID_EN_18',
    'hi': 'bhz2Z2ij2KY',
    'ta': 'VIDEO_ID_TA_18'
  },

};


  // Get the correct video ID
  var selectedVideoId = videoIds[videoIndex][language];
  var videoURL = `${baseURL}${selectedVideoId}?rel=0`;

  // Update iframe
  var iframe = document.getElementById('video' + videoIndex);
  if (iframe) {
    iframe.src = videoURL;
  }

  // Update active class
  const clickedButton = event.target;
  const buttons = document.querySelectorAll('.language-options > button');
  buttons.forEach(btn => btn.classList.remove('active'));
  clickedButton.classList.add('active'); 

  console.log(`Switched video ${videoIndex} to ${language}`);
}




</script>





<script>
  // Function to wait for all images to load
  function waitForDirectChildImagesToLoad(container, callback) {
    const cards = Array.from(container.children); // Direct .card children only
    const images = cards.flatMap(card => Array.from(card.querySelectorAll('img')));

    if (images.length === 0) return callback();

    let loadedCount = 0;
    const checkAllLoaded = () => {
      loadedCount++;
      if (loadedCount === images.length) callback();
    };

    images.forEach(img => {
      if (img.complete) {
        checkAllLoaded();
      } else {
        img.addEventListener("load", checkAllLoaded);
        img.addEventListener("error", checkAllLoaded);
      }
    });
  }

  // Initialize horizontal scrolling after images are loaded
  window.addEventListener("load", () => {
    waitForDirectChildImagesToLoad(panelWrapper1, () => {
      initHorizontalScroll1();
      ScrollTrigger.refresh();
    });

    waitForDirectChildImagesToLoad(panelWrapper2, () => {
      initHorizontalScroll2();
      ScrollTrigger.refresh();
    });
  });
</script>










<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    /// Select all images and the fullscreen elements
    const images = document.querySelectorAll('.screenshot-images');
    const fullscreenView = document.getElementById('fullscreen-view');
    const fullscreenImage = document.getElementById('fullscreen-image');

    // Add click event to each image
    images.forEach(image => {
        image.addEventListener('click', () => {
            fullscreenImage.src = image.src; // Set the image source
            fullscreenView.classList.remove('hidden'); // Show fullscreen view
        });
    });

    // Hide fullscreen on click
    fullscreenView.addEventListener('click', () => {
        fullscreenView.classList.add('hidden');
        fullscreenImage.src = ''; // Clear image source
    });


    $(document).ready(function () {
        $('.app-slider').slick({
            dots: true,             // Show navigation dots
            arrows: true,           // Enable previous/next arrows
            infinite: true,         // Infinite looping
            speed: 500,             // Transition speed
            slidesToShow: 3,        // Show one slide at a time
            slidesToScroll: 1,      // Scroll one slide at a time
            autoplay: true,         // Enable autoplay
            autoplaySpeed: 3000,    // Set autoplay interval to 3 seconds
            responsive: [
                {
                    breakpoint: 768,    // At widths less than 768px
                    settings: {
                        slidesToShow: 1,  // Show one slide
                    },
                },
                {
                    breakpoint: 480,    // At widths less than 480px
                    settings: {
                        slidesToShow: 1,  // Show one slide
                        arrows: false,    // Hide arrows for smaller screens
                    },
                },
            ],
        });
    });

</script>
<!--22222-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
  // Handle iframe reset for modals with class vm002
  $('.vm002').on('hidden.bs.modal', function () {
    var $iframe = $(this).find('iframe');
    if ($iframe.length) {
      $iframe.attr("src", $iframe.attr("src")); // resets the video
    }
  });
  
  
  
  
  
  
  
  
  
  
  
  
  
  function changeVideoLanguage11(videoIndex, language, event) {
  const baseURL = 'https://www.youtube.com/embed/';
  
  const videoIds = {
    1: {
      en: 'dKaM14UywsM',
      hi: 'DjVF0-4T-fM',
      ta: '-s9EIlK1Uw4'
    }
    // Add other video indices if needed
  };

  // Get the selected video ID
  const selectedVideoId = videoIds[videoIndex][language];
  const videoURL = `${baseURL}${selectedVideoId}?rel=0`;

  // Update the iframe
  const iframe = document.getElementById('video' + videoIndex);
  if (iframe) {
    iframe.src = videoURL;
  }

  // Remove 'active' from all sibling buttons in this language-options block
  const container = event.target.closest('.language-options');
  const buttons = container.querySelectorAll('button');
  buttons.forEach(btn => btn.classList.remove('active'));

  // Add 'active' to the clicked button
  event.target.classList.add('active');

  console.log(`Switched video ${videoIndex} to ${language}`);
}

    function changeVideoLanguage(videoIndex, language, event) {
  const baseURL = 'https://www.youtube.com/embed/';
  
  // Video ID mapping
  const videoIds = {
    1: {
      en: 'dKaM14UywsM',
      hi: 'DjVF0-4T-fM',
      ta: '-s9EIlK1Uw4'
    }
    // Add other video indices here if needed
  };

  // Get the selected video ID
  const selectedVideoId = videoIds[videoIndex][language];
  const videoURL = `${baseURL}${selectedVideoId}?rel=0`;

  // Update iframe with the new URL
  const iframe = document.getElementById('video' + videoIndex);
  if (iframe) {
    iframe.src = videoURL;
  }

  // Get all buttons and remove the 'active' class from them
  const buttons = document.querySelectorAll('.language-options > button');
  buttons.forEach(btn => {
    btn.classList.remove('active'); // Remove active class from all buttons
  });

  // Add 'active' class to the clicked button
  event.target.classList.add('active');
  
  // Log to console for debugging
  console.log(`Video ${videoIndex} switched to language: ${language}`);
}








// animation


document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
        observer.unobserve(entry.target); // Remove if you want re-animations on scroll
      }
    });
  }, {
    threshold: 0.1
  });

  // Combine all animation-related classes into one list
  document.querySelectorAll('.animate-in, .animate-left, .animate-right').forEach(el => {
    observer.observe(el);
  });
});

  
</script>


  <script>
    const carousel = document.querySelector("#carouselExampleControls");
    const carouselInner = carousel.querySelector(".carousel-inner");
    let startX, isDown = false;

    carouselInner.addEventListener("mousedown", (e) => {
      isDown = true;
      startX = e.clientX;
    });

    carouselInner.addEventListener("mouseup", (e) => {
      if (!isDown) return;
      const endX = e.clientX;
      handleSwipe(startX, endX);
      isDown = false;
    });

    carouselInner.addEventListener("mousemove", (e) => {
      if (isDown) e.preventDefault(); // prevents image selection
    });

    carouselInner.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
    });

    carouselInner.addEventListener("touchend", (e) => {
      const endX = e.changedTouches[0].clientX;
      handleSwipe(startX, endX);
    });

    function handleSwipe(start, end) {
      const diff = start - end;
      const threshold = 50; // min swipe distance
      const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carousel);

      if (diff > threshold) {
        carouselInstance.next();
      } else if (diff < -threshold) {
        carouselInstance.prev();
      }
    }
  </script>



  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper('.card-list', {
      loop: true,
      spaceBetween: 20,
      slidesPerView: 1,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }
      }
    });
  </script>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>


<!--changeVideoLanguage-->





<?php get_footer(); ?>