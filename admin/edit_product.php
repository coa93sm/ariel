

<?php
require_once '../app/config/config.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';

$user = new User($conn);

if ($user->is_logged() && $user->is_admin()) {
    $product_obj = new Product($conn);
    $product_id = $_GET['id'];
    $product = $product_obj->read($product_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $current_image = $product['image']; // Čuvanje trenutnog imena slike

        // Obrada nove slike
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . $image_name;

            // Postavite novu sliku za ažuriranje u bazi
            $image = $image_name;
        } else {
            // Ako nije odabrana nova slika, zadržite staru
            $image = $current_image;
        }

        $product_obj->update($product_id, $name, $price, $size, $image);

        header("Location: index.php");
        exit();
    }
}
?>







<form action="" method="POST" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>">

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>">

    <label for="size">Size:</label>
    <input type="text" name="size" id="size" value="<?php echo htmlspecialchars($product['size']); ?>">

    <!-- Prikaz trenutne slike -->
<label for="current-image">Current Image:</label>
<div style="display: flex; align-items: center;">
    <?php if (!empty($product['image'])): ?>
        <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Current Image" style="max-width: 200px; max-height: 200px;" id="current-image">
    <?php else: ?>
        <p>No image available</p>
    <?php endif; ?>

    <!-- Polje za upload nove slike -->
    <div style="margin-left: 20px;">
        <label for="image">Upload New Image:</label>
        <input type="file" name="image" id="image" onchange="previewImage(event)">

        <!-- Prikaz nove slike -->
        <div id="image-preview-container" style="margin-top: 10px;">
            <img id="image-preview" style="max-width: 200px; max-height: 200px;" />
        </div>
    </div>
</div>

<input type="submit" value="UPDATE">

</form>

<script>
function previewImage(event) {
    const input = event.target;
    const file = input.files[0];
    const preview = document.getElementById('image-preview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    } else {
        preview.src = '';
    }
}
</script>


