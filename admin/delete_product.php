<?php

require_once '../app/config/config.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';


$user=new User($conn);
if($user->is_logged() && $user->is_admin()):

    $product=new Product($conn);
    
    $product_id=$_GET['id'];

    $product->delete($product_id);
    header('Location: index.php');

endif;
?>

