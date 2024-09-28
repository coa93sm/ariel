<?php
require_once "inc/header.php"; 
require_once "app/classes/Product.php";

// Čitanje kriterijuma i smera sortiranja iz URL-a
$sortCriteria = isset($_GET['criteria']) ? $_GET['criteria'] : 'price';
$sortDirection = isset($_GET['direction']) ? $_GET['direction'] : 'asc';

// Dohvatanje proizvoda prema kriterijumu i smeru
$products = new Product($conn);
$productsList = $products->fetch_all($sortCriteria, $sortDirection);


?>




<!-- Filteri za sortiranje i filtriranje proizvoda -->
<div class="shop">
  <div class="shop__filters">
    <!-- Sortiranje bez forme, sa klikom na dugmad -->
    <div class="shop__sort">
      <p>SORTIRAJ:</p>


      <select id="sortCriteria" onchange="sortProducts()">
        <option  value="price_asc" <?= $sortCriteria == 'price' && $sortDirection == 'asc' ? 'selected' : '' ?>>Cena Rastuća</option>
        <option  value="price_desc" <?= $sortCriteria == 'price' && $sortDirection == 'desc' ? 'selected' : '' ?>>Cena Opadajuća</option>
      </select>


    </div>
  </div>

  <div class="shop__articles">
    <?php foreach ($productsList as $product): ?>
      <div class="article">
        <figure class="article__head">
          <img src="./uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="" class="article__img">
        </figure> 

        <div class="article__body">
          <h3 class="heading heading--tertiary"><?= htmlspecialchars($product['name']) ?></h3>
          <p class="article__price"><?= htmlspecialchars($product['price']) ?></p>
          <button class="btn btn--shop">
            <a style="text-decoration:none; color:#fff;" href="product.php?product_id=<?= htmlspecialchars($product['product_id']) ?>">Dodaj u korpu</a>
          </button>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>





<?php require_once 'inc/footer.php';?>

<!-- JavaScript funkcija za sortiranje -->
<script>
function sortProducts() {
    const select = document.getElementById('sortCriteria');
    const value = select.value;
    
    let criteria, direction;
    
    // Parsiranje vrednosti selektovane opcije
    [criteria, direction] = value.split('_');
    
    const url = new URL(window.location.href);
    url.searchParams.set('criteria', criteria);
    url.searchParams.set('direction', direction);
    
    // Preusmeravanje korisnika na novu URL adresu
    window.location.href = url.toString();
}
</script>