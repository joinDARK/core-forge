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
    session_start();
    require '../components/modals.php';
    require '../components/burger_menu.php';
    require '../components/header.php';
    require '../connect/connect.php';

    // --- Получаем параметры ---
    $table = $_GET['table'] ?? '';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    // Допустимые таблицы и их названия
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

    if (!isset($tables[$table]) || $id <= 0) {
        exit('Некорректный запрос.');
    }

    // --- Запрашиваем данные товара ---
    $stmt = $connect->prepare("SELECT * FROM `$table` WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        exit('Товар не найден.');
    }

    // --- Спецификации по категориям ---
    $specMappings = [
        'gpus' => [
            'graphics_processor' => 'Графический процессор',
            'memory' => 'Объем видеопамяти',
            'video_connectors' => 'Тип и количество видеоразъемов',
            'power' => 'Потребляемая мощность',
            'additional_power_connectors' => 'Разъемы дополнительного питания',
        ],
        'cpus' => [
            'socket' => 'Сокет',
            'core_count' => 'Количество ядер',
            'thread_count' => 'Количество потоков',
            'tdp' => 'TDP (Вт)',
            'frequency' => 'Базовая частота (ГГц)',
            'memory_type' => 'Тип поддерживаемой памяти',
        ],
        'motherboards' => [
            'form_factor' => 'Форм-фактор',
            'socket' => 'Сокет',
            'chipset' => 'Чипсет',
            'memory_type' => 'Тип памяти',
            'memory_slots' => 'Слотов памяти',
            'm2_slots' => 'Слотов M.2',
            'nvme_support' => 'Поддержка NVMe',
        ],
        'rams' => [
            'memory_type' => 'Тип памяти',
            'frequency' => 'Частота (МГц)',
            'module_count' => 'Количество модулей',
            'module_size' => 'Размер одного модуля (ГБ)',
            'total_size' => 'Общий объём (ГБ)',
        ],
        'psus' => [
            'power' => 'Мощность (Вт)',
            'form_factor' => 'Форм-фактор',
            'main_connector' => 'Основной разъём',
            'cpu_connectors' => 'Разъёмы для процессора',
            'pcie_connectors' => 'PCIe разъёмы',
        ],
        'cases' => [
            'form_factor' => 'Форм-фактор корпуса',
            'has_rgb' => 'Подсветка (RGB)',
            'mb_form_factor' => 'Форм-фактор материнской платы',
            'psu_form_factor' => 'Форм-фактор блока питания',
            'has_cooling' => 'Встроенное охлаждение',
            'has_psu' => 'Встроенный блок питания',
        ],
        'ssds' => [
            'capacity' => 'Объём (ГБ)',
            'nvme' => 'Поддержка NVMe',
            'connector' => 'Разъём',
            'read_speed' => 'Скорость чтения (МБ/с)',
            'write_speed' => 'Скорость записи (МБ/с)',
        ],
        'hdds' => [
            'capacity' => 'Объём (ГБ)',
            'rpm' => 'Скорость вращения (об/мин)',
            'max_transfer_rate' => 'Макс. скорость передачи (МБ/с)',
            'interface' => 'Интерфейс',
            'noise_level' => 'Уровень шума (дБ)',
        ],
    ];

    // Категория товара
    $categoryName = $tables[$table];

    $reviews_stmt = $connect->prepare(
        "SELECT r.*, u.name AS username
                        FROM reviews r
                        JOIN users u ON r.user_id = u.id
                        WHERE r.product_type = :product_type AND r.product_id = :product_id
                        ORDER BY r.created_at DESC"
    );
    $reviews_stmt->bindValue(':product_type', $table, PDO::PARAM_STR);
    $reviews_stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
    $reviews_stmt->execute();
    $reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

    $reviews_count = count($reviews);

    $avg_rating_stmt = $connect->prepare("
        SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews
        FROM reviews
        WHERE product_type = :product_type AND product_id = :product_id
    ");
    $avg_rating_stmt->bindValue(':product_type', $table, PDO::PARAM_STR);
    $avg_rating_stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
    $avg_rating_stmt->execute();
    $rating_data = $avg_rating_stmt->fetch(PDO::FETCH_ASSOC);

    $avg_rating = $rating_data['avg_rating'] ? round($rating_data['avg_rating'], 1) : 0;
    $total_reviews = $rating_data['total_reviews'];

    $files_stmt = $connect->prepare(
    "SELECT * FROM product_files WHERE product_type = :product_type AND product_id = :product_id"
    );
    $files_stmt->bindValue(':product_type', $table, PDO::PARAM_STR);
    $files_stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
    $files_stmt->execute();
    $product_files = $files_stmt->fetchAll(PDO::FETCH_ASSOC);

    function plural_form($number, $titles)
    {
        $cases = [2, 0, 1, 1, 1, 2];
        $number = abs($number);
        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }

    function render_stars($avg_rating) {
        $full_stars = floor($avg_rating);
        $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;
        $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);

        $html = '';
        for ($i = 0; $i < $full_stars; $i++) {
            $html .= '<img src="../assets/imgs/icons/filled_star.svg" alt="star">';
        }
        if ($half_star) {
            // Если у тебя есть полузвезда, подключи её, если нет — можешь вывести заполнённую или пустую звезду
            // Здесь пример с заполнённой, чтобы не ломать верстку:
            $html .= '<img src="../assets/imgs/icons/filled_star.svg" alt="star">';
            // Или если есть полузвезда: '<img src="../assets/imgs/icons/half_star.svg" alt="half_star">';
        }
        for ($i = 0; $i < $empty_stars; $i++) {
            $html .= '<img src="../assets/imgs/icons/star.svg" alt="star">';
        }
        return $html;
    }
    ?>
    <?php if (isset($_SESSION['user'])): ?>
        <dialog id="review-modal">
            <form method="post" id="review_form" action="/lib/create_review.php">
                <div class="dialog__header">
                    <p class="dialog__title">Оставить отзыв</p>
                    <button type="button" class="dialog__close" id="dialog__review_close">
                        <img src="../assets/imgs/icons/X.svg" alt="close">
                    </button>
                </div>
                <div class="dialog__body">
                    <input type="hidden" name="product_type" value="<?= htmlspecialchars($table) ?>">
                    <input type="hidden" name="product_id" value="<?= (int) $id ?>">
                    <div class="rating">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <div class="rating__star">
                                <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" <?= $i === 5 ? 'checked' : '' ?>
                                required>
                                <label for="star<?= $i ?>"
                                    title="<?= $i ?> звезд<?= $i > 1 ? 'ы' : 'а' ?>"><?= str_repeat('<img src="../assets/imgs/icons/filled_star.svg" alt="star">', $i) ?></label>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <textarea name="review" placeholder="Отзыв" rows="10" required></textarea>
                </div>
                <button type="submit" class="dialog__submit">Отправить</button>
            </form>
        </dialog>
    <?php endif; ?>
    <section id="item">
        <div class="container">
            <div class="item-info">
                <img src="../assets/imgs/catalog/<?= htmlspecialchars($item['img'], ENT_QUOTES) ?>" alt="rtx5090">
                <aside class="info">
                    <p class="info__title"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                    <div class="info__marks">
                        <div class="marks">
                            <?= render_stars($avg_rating) ?>
                        </div>
                        <p class="info__reviews-count"><?= $reviews_count ?>
                            <?= plural_form($reviews_count, ['отзыв', 'отзыва', 'отзывов']) ?>
                        </p>
                    </div>
                    <div class="tag"><?= htmlspecialchars($categoryName, ENT_QUOTES) ?></div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Описание товара</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                    stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <div class="accordion__content-inner">
                                <p class="desc"><?= nl2br(htmlspecialchars($item['desc'], ENT_QUOTES)) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Основные характеристики</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                    stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <div class="accordion__content-inner">
                                <div class="spec">
                                    <?php foreach ($specMappings[$table] as $field => $label): ?>
                                        <?php if (!empty($item[$field]) || $item[$field] === 0): ?>
                                            <p class="spec__info">
                                                <span><?= $label ?>:</span>
                                                <?php if (in_array($field, ['nvme_support', 'nvme', 'has_rgb', 'has_cooling', 'has_psu'])): ?>
                                                    <?= $item[$field] ? 'Да' : 'Нет' ?>
                                                <?php else: ?>
                                                    <?= htmlspecialchars($item[$field], ENT_QUOTES) ?>
                                                <?php endif; ?>
                                            </p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Доп. материалы</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                    stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <div class="accordion__content-inner">
                                <div class="files">
                                    <?php if (count($product_files) > 0): ?>
                                        <?php foreach ($product_files as $file): ?>
                                            <a href="/lib/download.php?id=<?= $file['id'] ?>" class="file" download>
                                                <?= htmlspecialchars($file['original_name'] ?: $file['filename']) ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span style="color:#888;">Нет дополнительных материалов</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Цена: <?= number_format($item['price'], 0, ',', ' ') ?> ₽</p>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <button class="dark" onclick="alert('Вы должны зарегистрированы, чтобы оставить отзыв')">Войдите, чтобы оставить отзыв</button>
                    <?php else: ?>
                        <button class="secondary" id="review_button">Оставить отзыв</button>
                        <form method="post" action="/lib/add_to_cart.php" class="info__form">
                            <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                            <input type="hidden" name="id" value="<?= (int) $id ?>">
                            <input type="number" name="quantity" minlength="1" value="1" required>
                            <button type="submit">В корзину</button>
                        </form>
                    <?php endif; ?>
                </aside>
            </div>
            <div class="item-reviews">
                <h2 class="item-reviews__title">ОТЗЫВЫ О ТОВАРЕ</h2>
                <div class="item-reviews__container">
                    <?php if (count($reviews) > 0): ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="item-review__container<?= ($review['user_id'] == 1 ? ' admin' : '') ?>">
                                <div class="item-review">
                                    <div class="item-review__header">
                                        <div class="item-review__main-content">
                                            <p class="item-review__author">
                                                <?= htmlspecialchars($review['user_id'] == 1 ? 'Команда КорФордж' : $review['username']) ?>
                                            </p>
                                            <div class="item-review__mark">
                                                <?php
                                                $stars = (int) $review['rating'];
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i < $stars) {
                                                        echo '<img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">';
                                                    } else {
                                                        echo '<img src="../assets/imgs/icons/star.svg" alt="star">';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p class="item-review__date">
                                            <?= date('d.m.Y', strtotime($review['created_at'])) ?>
                                        </p>
                                    </div>
                                    <p class="item-review__text"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="color: #888; padding: 24px 0;">Отзывов пока нет. Будьте первым!</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    require "../components/footer.php";
    ?>
    <script src="../assets/scripts/script.js" defer></script>
    <script src="../assets/scripts/accordion.js" defer></script>
</body>

</html>