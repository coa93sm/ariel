<?php
require_once "inc/header.php"; 
require_once "app/classes/Product.php";

$sortCriteria = isset($_GET['criteria']) ? $_GET['criteria'] : 'price';
$sortDirection = isset($_GET['direction']) ? $_GET['direction'] : 'asc';

$products = new Product($conn);
$productsList = $products->fetch_all($sortCriteria, $sortDirection);

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $kkk = $_POST['kkk'];
  var_dump($kkk);
  echo "$kkk";
}
?>

<!-- Add filter options -->
<div class="shop">
  <div class="shop__filters">
    <form action="" method="GET">
      <div class="shop__sort">
        <p>SORTIRAJ:</p>
        <select name="criteria">
          <option value="price" <?= $sortCriteria == 'price' ? 'selected' : '' ?>>Cena</option>
          <option value="rating" <?= $sortCriteria == 'rating' ? 'selected' : '' ?>>Ocena</option>
        </select>
        <select name="direction">
          <option value="asc" <?= $sortDirection == 'asc' ? 'selected' : '' ?>>Rastuća</option>
          <option value="desc" <?= $sortDirection == 'desc' ? 'selected' : '' ?>>Opadajuća</option>
        </select>
        <button type="submit">Sortiraj</button>
      </div>
    </form>

    <!-- Filter products by category -->
    <form action="" method="GET">
      <div class="shop__filter">
        <p>FILTER:</p>
        <select name="category">
          <option value="">Svi proizvodi</option>
          <option value="bracelets">Narukvice</option>
          <option value="necklaces">Ogrlice</option>
          <option value="earrings">Mindjuse</option>
        </select>
        <button type="submit">Filtriraj</button>
      </div>
    </form>
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
