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
    $product_type = 'cpus';
    require '../../components/modals.php';
    require '../../components/product_file_modal.php';
    require '../../components/header.php';
    require '../../lib/product_crud.php';
    require '../../lib/get_product_pdfs.php';
    // Пример: получаем параметры
    $search = trim($_GET['search'] ?? '');
    $sort = $_GET['sort'] ?? 'id_desc';

    // Строим SQL
    $sql = "SELECT * FROM cpus"; // или другая таблица
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
        <form method="post" action="/lib/handlers/cpu_crud.php" enctype="multipart/form-data">
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
                <input type="text" name="socket" placeholder="Сокет" required>
                <input type="number" name="core_count" placeholder="Количество ядер" min="1" required>
                <input type="number" name="thread_count" placeholder="Количество потоков" min="1" required>
                <input type="number" name="tdp" placeholder="TDP (Вт)" min="0" required>
                <input type="number" step="0.01" name="frequency" placeholder="Базовая частота (ГГц)" min="0" required>
                <input type="text" name="memory_type" placeholder="Тип поддерживаемой памяти" required>
            </div>
            <button type="submit" class="dialog__submit">Добавить</button>
        </form>
    </dialog>
    <dialog class="upd_form">
        <form method="post" action="/lib/handlers/cpu_crud.php" enctype="multipart/form-data">
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
                <input type="text" name="socket" placeholder="Сокет" required>
                <input type="number" name="core_count" placeholder="Количество ядер" min="1" required>
                <input type="number" name="thread_count" placeholder="Количество потоков" min="1" required>
                <input type="number" name="tdp" placeholder="TDP (Вт)" min="0" required>
                <input type="number" step="0.01" name="frequency" placeholder="Базовая частота (ГГц)" min="0" required>
                <input type="text" name="memory_type" placeholder="Тип поддерживаемой памяти" required>
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
                                    <p class="data__item-info"><span>Сокет:</span>
                                        <?= htmlspecialchars($product['socket'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Ядер:</span>
                                        <?= htmlspecialchars($product['core_count'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Потоков:</span>
                                        <?= htmlspecialchars($product['thread_count'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>TDP (Вт):</span>
                                        <?= htmlspecialchars($product['tdp'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Базовая частота (ГГц):</span>
                                        <?= htmlspecialchars($product['frequency'] ?? '', ENT_QUOTES) ?></p>
                                    <p class="data__item-info"><span>Тип поддерживаемой памяти:</span>
                                        <?= htmlspecialchars($product['memory_type'] ?? '', ENT_QUOTES) ?></p>
                                    <?php
                                    $pdfs = get_product_pdfs($connect, $product_type, $product['id']);
                                    ?>
                                    <div class="accordion gray">
                                        <div class="accordion__header">
                                            <p class="accordion__title">PDF-файлы</p>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5 9L11.2191 14.3306C11.6684 14.7158 12.3316 14.7158 12.7809 14.3306L19 9"
                                                    stroke="#EEF0F5" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                        <div class="accordion__content">
                                            <div class="accordion__content-inner">
                                                <!-- Список PDF -->
                                                <?php if (empty($pdfs)): ?>
                                                    <div class="pdf-empty">Нет файлов</div>
                                                <?php else: ?>
                                                    <div class="pdf-list">
                                                        <?php foreach ($pdfs as $pdf): ?>
                                                            <div class="pdf-item">
                                                                <a href="/assets/uploads/<?= htmlspecialchars($pdf['filename']) ?>"
                                                                    target="_blank">
                                                                    <?= htmlspecialchars($pdf['original_name']) ?>
                                                                </a>
                                                                <form method="post" action="/lib/delete_product_file.php"
                                                                    style="display:inline;">
                                                                    <input type="hidden" name="file_id" value="<?= $pdf['id'] ?>">
                                                                    <input type="hidden" name="product_type"
                                                                        value="<?= $product_type ?>">
                                                                    <input type="hidden" name="product_id"
                                                                        value="<?= $product['id'] ?>">
                                                                    <button type="submit" onclick="return confirm('Удалить файл?')"
                                                                        class="item__delete-btn" style="margin-left:6px;">
                                                                        <img src="../../assets/imgs/icons/delete.svg" alt="delete">
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <button type="button" class="add-file-btn"
                                                    onclick="showAddFileModal(<?= $product['id'] ?>, 'gpus')">
                                                    Добавить PDF-файл
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data__buttons-group">
                                        <button type="button" class="update-btn" data-id="<?= $product['id'] ?>"
                                            data-name="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
                                            data-desc="<?= htmlspecialchars($product['desc'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($product['price'], ENT_QUOTES) ?>"
                                            data-socket="<?= htmlspecialchars($product['socket'] ?? '', ENT_QUOTES) ?>"
                                            data-core_count="<?= htmlspecialchars($product['core_count'] ?? '', ENT_QUOTES) ?>"
                                            data-thread_count="<?= htmlspecialchars($product['thread_count'] ?? '', ENT_QUOTES) ?>"
                                            data-tdp="<?= htmlspecialchars($product['tdp'] ?? '', ENT_QUOTES) ?>"
                                            data-frequency="<?= htmlspecialchars($product['frequency'] ?? '', ENT_QUOTES) ?>"
                                            data-memory_type="<?= htmlspecialchars($product['memory_type'] ?? '', ENT_QUOTES) ?>">Изменить</button>
                                        <form method="post" action="/lib/handlers/cpu_crud.php">
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
                updForm.elements["socket"].value = btn.dataset.socket || '';
                updForm.elements["core_count"].value = btn.dataset.core_count || '';
                updForm.elements["thread_count"].value = btn.dataset.thread_count || '';
                updForm.elements["tdp"].value = btn.dataset.tdp || '';
                updForm.elements["frequency"].value = btn.dataset.frequency || '';
                updForm.elements["memory_type"].value = btn.dataset.memory_type || '';
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