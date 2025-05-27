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
    // Получаем параметры поиска и сортировки
    $search = trim($_GET['search'] ?? '');
    $sort = $_GET['sort'] ?? 'id_desc';

    // Формируем SQL-запрос
    $sql = "SELECT * FROM orders";
    $conditions = [];
    $params = [];

    // Поиск по id, имени, адресу, телефону (расширить можно как нужно)
    if ($search !== '') {
        $conditions[] = "(id = :id_exact OR name LIKE :search OR address LIKE :search OR tel LIKE :search)";
        $params['id_exact'] = (int) $search;
        $params['search'] = "%$search%";
    }
    if ($conditions) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    if ($sort === 'id_asc') {
        $sql .= " ORDER BY id ASC";
    } else {
        $sql .= " ORDER BY id DESC";
    }

    // Выполняем подготовленный запрос
    $stmt = $connect->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function getStatusClass($status)
    {
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

    function get_product_info($pdo, $type, $id)
    {
        $allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
        if (!in_array($type, $allowed_types))
            return null;
        $stmt = $pdo->prepare("SELECT * FROM `$type` WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <dialog class="upd_form" id="order-status-modal">
        <form method="post" id="order-status-form">
            <div class="dialog__header">
                <p class="dialog__title">Изменить статус заказа</p>
                <button type="button" class="dialog__close" id="close-status-modal">
                    <img src="../../assets/imgs/icons/X.svg" alt="close">
                </button>
            </div>
            <div class="dialog__body">
                <input type="hidden" name="order_id" id="order_id_input">
                <select name="status" id="status_select" required style="width:100%;margin-bottom: 20px;">
                    <option value="В обработке">В обработке</option>
                    <option value="Оплачен">Оплачен</option>
                    <option value="Отменен">Отменен</option>
                </select>
            </div>
            <button type="submit" class="dialog__submit">Сохранить</button>
        </form>
    </dialog>
    <section id="data">
        <div class="container">
            <div class="data-container">
                <?php foreach ($orders as $order): ?>
                    <?php
                    // Получаем все товары заказа:
                    $stmt_items = $connect->prepare("SELECT * FROM order_items WHERE order_id = ?");
                    $stmt_items->execute([$order['id']]);
                    $order_items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                    $order_total = 0;
                    $order_count = 0;
                    foreach ($order_items as $order_item) {
                        $order_total += $order_item['price'] * $order_item['quantity'];
                        $order_count += $order_item['quantity'];
                    }
                    ?>
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
                                        <div class="status__tag <?= getStatusClass($order['status']) ?>">
                                            <?= $order['status'] ?>
                                        </div>
                                    </div>
                                    <p class="data__item-info"><span>Адрес доставки:</span> <?= $order['address'] ?>
                                    </p>
                                    <p class="data__item-info"><span>Контактный номер:</span>
                                        <?= $order['tel'] ?></p>
                                    <p class="data__item-info"><span>Заказчик:</span>
                                        <?= $order['name'] ?></p>
                                    <p class="data__item-info"><span>Способо оплаты:</span>
                                        <?= $order['payment_method'] ?></p>
                                    <p class="data__item-info"><span>Сумма заказа:</span>
                                        <?= number_format($order_total, 0, ',', ' ') ?> ₽</p>
                                    <p class="data__item-info"><span>Кол-во товаров:</span> <?= $order_count ?></p>
                                    <div class="accordion gray">
                                        <div class="accordion__header">
                                            <p class="accordion__title">Товары</p>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                                    stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                        <div class="accordion__content">
                                            <div class="accordion__content-inner">
                                                <table class="order-products">
                                                    <thead>
                                                        <tr>
                                                            <th>Фото</th>
                                                            <th>Название</th>
                                                            <th>Цена за шт.</th>
                                                            <th>Кол-во</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Получаем все товары заказа:
                                                        $stmt_items = $connect->prepare("SELECT * FROM order_items WHERE order_id = ?");
                                                        $stmt_items->execute([$order['id']]);
                                                        $order_items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($order_items as $order_item):
                                                            $product = get_product_info($connect, $order_item['product_type'], $order_item['product_id']);
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php if ($product): ?>
                                                                        <img src="/assets/imgs/catalog/<?= htmlspecialchars($product['img']) ?>"
                                                                            alt="<?= htmlspecialchars($product['name']) ?>"
                                                                            style="max-width:60px;max-height:60px;">
                                                                    <?php else: ?>
                                                                        <span>Нет фото</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $product ? htmlspecialchars($product['name']) : 'Не найдено' ?>
                                                                </td>
                                                                <td>
                                                                    <?= number_format($order_item['price'], 0, ',', ' ') ?> ₽
                                                                </td>
                                                                <td>
                                                                    <?= $order_item['quantity'] ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data__buttons-group">
                                        <button type="button" class="update-btn" data-order-id="<?= $order['id'] ?>"
                                            data-current-status="<?= htmlspecialchars($order['status'], ENT_QUOTES) ?>">
                                            Изменить статус заказа
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="filters_container" id="admin-filters">
                <aside class="filters">
                    <form method="get" id="order-filters-form" style="display:flex;flex-direction:column;gap:10px;">
                        <div class="search">
                            <input type="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                placeholder="Поиск" aria-label="Поиск">
                            <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                                <img src="/assets/imgs/icons/search.svg" alt="search">
                            </button>
                        </div>
                        <p class="title">Фильтры</p>
                        <div class="filters__content">
                            <a
                                href="?sort=id_asc<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">По
                                возрастанию ID</a>
                            <a
                                href="?sort=id_desc<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>">По
                                убыванию ID</a>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
    </section>
    <script defer>
        // Открытие модалки
        document.querySelectorAll('.update-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const orderId = this.getAttribute('data-order-id');
                const currentStatus = this.getAttribute('data-current-status');
                document.getElementById('order_id_input').value = orderId;
                document.getElementById('status_select').value = currentStatus;
                document.getElementById('order-status-modal').showModal();
            });
        });
        // Закрытие модалки
        document.getElementById('close-status-modal').onclick = function () {
            document.getElementById('order-status-modal').close();
        };
        // AJAX-отправка формы
        document.getElementById('order-status-form').onsubmit = async function (e) {
            e.preventDefault();
            const orderId = document.getElementById('order_id_input').value;
            const status = document.getElementById('status_select').value;
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('status', status);
            const response = await fetch('/lib/handlers/update_order_status.php', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();
            if (result.success) {
                window.location.reload();
            } else {
                alert(result.error || "Не удалось обновить статус");
            }
        };
    </script>
</body>

</html>