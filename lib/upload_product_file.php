<?php
require '../connect/connect.php';
require './checkAuth.php';
require './checkIsAdmin.php';

if (!isset($_POST['product_type'], $_POST['product_id'], $_FILES['pdf_file'])) {
    die('Ошибка данных');
}

$type = $_POST['product_type'];
$id = intval($_POST['product_id']);
$file = $_FILES['pdf_file'];

if ($file['type'] !== 'application/pdf' || $file['error'] !== UPLOAD_ERR_OK) {
    die('Файл должен быть PDF');
}

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$unique_name = uniqid('pdf_', true) . '.' . $ext;
$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/';
if (!is_dir($upload_dir))
    mkdir($upload_dir, 0777, true);
$upload_path = $upload_dir . $unique_name;

if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
    die('Ошибка загрузки');
}

$stmt = $connect->prepare("INSERT INTO product_files (product_type, product_id, filename, original_name) VALUES (?, ?, ?, ?)");
$stmt->execute([$type, $id, $unique_name, $file['name']]);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>