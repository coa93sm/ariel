<?php

require_once "header.php";
require_once '../app/classes/User.php';

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

<form action="" method="POST">
    <div>
        <label>Username</label>
        <input type="username" name="username">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">Login</button>
</form>


<?php require_once "inc/footer.php" ?>
