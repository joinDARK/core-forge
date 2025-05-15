<?php
session_start();
require_once '../connect/connect.php';

// Проверка авторизации
if (!isset($_SESSION['user']['id'])) {
    header('Location: /pages/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];

// Принимаем параметры из POST или GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_type = $_POST['table'] ?? '';
    $product_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
} else {
    $product_type = $_GET['type'] ?? '';
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $quantity = 1; // всегда 1 из каталога
}

// Валидируем данные
$allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
if (!in_array($product_type, $allowed_types) || $product_id <= 0) {
    header('Location: /pages/catalog.php');
    exit;
}

// Проверяем наличие товара
$stmt = $connect->prepare("SELECT id FROM `$product_type` WHERE id = ?");
$stmt->execute([$product_id]);
if (!$stmt->fetch()) {
    header('Location: /pages/catalog.php');
    exit;
}

// Проверяем наличие товара в корзине
$stmt = $connect->prepare("SELECT id, quantity FROM cart_items WHERE user_id = ? AND product_type = ? AND product_id = ?");
$stmt->execute([$user_id, $product_type, $product_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $stmt = $connect->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?");
    $stmt->execute([$quantity, $row['id']]);
} else {
    $stmt = $connect->prepare("INSERT INTO cart_items (user_id, product_type, product_id, quantity) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $product_type, $product_id, $quantity]);
}

// Редирект назад
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;