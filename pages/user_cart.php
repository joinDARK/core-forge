<?php
require '../lib/checkAuth.php';
?>
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
    require '../components/burger_menu.php';
    require '../components/header.php';
    ?>
    <section id="cart">
        <div class="container">
            <div class="profile_container">
                <aside class="profile">
                    <div class="profile__info">
                        <img src="../assets/imgs/profiles/user.png" alt="user">
                        <div class="profile__info-text">
                            <p class="profile__name"><?=$_SESSION['user']['name']?></p>
                            <a href="mailto:<?=$_SESSION['user']['email']?>" class="profile__email"><?=$_SESSION['user']['email']?></a>
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