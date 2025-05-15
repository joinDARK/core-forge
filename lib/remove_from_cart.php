<?php
session_start();
require_once '../connect/connect.php';

if (!isset($_SESSION['user']['id'])) {
    header('Location: /pages/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_type = $_GET['type'] ?? '';
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Проверяем тип и id
$allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
if (!in_array($product_type, $allowed_types) || $product_id <= 0) {
    header('Location: /pages/user_cart.php');
    exit;
}

// Удаляем товар из корзины
$stmt = $connect->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_type = ? AND product_id = ?");
$stmt->execute([$user_id, $product_type, $product_id]);

// Возврат на корзину
header('Location: /pages/user_cart.php');
exit;