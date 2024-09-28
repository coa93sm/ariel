<?php
require_once './header.php';
require_once '../app/config/config.php';
require_once '../app/classes/Cart.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Order.php';

$order_id = $_GET['order_id'];

$order = new Order($conn);
$order_items = $order->get_order_items($order_id); // Funkcija koja vraća stavke iz porudžbine

?>


<div class="table-wrapper">
    <h2>Order Details for Order ID: <?php echo $order_id; ?></h2>
    <table class="cart-table">
        <thead class="cart-header">
            <tr class="header-row">
                <th>Product Name</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity'] * $item['price']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>