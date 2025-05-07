<?php
/* --------------------------------------------------
 *  ХЕЛПЕР ДЛЯ АКТИВНОЙ КНОПКИ
 * -------------------------------------------------- */
$currentFile = basename($_SERVER['SCRIPT_NAME']);     // например: index.php или catalog.php

/**
 * Вернёт строку классов для <button>.
 * @param string $file  Имя файла, с которым сравниваем (index.php, catalog.php …)
 * @return string       "dark active"  или  "dark"
 */
function btnClass(string $file): string
{
    global $currentFile;                       // текущий открытый файл
    return $currentFile === $file ? 'primary' : 'dark';
}
?>

<dialog id="burger-menu">
    <div class="burger-menu__header">
        <p class="burger-menu__title">Навигация</p>
        <button type="button" class="burger-menu__close" id="burger-menu__close">
            <img src="../assets/imgs/icons/X.svg" alt="close">
        </button>
    </div>

    <div class="burger-menu__body">
        <!-- ---------- Ссылки, доступные всем ---------- -->
        <a href="/index.php" class="burger-menu__link">
            <button class="<?= btnClass('index.php') ?>">Главная</button>
        </a>

        <a href="/pages/catalog.php" class="burger-menu__link">
            <button class="<?= btnClass('catalog.php') ?>">Каталог</button>
        </a>

        <?php if (isset($_SESSION['user'])): ?>
            <!-- ---------- Блок профиля ---------- -->
            <div class="profile__info">
                <img src="../assets/imgs/profiles/user.png" alt="user">
                <div class="profile__info-text">
                    <p class="profile__name"><?= $_SESSION['user']['name'] ?></p>
                    <a href="mailto:<?= $_SESSION['user']['email'] ?>"
                       class="profile__email"><?= $_SESSION['user']['email'] ?></a>
                </div>
            </div>

            <!-- ---------- Пользовательские страницы ---------- -->
            <a href="/pages/user_fav.php" class="burger-menu__link">
                <button class="<?= btnClass('user_fav.php') ?>">Избранные</button>
            </a>
            <a href="/pages/user_history.php" class="burger-menu__link">
                <button class="<?= btnClass('user_history.php') ?>">История</button>
            </a>
            <a href="/pages/user_cart.php" class="burger-menu__link">
                <button class="<?= btnClass('user_cart.php') ?>">Корзина</button>
            </a>

        <?php else: ?>
            <!-- ---------- Гость ---------- -->
            <button class="login-button <?= btnClass('login.php') // если есть отдельная страница входа ?>"></button>
            <p>или</p>
            <button class="reg-button <?= btnClass('register.php') // если есть отдельная страница регистрации ?>"></button>
        <?php endif; ?>
    </div>
</dialog>