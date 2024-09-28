<?php


require_once 'inc/header.php';
require_once 'app/classes/Cart.php';
require_once 'app/classes/Order.php';
if(!$user->is_logged()){
    header("Location: login.php");
    exit();
}




if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $delivery_address=$_POST['contry'].",".$_POST['city'].",".$_POST['zip'].",".$_POST['address'];
    
    if($delivery_address!=NULL){
    
    $order=new Order($conn);
    $order=$order->create($delivery_address);
    //var_dump($order);
    $_SESSION['message']['type']='success';
    $_SESSION['message']['text']="uspesno";
    header("Location: orders.php");
    exit();
    }
}


?>

<div class="login-wrapper">
    <form action="" method="post" class="login-form">
        <div class="form-group">
            <label for="country">Država</label>
            <input type="text" name="country" id="country" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="city">Grad</label>
            <input type="text" name="city" id="city" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="zip">Poštanski broj</label>
            <input type="text" name="zip" id="zip" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="address">Adresa</label>
            <input type="text" name="address" id="address" class="form-input" required>
        </div>
        <button type="submit" class="login-button">Pošalji</button>
    </form>
</div>





<?php require_once 'inc/footer.php'; ?>


<!------------------------------------------------------->
<!------------------------------------------------------->
<!------------------------------------------------------->
<!--

//var_dump($cart_items);
/*if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo 'POST zahtev primljen';
    var_dump($_POST); // Ispisivanje sadržaja POST podataka
} else {
    echo 'Trenutni metod je: ' . $_SERVER['REQUEST_METHOD'];
}*/

-->
<!------------------------------------------------------->
<!------------------------------------------------------->
<!------------------------------------------------------->
<!--

/*$cart=new Cart($conn);
$cart_items=$cart->get_cart_items();



if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $order=new Order($conn);
    $order=$order->create($cart_items);
}*/

-->
<!------------------------------------------------------->
<!------------------------------------------------------->
<!------------------------------------------------------->