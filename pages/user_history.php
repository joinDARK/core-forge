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
    ?>
    <section id="history">
        <div class="container">
            <div class="profile_container">
                <aside class="profile">
                    <div class="profile__info">
                        <img src="../assets/imgs/profiles/user.png" alt="user">
                        <div class="profile__info-text">
                            <p class="profile__name"><?=$_SESSION['user']['name']?></p>
                            <a href="mailto:<?=$_SESSION['user']['email']?>" class="profile__email"><?=$_SESSION['user']['email']?></a>
                        </div>
                    </div>
                    <a href="#">
                        <button class="dark">История</button>
                    </a>
                    <a href="/pages/user_fav.php">
                        <button>Избранные</button>
                    </a>
                </aside>
            </div>
            <div class="history-content">
                <p class="history-content__title">История заказов</p>
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
</body>

</html>