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
    require_once '../connect/connect.php';
    require_once '../lib/fav_functions.php';

    $tables = [
        'gpus' => 'Видеокарта',
        'cpus' => 'Процессор',
        'motherboards' => 'Материнская плата',
        'rams' => 'Оперативная память',
        'psus' => 'Блок питания',
        'cases' => 'Корпус',
        'ssds' => 'SSD-диск',
        'hdds' => 'HDD-диск',
    ];

    function get_product_info($pdo, $type, $id)
    {
        global $tables;
        if (!isset($tables[$type]))
            return null;
        $stmt = $pdo->prepare("SELECT * FROM `$type` WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $user_id = $_SESSION['user']['id'];
    $favorites = get_favorites($connect, $user_id);
    ?>
    <section id="favorites">
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
                    <a href="/pages/user_history.php">
                        <button>История</button>
                    </a>
                    <a href="#">
                        <button class="dark">Избранные</button>
                    </a>
                </aside>
            </div>
            <div class="history-content">
                <p class="history-content__title">Избранные товары</p>
                <div class="history-content__items">
                    <div class="catalog__content">
                        <?php if (empty($favorites)): ?>
                            <p style="margin: 30px 0;">У вас пока нет избранных товаров.</p>
                        <?php else: ?>
                            <?php foreach ($favorites as $fav): ?>
                                <?php $product = get_product_info($connect, $fav['product_type'], $fav['product_id']); ?>
                                <?php if ($product): ?>
                                    <div class="card">
                                        <div class="img">
                                            <a
                                                href="/pages/item.php?table=<?= $fav['product_type'] ?>&id=<?= $fav['product_id'] ?>">
                                                <img src="../assets/imgs/catalog/<?= htmlspecialchars($product['img']) ?>"
                                                    alt="<?= htmlspecialchars($product['name']) ?>">
                                            </a>
                                            <a href="/lib/remove_from_fav.php?type=<?= $fav['product_type'] ?>&id=<?= $fav['product_id'] ?>"
                                                title="Убрать из избранного">
                                                <svg class="fav-button_filled" width="20" height="18" viewBox="0 0 20 18"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="card__container">
                                            <div class="info">
                                                <p class="title"><?= htmlspecialchars($product['name']) ?></p>
                                                <div class="tag"><?= htmlspecialchars($tables[$fav['product_type']]) ?></div>
                                                <p class="desc"><?= htmlspecialchars($product['desc']) ?></p>
                                            </div>
                                            <div class="bottom">
                                                <p><?= number_format($product['price'], 0, ',', ' ') ?> ₽</p>
                                                <a
                                                    href="/lib/add_to_cart.php?type=<?= $fav['product_type'] ?>&id=<?= $fav['product_id'] ?>">
                                                    <button>В корзину</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require "../components/footer.php";
    ?>
    <script src="../assets/scripts/script.js" defer></script>
</body>

</html>