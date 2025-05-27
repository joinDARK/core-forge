<?php
require '../connect/connect.php';
require './checkAuth.php';
require './checkIsAdmin.php';
session_start();

if (!isset($_POST['file_id']))
    die('Нет файла');
$file_id = intval($_POST['file_id']);

$stmt = $connect->prepare("SELECT filename FROM product_files WHERE id = ?");
$stmt->execute([$file_id]);
$file = $stmt->fetch();
if ($file) {
    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/' . $file['filename'];
    if (file_exists($file_path))
        unlink($file_path);
    $connect->prepare("DELETE FROM product_files WHERE id = ?")->execute([$file_id]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>