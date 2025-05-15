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
    require '../components/header.php';
    require '../connect/connect.php';
    require '../lib/fav_functions.php';

    // Получаем параметры фильтрации и поиска
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Массив таблиц и их человекочитаемых названий
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

    // Подготовка частей SQL
    $sqlParts = [];
    $params = [];

    // Функция для добавления части SQL
    $addPart = function ($tableName, $label) use (&$sqlParts, &$params, $search) {
        // TODO нужно будет исправить запрос в дальнейшем
        $part = "SELECT
                id,
                name,
                `desc`,
                price,
                '$label' AS category,
                '$tableName' AS table_name,
                img
            FROM `$tableName`";
        if ($search !== '') {
            $part .= " WHERE name LIKE :search OR `desc` LIKE :search";
            $params['search'] = "%{$search}%";
        }
        $sqlParts[] = $part;
    };

    // Если выбрана конкретная категория и она есть в списке таблиц
    if ($category !== 'all' && array_key_exists($category, $tables)) {
        $addPart($category, $tables[$category]);
    } else {
        // Иначе объединяем все таблицы
        foreach ($tables as $table => $label) {
            $addPart($table, $label);
        }
    }

    // Собираем финальный SQL
    $sql = implode("\nUNION ALL\n", $sqlParts) . "\nORDER BY name";

    // Выполняем запрос
    $stmt = $connect->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue(":{$key}", $value);
    }
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="#" class="burger-menu__link">
                <button>Каталог</button>
            </a>
            <?php if (isset($_SESSION['user'])): ?>
                <div class="profile__info">
                    <img src="../assets/imgs/profiles/user.png" alt="user">
                    <div class="profile__info-text">
                        <p class="profile__name"><?= $_SESSION['user']['name'] ?></p>
                        <a href="mailto:<?= $_SESSION['user']['email'] ?>"
                            class="profile__email"><?= $_SESSION['user']['email'] ?></a>
                    </div>
                </div>

                <a href="/pages/user_fav.php" class="burger-menu__link">
                    <button class="dark">Избранные</button>
                </a>
                <a href="/pages/user_history.php" class="burger-menu__link">
                    <button class="dark">История</button>
                </a>
                <a href="/pages/user_cart.php" class="burger-menu__link">
                    <button class="dark">Корзина</button>
                </a>

            <?php else: ?>
                <button class="login-button">Войти</button>
                <p>или</p>
                <button class="reg-button">Зарегистрироваться</button>
            <?php endif; ?>
            <p class="filters__title">Фильтры</p>
            <div class="filters__content">
                <a href="?category=all<?= $search ? '&search=' . urlencode($search) : '' ?>"
                    class="<?= $category === 'all' ? 'active' : '' ?>">Все</a>
                <?php foreach ($tables as $table => $label): ?>
                    <a href="?category=<?= $table ?><?= $search ? '&search=' . urlencode($search) : '' ?>"
                        class="<?= $category === $table ? 'active' : '' ?>">
                        <?= $label ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </dialog>
    <section id="catalog">
        <div class="container">
            <div class="filters_container">
                <aside class="filters">
                    <p class="title">Фильтры</p>
                    <form method="get" class="search">
                        <input type="search" name="search" placeholder="Поиск" aria-label="Поиск"
                            value="<?= htmlspecialchars($search, ENT_QUOTES) ?>">
                        <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                            <img src="../assets/imgs/icons/search.svg" alt="search">
                        </button>
                        <!-- Скрытый инпут для сохранения выбранной категории при поиске -->
                        <input type="hidden" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES) ?>">
                    </form>
                    <div class="filters__content">
                        <a href="?category=all<?= $search ? '&search=' . urlencode($search) : '' ?>"
                            class="<?= $category === 'all' ? 'active' : '' ?>">Все</a>
                        <?php foreach ($tables as $table => $label): ?>
                            <a href="?category=<?= $table ?><?= $search ? '&search=' . urlencode($search) : '' ?>"
                                class="<?= $category === $table ? 'active' : '' ?>">
                                <?= $label ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
            <div class="catalog__container">
                <div class="catalog__content">
                    <?php if (empty($items)): ?>
                        <p>Товары не найдены.</p>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <div class="card">
                                <div class="img">
                                    <a href="/pages/item.php?table=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>">
                                        <img src="../assets/imgs/catalog/<?= htmlspecialchars($item['img']) ?>"
                                            alt="<?= htmlspecialchars($item['name'], ENT_QUOTES) ?>">
                                    </a>
                                    <?php if (isset($_SESSION['user']['id'])): ?>
                                        <?php if (is_favorite($connect, $_SESSION['user']['id'], $item['table_name'], $item['id'])): ?>
                                            <a href="/lib/remove_from_fav.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>" title="Убрать из избранного">
                                                <svg class="fav-button_filled" width="20" height="18" viewBox="0 0 20 18"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                                </svg>
                                            </a>
                                        <?php else: ?>
                                            <a href="/lib/add_to_fav.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>" title="В избранное">
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
                                        <a href="/lib/add_to_cart.php?type=<?= $item['table_name'] ?>&id=<?= $item['id'] ?>">
                                            <button>В корзину</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if (count($items) >= 20): // пример пагинации ?>
                    <button class="dark">Показать больше</button>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    require "../components/footer.php"
        ?>
    <script src="../assets/scripts/script.js" defer></script>
</body>

</html>