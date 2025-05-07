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
                <a href="#">Процессоры</a>
                <a href="/pages/admin/gpu.php">Видеокарты</a>
                <a href="#">Материнские платы</a>
                <a href="#">Оперативная память</a>
                <a href="#">Блоки питания</a>
                <a href="#">Корпуса</a>
                <a href="#">SSD-диски</a>
                <a href="#">HDD-диски</a>
                <a href="#">
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
        <div class="search">
            <input type="search" placeholder="Поиск" aria-label="Поиск">
            <button type="search" class="transparent" aria-label="Найти" id="search-button">
                <img src="../assets/imgs/icons/search.svg" alt="search">
            </button>
        </div>
        <button id="burger-menu__open">
            <img src="../assets/imgs/icons/menu.svg" alt="menu">
        </button>
    </div>
</header>