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
      <a href="?criteria=price&direction=asc" <?= $sortCriteria == 'price' && $sortDirection == 'asc' ? 'style="font-weight:bold;"' : '' ?>>Cena Rastuća</a>
      |
      <a href="?criteria=price&direction=desc" <?= $sortCriteria == 'price' && $sortDirection == 'desc' ? 'style="font-weight:bold;"' : '' ?>>Cena Opadajuća</a>
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

<div class="navbar navbar--mob">
  <ul class="navbar__list">
    <li class="navbar__item">
      <a href="index.html" class="navbar__link">Pocetna</a>
    </li>
    <li class="navbar__item">
      <a href="cart.html" class="navbar__link">Korpa</a>
    </li>
  </ul>
</div>

</body>
</html>
