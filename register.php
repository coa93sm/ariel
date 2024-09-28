<?php
require_once "inc/header.php"; 
require_once "app/config/config.php";
require_once "app/classes/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Pass the connection object to the User class
    $user = new User($conn);

    // Call the create method
    $created = $user->create($name, $username, $email, $password);

    if ($created) {
        $_SESSION['message']['type']='success';
        $_SESSION['message']['text']="uspesno registrovan nalog";
        header("Location: shop.php");
        exit();
    } else {
        $_SESSION['message']['type']='danger';
        $_SESSION['message']['text']="greska";
        header("Location: register.php");
        exit();
    }
}
?>



<div class="login-wrapper">
    <form method="POST" action="" class="login-form">
        <div class="form-group">
            <label for="name">IME</label>
            <input type="text" name="name" id="name" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="email">Adresa</label>
            <input type="email" name="email" id="email" class="form-input" required>
        </div>
        <button type="submit" class="login-button">Registracija</button>
    </form>
</div>

<?php require_once 'inc/footer.php'?>