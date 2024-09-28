<?php

require_once './header.php';
require_once '../app/classes/Product.php';
$user=new User($conn);
if($user->is_logged() && $user->is_admin()):

    $products=new Product($conn);
    $products=$products->fetch_all();
?>



<div class="table-wrapper">
    <table class="cart-table">
        <thead class="cart-header">
            <tr class="header-row">
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="cart-body">
            <?php foreach ($products as $product): ?>
                <tr class="cart-item">
                    <td class="cart-item-name"><?php echo $product['product_id']; ?></td>
                    <td class="cart-item-name"><?php echo $product['name']; ?></td>
                    <td class="cart-item-name"><?php echo $product['price']; ?></td>
                    <td class="cart-item-name"><?php echo $product['size']; ?></td>
                    <td class="cart-item-image"><img class="cart__img" src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="max-width: 200px; max-height: 200px;"></td>
                    <td><?php echo $product['created_at']; ?></td>
                    <td class="cart-item-name">
                        <a href="edit_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-delete">Delete</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    
<?php endif;?>

<?php require_once "footer.php"?>

