<?php 

require_once '../app/config/config.php';
require_once '../app/classes/User.php';
$user=new User($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/ariel/public/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <script type="module" src="http://localhost/ariel/public/js/app.js" defer></script>
    <title>Ariel jewelry</title>
  </head>
<body class="main-grid">




<nav class="navbar">
    <div class="navbar__wrapper">
    
        <div class="navbar__logo"><span>ARIEL</span><span>jewelry</span></div>
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert_<?php echo $_SESSION['message']['type']; ?>">
            <?php echo $_SESSION['message']['text']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
        <ul class="navbar__list">
            <?php if(!$user->is_logged()): ?>
            <li class="navbar__item">
                <a href="index.php" class="navbar__link">Početna</a>
            </li>
            <li class="navbar__item">
                <a href="shop.php" class="navbar__link">Prodavnica</a>
            </li>
            <li class="navbar__item">
                <a href="login.php" class="navbar__link">Logovanje</a>
            </li>
            <li class="navbar__item">
                <a href="register.php" class="navbar__link">Registracija</a>
            </li>
            <?php else: ?>
            <li class="navbar__item">
                <a href="index.php" class="navbar__link">Početna</a>
            </li>
            <li class="navbar__item">
                <a href="orders.php" class="navbar__link">Porudzbine</a>
            </li>
            <li class="navbar__item">
                <a href="add_product.php" class="navbar__link">Dodaj</a>
            </li>
            <li class="navbar__item">
                <a href="logout.php" class="navbar__link">Izloguj se</a>
            </li>
            <?php endif; ?>
            <li class="navbar__hamburger navbar__hamburger--open">
                <i class="fa-solid fa-bars"></i>
            </li>
        </ul>
    </div>
    
</nav>

