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

    if (!isset($_SESSION['user']['id'])) {
        $response['errors']['auth'] = 'Вы не авторизованы';
        echo json_encode($response);
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    // Проверяем, что пользователь авторизован
    if (empty($user_id)) {
        $response['errors']['auth'] = 'Вы не авторизованы';
        echo json_encode($response);
        exit;
    }
    
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        $response['errors']['auth'] = 'Пользователь не найден';
        echo json_encode($response);
        exit;
    }

    // Подключаем функцию получения корзины (или просто пиши запрос прямо здесь)
    require_once 'cart_functions.php';

    // Получаем корзину пользователя
    $cart_items = get_cart($connect, $user_id);

    if (!$cart_items) {
        $response['errors']['cart'] = 'Ваша корзина пуста';
        echo json_encode($response);
        exit;
    }

    // Если есть ошибки — возвращаем их
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    // --- ДОБАВЛЯЕМ ЗАКАЗ ---
    try {
        $stmt = $connect->prepare('INSERT INTO orders (name, tel, address, payment_method) VALUES (:name, :tel, :address, :payment_method)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->execute();
        $order_id = $connect->lastInsertId();

        // --- СОХРАНЯЕМ ПОЗИЦИИ ЗАКАЗА ---
        $allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
        foreach ($cart_items as $item) {
            $type = $item['product_type'];
            $id = $item['product_id'];
            $quantity = $item['quantity'];
            if (!in_array($type, $allowed_types))
                continue;
            // Получаем цену на момент заказа
            $stmt_price = $connect->prepare("SELECT price FROM `$type` WHERE id = ?");
            $stmt_price->execute([$id]);
            $row = $stmt_price->fetch(PDO::FETCH_ASSOC);
            $price = $row ? $row['price'] : 0;

            $stmt_item = $connect->prepare("INSERT INTO order_items (order_id, product_type, product_id, quantity, price) VALUES (?, ?, ?, ?, ?)");
            $stmt_item->execute([$order_id, $type, $id, $quantity, $price]);
        }

        // --- ОЧИЩАЕМ КОРЗИНУ ---
        $stmt_clear = $connect->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt_clear->execute([$user_id]);

        $response['success'] = true;
    } catch (PDOException $e) {
        $response['errors']['database'] = 'Ошибка базы данных: ' . $e->getMessage();
    }

    echo json_encode($response);
    exit;
}