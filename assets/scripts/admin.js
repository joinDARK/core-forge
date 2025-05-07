document.addEventListener("DOMContentLoaded", function () {
    const dialog = document.querySelector(".add_form");
    const openButton = document.getElementById("open_add_form");
    const closeButton = dialog.querySelector(".dialog__close");

    // Открытие диалога
    openButton.addEventListener("click", () => {
        dialog.showModal();
    });

    // Закрытие по кнопке с крестиком
    closeButton.addEventListener("click", () => {
        dialog.close();
    });

    // Закрытие по клику вне формы (опционально)
    dialog.addEventListener("click", (event) => {
        const rect = dialog.querySelector("form").getBoundingClientRect();
        const isInDialog = (
            event.clientX >= rect.left &&
            event.clientX <= rect.right &&
            event.clientY >= rect.top &&
            event.clientY <= rect.bottom
        );
        if (!isInDialog) {
            dialog.close();
        }
    });
});