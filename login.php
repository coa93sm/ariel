<?php

require_once 'inc/header.php';
require_once 'app/classes/User.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $user=new User($conn);
    $result=$user->login($username,$password);

    if(!$result){
        $_SESSION['message']['type']="danger";
        $_SESSION['message']['text']="netacan username ili sifra";
        header("Location: login.php");
    exit();
    }
    if ($user->is_admin()){
        $_SESSION['message']['type']="success";
        $_SESSION['message']['text']="logovanje je uspelo";
        header("Location: admin/index.php");
        exit();
    }else{
    $_SESSION['message']['type']="success";
    $_SESSION['message']['text']="logovanje je uspelo";
    header("Location: shop.php");
    exit();
    }
}

?>
<div class="login-wrapper"> 
    <form action="" method="POST" class="login-form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-input" required>
        </div>
        <button type="submit" class="login-button">Login</button>
    </form>
</div>

<?php require_once "inc/footer.php" ?>
