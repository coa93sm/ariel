
    <footer class="footer"></footer>
    <div class="navbar navbar--mob">
    <ul class="navbar__list">
            <?php if(!$user->is_logged()): ?>
            <li class="navbar__item">
                <a href="index.php" class="navbar__link">Početna</a>
            </li>
            <li class="navbar__item">
                <a href="shop.php" class="navbar__link">Prodavnica</a>
            </li>
            <li class="navbar__item">
                <a href="login.php" class="navbar__link">Logovanje</a>
            </li>
            <li class="navbar__item">
                <a href="register.php" class="navbar__link">Registracija</a>
            </li>
            <?php else: ?>
                <li class="navbar__item">
                <a href="index.php" class="navbar__link">Početna</a>
            </li>
            <li class="navbar__item">
                <a href="orders.php" class="navbar__link">Porudzbine</a>
            </li>
            <li class="navbar__item">
                <a href="add_product.php" class="navbar__link">Dodaj</a>
            </li>
            <li class="navbar__item">
                <a href="logout.php" class="navbar__link">Izloguj se</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
  </body>
</html>