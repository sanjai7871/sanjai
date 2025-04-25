<?php 
/* 
    Template Name: home page1
*/
get_header();
?>
<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");


    /* feature */
    .card.features {
        padding: 30px !important;
        border-radius: 25px;
        border: 1px solid #ddd;
    }


    .container1 {
        width: 15000px;
        height: 1000px;
    }


    .hero-section {
        /*padding-top: 100px;*/
        position: relative;
    }

    .hero-section-container {
        text-align: center;
        margin-bottom: 2rem;
        z-index: 2;
        position: relative;
    }

    .hero-btn {
        margin-top: 20px;
        display: inline-block;
        padding: 10px 20px;
        background-color: #a0ca00;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .image-wrapper1 {
        position: relative;
        width: 1041px;
        height: 603px;
        overflow: hidden;

        display: block;
        margin: auto;
        align-items: center;
    }

    .hero-image1 {
        position: absolute;
        width: 90%;
        /*height: 100%;*/
        object-fit: cover;
        z-index: 0;
        left: 50%;
        transform: translateX(-50%);

    }

    .hero-image-slide {
        position: absolute;
        top: -5%;
        width: 67%;
        height: 100%;
        z-index: 1;
        left: 50%;
        transform: translateX(-50%);
    }

    .d-block {
        height: 600px;
        object-fit: contain;
    }

    @media screen and (max-width: 768px) {
        .container1 {
            width: 100%;
            height: auto;
            padding: 10px;
            overflow-x: hidden;
        }

        .card.features {
            padding: 20px !important;
            border-radius: 15px;
        }

        /*.hero-section {*/
        /*    padding-top: 60px;*/
        /*}*/

        .hero-btn {
            padding: 8px 16px;
            font-size: 14px;
        }

        .image-wrapper1 {
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-image1 {
            position: relative;
            width: 100%;
            height: auto;
            object-fit: contain;
            z-index: 0;
            left: 0;
            transform: none;
            display: none;
        }

        .hero-image-slide {
            position: relative;
            width: 100%;
            height: auto;
            object-fit: contain;
            z-index: 1;
            left: 0;
            top: 0;
            transform: none;

        }

        .d-block {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
    }

    /*video*/


    #intro-video {
        border-radius: 20px;
        background-image: url('https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        min-height: 460px;
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        position: relative;
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
    justify-content: center;
    align-items: center;
    text-align: justify;
    gap: 10px;
}

#scrollN > div {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    position: sticky;
    top: 230.4px; /* Converted from 30vh */
    gap: 30px;
    background-image: url('https://maktab.info/wp-content/uploads/2025/04/Frame-5-scaled.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

#scrollN > div:first-child {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    position: sticky;
    top: 0px; /* Remains the same, as 0vh = 0px */
    height: 230.4px; /* Converted from 30vh */
}

#scrollN > div > nav > ul {
    display: flex;
    flex-direction: row;
    list-style-type: none;
}

#scrollN img {
    height: 150px; /* Updated from 255.99px to 150px */
    width: 100%;
}




    /*<script src="https://cdn.tailwindcss.com"></script>*/
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">









<section class="hero-section">
    <div class="container">
        <div class="hero-section-container">
            <h1 class="h1-title">Empowering <span class="span-tag">Maktab</span> through Digital Innovations and
                Solutions</h1>
            <p class="para">
                Our all-in-one solution streamlines operations, enhances communication, and optimizes learning.
                Apps for admins, teachers, and parents simplify attendance, student records, and class activities
                management.
            </p>
            <a href="https://maktab.info/contact-us/" class="hero-btn">Get Started</a>
        </div>

        <div class="image-wrapper1">
            <!-- Background Image -->
            <img src="https://maktab.info/wp-content/uploads/2025/04/image-1.png" class="hero-image1"
                alt="Background" />




            <!-- ✅ Carousel -->
            <div id="carouselExampleDark" class="carousel carousel-dark slide hero-image-slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-16-03-31-MAKTAB.png"
                            class="d-block w-100" alt="Slide 1" />
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image.png" class="d-block w-100"
                            alt="Slide 1" />
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image-8.png" class="d-block w-100"
                            alt="Slide 2" />
                    </div>
                    <div class="carousel-item">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image-6.png" class="d-block w-100"
                            alt="Slide 3" />
                    </div>

                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image-5.png" class="d-block w-100"
                            alt="Slide 2" />
                    </div>
                    <div class="carousel-item">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image-3.png" class="d-block w-100"
                            alt="Slide 3" />
                    </div>

                    <div class="carousel-item">
                        <img src="https://maktab.info/wp-content/uploads/2025/04/image-3.png" class="d-block w-100"
                            alt="Slide 3" />
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
</section>





<section class="section-padding" id="features">

    <div class="container">
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

            <div class="feature col-md-12 section-title">
                <h2 class="fs-2 text-body-emphasis">Key <span class="solutin-highlight">Feature</span> for Maktab
                    Management</h2>
                <p>Streamline operations, enhance communication, and simplify attendance tracking with our all-in-one
                    digital solution.</p>
                <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                <!--  Explore More-->
                <!--  <i class="bi bi-arrow-right"></i>-->
                <!--</a>-->
            </div>
            <div class="feature col">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Admin Control Panel</h3>
                    <p>A comprehensive admin app designed for maktab administrators, providing tools to manage
                        admissions, track attendance, update student records, and monitor tasks, ensuring a seamless
                        digital experience for every aspect of your institution.</p>
                    <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                    <!--  Read More-->
                    <!--  <i class="bi bi-arrow-up-right"></i>-->
                    <!--</a>-->
                </div>
            </div>
            <div class="feature col">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-phone"></i>
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
            <div class="feature col">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-diagram-3"></i>
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
            <div class="feature col">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-newspaper"></i>
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
            <div class="feature col">
                <div class="card features">
                    <div class="feature-icon d-inline-flex align-items-center fs-2 mb-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="fs-2 text-body-emphasis">Task Management & Progress Tracking</h3>
                    <p>Assign and manage tasks for students with ease. The platform allows teachers to track task
                        completion and performance, while parents receive instant updates, creating a collaborative
                        environment for student success.</p>
                    <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                    <!--Read More-->
                    <!--  <i class="bi bi-arrow-up-right"></i>-->
                    <!--</a>-->
                </div>
            </div>
        </div>
    </div>
</section>

<!--<section ids="screenshot" class="section-padding">-->
<!--    <div class="container">-->
<!--<div class="row g-4 py-5">-->
<!--    <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--        <div class="card">-->

<!--            <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/01/maktab.png">-->
<!--            <h2 class="screenshot-name">Maktab Dashboard</h2>-->
<!--        </div>-->
<!--        </div>-->
<!--        <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--             <div class="card">-->

<!--        <img class="screenshot-image" src="https://maktab.info/wp-content/uploads/2025/01/iPhone-1.png">-->
<!--        <h2 class="screenshot-name">Parents Dashboard</h2>-->
<!--        </div>-->
<!--        </div>-->
<!--        <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--             <div class="card">-->

<!--        <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/01/student.png">-->
<!--        <h2 class="screenshot-name">Students Dashboard</h2>-->
<!--        </div>-->
<!--        </div>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->



<!--<section id="screenshot" class="section-padding" style="background:#F7F5F2;">-->
<!--    <div class="container">-->
<!--        <h2 class="Solution-title">App <span class="solutin-highlight">Screenshots</span></h2>-->
<!--        <div class="row g-4 py-5">-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--                <div class="card hover-card">-->
<!--                    <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/01/maktab.png" alt="Maktab Dashboard">-->
<!--                    <h2 class="screenshot-name">Maktab Dashboard</h2>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--                <div class="card hover-card">-->
<!--                    <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/01/iPhone-1.png" alt="Parents Dashboard">-->
<!--                    <h2 class="screenshot-name">Parents Dashboard</h2>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-4 col-sm-12">-->
<!--                <div class="card hover-card">-->
<!--                    <img class="screenshot-images" src="https://maktab.info/wp-content/uploads/2025/01/student.png" alt="Students Dashboard">-->
<!--                    <h2 class="screenshot-name">Students Dashboard</h2>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--       <div class="app-slider">-->
<!--  <div><img src="https://maktab.info/wp-content/uploads/2025/01/screenshot4.jpg" alt="App Screenshot 1"></div>-->
<!--  <div><img src="https://maktab.info/wp-content/uploads/2025/01/screenshot2.jpg" alt="App Screenshot 2"></div>-->
<!--  <div><img src="https://maktab.info/wp-content/uploads/2025/01/screenshot3.jpg" alt="App Screenshot 3"></div>-->
<!--  <div><img src="https://maktab.info/wp-content/uploads/2025/01/screenshot1.jpg" alt="App Screenshot 4"></div>-->
<!--</div>-->


<!--    </div>-->
<!--</section>-->












<div id="fullscreen-view" class="fullscreen hidden">
    <img id="fullscreen-image" src="" alt="Fullscreen Image">
</div>




<!--div 2 plan-->

<!--div2 -->



<section class="bg-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Flexible pricing</h2>
        <p class="text-muted mb-4">
            Choose a plan that fits your event integration needs. Pricing is per connection, there is no limit of how
            many connections you can have.
            <a href="#" class="text-success text-decoration-underline">Contact us</a>.
        </p>
        <hr class="mb-5">

        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- Early Bird -->
            <div class="col">
                <div class="card h-100 border rounded-4 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-start fw-semibold">Early bird</h5>
                        <div class="text-start mt-3">
                            <span class="h5 text-muted align-top">$</span>
                            <span class="display-5 fw-bold">200</span>
                            <div class="small text-muted">one-time payment</div>
                        </div>
                        <p class="text-start text-muted mt-2 small">This price is available until Oct. 30th 2023.</p>
                        <hr>
                        <ul class="text-start mb-4 small text-muted list-unstyled">
                            <li>✔ All in Essential & Plus</li>
                            <li>✔ Lifetime access for one connection</li>
                            <li>✔ Early access to the product</li>
                            <li>✔ Fully refundable</li>
                        </ul>
                        <a href="#" class="btn btn-success mt-auto rounded-pill">Claim this price</a>
                    </div>
                </div>
            </div>

            <!-- Essential -->
            <div class="col">
                <div class="card h-100 border rounded-4 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-start fw-semibold">Essential</h5>
                        <div class="text-start mt-3">
                            <span class="h5 text-muted align-top">$</span>
                            <span class="display-5 fw-bold">15</span>
                            <div class="small text-muted">/month/connection</div>
                        </div>
                        <p class="text-start text-muted mt-2 small">For events without complex structures.</p>
                        <hr>
                        <ul class="text-start mb-4 small text-muted list-unstyled">
                            <li>✔ Field mapping customization</li>
                            <li>✔ Eventbrite embedded checkout</li>
                            <li>✔ Automated event updates</li>
                            <li>✔ Real-time data synchronisation</li>
                        </ul>
                        <button class="btn btn-secondary mt-auto rounded-pill disabled">Coming soon</button>
                    </div>
                </div>
            </div>

            <!-- Plus -->
            <div class="col">
                <div class="card h-100 border rounded-4 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-start fw-semibold">Plus</h5>
                        <div class="text-start mt-3">
                            <span class="h5 text-muted align-top">$</span>
                            <span class="display-5 fw-bold">25</span>
                            <div class="small text-muted">/month/connection</div>
                        </div>
                        <p class="text-start text-muted mt-2 small">For all event types.</p>
                        <hr>
                        <ul class="text-start mb-4 small text-muted list-unstyled">
                            <li>✔ All in Essential</li>
                            <li>✔ Recurring events referencing</li>
                            <li>✔ Multiple collection capability</li>
                            <li>✔ Event series functionality</li>
                        </ul>
                        <button class="btn btn-secondary mt-auto rounded-pill disabled">Coming soon</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>













<!--solution-->


<section id="solution" class="section-padding" style="background:#fff;padding-bottom:20px;">
   
    <div class="container">
        <div class="row column-reverse g-4 py-5">
            <div class="col-lg-6 col-md-12">
                <img src="https://maktab.info/wp-content/uploads/2025/04/admin-screenshot.png" width="100%">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-lg-5 col-md-12" style="padding:0px 30px;">
                <h2 class="Solution-title">Maktab Admin Panel – For <span class="solutin-highlight">Makatib, Madaris &
                        Niswan</span></h2>
                <p class="solution-para">Efficiently manage students, teachers, classes, and records. Tailored for
                    Makatib, Madaris, and Niswan, this system supports traditional Islamic education with modern tools.
                </p>
                <!--<button>button</button>-->
                <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                <!--      Explore More-->
                <!--      <i class="bi bi-arrow-right"></i>-->
                <!--    </a>-->
            </div>
        </div>
    </div>









<div class="container">

<div id="scrollN" style="width: 100%;">

    <div style="display: flex; flex-direction: column;">
        <h1>Maktab Admin Panel</h1> <!-- First h4 changed to h1 -->
        <p>Efficiently manage students, teachers, classes, and records. Tailored for Makatib, Madaris, and Niswan.</p>
    </div>

    <div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-10-38-MAKTAB.png"
                alt="Dashboard Overview">
            <h4>Dashboard Overview</h4> <!-- Changed to h4 -->
            <p>View summaries of all key data: students, teachers, fees, and recent activities.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-08-39-MAKTAB-2.png"
                alt="Student Profiles">
            <h4>Student Profiles</h4>
            <p>Access and manage detailed student records, academic history, and attendance.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-12-59-MAKTAB.png"
                alt="Class Scheduling">
            <h4>Class Scheduling</h4>
            <p>Create and assign class timetables with real-time conflict detection.</p>
        </div>
    </div>

    <div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-18-18-MAKTAB1.png"
                alt="Teacher Management">
            <h4>Teacher Management</h4>
            <p>Onboard, assign, and monitor teacher responsibilities and performance.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-19-46-MAKTAB.png"
                alt="Fee Tracking">
            <h4>Fee Tracking</h4>
            <p>Track fee collection status, generate invoices, and send reminders.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-33-42-MAKTAB-1.png"
                alt="Exam Results">
            <h4>Exam Results</h4>
            <p>Publish, archive, and analyze student performance in exams.</p>
        </div>
    </div>

    <div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-30-42-MAKTAB.png"
                alt="Reports & Analytics">
            <h4>Reports & Analytics</h4>
            <p>Generate reports for attendance, academics, and finances with charts.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-36-36-MAKTAB.png"
                alt="Announcements">
            <h4>Announcements</h4>
            <p>Send updates and important notifications to staff and students.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-37-59-MAKTAB.png"
                alt="Library System">
            <h4>Library System</h4>
            <p>Manage book inventory, borrowing history, and library schedules.</p>
        </div>
    </div>

    <div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-42-00-MAKTAB1.png"
                alt="Attendance Tracking">
            <h4>Attendance Tracking</h4>
            <p>Mark and monitor daily attendance with automated alerts for absences.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-42-49-MAKTAB.png"
                alt="Role Management">
            <h4>Role Management</h4>
            <p>Assign roles like admin, teacher, or accountant with permission control.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-44-55-MAKTAB.png"
                alt="Document Center">
            <h4>Document Center</h4>
            <p>Upload and manage documents like certificates, notices, and curriculum.</p>
        </div>
    </div>

    <div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-49-33-MAKTAB.png"
                alt="Event Calendar">
            <h4>Event Calendar</h4>
            <p>Plan and publish events like exams, holidays, and parent-teacher meetings.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-51-26-MAKTAB.png"
                alt="User Settings">
            <h4>User Settings</h4>
            <p>Manage profile settings, passwords, and preferences for all users.</p>
        </div>
        <div class="card hover-card">
            <img class="screenshot-images"
                src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-19-33-42-MAKTAB-1.png"
                alt="Backup & Restore">
            <h4>Backup & Restore</h4>
            <p>Safeguard data with scheduled backups and easy restore options.</p>
        </div>
    </div>

</div>


</div>





















    <div class="container">
        <div class="row flex-column-reverse flex-lg-row g-4 py-5">



            <div class="col-lg-5 col-md-12" style="padding:0px 30px;">
                <h2 class="Solution-title">Maktab Staff Panel – Smart Tools for <span
                        class="solutin-highlight">Attendance & Exam</span></h2>
                <p class="solution-para">Manage attendance, exams, schedules, and records efficiently. Built for
                    Makatib, Madaris, and Niswan, this platform simplifies educational tasks and enhances staff
                    productivity daily.</p>
                <!--<a href="#" class="icon-link" contenteditable="false" style="cursor: pointer;">-->
                <!--      Explore More-->
                <!--      <i class="bi bi-arrow-right"></i>-->
                <!--    </a>-->
            </div>



            <div class="col-md-1">
            </div>

            <div class="col-lg-6 col-md-12">
                <img src="https://maktab.info/wp-content/uploads/2025/04/admin-screenshot.png" width="100%">
            </div>

        </div>
    </div>


    <div class="container">
        <div class="row column-reverse g-4 py-5">
            <div class="col-lg-6 col-md-12">
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" width="100%">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-lg-5 col-md-12" style="padding:0px 30px;">
                <h2 class="Solution-title">Maktab Parent Panel – <span class="solutin-highlight">Easy Mobile Access
                    </span>for Students & Parents</h2>
                <p class="solution-para">Track attendance, results, and updates on your phone. Designed for Makatib,
                    Madaris, and Niswa, this tool keeps parents and students connected—anytime, anywhere.</p>
                <!--<a href="#" class="icon-link" contenteditab<span class="solutin-highlight">le="false" style="cursor: pointer;">-->
                <!--      Explore More-->
                <!--      <i class="bi bi-arrow-right"></i>-->
                <!--    </a>-->
            </div>
        </div>
    </div>
</section>















<section id="solution" class="section-padding" style="background:#fff;padding-bottom:180px;">

    <!--    <div class="text-center mb-4">-->
    <!--  <h1 class="text-white font-weight-bold">Your Digital Learning Partner</h1>-->
    <!--</div>-->
    <div class="container">
        <!-- Video Section -->
        <!-- Video Section -->
        <section id="intro-video">
            <div class="promo-video" data-toggle="modal" data-target="#exampleModalCenter">
                <div class="waves-block">
                    <div class="waves wave-1"></div>
                    <div class="waves wave-2"></div>
                    <div class="waves wave-3"></div>
                </div>
                <i class="fa fa-play"></i>
            </div>
        </section>

        <!-- Video Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body p-0">
                        <div class="custom-video-wrapper">
                            <iframe src="https://www.youtube.com/embed/CAVyaJkC8iI" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</section>






<!--<section id="solution" class="section-padding" style="background:#fff;padding-bottom:80px;">-->

<!--  <div class="container text-center mb-5">-->
<!--    <h1 class="fw-bold">Find the right plan</h1>-->
<!--    <p class="text-muted mx-auto" style="max-width: 600px;">-->
<!--      Invest in your company's future with our comprehensive financial solution. Contact us for pricing details and see how we can help you streamline your finances and reach your business goals.-->
<!--    </p>-->
<!--  </div>-->

<!--  <div class="container">-->
<!--    <div class="row row-cols-1 row-cols-md-3 g-4 text-center">-->
<!-- Basic Plan -->
<!--      <div class="col">-->
<!--        <div class="card card2 shadow-sm">-->
<!--          <div class="card-body d-flex flex-column">-->
<!--            <div class="plan-title mb-2">Basic</div>-->
<!--            <div class="price mb-3">$0</div>-->
<!--            <p class="text-muted">Get a professional website designed according to your needs.</p>-->
<!--            <ul class="list-unstyled mb-4">-->
<!--              <li>Get a fully designed Website.</li>-->
<!--              <li>Webflow Development</li>-->
<!--              <li>Limited Support</li>-->
<!--            </ul>-->
<!--            <div class="mt-auto">-->
<!--              <button class="btn btn-outline-dark">Select Plan</button>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

<!-- Pro Plan -->
<!--      <div class="col">-->
<!--        <div class="card card2 shadow-sm">-->
<!--          <div class="card-body d-flex flex-column">-->
<!--            <div class="plan-title pro mb-2">Pro</div>-->
<!--            <div class="price mb-3">$499</div>-->
<!--            <p class="text-muted">Get a professional website designed according to your needs.</p>-->
<!--            <ul class="list-unstyled mb-4">-->
<!--              <li>Get a fully designed Website</li>-->
<!--              <li>Webflow Development</li>-->
<!--              <li>Limited Support</li>-->
<!--              <li>24/7 Support system</li>-->
<!--            </ul>-->
<!--            <div class="mt-auto">-->
<!--              <button class="btn btn-outline-dark">Select Plan</button>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

<!-- Enterprise Plan -->
<!--      <div class="col">-->
<!--        <div class="card card2 shadow-sm">-->
<!--          <div class="card-body d-flex flex-column">-->
<!--            <div class="plan-title enterprise mb-2">Enterprise</div>-->
<!--            <div class="price mb-3">$999</div>-->
<!--            <p class="text-muted">Get a professional website designed according to your needs.</p>-->
<!--            <ul class="list-unstyled mb-4">-->
<!--              <li>Get a fully designed Website</li>-->
<!--              <li>Webflow Development</li>-->
<!--              <li>Limited Support</li>-->
<!--              <li>24/7 Support system</li>-->
<!--              <li>Multiple revisions</li>-->
<!--              <li>Dedicated Account Manager</li>-->
<!--            </ul>-->
<!--            <div class="mt-auto">-->
<!--              <button class="btn btn-success">Contact us</button>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->






<!--Scroll   img-->


<section id="solution" class="section-padding" style="background:#fff;padding-bottom:240px;">



    <div class="marquee-wrapper">

        <!-- First Row: Left Scroll -->
        <div class="marquee marquee-left">
            <div class="marquee-content">
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/screenshot4.jpg" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/hero-section.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-16-03-31-MAKTAB.png"
                    alt="Logo 5" />

                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/screenshot4.jpg" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/hero-section.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-16-03-31-MAKTAB.png"
                    alt="Logo 5" />
            </div>
        </div>

        <!-- Second Row: Right Scroll -->
        <div class="marquee marquee-right">
            <div class="marquee-content">
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/screenshot4.jpg" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/hero-section.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-16-03-31-MAKTAB.png"
                    alt="Logo 5" />

                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-08-at-10-24-55-MAKTAB.png"
                    alt="Logo 1" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/screenshot1.png" alt="Logo 2" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/screenshot4.jpg" alt="Logo 3" />
                <img src="https://maktab.info/wp-content/uploads/2025/01/hero-section.png" alt="Logo 4" />
                <img src="https://maktab.info/wp-content/uploads/2025/04/Screenshot-2025-04-07-at-16-03-31-MAKTAB.png"
                    alt="Logo 5" />
            </div>
        </div>

    </div>

</section>
















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
<script>
    $('#exampleModalCenter').on('hidden.bs.modal', function () {
        var $iframe = $(this).find('iframe');
        $iframe.attr("src", $iframe.attr("src")); // resets the video
    });
</script>


<?php get_footer(); ?>