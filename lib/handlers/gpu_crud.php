<?php
// gpu_crud_handler.php — Обработчик CRUD-запросов для видеокарт (таблица `gpus`)

require '../../connect/connect.php';
require '../product_crud.php';

$category = 'videocards'; // ключ из $allowedCategories → таблица `gpus`

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1) Удаление: если передан delete_id
        if (!empty($_POST['delete_id'])) {
            $id = (int) $_POST['delete_id'];
            deleteProduct($category, $id);
            // перенаправляем обратно на страницу админа с флагом
            header('Location: /pages/admin/gpu.php');
            exit;
        }

        // Собираем данные из формы
        $data = [
            'name'                        => trim($_POST['name'] ?? ''),
            'desc'                        => trim($_POST['desc'] ?? ''),
            'graphics_processor'          => trim($_POST['graphics_processor'] ?? ''),
            'memory'                      => trim($_POST['memory'] ?? ''),
            'video_connectors'            => trim($_POST['video_connectors'] ?? ''),
            'power'                       => trim($_POST['power'] ?? ''),
            'additional_power_connectors' => trim($_POST['additional_power_connectors'] ?? ''),
            'price'                       => trim($_POST['price'] ?? ''),
        ];

        // Валидация: все поля обязательны, кроме описания (если нужно)
        foreach (['name','graphics_processor','memory','video_connectors','power','additional_power_connectors','price'] as $field) {
            if ($data[$field] === '') {
                throw new Exception("Поле «{$field}» обязательно для заполнения.");
            }
        }

        // 2) Обновление: если передан id
        if (!empty($_POST['id'])) {
            $id = (int) $_POST['id'];
            updateProduct($category, $id, $data);
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?updated=1');
            exit;
        }

        // 3) Создание: ни delete_id, ни id не переданы
        $newId = createProduct($category, $data);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?created=1');
        exit;
    }
} catch (Exception $e) {
    die($e);
}