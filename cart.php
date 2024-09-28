<?php
require_once 'inc/header.php';
require_once 'app/classes/Cart.php';
require_once 'app/classes/Product.php';

if(!$user->is_logged()){
    header("Location: login.php");
    exit();
}

$cart=new Cart($conn);
$cart_items=$cart->get_cart_items();
?>

<div class="table-wrapper">
    <table class="cart-table">
        <thead class="cart-header">
            <tr class="header-row">
                <th class="header-cell">Product Name</th>
                <th class="header-cell">Size</th>
                <th class="header-cell">Price</th>
                <th class="header-cell">Image</th>
                <th class="header-cell">Količine</th>
            </tr>
        </thead>
        <tbody class="cart-body">
            <?php foreach ($cart_items as $item): ?>
                <tr class="cart-item">
                    <td class="cart-item-name"><?php echo htmlspecialchars($item['name']); ?></td>
                    <td class="cart-item-size"><?php echo htmlspecialchars($item['size']); ?></td>
                    <td class="cart-item-price"><?php echo htmlspecialchars($item['price']); ?></td>
                    <td class="cart-item-image">
                        <img src="./uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="Current Image" class="product-image">
                    </td>
                    <td class="cart-item-quantity"><?php echo htmlspecialchars($item['quantity']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="checkout.php" class="checkout-link">CHECKOUT</a>
</div>

<?php require_once 'inc/footer.php' ?>