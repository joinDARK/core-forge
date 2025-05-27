<?php
require '../connect/connect.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    http_response_code(400);
    exit('Некорректный запрос.');
}

$stmt = $connect->prepare("SELECT * FROM product_files WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    http_response_code(404);
    exit('Файл не найден.');
}

$filepath = __DIR__ . '/../assets/uploads/' . $file['filename']; // Путь до папки с файлами
if (!file_exists($filepath)) {
    http_response_code(404);
    exit('Файл не найден на сервере.');
}

// Заголовки для скачивания файла
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file['original_name'] ?: $file['filename']) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
readfile($filepath);
exit;