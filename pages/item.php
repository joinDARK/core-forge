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
            'cores' => 'Количество ядер',
            'threads' => 'Количество потоков',
            'base_clock' => 'Базовая частота',
            'boost_clock' => 'Максимальная частота',
            'tdp' => 'TDP',
        ],
        'motherboards' => [
            'socket' => 'Сокет',
            'chipset' => 'Чипсет',
            'form_factor' => 'Форм-фактор',
            'memory_slots' => 'Слотов памяти',
            'pci_slots' => 'PCIe слотов',
        ],
        'rams' => [
            'type' => 'Тип памяти',
            'capacity' => 'Объем',
            'speed' => 'Частота',
            'modules' => 'Количество модулей',
            'timings' => 'Тайминги',
        ],
        'psus' => [
            'power' => 'Мощность',
            'certification' => 'Сертификат эффективности',
            'modular' => 'Модульность',
            'fans' => 'Вентилятор',
        ],
        'cases' => [
            'form_factor' => 'Форм-фактор',
            'drive_bays' => 'Отсеки для дисков',
            'front_io' => 'Порты на передней панели',
            'cooling_support' => 'Поддержка охлаждения',
        ],
        'ssds' => [
            'capacity' => 'Объем',
            'interface' => 'Интерфейс',
            'read_speed' => 'Скорость чтения',
            'write_speed' => 'Скорость записи',
        ],
        'hdds' => [
            'capacity' => 'Объем',
            'rpm' => 'Скорость вращения',
            'cache' => 'Кеш-память',
            'interface' => 'Интерфейс',
        ],
    ];

    // Категория товара
    $categoryName = $tables[$table];
    ?>
    <section id="item">
        <div class="container">
            <div class="item-info">
                <img src="../assets/imgs/catalog/<?=htmlspecialchars($item['img'], ENT_QUOTES)?>" alt="rtx5090">
                <aside class="info">
                    <p class="info__title"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                    <div class="info__marks">
                        <div class="marks">
                            <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                            <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                            <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                            <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                            <img src="../assets/imgs/icons/star.svg" alt="star">
                        </div>
                        <p class="info__reviews-count">1001 отзывов</p>
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
                                        <?php if (!empty($item[$field])): ?>
                                            <p class="spec__info">
                                                <span><?= $label ?>:</span>
                                                <?= htmlspecialchars($item[$field], ENT_QUOTES) ?>
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
                                    <a href="" class="file">
                                        Полные характеристики
                                        <img src="../assets/imgs/icons/attach_file.svg" alt="attach_file">
                                    </a>
                                    <a href="" class="file">
                                        Гайды
                                        <img src="../assets/imgs/icons/attach_file.svg" alt="attach_file">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Цена: <?= number_format($item['price'], 0, ',', ' ') ?> ₽</p>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <button class="dark">Войдите, чтобы оставить отзыв</button>
                    <?php else: ?>
                        <button class="secondary" id="review_button">Оставить отзыв</button>
                        <form method="post" action="/lib/add_to_cart.php" class="info__form">
                            <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                            <input type="hidden" name="id" value="<?= (int)$id ?>">
                            <input type="number" name="quantity" minlength="1" value="1" required>
                            <button type="submit">В корзину</button>
                        </form>
                    <?php endif; ?>
                </aside>
            </div>
            <div class="item-reviews">
                <h2 class="item-reviews__title">ОТЗЫВЫ О ТОВАРЕ</h2>
                <div class="item-reviews__container">
                    <div class="item-review__container">
                        <div class="item-review">
                            <div class="item-review__header">
                                <img class="item-review__author-img" src="../assets/imgs/reviews/evg.jpg" alt="evg">
                                <div class="item-review__main-content">
                                    <p class="item-review__author">Евгений</p>
                                    <div class="item-review__mark">
                                        <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                        <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                        <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                        <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                        <img src="../assets/imgs/icons/star.svg" alt="star">
                                    </div>
                                </div>
                                <p class="item-review__date">15 января 2025</p>
                            </div>
                            <p class="item-review__text">Топовая видеокарта!!!</p>
                        </div>
                    </div>
                    <div class="item-review__container admin">
                        <div class="item-review">
                            <div class="item-review__header">
                                <p class="item-review__author">Команда КорФордж</p>
                                <p class="item-review__date">25 января 2025</p>
                            </div>
                            <p class="item-review__text">Евгений, спасибо за ваш оставленный отзыв! =). Надеюсь вы
                                обратитесь к нам еще!</p>
                        </div>
                    </div>
                    <button class="dark">Показать больше</button>
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