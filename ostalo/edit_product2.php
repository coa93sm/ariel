<!--?php
require_once '../app/config/config.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';


$user=new User($conn);
if($user->is_logged() && $user->is_admin()):

    $product_obj=new Product($conn);
    $product=$product_obj->read($_GET['id']);
    //var_dump($_GET['id']);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $product_id=$_GET['id'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $size=$_POST['size'];
        $image=$_POST['image'];
        /////////////////////////////////////////////////////
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name']; // Ime originalnog fajla
            $image_tmp = $_FILES['image']['tmp_name']; // Privremena lokacija fajla na serveru
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION); // Ekstenzija fajla (npr. jpg, png)
            $new_image_name = uniqid() . '.' . $image_extension; // Generiše jedinstveno ime za sliku
            $upload_dir = '../uploads/'; // Putanja do direktorijuma gde će slika biti sačuvana
            
            // Kreirajte direktorijum ako ne postoji
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Kreira direktorijum sa odgovarajućim dozvolama
            }
        
            // Premestite sliku u upload direktorijum
            move_uploaded_file($image_tmp, $upload_dir . $new_image_name); // Premesta fajl sa privremene lokacije na novu lokaciju
            
            $image = $new_image_name; // Postavite novo ime slike za ažuriranje u bazi
        }
        
        /////////////////////////////////////////////////////
        $product_obj->update($product_id,$name,$price,$size,$image);

        header("Location: edit_product.php?id=".$product_id);
        exit();
    }
    

endif;
?-->