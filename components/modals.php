<dialog id="reg-modal">
    <form method="post" id="reg_form">
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
    <form method="post" id="login_form">
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