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

        $sql = "SELECT * FROM `gpus`";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $gpus = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <a href="#">Видеокарта</a>
                    <a href="#">Процессор</a>
                    <a href="#">Кулер</a>
                </div>
            </div>
        </dialog>
        <section id="catalog">
            <div class="container">
                <div class="filters_container">
                    <aside class="filters">
                        <p class="title">Фильтры</p>
                        <div class="search">
                            <input type="search" placeholder="Поиск" aria-label="Поиск">
                            <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                                <img src="../assets/imgs/icons/search.svg" alt="search">
                            </button>
                        </div>
                        <div class="filters__content">
                            <a href="#">Все</a>
                            <a href="#">Процессоры</a>
                            <a href="#">Видеокарты</a>
                            <a href="#">Материнские платы</a>
                            <a href="#">Оперативная память</a>
                            <a href="#">Блоки питания</a>
                            <a href="#">Корпуса</a>
                            <a href="#">SSD-диски</a>
                            <a href="#">HDD-диски</a>
                        </div>
                    </aside>
                </div>
                <div class="catalog__container">
                    <div class="catalog__content">
                        <?php
                        foreach ($gpus as $gpu) {
                            ?>
                            <div class="card">
                                <div class="img">
                                    <a href="/pages/item.php?id=<?= $gpu['id'] ?>">
                                        <img src="../assets/imgs/catalog/rtx5090.png" alt="<?= $gpu['name'] ?>">
                                    </a>
                                    <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                    </svg>
                                </div>
                                <div class="card__container">
                                    <div class="info">
                                        <p class="title"><?= $gpu['name'] ?></p>
                                        <div class="tag">Видеокарта</div>
                                        <p class="desc"><?= $gpu['desc'] ?></p>
                                    </div>
                                    <div class="bottom">
                                        <p><?= $gpu['price'] ?> ₽</p>
                                        <a href="#">
                                            <button>В корзину</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <button class="dark">Показать больше</button>
                </div>
            </div>
        </section>
        <?php
        require "../components/footer.php"
            ?>
        <script src="../assets/scripts/script.js" defer></script>
    </body>

    </html>