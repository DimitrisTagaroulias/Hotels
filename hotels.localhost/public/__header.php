<?php
// Boot application
// require_once __DIR__ . "/../../boot/boot.php";

use Hotel\User;
?>

<header id="home-header">
  <section class="page-intro">
    <div class="logo-container">
      <a href="index.php">
        <div id="logo"></div>
      </a>
    </div>
    <h1 id="company-name">
      <a href="index.php">TravelWorld</a>
    </h1>
    <h1 id="slogan">
      <a href="index.php">Travel now! Travel Anywhere!</a>
    </h1>
  </section>

  <div class="logged-in <?php echo empty(User::getCurrentUserId())  ? "non-visible" : "" ?>">
    <a href="profile.php"
      ><span class="logged-in-inner"></span><span>Logged in</span></a
    >
  </div>

  <nav class="header-nav">
    <div id="empty1"></div>
    <ul class="header-ul">
      <li id="hotels">
        <a href="hotels.php"><i class="fa-solid fa-hotel"></i> Hotels</a>
      </li>
      <li id="home">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
      </li>
      <li id="profile">
        <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
      </li>
      <li id="log-in">
        <a href="login.php"
          ><i class="fa-solid fa-arrow-right-to-bracket"></i> Log-in</a
        >
      </li>
      <li id="register-nav">
        <a href="register.php"
          ><i class="fa-regular fa-address-card"></i> Register</a
        >
      </li>
      <li id="about-us">
        <a href="about.php"><i class="fa-solid fa-circle-info"></i> About us</a>
      </li>
    </ul>
    <div id="empty2"></div>
  </nav>
</header>
