<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж (Админ Панель)</title>
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="stylesheet" href="../assets/style/admin.css">
    <link rel="shortcut icon" href="../assets/imgs/logo/logo.svg" type="image/x-icon">
</head>

<body>
    <?php
    require '../components/modals.php';
    ?>
    <header>
        <div class="header__container">
            <a href="/pages/gpu.php">Видеокарты</a>
            <a href="#">Процессоры</a>
            <a href="#">Куллеры</a>
            <a href="#">Материнские платы</a>
            <a href="#">Оперативная память</a>
            <button class="primary" id="reg-button">
                <img src="../assets/imgs/profiles/user.png" alt="user" class="user-icon">
            </button>
        </div>
    </header>
    <section id="data">
        <div class="container">
            <div class="data-container">
                <div class="data__item">
                    <p class="data__id">ID: 1</p>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Карточка товара</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <p class="data__item-info"><span>Картинка:</span> rtx5090.jpg</p>
                            <p class="data__item-info"><span>Описание:</span> Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                            <p class="data__item-info"><span>Графический процессор:</span> GeForce RTX 5090</p>
                            <p class="data__item-info"><span>Объем видеопамяти:</span> 32 ГБ GDDR7</p>
                            <p class="data__item-info"><span>Тип и количество видеоразъемов:</span> 3 DisplayPort, HDMI</p>
                            <p class="data__item-info"><span>Потребляемая мощность:</span> 575 W</p>
                            <p class="data__item-info"><span>Разъемы дополнительного питания:</span> 16 pin (12V-2x6)</p>
                            <p class="data__item-info"><span>Файлы:</span> guides.pdf, specs.pdf</p>
                            <div class="data__buttons-group">
                                <button>Изменить</button>
                                <button class="secondary">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data__item">
                    <p class="data__id">ID: 1</p>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Карточка товара</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <p class="data__item-info"><span>Картинка:</span> rtx5090.jpg</p>
                            <p class="data__item-info"><span>Описание:</span> Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                            <p class="data__item-info"><span>Графический процессор:</span> GeForce RTX 5090</p>
                            <p class="data__item-info"><span>Объем видеопамяти:</span> 32 ГБ GDDR7</p>
                            <p class="data__item-info"><span>Тип и количество видеоразъемов:</span> 3 DisplayPort, HDMI</p>
                            <p class="data__item-info"><span>Потребляемая мощность:</span> 575 W</p>
                            <p class="data__item-info"><span>Разъемы дополнительного питания:</span> 16 pin (12V-2x6)</p>
                            <p class="data__item-info"><span>Файлы:</span> guides.pdf, specs.pdf</p>
                            <div class="data__buttons-group">
                                <button>Изменить</button>
                                <button class="secondary">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data__item">
                    <p class="data__id">ID: 1</p>
                    <div class="accordion">
                        <div class="accordion__header">
                            <p class="accordion__title">Карточка товара</p>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9" stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="accordion__content">
                            <p class="data__item-info"><span>Картинка:</span> rtx5090.jpg</p>
                            <p class="data__item-info"><span>Описание:</span> Описание товара, которое должно занимать примерно максимум 4 строки текста. Для этого надо смотреть, как это выглядит</p>
                            <p class="data__item-info"><span>Графический процессор:</span> GeForce RTX 5090</p>
                            <p class="data__item-info"><span>Объем видеопамяти:</span> 32 ГБ GDDR7</p>
                            <p class="data__item-info"><span>Тип и количество видеоразъемов:</span> 3 DisplayPort, HDMI</p>
                            <p class="data__item-info"><span>Потребляемая мощность:</span> 575 W</p>
                            <p class="data__item-info"><span>Разъемы дополнительного питания:</span> 16 pin (12V-2x6)</p>
                            <p class="data__item-info"><span>Файлы:</span> guides.pdf, specs.pdf</p>
                            <div class="data__buttons-group">
                                <button>Изменить</button>
                                <button class="secondary">Удалить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filters_container">
                <aside class="filters">
                    <div class="search">
                        <input type="search" placeholder="Поиск" aria-label="Поиск">
                        <button type="submit" class="transparent" aria-label="Найти" id="search-button">
                            <img src="../assets/imgs/icons/search.svg" alt="search">
                        </button>
                    </div>
                    <button class="white">Добавить товар</button>
                    <p class="title">Фильтры</p>
                    <div class="filters__content">
                        <a href="#">По возрастанию ID</a>
                        <a href="#">По убыванию ID</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</body>

</html>