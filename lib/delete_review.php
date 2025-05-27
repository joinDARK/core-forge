<?php
require './checkAuth.php';
require './checkIsAdmin.php';
require '../connect/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_review_id'])) {
    $delete_id = (int) $_POST['delete_review_id'];
    $stmt = $connect->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->execute([$delete_id]);

    // Редирект обратно на страницу отзывов (можно изменить URL)
    header("Location: /pages/admin/reviews.php");
    exit;
} else {
    // Если попытка зайти напрямую без POST — редирект
    header("Location: /index.php");
    exit;
}