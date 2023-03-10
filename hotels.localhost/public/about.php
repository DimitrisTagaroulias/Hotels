<?php
  require __DIR__.'/../boot/boot.php';

  // <!-- HEAD START-->
  require_once('__head.html')
?>

    <title>Travel the World | Login</title>

    <!-- CSS START -->
    
    <?php require_once('__css.html') ?>

    
    
    <link rel="stylesheet" type="text/css" href="assets/css/css_about/about-main.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/css_about/slider.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/css_about/media_about_320-2.css" media="screen and (min-width:320px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_414_HEADER-12.css" media="screen and (min-width:414px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_about/media_about_481-3.css" media="screen and (min-width:481px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    
    <link rel="stylesheet" type="text/css" href="assets/css/css_about/media_about_769_LS-4.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    
    <!-- CSS END -->

  </head>
  <!-- HEAD END-->
  
   <!-- BODY START -->
  <body>
    <!-- HEADER START -->
    <?php require_once('__header.php') ?>

    <div class="hero-container">
    
    <!-- OUTER MAIN START -->
    <main id="outer-main">
      <!-- HOME MAIN START -->
        <main id="home-main">
          <!--  -->
          <!--  -->
          <!--  -->
            <article class="about-container">
                <section class=about-title>Who we are</section>
                    <section class=about-main>
                        TravelWorld was founded in 2015. Through the continuous development and expansion of its activities, it emerged as a leading Hotel Management company.
                        It is one of the largest producers of hotel reservations in the Greek market, while it has received various distinctions and awards from the most reliable international organizations for the high level of its services and its business development.  
                    </section>
                    <div class="about-photo">

                        <div class="slideshow-container">
                            <div class="mySlides fade">
                                <picture>
                                    <source media="screen and (min-width: 769px)" srcset="assets/images/about-images/photo_1_769.jpg">
                                    <source media="screen and (min-width: 481px)" srcset="assets/images/about-images/photo_1_481.jpg">
                                    <img src="assets/images/about-images/photo_1_280.jpg">
                                </picture>
                            </div>
                            <div class="mySlides fade">
                                <picture>
                                    <source media="screen and (min-width: 769px)" srcset="assets/images/about-images/photo_2_769.jpg">
                                    <source media="screen and (min-width: 481px)" srcset="assets/images/about-images/photo_2_481.jpg">
                                    <img src="assets/images/about-images/photo_2_280.jpg">
                                </picture>
                            </div>
                            <div class="mySlides fade">
                                <picture>
                                    <source media="screen and (min-width: 769px)" srcset="assets/images/about-images/photo_3_769.jpg">
                                    <source media="screen and (min-width: 481px)" srcset="assets/images/about-images/photo_3_481.jpg">
                                    <img src="assets/images/about-images/photo_3_280.jpg">
                                </picture>
                            </div>
                            <div class="mySlides fade">
                                <picture>
                                    <source media="screen and (min-width: 769px)" srcset="assets/images/about-images/photo_4_769.jpg">
                                    <source media="screen and (min-width: 481px)" srcset="assets/images/about-images/photo_4_481.jpg">
                                    <img src="assets/images/about-images/photo_4_280.jpg">
                                </picture>
                            </div>
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            <div class="dots-wrapper">
                                <span class="dot" onclick="currentSlide(0)"></span>
                                <span class="dot" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                                <span class="dot" onclick="currentSlide(3)"></span>
                            </div>
                        </div>
                        
                    </div>
                <section class=about-footer>We are here for you!</section>
            </article>
          <!--  -->
          <!--  -->
          <!--  -->
      </main>
      <!-- HOME MAIN END -->
    </main>
    <!-- OUTER MAIN END-->
   </div>

    <!-- JavaScript START -->
    <?php require_once('__common_JS_files.html') ?>
    <script src="assets/js/about/slider.js"></script>
    <!-- JavaScript END -->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>