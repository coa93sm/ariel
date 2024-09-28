<?php
require_once './header.php';
require_once '../app/classes/Product.php';

$user = new User($conn);

if ($user->is_logged() && $user->is_admin()) {
    $product_obj = new Product($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        
        // Obrada nove slike
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $upload_dir = '../uploads/';
            $upload_file = $upload_dir . $image_name;
            
            // Premestite sliku u upload direktorijum
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_file);

            $image = $image_name;
        }
        
        $product_obj->create($name, $price, $size, $image);

        header("Location: index.php");
        exit();
    }
}
?>


<div class="form-wrapper">
    <form action="" method="POST" enctype="multipart/form-data" class="product-form">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="size">Size:</label>
            <input type="text" name="size" id="size" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Upload Image:</label>
            <label class="form-control-btn">
                <input type="file" name="image" id="image" onchange="previewImage(event)">
                Izaberi sliku
            </label>
        </div>

        <div id="image-preview-container" class="image-preview-container" style="margin-top: 10px;">
            <img id="image-preview" class="image-preview" style="max-width: 200px; max-height: 200px;" />
        </div>

        <input type="submit" value="ADD PRODUCT" class="btn-submit">
    </form>
</div>



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
<?php require_once "footer.php"?>