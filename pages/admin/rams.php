<?php
require '../../lib/checkAuth.php';
require '../../lib/checkIsAdmin.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КорФордж (Админ Панель)</title>
    <link rel="stylesheet" href="../../assets/style/style.css">
    <link rel="stylesheet" href="../../assets/style/admin.css">
    <link rel="shortcut icon" href="../../assets/imgs/logo/logo.svg" type="image/x-icon">
    <script src="../../assets/scripts/accordion.js" defer></script>
</head>

<body>
    <?php
    require '../../components/modals.php';
    require '../../components/header.php';
    require '../../lib/product_crud.php';
    // Пример: получаем параметры
    $search = trim($_GET['search'] ?? '');
    $sort = $_GET['sort'] ?? 'id_desc';

    // Строим SQL
    $sql = "SELECT * FROM rams"; // или другая таблица
    $conditions = [];
    $params = [];

    if ($search !== '') {
        $conditions[] = "(name LIKE :search OR id = :idsearch)";
        $params['search'] = "%$search%";
        $params['idsearch'] = (int) $search;
    }

    if ($conditions) {
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }

    switch ($sort) {
        case 'id_asc':
            $sql .= " ORDER BY id ASC";
            break;
        case 'id_desc':
        default:
            $sql .= " ORDER BY id DESC";
            break;
    }

    // Выполняем запрос
    $stmt = $connect->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    $stmt->execute();
    $products = $stmt->fetchAll();
    ?>
    <dialog class="add_form">
        <form method="post" action="/lib/handlers/rams_crud.php" enctype="multipart/form-data">
            <div class="dialog__header">
                <p class="dialog__title">Добавить товар</p>
                <button type="button" class="dialog__close">
                    <img src="../../assets/imgs/icons/X.svg" alt="close">
                </button>
            </div>
            <div class="dialog__body">
                <input type="text" name="name" placeholder="Название" required>
                <textarea name="desc" placeholder="Описание" rows="10" required></textarea>
                <input type="text" name="price" placeholder="Цена" required>
                <input type="file" name="image" placeholder="Изображение" required>
            </div>
            <button type="submit" class="dialog__submit">Добавить</button>
        </form>
    </dialog>
    <dialog class="upd_form">
        <form method="post" action="/lib/handlers/rams_crud.php" enctype="multipart/form-data">
            <div class="dialog__header">
                <p class="dialog__title">Изменить данные</p>
                <button type="button" class="dialog__close">
                    <img src="../../assets/imgs/icons/X.svg" alt="close">
                </button>
            </div>
            <div class="dialog__body">
                <input type="hidden" name="id">
                <input type="text" name="name" placeholder="Название" required>
                <textarea name="desc" placeholder="Описание" rows="10" required></textarea>
                <input type="text" name="price" placeholder="Цена" required>
                <input type="file" name="image" placeholder="Изображение">
            </div>
            <button type="submit" class="dialog__submit">Изменить</button>
        </form>
    </dialog>
    <section id="data">
        <div class="container">
            <div class="data-container">
                <?php
                foreach ($products as $product) {
                    ?>
                    <div class="data__item">
                        <p class="data__id">ID: <?= $product['id'] ?></p>
                        <div class="accordion">
                            <div class="accordion__header">
                                <p class="accordion__title"><?= $product['name'] ?></p>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                        stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="accordion__content">
                                <div class="accordion__content-inner">
                                    <p class="data__item-info"><span>Картинка:</span> <?= $product['img'] ?></p>
                                    <p class="data__item-info"><span>Описание:</span> <?= $product['desc'] ?></p>
                                    <p class="data__item-info"><span>Цена:</span> <?= $product['price'] ?> ₽</p>
                                    <p class="data__item-info"><span>Тип памяти:</span>
                                        <?= htmlspecialchars($product['memory_type'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Частота (МГц):</span>
                                        <?= htmlspecialchars($product['frequency'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Количество модулей:</span>
                                        <?= htmlspecialchars($product['module_count'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Размер одного модуля (ГБ):</span>
                                        <?= htmlspecialchars($product['module_size'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Общий объём (ГБ):</span>
                                        <?= htmlspecialchars($product['total_size'] ?? '', ENT_QUOTES) ?></p>
                                    <div class="data__buttons-group">
                                        <button type="button" class="update-btn" data-id="<?= $product['id'] ?>"
                                            data-name="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
                                            data-desc="<?= htmlspecialchars($product['desc'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($product['price'], ENT_QUOTES) ?>"
                                            data-memory_type="<?= htmlspecialchars($product['memory_type'] ?? '', ENT_QUOTES) ?>"
                                            data-frequency="<?= htmlspecialchars($product['frequency'] ?? '', ENT_QUOTES) ?>"
                                            data-module_count="<?= htmlspecialchars($product['module_count'] ?? '', ENT_QUOTES) ?>"
                                            data-module_size="<?= htmlspecialchars($product['module_size'] ?? '', ENT_QUOTES) ?>"
                                            data-total_size="<?= htmlspecialchars($product['total_size'] ?? '', ENT_QUOTES) ?>">Изменить</button>
                                        <form method="post" action="/lib/handlers/rams_crud.php">
                                            <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                                            <button class="secondary">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            require '../../components/admin_filters.php';
            ?>
        </div>
    </section>
    <script>
        const addDialog = document.querySelector(".add_form");
        const updDialog = document.querySelector(".upd_form");
        const addBtn = document.getElementById("add__open");
        const closeBtns = document.querySelectorAll(".dialog__close");
        const updateBtns = document.querySelectorAll(".update-btn");
        const deleteForms = document.querySelectorAll(".data__buttons-group form");

        // 1. Открываем «Добавить»
        addBtn?.addEventListener("click", () => addDialog.showModal());

        // 2. Открываем «Изменить» и заполняем поля
        updateBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const updForm = updDialog.querySelector("form");
                updForm.elements["id"].value = btn.dataset.id;
                updForm.elements["name"].value = btn.dataset.name;
                updForm.elements["desc"].value = btn.dataset.desc;
                updForm.elements["price"].value = btn.dataset.price;
                updDialog.showModal();
            });
        });

        // 3. Закрытие по крестику
        closeBtns.forEach(btn => {
            const dlg = btn.closest("dialog");
            btn.addEventListener("click", () => dlg.close());
        });

        // 4. Закрытие по клику вне и сброс форм
        [addDialog, updDialog].forEach(dlg => {
            dlg.addEventListener("click", e => {
                const form = dlg.querySelector("form");
                const rect = form.getBoundingClientRect();
                if (
                    e.clientX < rect.left || e.clientX > rect.right ||
                    e.clientY < rect.top || e.clientY > rect.bottom
                ) {
                    dlg.close();
                }
            });
            dlg.addEventListener("close", () => dlg.querySelector("form").reset());
        });

        // 5. Удаление с confirm
        deleteForms.forEach(form => {
            form.addEventListener("submit", e => {
                if (!confirm("Вы уверены, что хотите удалить товар?")) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>