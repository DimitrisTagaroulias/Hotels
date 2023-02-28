
<?php
  require __DIR__.'/../boot/boot.php';

  // <!-- HEAD START-->
  require_once('__head.html')
?>

    <title>Travel the World | Login</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>
    
    <link rel="stylesheet" type="text/css" href="assets/css/login-register-form-1.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/css_login/login_travelworld-login-form-10.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/css_login/media_login_320-2.css" media="screen and (min-width:320px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_414_HEADER-12.css" media="screen and (min-width:414px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_login/media_login_481-3.css" media="screen and (min-width:481px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_769_Back_Ground_Photo-15.css" media="screen and (min-width:769px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_login/media_login_769_LS-4.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    <!-- CSS END -->

  </head>
  <!-- HEAD END-->
  
   <!-- BODY START -->
  <body>
     <!-- class= "xxxx unused"= εμειναν μονο για λογους κατανοησης του περιεχομενου -->
    <!-- class= "xxxx unused"= it's only for understanding the content -->

    <!-- HEADER START -->
    <?php require_once('__header.php') ?>

    <div class="hero-container">
    
    <!-- OUTER MAIN START -->
    <main id="outer-main">
      <!-- HOME MAIN START -->
        <main id="home-main">
          <div id="logInModal" class="modal logInModal">
            <form id="login-form" class="modal-content animate" action="actions/login.php" method="post">
              <?php if (!empty($_GET['error'])): ?>
              <div class="modalErrorResponse"><?php echo $_GET['error'] ?></div>
              <?php endif ?>
              
              <div class="inputs-container">
                <label for="emailLogin"> <b>Email</b> </label>
                <input type="text" placeholder="Enter Email" name="emailLogin">
                <label for="passWordLogin"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="passWordLogin" class="password">
                <label class="show-password">
                <input type="checkbox" name="show-password"> Show/Hide password
                </label>
                <button id="login-button" class="login-form-button" type="submit">Login</button>
                <div class="container-flex">
                  <div id="remember">
                    <label class="remember">
                    <input type="checkbox" name="remember"> Remember me</label>
                  </div>
                  <div id="forgot">
                    <div class="psw">Forgot <a href="#">password?</a></div>
                    <div class="register-btn"><a href="register.php">Register</a></div>
                  </div>   
                </div>
              </div>
            </form>
          </div>
      </main>
      <!-- HOME MAIN END -->
    </main>
    <!-- OUTER MAIN END-->
   </div>

    <!-- JavaScript START -->
    <?php require_once('__common_JS_files.html') ?>
    
    <script src="assets/js/common_files_JS/login_register_common_functions.js"></script>
    <script src="assets/js/login/login_form-1.js"></script>
    <!-- JavaScript END -->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>
    
