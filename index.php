<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж</title>
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="stylesheet" href="assets/style/adaptive.css">
    <link rel="shortcut icon" href="assets/imgs/logo/logo.svg" type="image/x-icon">
    <script src="assets/scripts/script.js" defer></script>
    <script src="assets/scripts/slider.js" defer></script>
</head>

<body>
    <?php
    session_start();
    require 'components/modals.php';
    require 'components/burger_menu.php';
    require 'components/header.php';
    require 'connect/connect.php';
    require_once 'lib/fav_functions.php'; // если нужно для is_favorite
    
    // Массив всех таблиц с категориями
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

    $newProducts = [];
    foreach ($tables as $table => $label) {
        // Защита: если нет поля created_at — поправь!
        $stmt = $connect->prepare("SELECT id, name, `desc`, price, img, created_at, '$table' as table_name, '$label' as category FROM `$table` ORDER BY created_at DESC LIMIT 6");
        $stmt->execute();
        $newProducts = array_merge($newProducts, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    // Оставим только 6 самых новых товаров из всех категорий
    usort($newProducts, function ($a, $b) {
        return strtotime($b['created_at']) < strtotime($a['created_at']) ? 1 : -1;
    });
    $newProducts = array_reverse(array_slice($newProducts, 0, 6));
    ?>
    <main>
        <div class="container">
            <div class="main__title">
                <h1>КорФордж</h1>
                <h2>Кузница ваших мечт</h2>
            </div>
            <div class="main__advantages">
                <div class="main__advantages-item">
                    <img src="assets/imgs/main/list.svg" alt="list">
                    <div class="advantages-item__text">
                        <p class="advantages-item__text__title">широкий ассортимент</p>
                        <p class="advantages-item__text__sub-title">В КорФордж вы создаете собственный цифровой организм
                            из тысяч уникальных «органов» для вашего ПК!</p>
                    </div>
                </div>
                <div class="main__advantages-item">
                    <img src="assets/imgs/main/check.svg" alt="check">
                    <div class="advantages-item__text">
                        <p class="advantages-item__text__title">высокое качество</p>
                        <p class="advantages-item__text__sub-title">Наши компоненты настолько надёжны, что даже
                            кузнечный молот позавидует их прочности</p>
                    </div>
                </div>
                <div class="main__advantages-item">
                    <img src="assets/imgs/main/experts.svg" alt="experts">
                    <div class="advantages-item__text">
                        <p class="advantages-item__text__title">экспертные рекомендации</p>
                        <p class="advantages-item__text__sub-title">Забудьте про «возможно, подойдёт»: наши гуру железа
                            подберут детали так, будто видят ваши мечты насквозь</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <section id="new">
        <div class="container">
            <div class="new__col-1">
                <div class="tag gray">Новинки</div>
                <p class="title">Свежая партия из горна</p>
                <p class="sub-title">Успей забрать раскаленную новинку, пока не остыла!</p>
                <a href="/pages/catalog.php">
                    <button>Перейти в каталог</button>
                </a>
            </div>
            <div class="crop-container">
                <img src="assets/imgs/new/rtx.png" alt="rtx">
            </div>
        </div>
    </section>
    <section id="discount">
        <div class="container">
            <div class="discount__col-1">
                <div class="tag">Акция</div>
                <p class="title">Горячая ковка выгоды</p>
                <p class="sub-title">Ударь по ценам, пока они не остыли!</p>
                <p class="text">— Скидки до 30% на SSD-накопители. <br> — Кэшбэк 10% бонусными монетами на следующую
                    покупку. <br> — Секретный купон: введите «КОРФОРДЖ2024» и получите +5% скидки.</p>
                <a href="/pages/catalog.php">
                    <button class="secondary">Перейти в каталог</button>
                </a>
            </div>
            <img src="assets/imgs/discount/item.png" alt="rtx">
        </div>
    </section>
    <section id="reviews">
        <div class="container">
            <p class="title">Клеймо одобрения</p>
            <div class="slider">
                <img src="assets/imgs/slider/Left.svg" alt="Left">
                <div class="slider-container">
                    <div class="slider-container__content">
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                        <div class="review">
                            <p class="review__text">Собрал ПК на 10 лет вперёд — компоненты как из танковой брони!
                                Менеджер подобрал связку CPU+GPU, которая рвёт даже киберспортивные бенчмарки.
                                Рекомендую: тут знают, как закалить сталь!</p>
                            <div class="review__bottom-container">
                                <img src="assets/imgs/reviews/ivan.png" alt="people">
                                <p>Иван</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="assets/imgs/slider/Right.svg" alt="Right">
            </div>
        </div>
    </section>
    <section id="pop">
        <div class="container">
            <div class="slider">
                <img src="assets/imgs/slider/Left.svg" alt="Left">
                <div class="slider-container">
                    <div class="slider-container__content">
                        <?php if (empty($newProducts)): ?>
                            <p>Нет новых товаров.</p>
                        <?php else: ?>
                            <?php foreach ($newProducts as $item): ?>
                                <div class="card">
                                    <div class="img">
                                        <a href="/pages/item.php?table=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>">
                                            <img src="assets/imgs/catalog/<?= htmlspecialchars($item['img']) ?>"
                                                alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>">
                                        </a>
                                        <?php if (isset($_SESSION['user']['id'])): ?>
                                            <?php if (is_favorite($connect, $_SESSION['user']['id'], $item['table_name'], $item['id'])): ?>
                                                <a href="/lib/remove_from_fav.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>"
                                                    title="Убрать из избранного">
                                                    <svg class="fav-button_filled" width="20" height="18" viewBox="0 0 20 18"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                                    </svg>
                                                </a>
                                            <?php else: ?>
                                                <a href="/lib/add_to_fav.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>"
                                                    title="В избранное">
                                                    <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card__container">
                                        <div class="info">
                                            <p class="title"><?= htmlspecialchars($item['name'], ENT_QUOTES) ?></p>
                                            <div class="tag"><?= htmlspecialchars($item['category'], ENT_QUOTES) ?></div>
                                            <p class="desc"><?= htmlspecialchars($item['desc'], ENT_QUOTES) ?></p>
                                        </div>
                                        <div class="bottom">
                                            <p><?= number_format($item['price'], 0, ',', ' ') ?> ₽</p>
                                            <?php if (isset($_SESSION['user']['id'])): ?>
                                                <a
                                                    href="/lib/add_to_cart.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>">
                                                    <button>В корзину</button>
                                                </a>
                                            <?php else: ?>
                                                <button>В корзину</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <img src="assets/imgs/slider/Right.svg" alt="Right">
            </div>
        </div>
    </section>
    <?php
    require "components/footer.php"
        ?>
</body>

</html>