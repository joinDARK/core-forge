<?php
require '../../connect/connect.php';
require '../../lib/checkAuth.php';
require '../../lib/checkIsAdmin.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Неверный метод']);
    exit;
}

$order_id = (int) ($_POST['order_id'] ?? 0);
$status = $_POST['status'] ?? '';

$allowed = ['В обработке', 'Оплачен', 'Отменен'];
if (!$order_id || !in_array($status, $allowed)) {
    echo json_encode(['success' => false, 'error' => 'Некорректные данные']);
    exit;
}

$stmt = $connect->prepare("UPDATE orders SET status = ? WHERE id = ?");
if ($stmt->execute([$status, $order_id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Ошибка обновления']);
}
exit;