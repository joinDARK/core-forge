// --------------------------------------------------
// МОДАЛЬНЫЕ ОКНА
// --------------------------------------------------
const regModal = document.querySelector("#reg-modal");
const loginModal = document.querySelector("#login-modal");
const buyModal = document.querySelector("#buy-modal");
const reviewModal = document.querySelector("#review-modal");
const burgerMenuModal = document.querySelector("#burger-menu");

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => root.querySelectorAll(sel);

/* ---------- Вспомогалки ---------- */
function clearAllInputs(modal) {
    modal?.querySelectorAll("input").forEach((i) => (i.value = ""));
}
function openModal(modal) {
    modal?.showModal();
}
function closeModal(modal, alsoClear = false) {
    if (!modal) return;
    modal.close();
    if (alsoClear) clearAllInputs(modal);
}

/* ---------- Переключения «Регистрация / Вход» ---------- */
$$(".reg-button, #swap_to_reg").forEach((btn) => {
    btn.addEventListener("click", () => {
        closeModal(loginModal, true);
        openModal(regModal);
    });
});
$("#dialog__reg_close")?.addEventListener("click", () =>
    closeModal(regModal, true)
);

$$(".login-button, #swap_to_sign_in").forEach((btn) => {
    btn.addEventListener("click", () => {
        closeModal(regModal, true);
        openModal(loginModal);
    });
});
$("#dialog__login_close")?.addEventListener("click", () =>
    closeModal(loginModal, true)
);

/* ---------- Прочие модалки ---------- */
$("#burger-menu__open")?.addEventListener("click", () =>
    openModal(burgerMenuModal)
);
$("#burger-menu__close")?.addEventListener("click", () =>
    closeModal(burgerMenuModal)
);

$("#buy")?.addEventListener("click", () => openModal(buyModal));
$("#dialog__buy_close")?.addEventListener("click", () =>
    closeModal(buyModal, true)
);

$("#review_button")?.addEventListener("click", () => openModal(reviewModal));
$("#dialog__review_close")?.addEventListener("click", () =>
    closeModal(reviewModal, true)
);

// --------------------------------------------------
// AJAX-ОБРАБОТКА ФОРМ
// --------------------------------------------------
/* Удаляем сообщения об ошибках + сбрасываем setCustomValidity */
function clearFormErrors(form) {
    form.querySelectorAll(".form-error").forEach((el) => el.remove());
    form.querySelectorAll("input").forEach((input) =>
        input.setCustomValidity("")
    );
}

/* Помечаем поле ошибкой (псевдокласс :user-invalid) */
function setInputError(input, message) {
    input.setCustomValidity(message); // делает поле invalid и user-invalid
    input.reportValidity(); // выводим стандартный тултип браузера
    // при следующем изменении сбросим customValidity
    input.addEventListener("input", () => input.setCustomValidity(""), {
        once: true,
    });
}

/* Вывод ошибок + setCustomValidity */
function renderFormErrors(form, errors) {
    clearFormErrors(form);
    Object.entries(errors).forEach(([field, message]) => {
        const input = form.querySelector(`[name="${field}"]`);
        if (!input) {
            return;
        }

        // 1) Встроенная валидация и псевдокласс
        setInputError(input, message);

        // 2) Текстовая подпись под полем (по желанию)
        const errEl = document.createElement("div");
        errEl.className = "form-error text-red-600 text-sm mt-1";
        errEl.textContent = message;
        input.insertAdjacentElement("afterend", errEl);
    });
}

/**
 * Универсальная отправка формы Fetch-ом
 * @param {HTMLFormElement} form
 * @param {Function} onSuccess
 */
async function ajaxForm(form, onSuccess) {
    const submitBtn = $(".dialog__submit", form);
    submitBtn.disabled = true;

    const formData = new FormData(form);
    try {
        const res = await fetch(form.action, {
            method: "POST",
            body: formData,
        });
        const json = await res.json();

        if (json.success) {
            clearFormErrors(form);
            onSuccess(json);
        } else {
            alert("Ошибка валидации формы. Обратитесь к администратору.");
            renderFormErrors(form, json.errors || {});
        }
    } catch (e) {
        alert("Не удалось отправить запрос. Попробуйте позже.");
        console.error(e);
    } finally {
        submitBtn.disabled = false;
    }
}

/* ---------- Регистрация ---------- */
$("#reg_form")?.addEventListener("submit", function (e) {
    e.preventDefault();
    ajaxForm(this, () => {
        this.reset();
        closeModal(regModal);
        openModal(loginModal);
    });
});

/* ---------- Вход ---------- */
$("#login_form")?.addEventListener("submit", function (e) {
    e.preventDefault();
    ajaxForm(this, () => {
        window.location.href = window.location.href;
    });
});

/* ---------- Заказ товара ---------- */
$("#buy_form")?.addEventListener("submit", function (e) {
    e.preventDefault();
    ajaxForm(this, () => {
        this.reset();
        closeModal(buyModal);
        alert("Заказ успешно оформлен!");
        location.reload(); // перезагружаем страницу, чтобы обновить корзину
    });
});

/* ---------- Отзыв ---------- */
// $("#review_form")?.addEventListener("submit", function (e) {
//     e.preventDefault();
//     ajaxForm(this, () => {
//         this.reset();
//         closeModal(reviewModal);
//         alert("Отзыв успешно отправлен!");
//     });
// });

/* ---------- Удаление товара ---------- */
$("#clear-cart")?.addEventListener("click", async function (e) {
    e.preventDefault();
    if (!confirm("Вы точно хотите очистить корзину?")) return;

    try {
        const res = await fetch("/lib/clear_cart.php", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (res.ok) {
            // Можно сделать красивее: location.reload() или очистить таблицу вручную
            location.reload();
        } else {
            alert("Ошибка при очистке корзины. Попробуйте ещё раз.");
        }
    } catch (err) {
        alert("Ошибка соединения. Попробуйте позже.");
    }
});
