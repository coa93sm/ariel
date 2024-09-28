<?php
require_once "inc/header.php";
require_once "app/classes/Cart.php";
require_once "app/classes/Order.php";

if(!$user->is_logged()){
    header("Location: login.php");
    exit();
}

$order=new Order($conn);
$orders=$order->get_orders();

?>

<table>
    <tbody>
        <?php foreach($orders as $order): ?>
            <tr>
                <th><?php echo ($order['order_id']);?></th>
                <th><?php echo htmlspecialchars(($order['name']));?></th>
                <th><?php echo htmlspecialchars(($order['quantity']));?></th>
                <th><?php echo htmlspecialchars(($order['size']));?></th>
                <th><?php echo htmlspecialchars(($order['delivery_address']));?></th>
            </tr>
            <?php endforeach;?>
    </tbody>
</table>
<?php require_once "inc/footer.php";?>