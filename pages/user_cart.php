<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж</title>
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="stylesheet" href="../assets/style/adaptive.css">
    <link rel="shortcut icon" href="../assets/imgs/logo/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    require '../components/modals.php';
    ?>
    <dialog id="burger-menu">
        <div class="burger-menu__header">
            <p class="burger-menu__title">Навигация</p>
            <button type="button" class="burger-menu__close" id="burger-menu__close">
                <img src="../assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="burger-menu__body">
            <a href="/index.php" class="burger-menu__link">
                <button class="dark">Главная</button>
            </a>
            <a href="/pages/catalog.php" class="burger-menu__link">
                <button class="dark">Каталог</button>
            </a>
            <div class="profile__info">
                <img src="../assets/imgs/profiles/user.png" alt="user">
                <div class="profile__info-text">
                    <p class="profile__name">Пользователь</p>
                    <a href="mailro:user@mail.ru" class="profile__email">user@mail.ru</a>
                </div>
            </div>
            <a href="/pages/user_fav.php" class="burger-menu__link">
                <button class="dark">Избранные</button>
            </a>
            <a href="/pages/user_history.php" class="burger-menu__link">
                <button class="dark">История</button>
            </a>
            <a href="#" class="burger-menu__link">
                <button>Корзина</button>
            </a>
        </div>
    </dialog>
    <header>
        <div class="header__container">
            <a href="/index.php">Главная</a>
            <a href="/pages/catalog.php">Каталог</a>
            <a href="/pages/user_cart.php">Корзина</a>
            <button class="primary" id="reg-button">
                <img src="../assets/imgs/profiles/user.png" alt="user" class="user-icon">
            </button>
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
        </div>
    </header>
    <section id="cart">
        <div class="container">
            <div class="profile_container">
                <aside class="profile">
                    <div class="profile__info">
                        <img src="../assets/imgs/profiles/user.png" alt="user">
                        <div class="profile__info-text">
                            <p class="profile__name">Пользователь</p>
                            <a href="mailro:user@mail.ru" class="profile__email">user@mail.ru</a>
                        </div>
                    </div>
                    <a href="/pages/user_history.php">
                        <button>История</button>
                    </a>
                    <a href="/pages/user_fav.php">
                        <button>Избранные</button>
                    </a>
                </aside>
            </div>
            <div class="cart-content">
                <h1>Корзина товаров</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th class="item__price">Цена</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                        <tr>
                            <td>Карточка товара</td>
                            <td class="item__price">100 000 ₽</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Итого:</td>
                            <td class="item__price">600 000 ₽</td>
                        </tr>
                    </tfoot>
                </table>
                <button id="buy">Заказать товары</button>
            </div>
        </div>
    </section>
    <?php
    require "../components/footer.php";
    ?>
    <script src="../assets/scripts/script.js" defer></script>
</body>

</html>