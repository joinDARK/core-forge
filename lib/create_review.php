<?php
session_start();
require '../connect/connect.php';

if (!isset($_SESSION['user'])) {
    // Пользователь не авторизован — редирект или ошибка
    header('Location: /index.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_type = $_POST['product_type'] ?? '';
$product_id = (int) ($_POST['product_id'] ?? 0);
$comment = trim($_POST['review'] ?? '');
$rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 5;

if ($rating < 1 || $rating > 5)
    $rating = 5;

// Валидация
$allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
if (!in_array($product_type, $allowed_types) || $product_id <= 0 || $comment === '') {
    // Можно сделать редирект с ошибкой или сообщение
    header('Location: /index.php');
    exit;
}

$stmt = $connect->prepare("INSERT INTO reviews (user_id, product_type, product_id, comment, rating, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->execute([$user_id, $product_type, $product_id, $comment, $rating]);

// После добавления — редирект обратно на страницу товара
header("Location: /pages/item.php?table=$product_type&id=$product_id");
exit;