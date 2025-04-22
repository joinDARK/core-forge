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
            <a href="/pages/catalog.php" class="burger-menu__link">
                <button class="dark">Каталог</button>
            </a>
            <div class="profile__info">
                <img src="../assets/imgs/profiles/user.png" alt="user">
                <div class="profile__info-text">
                    <p class="profile__name">Пользователь</p>
                    <a href="mailro:user@mail.ru" class="profile__email">user@mail.ru</a>
                </div>
            </div>
            <a href="#" class="burger-menu__link">
                <button>Избранные</button>
            </a>
            <a href="/pages/user_history.php" class="burger-menu__link">
                <button class="dark">История</button>
            </a>
            <a href="/pages/user_cart.php" class="burger-menu__link">
                <button class="dark">Корзина</button>
            </a>
        </div>
    </dialog>
    <header>
        <div class="header__container">
            <a href="/index.php">Главная</a>
            <a href="/pages/catalog.php">Каталог</a>
            <a href="/pages/user_cart.php">Корзина</a>
            <button class="primary" id="reg-button">
                <img src="../assets/imgs/profiles/user.png" alt="user" class="user-icon">
            </button>
        </div>
        <div class="container">
            <div class="search">
                <input type="search" placeholder="Поиск" aria-label="Поиск">
                <button type="search" class="transparent" aria-label="Найти" id="search-button">
                    <img src="../assets/imgs/icons/search.svg" alt="search">
                </button>
            </div>
            <button id="burger-menu__open">
                <img src="../assets/imgs/icons/menu.svg" alt="menu">
            </button>
        </div>
    </header>
    <section id="favorites">
        <div class="container">
            <div class="profile_container">
                <aside class="profile">
                    <div class="profile__info">
                        <img src="../assets/imgs/profiles/user.png" alt="user">
                        <div class="profile__info-text">
                            <p class="profile__name">Пользователь</p>
                            <a href="mailro:user@mail.ru" class="profile__email">user@mail.ru</a>
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
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="img">
                                <a href="/pages/item.php">
                                    <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                                </a>
                                <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z" />
                                </svg>
                            </div>
                            <div class="card__container">
                                <div class="info">
                                    <p class="title">Карточка товара</p>
                                    <div class="tag">Видеокарта</div>
                                    <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки
                                        текста. Для этого надо смотреть, как это выглядит</p>
                                </div>
                                <div class="bottom">
                                    <p>100 000 ₽</p>
                                    <a href="#">
                                        <button>В корзину</button>
                                    </a>
                                </div>
                            </div>
                        </div>
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