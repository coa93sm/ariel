<?php
require_once './header.php';
require_once '../app/config/config.php';
require_once '../app/classes/Cart.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Order.php';

$user = new User($conn);
if ($user->is_logged() && $user->is_admin()) {
    $order = new Order($conn);
    $orders = $order->admin_get_orders();
}
?>
<div class="table-wrapper">
    <table class="cart-table">
        <thead class="cart-header">
            <tr class="header-row">
                <th>Order ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Delivery Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo ($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['name']); ?></td>
                    <td><?php echo htmlspecialchars($order['delivery_address']); ?></td>
                    <td>
                        <a href="order_details.php?order_id=<?php echo $order['order_id']; ?>" class="checkout-link">View Order Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
