<?php
require '../connect/connect.php';
// Устанавливаем JSON-ответ
header('Content-Type: application/json');
$response = ['success' => false, 'errors' => []];

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['errors'][] = 'Не валидный метод запроса';
    echo json_encode($response);
    exit;
} else {
    // Получаем и очищаем входные данные
    $name = htmlspecialchars(trim($_POST['name']) ?? '');
    $password = htmlspecialchars(trim($_POST['password'])) ?? '';
    $repeat_password = htmlspecialchars(trim($_POST['repeat_password'])) ?? '';
    $email = htmlspecialchars(trim($_POST['email']) ?? '');
    $address = htmlspecialchars(trim($_POST['address']) ?? '');
    $tel = htmlspecialchars(trim($_POST['tel']) ?? '');

    // Валидация полей
    if (empty($password)) {
        $response['errors']['password'] = 'Пароль не может быть пустым';
    }

    if (empty($repeat_password)) {
        $response['errors']['repeat_password'] = 'Повторный пароль не может быть пустым';
    }

    if ($password !== $repeat_password) {
        $response['errors']['repeat_password'] = 'Пароли не совпадают';
    }

    if (empty($email)) {
        $response['errors']['email'] = 'Email не может быть пустым';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Некорректный email';
    }

    if (empty($name)) {
        $response['errors']['name'] = 'Имя не может быть пустым';
    }

    if (empty($address)) {
        $response['errors']['address'] = 'Адрес не может быть пустым';
    }

    if (empty($tel)) {
        $response['errors']['tel'] = 'Телефон не может быть пустым';
    }

    // Проверяем, существует ли пользователь с таким логином или email
    try {
        $stmt = $connect->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response['errors']['email'] = 'Пользователь с таким email уже существует';
        }
    } catch (PDOException $e) {
        $response['errors']['database'] = 'Ошибка базы данных: ' . $e->getMessage();
    }

    // Если есть ошибки валидации — возвращаем их
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    // Вставка в базу через подготовленный запрос
    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connect->prepare('INSERT INTO users (name, password, email, address, tel) VALUES (:name, :password, :email, :address, :tel)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':tel', $tel);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['errors']['database'] = 'Ошибка при регистрации пользователя';
        }
    } catch (PDOException $e) {
        $response['errors'][] = 'Ошибка базы данных: ' . $e->getMessage();
    }

    // Выводим результат
    echo json_encode($response);
    exit;
}