<?php
require '../../lib/checkAuth.php';
require '../../lib/checkIsAdmin.php';
require '../../connect/connect.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж (Админ Панель)</title>
    <link rel="stylesheet" href="../../assets/style/style.css">
    <link rel="stylesheet" href="../../assets/style/admin.css">
    <link rel="shortcut icon" href="../../assets/imgs/logo/logo.svg" type="image/x-icon">
    <script src="../../assets/scripts/accordion.js" defer></script>
</head>

<body>
    <?php
    require '../../components/header.php';
    $sql = "SELECT * FROM orders";
    $orders = $connect->query($sql)->fetchAll();

    function getStatusClass($status) {
        switch ($status) {
            case 'В обработке':
                return 'status__tag_wait';
            case 'Оплачен':
                return 'status__tag_conf';
            case 'Отменен':
                return 'status__tag_cancel';
            default:
                return '';
        }
    }
    ?>
    <section id="data">
        <div class="container">
            <div class="data-container">
                <?php foreach ($orders as $order): ?>
                    <div class="data__item">
                        <p class="data__id">ID: <?= $order['id'] ?></p>
                        <div class="accordion">
                            <div class="accordion__header">
                                <p class="accordion__title">Заказ № <?= $order['id'] ?></p>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                        stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="accordion__content">
                                <div class="accordion__content-inner">
                                    <div class="status">
                                        <p class="status__info">Статус:</p>
                                        <div class="status__tag <?= getStatusClass($order['status'])?>"><?= $order['status'] ?></div>
                                    </div>
                                    <p class="data__item-info"><span>Адрес доставки:</span> <?= $order['address'] ?>
                                    </p>
                                    <p class="data__item-info"><span>Контактный номер:</span>
                                        <?= $order['tel'] ?></p>
                                    <p class="data__item-info"><span>Заказчик:</span>
                                        <?= $order['name'] ?></p>
                                    <p class="data__item-info"><span>Способо оплаты:</span>
                                        <?= $order['payment_method'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="filters_container" id="admin-filters">
                <aside class="filters">
                    <div class="search">
                        <input type="search" placeholder="Поиск" aria-label="Поиск">
                        <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                            <img src="/assets/imgs/icons/search.svg" alt="search">
                        </button>
                    </div>
                    <p class="title">Фильтры</p>
                    <div class="filters__content">
                        <a href="#">По возрастанию ID</a>
                        <a href="#">По убыванию ID</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</body>

</html>