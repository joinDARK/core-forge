<?php
session_start();
require_once '../connect/connect.php';

if (!isset($_SESSION['user']['id'])) {
    http_response_code(403);
    exit;
}

$user_id = $_SESSION['user']['id'];
$stmt = $connect->prepare("DELETE FROM cart_items WHERE user_id = ?");
$stmt->execute([$user_id]);

echo json_encode(['success' => true]);