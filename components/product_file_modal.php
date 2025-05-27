<dialog class="add-product-file-modal" id="add-product-file-modal">
    <form method="post" action="/lib/upload_product_file.php" enctype="multipart/form-data" id="add-product-file-form">
        <div class="dialog__header">
            <p class="dialog__title">Загрузить PDF-файл</p>
            <button type="button" class="dialog__close" id="close-add-file-modal">
                <img src="/assets/imgs/icons/X.svg" alt="close">
            </button>
        </div>
        <div class="dialog__body">
            <input type="hidden" name="product_id" id="add_file_product_id">
            <input type="hidden" name="product_type" id="add_file_product_type">
            <input type="file" name="pdf_file" accept="application/pdf" required>
        </div>
        <button type="submit" class="dialog__submit">Загрузить</button>
    </form>
</dialog>
<script defer>
    // Открытие модалки: вызывай showAddFileModal(productId, productType) из своей страницы
    window.showAddFileModal = function (productId, productType) {
        document.getElementById('add_file_product_id').value = productId;
        document.getElementById('add_file_product_type').value = productType;
        document.getElementById('add-product-file-modal').showModal();
    };

    // Закрытие по крестику
    document.getElementById('close-add-file-modal')?.addEventListener('click', () => {
        document.getElementById('add-product-file-modal').close();
    });

    // Закрытие по клику вне модалки
    document.getElementById('add-product-file-modal')?.addEventListener('click', function (e) {
        const form = this.querySelector("form");
        const rect = form.getBoundingClientRect();
        if (
            e.clientX < rect.left || e.clientX > rect.right ||
            e.clientY < rect.top || e.clientY > rect.bottom
        ) {
            this.close();
        }
    });
</script>