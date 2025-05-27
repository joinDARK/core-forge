<?php
require '../lib/checkAuth.php';
require_once '../lib/cart_functions.php';
require '../connect/connect.php';

$user_id = $_SESSION['user']['id'];
$cart_items = get_cart($connect, $user_id);
$total = 0;
$total_quantity = 0;
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
                            <p class="profile__name"><?= $_SESSION['user']['name'] ?></p>
                            <a href="mailto:<?= $_SESSION['user']['email'] ?>"
                                class="profile__email"><?= $_SESSION['user']['email'] ?></a>
                        </div>
                    </div>
                    <div class="profile__info-container">
                        <img src="../assets/imgs/icons/location_on.svg" alt="location">
                        <p class="profile__location"><?= $_SESSION['user']['address'] ?></p>
                    </div>
                    <div class="profile__info-container">
                        <img src="../assets/imgs/icons/phone.svg" alt="phone">
                        <p class="profile__location"><?= $_SESSION['user']['tel'] ?></p>
                    </div>
                    <a href="#">
                        <button class="dark">Корзина</button>
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
                            <th class="item__name">Название</th>
                            <th class="item__price">Цена</th>
                            <th class="item__price">Кол-во</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <?php $product = get_product_info($connect, $item['product_type'], $item['product_id']); ?>
                            <?php if ($product): ?>
                                <tr>
                                    <td class="item__name"><?= htmlspecialchars($product['name'] ?? 'Нет названия') ?></td>
                                    <td class="item__price"><?= number_format($product['price'], 0, ',', ' ') ?> ₽</td>
                                    <td class="item__price"><?= $item['quantity'] ?></td>
                                    <td>
                                        <a href="/lib/remove_from_cart.php?type=<?= htmlspecialchars($item['product_type']) ?>&id=<?= (int) $item['product_id'] ?>"
                                            class="item__delete-btn">
                                            <img src="../assets/imgs/icons/delete.svg" alt="delete">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $total += $product['price'] * $item['quantity'];
                                $total_quantity += $item['quantity']; // вот здесь!
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="item__name">Итого:</td>
                            <td class="item__price"><?= number_format($total, 0, ',', ' ') ?> ₽</td>
                            <td class="item__price"><?= $total_quantity ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <button id="buy">Заказать товары</button>
                <button id="clear-cart" class="secondary">Очистить корзину</button>
            </div>
        </div>
    </section>
    <?php
    require "../components/footer.php";
    ?>
    <script src="../assets/scripts/script.js" defer></script>
</body>

</html>