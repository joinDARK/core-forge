<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж</title>
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="shortcut icon" href="../assets/imgs/logo/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    require '../components/modals.php';
    require '../components/header.php';
    ?>
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
                        <a href="#">Видеокарта</a>
                        <a href="#">Процессор</a>
                        <a href="#">Кулер</a>
                    </div>
                </aside>
            </div>
            <div class="catalog__container">
                <div class="catalog__content">
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img">
                            <img src="../assets/imgs/catalog/rtx5090.png" alt="rtx5090">
                            <svg class="fav-button" width="20" height="18" viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.54918 16.0182L2.38816 9.52515C0.537281 7.57452 0.53728 4.39129 2.38816 2.44067C4.21083 0.519777 7.14313 0.519777 8.9658 2.44067C9.52799 3.03315 10.472 3.03315 11.0342 2.44067C12.8569 0.519777 15.7892 0.519776 17.6118 2.44067C19.4627 4.39129 19.4627 7.57452 17.6118 9.52515L11.4508 16.0182C10.6622 16.8493 9.33784 16.8493 8.54918 16.0182Z"/>
                            </svg>
                        </div>
                        <div class="info">
                            <p class="title">Карточка товара</p>
                            <div class="tag">Видеокарта</div>
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                        <div class="bottom">
                            <p>100 000 ₽</p>
                            <a href="#">
                                <button>В корзину</button>
                            </a>
                        </div>
                    </div>
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
