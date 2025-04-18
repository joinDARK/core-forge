// Модалки
let regModal = document.querySelector("#reg-modal");
let loginModal = document.querySelector("#login-modal");
let buyModal = document.querySelector("#buy-modal");

function clearAllInputs(modal) {
    modal.querySelectorAll("input").forEach(function (input) {
        input.value = "";
    });
}

document
    .querySelectorAll("#reg-button, #swap_to_reg")
    .forEach(function (button) {
        button.addEventListener("click", function () {
            if (regModal) {
                loginModal.close();
                clearAllInputs(loginModal);

                regModal.showModal();

                let close = regModal.querySelector("#dialog__reg_close");
                if (close) {
                    close.addEventListener("click", function () {
                        regModal.close();
                        clearAllInputs(regModal);
                    });
                }
            } else {
                alert("Reg Modal not found");
            }
        });
    });

document
    .querySelectorAll("#swap_to_sign_in, #login-button")
    .forEach(function (button) {
        button.addEventListener("click", function () {
            if (loginModal) {
                regModal.close();
                clearAllInputs(regModal);

                loginModal.showModal();

                let close = loginModal.querySelector("#dialog__login_close");
                if (close) {
                    close.addEventListener("click", function () {
                        loginModal.close();
                        clearAllInputs(loginModal);
                    });
                }
            } else {
                alert("Sign In Modal not found");
            }
        });
    });

document.querySelector('#buy').addEventListener('click', () => {
  if (buyModal) {
    buyModal.showModal();

    let close = buyModal.querySelector("#dialog__buy_close");
    if (close) {
        close.addEventListener("click", function () {
            buyModal.close();
            clearAllInputs(buyModal);
        });
    }
  } else {
    alert("Buy Modal not found");
  }
});