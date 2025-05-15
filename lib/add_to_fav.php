<?php
session_start();
require_once '../connect/connect.php';
require_once '../lib/fav_functions.php';

if (!isset($_SESSION['user']['id'])) {
    header('Location: /pages/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_type = $_GET['type'] ?? '';
$product_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
if (!in_array($product_type, $allowed_types) || $product_id <= 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

add_to_favorites($connect, $user_id, $product_type, $product_id);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;