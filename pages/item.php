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
    <section id="item">
        <div class="container">
            <div class="item-info">
                <div class="item-slider">
                    <div class="item-slider__container">
                        <img src="../assets/imgs/items/rtx5090.png" alt="rtx5090">
                    </div>
                    <div class="item-slider__nav">
                        <div class="item-slider__nav-button current"></div>
                        <div class="item-slider__nav-button"></div>
                        <div class="item-slider__nav-button"></div>
                    </div>
                </div>
                <aside class="info">
                    <p class="info__title">Карточка товара</p>
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
                    <div class="tag">Видеокарта</div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Описание товара</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <p class="desc">Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                        </div>
                    </div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Основные характеристики</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <div class="spec">
                                <p class="spec__info"><span>Графический процессор:</span> GeForce RTX 5090</p>
                                <p class="spec__info"><span>Объем видеопамяти:</span> 32 ГБ GDDR7</p>
                                <p class="spec__info"><span>Тип и количество видеоразъемов:</span> 3 DisplayPort, HDMI</p>
                                <p class="spec__info"><span>Потребляемая мощность:</span> 575 W</p>
                                <p class="spec__info"><span>Разъемы дополнительного питания:</span> 16 pin (12V-2x6)</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Доп. материалы</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
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
                    <button class="dark">Войдите, чтобы оставить отзыв</button>
                    <button>330 000 ₽</button>
                </aside>
            </div>
            <div class="item-reviews">
                <h2 class="item-reviews__title">ОТЗЫВЫ О ТОВАРЕ</h2>
                <div class="item-reviews__container">
                    <div class="item-review__container">
                        <div class="item-review">
                            <div class="item-review__header">
                                <img class="item-review__author-img" src="../assets/imgs/reviews/evg.jpg" alt="evg">
                                <p class="item-review__author">Евгений</p>
                                <div class="item-review__mark">
                                    <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                    <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                    <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                    <img src="../assets/imgs/icons/filled_star.svg" alt="filled_star">
                                    <img src="../assets/imgs/icons/star.svg" alt="star">
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
                            <p class="item-review__text">Евгений, спасибо за ваш оставленный отзыв! =). Надеюсь вы обратитесь к нам еще!</p>
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