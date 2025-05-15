<dialog id="reg-modal">
    <form method="post" id="reg_form" action="/lib/reg.php">
        <div class="dialog__header">
            <p class="dialog__title">Регистрация</p>
            <button type="button" class="dialog__close" id="dialog__reg_close">
                <img src="../assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="dialog__body">
            <input type="text" name="name" placeholder="Имя" required>
            <input type="email" name="email" placeholder="Эл. почта" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="repeat_password" placeholder="Подтвердить пароль" required>
        </div>
        <button type="submit" class="dialog__submit">Зарегистрироваться</button>
        <button type="button" id="swap_to_sign_in">Уже есть аккаунт? Войти</button>
    </form>
</dialog>

<dialog id="login-modal">
    <form method="post" id="login_form" action="/lib/login.php">
        <div class="dialog__header">
            <p class="dialog__title">Войти в аккаунт</p>
            <button type="button" class="dialog__close" id="dialog__login_close">
                <img src="../assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="dialog__body">
            <input type="email" name="email" placeholder="Эл. почта" required>
            <input type="password" name="password" placeholder="Пароль" required>
        </div>
        <button type="submit" class="dialog__submit">Войти</button>
        <button type="button" id="swap_to_reg">Нету акаунта? Зарегистрироваться</button>
    </form>
</dialog>

<?php if (isset($_SESSION["user"])): ?>
<dialog id="buy-modal">
    <form method="post" id="buy_form" action="/lib/create_order.php">
        <div class="dialog__header">
            <p class="dialog__title">Заказать товары</p>
            <button type="button" class="dialog__close" id="dialog__buy_close">
                <img src="../assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="dialog__body">
            <input type="text" name="name" placeholder="Имя" value="<?=$_SESSION["user"]["name"]?>" required>
            <input type="text" name="address" placeholder="Адрес" required>
            <input type="text" name="tel" placeholder="Контактный номер" required>
            <select name="payment_method" id="payment_method" placeholder="Способ оплаты" required>
                <option value="Банковской картой">Банковской картой</option>
                <option value="Наличными">Наличными</option>
                <option value="СБП">СБП</option>
            </select>
        </div>
        <button type="submit" class="dialog__submit">Заказать</button>
    </form>
</dialog>
<dialog id="review-modal">
    <form method="post" id="review_form">
        <div class="dialog__header">
            <p class="dialog__title">Оставить отзыв</p>
            <button type="button" class="dialog__close" id="dialog__review_close">
                <img src="../assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="dialog__body">
            <input hidden type="text" name="name" placeholder="Имя" required>
            <textarea name="review" placeholder="Отзыв" rows="10" required></textarea>
        </div>
        <button type="submit" class="dialog__submit">Отправить</button>
    </form>
</dialog>
<?php endif; ?>