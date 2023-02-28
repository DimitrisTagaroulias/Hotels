    
<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\User;

  // If there is already logged in user, return to main page
  if (!empty(User::getCurrentUserId())){
  header('Location: ./index.php');
  return;
  }
  // <!-- HEAD START --> 
  require_once('__head.html')
?>
    <title>Travel the World | Register</title>

    <!-- CSS START -->
    <?php require_once('__css.html') ?>
    
    <link rel="stylesheet" type="text/css" href="assets/css/login-register-form-1.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/css_register/register_travelworld-register-form-10.css" />    
    <link rel="stylesheet" type="text/css" href="assets/css/css_register/media_register_320-2.css" media="screen and (min-width:320px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_414_HEADER-12.css" media="screen and (min-width:414px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_register/media_register_481-3.css" media="screen and (min-width:481px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_630_HEADER-14.css" media="screen and (min-width:630px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/__media_769_Back_Ground_Photo-15.css" media="screen and (min-width:769px)"/>
    <link rel="stylesheet" type="text/css" href="assets/css/css_register/media_register_769_LS-4.css" media="screen and (min-width: 769px) and (orientation: landscape)"/>
    <!-- CSS END --> 
  </head>
  <!-- HEAD END --> 

  
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
            <form class="modal-content animate register-form" action="actions/register.php" method="post">
              <?php if (!empty($_GET['error'])): ?>
              <div class="modalErrorResponse"><?php echo $_GET['error'] ?></div>
              <?php endif ?>
              
              <div class="inputs-container">
                <input type="hidden" name="csrf" value="<?php echo User::getCsrf() ?>">
                <label for="userNameREG">
                  <b>Username</b>
                </label>
                <input type="text" placeholder="Enter Username" name="userNameREG" class="reg-input input-0" id="reg-user-name">
                <p id="reg-ErrorUserName" class                  Username should be between 8 - 20 chara                  Username should be between 6 - 18 characters! First and last letter shouldn't
                be a special character. Also _. or ._ are not valid sequence.
                </p>
                <label for="emailREG">
                  <b>Email</b>
                </label>
                <input type="text" placeholder="Enter Email" name="emailREG" class="reg-input input-1" id="reg-email">
                <p id="reg-ErrorEmail" class="registrationRulesError par-basic-css toBeDisplayedOnSubmit-1 starts-hidden hidden">
                  Enter a valid Email
                </p>
                <label for="repeatEmailREG">
                  <b>Repeat Email</b>
                </label>
                <input type="text" placeholder="Enter Enter your Email again" name="repeatEmailREG" class="reg-input input-2" id="reg-email-repeat">
                <p id="reg-ErrorEmail-repeat" class="registrationRulesError par-basic-css starts-hidden hidden">
                  The Emails don't match
                </p>
                <p id="reg-ErrorEmail-repeat-2" class="registrationRulesError par-basic-css toBeDisplayedOnSubmit-2 starts-hidden hidden">
                  Enter a valid email first!
                </p>
                <label for="passWordREG">
                  <b>Password</b>
                </label>
                <input type="password" placeholder="Enter Password" name="passWordREG" class="reg-input password input-3" id="reg-password">
                <label class="show-password">
                  <input type="checkbox" name="show-password"> Show/Hide password
                </label>
                <p id="reg-ErrorPassword" class="par-basic-css toBeDisplayedOnSubmit-3 starts-visible">
                  Password should be at least 8 characters and should contain least one digit,one upper case letter,one lower case letter.
                </p>
                <div id="regForm-buttons">
                  <button type="button" class="resetForm-btn-REG">Reset form</button>
                  <button id="final-registration-button" class="final-registration-button" type="submit">Register</button> 
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
    <script src="assets/js/register/register_form-2.js"></script>
    <!-- JavaScript END -->

    <!-- FOOTER -->
    <?php require_once('__footer.html') ?>
    
