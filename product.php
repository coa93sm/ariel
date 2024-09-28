<?php
//echo $_GET['product_id'];
require_once 'inc/header.php';
require_once 'app/classes/Product.php';
require_once 'app/classes/Cart.php';

$product=new Product($conn);

$product=$product->read($_GET['product_id']);

//var_dump($product);


if ($_SERVER['REQUEST_METHOD']=='POST'){
    $product_id=$product['product_id'];
    $user_id=$_SESSION['user_id'];
    $quantity=$_POST['quantity'];
    $cart=new Cart($conn);
    $cart->add_to_cart($product_id,$user_id,$quantity);

    header('Location: cart.php');
    exit();
}
?>

<div>
    
<img src="./uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;" id="current-image">
        <h1><?=$product['name']?></h1>
        <h2><?=$product['size']?></h2>
        <h3><?=$product['price']?></h3>
        <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>">
            <input type="number" name="quantity">
            <button type="submit">Add to Cart</button>
        </form>
        <hr>
    
</div>

<?php require_once 'inc/footer.php'?>