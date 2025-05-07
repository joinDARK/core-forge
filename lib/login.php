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
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'])) ?? '';

    // Валидация полей
    if (empty($email)) {
        $response['errors']['email'] = 'Email не может быть пустым';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Некорректный email';
    }

    if (empty($password)) {
        $response['errors']['password'] = 'Пароль не может быть пустым';
    }

    // Если есть ошибки — возвращаем их
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    // Аутентификация пользователя
    try {
        $stmt = $connect->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            $response['errors']['email'] = 'Неверный логин или пароль';
            $response['errors']['password'] = 'Неверный логин или пароль';
        } else {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Проверяем пароль
            if (!password_verify($password, $user['password'])) {
                $response['errors']['password'] = 'Неверный логин или пароль';
                $response['errors']['email'] = 'Неверный логин или пароль';
            } else {
                // Успешная аутентификация
                session_regenerate_id(true);
                $_SESSION['user'] = $user;
                $response['success'] = true;
            }
        }
    } catch (PDOException $e) {
        $response['errors']['database'] = 'Ошибка базы данных: ' . $e->getMessage();
    }

    // Выводим результат
    echo json_encode($response);
    exit;
}