<?php
// В начале header.php, до вывода HTML:
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
// Всегда отправляем на страницу каталога:
$catalogUrl = '/pages/catalog.php';
?>

<header>
    <div class="header__container">
        <?php if (isset($_SESSION["user"])): ?>
            <?php if ($_SESSION["user"]["role"] != "admin"): ?>
                <a href="/index.php">Главная</a>
                <a href="/pages/catalog.php">Каталог</a>
                <a href="../pages/user_cart.php">Корзина</a>
                <a href="../lib/exit.php">Выйти</a>
                <a href="../pages/user_history.php">
                    <button class="primary" id="reg-button">
                        <img src="../assets/imgs/profiles/user.png" alt="user" class="user-icon">
                    </button>
                </a>
            <?php else: ?>
                <a href="/pages/admin/cpu.php">Процессоры</a>
                <a href="/pages/admin/gpu.php">Видеокарты</a>
                <a href="/pages/admin/motherboards.php">Материнские платы</a>
                <a href="/pages/admin/rams.php">Оперативная память</a>
                <a href="/pages/admin/psus.php">Блоки питания</a>
                <a href="/pages/admin/cases.php">Корпуса</a>
                <a href="/pages/admin/ssds.php">SSD-диски</a>
                <a href="/pages/admin/hdds.php">HDD-диски</a>
                <a href="/pages/admin/orders.php">
                    <button>Заказы</button>
                </a>
                <a href="#">
                    <button>Отзывы</button>
                </a>
                <a href="/lib/exit.php">
                    <button>Выйти</button>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="/index.php">Главная</a>
            <a href="/pages/catalog.php">Каталог</a>
            <button class="reg-button">
                <img src="../assets/imgs/icons/user.svg" alt="user">
            </button>
        <?php endif; ?>
    </div>
    <div class="container">
        <form method="get" action="<?= $catalogUrl ?>" class="search">
            <input type="search" name="search" placeholder="Поиск" aria-label="Поиск"
                value="<?= htmlspecialchars($search, ENT_QUOTES) ?>">
            <?php if ($category !== 'all'): ?>
                <input type="hidden" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES) ?>">
            <?php endif; ?>
            <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                <img src="../assets/imgs/icons/search.svg" alt="search">
            </button>
        </form>
        <button id="burger-menu__open">
            <img src="../assets/imgs/icons/menu.svg" alt="menu">
        </button>
    </div>
</header>