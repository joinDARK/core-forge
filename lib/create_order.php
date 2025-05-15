<?php
require '../connect/connect.php';
// Запускаем сессию для сохранения данных пользователя
session_start();

// Устанавливаем JSON-ответ
header('Content-Type: application/json');
$response = ['success' => false, 'errors' => []];

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['errors'][] = 'Неверный метод запроса';
    echo json_encode($response);
    exit;
} else {
    // Получаем и очищаем входные данные
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $tel = htmlspecialchars(trim($_POST['tel'])) ?? '';
    $address = htmlspecialchars(trim($_POST['address'])) ?? '';
    $payment_method = htmlspecialchars(trim($_POST['payment_method'])) ?? '';

    // Валидация полей
    if (empty($name)) {
        $response['errors']['name'] = 'Имя не может быть пустым';
    }

    if (empty($tel)) {
        $response['errors']['tel'] = 'Номер телефона не может быть пустым';
    }

    if (empty($address)) {
        $response['errors']['address'] = 'Адрес доставки не может быть пустым';
    }

    if (empty($payment_method)) {
        $response['errors']['payment_method'] = 'Способ оплаты не может быть пустым';
    } elseif (!in_array($payment_method, ['Банковской картой', 'Наличными', 'СБП'])) {
        $response['errors']['payment_method'] = 'Некорректный способ оплаты';
    }

    // Если есть ошибки — возвращаем их
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    // Аутентификация пользователя
    try {
        $stmt = $connect->prepare('INSERT INTO orders (name, tel, address, payment_method) VALUES (:name, :tel, :address, :payment_method)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->execute();

        $response['success'] = true;
    } catch (PDOException $e) {
        $response['errors']['database'] = 'Ошибка базы данных: ' . $e->getMessage();
    }

    // Выводим результат
    echo json_encode($response);
    exit;
}