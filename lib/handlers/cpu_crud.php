<?php
// gpu_crud.php — Обработчик CRUD-запросов для видеокарт (таблица `gpus`)

require '../../connect/connect.php';
require '../product_crud.php';

$category = 'processors'; // ключ из $allowedCategories → таблица `gpus`

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1) Удаление: если передан delete_id
        if (!empty($_POST['delete_id'])) {
            $id = (int) $_POST['delete_id'];
            deleteProduct($category, $id);
            header('Location: /pages/admin/cpu.php');
            exit;
        }

        // 2) Собираем данные из формы
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'desc' => trim($_POST['desc'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'socket' => trim($_POST['socket'] ?? ''),
            'core_count' => isset($_POST['core_count']) ? (int) $_POST['core_count'] : null,
            'thread_count' => isset($_POST['thread_count']) ? (int) $_POST['thread_count'] : null,
            'tdp' => isset($_POST['tdp']) ? (int) $_POST['tdp'] : null,
            'frequency' => isset($_POST['frequency']) ? (float) $_POST['frequency'] : null,
            'memory_type' => trim($_POST['memory_type'] ?? ''),
        ];

        // 3) Обработка загрузки изображения (опционально)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../assets/imgs/catalog/';
            if (!is_dir($uploadDir)) {
                die("Директория для загрузки изображений не найдена: {$uploadDir}");
            }
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $originalName = $_FILES['image']['name'];
            $ext = pathinfo($originalName, PATHINFO_EXTENSION);
            $newFileName = uniqid('cpu_', true) . '.' . $ext;
            $destPath = $uploadDir . $newFileName;
            if (!move_uploaded_file($fileTmpPath, $destPath)) {
                throw new Exception('Ошибка загрузки изображения.');
            }
            $data['img'] = $newFileName;
        }

        // 4) Валидация: все поля обязательны, кроме описания и изображения
        $requiredFields = [
            'name',
            'price',
            'socket',
            'core_count',
            'thread_count',
            'tdp',
            'frequency',
            'memory_type'
        ];
        foreach ($requiredFields as $field) {
            if ($data[$field] === '' || $data[$field] === null) {
                throw new Exception("Поле «{$field}» обязательно для заполнения.");
            }
        }

        // 5) Обновление: если передан id
        if (!empty($_POST['id'])) {
            $id = (int) $_POST['id'];
            updateProduct($category, $id, $data);
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?updated=1');
            exit;
        }

        // 6) Создание: ни delete_id, ни id не переданы
        $newId = createProduct($category, $data);
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?created=1');
        exit;
    }
} catch (Exception $e) {
    die($e);
}
?>