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
    $sql = "SELECT r.*, u.name AS username 
        FROM reviews r 
        LEFT JOIN users u ON r.user_id = u.id";
    $conditions = [];
    $params = [];

    // Поиск по id, имени, адресу, телефону (расширить можно как нужно)
    if ($search !== '') {
        $conditions[] = "(r.id = :id_exact OR u.name LIKE :search OR r.comment LIKE :search)";
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
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    function get_product_info($connect, $product_type, $product_id)
    {
        $allowed_tables = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
        if (!in_array($product_type, $allowed_tables))
            return null;
        $stmt = $connect->prepare("SELECT name FROM `$product_type` WHERE id = ?");
        $stmt->execute([$product_id]);
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
                <?php foreach ($reviews as $review): ?>
                    <?php $product = get_product_info($connect, $review['product_type'], $review['product_id']); ?>
                    <div class="data__item">
                        <p class="data__id">ID: <?= $review['id'] ?></p>
                        <div class="accordion">
                            <div class="accordion__header">
                                <p class="accordion__title">Отзыв №<?= $review['id'] ?></p>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                        stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="accordion__content">
                                <div class="accordion__content-inner">
                                    <p class="data__item-info"><span>Пользователь:</span>
                                        <?= htmlspecialchars($review['username'] ?? 'Гость') ?></p>
                                    <p class="data__item-info"><span>Товар:</span>
                                        <?= htmlspecialchars($product['name'] ?? 'Не найден') ?></p>
                                    <p class="data__item-info"><span>Дата:</span>
                                        <?= date('d.m.Y H:i', strtotime($review['created_at'])) ?></p>
                                    <p class="data__item-info"><span>Текст отзыва:</span>
                                        <?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                    <div class="data__item-info_container">
                                        <p class="data__item-info"><span>Оценка:</span></p>
                                        <div class="data__rating">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <img src="../../assets/imgs/icons/<?= $i <= $review['rating'] ? 'filled_star' : 'star' ?>.svg"
                                                    alt="star">
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div class="data__buttons-group">
                                        <form method="post" action="/lib/delete_review.php"
                                            onsubmit="return confirm('Вы уверены, что хотите удалить этот отзыв?');">
                                            <input type="hidden" name="delete_review_id" value="<?= $review['id'] ?>">
                                            <button type="submit" class="secondary">Удалить</button>
                                        </form>
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
</body>

</html>