<?php
function add_to_favorites($pdo, $user_id, $product_type, $product_id)
{
    // Проверяем, есть ли уже в избранном
    $stmt = $pdo->prepare("SELECT id FROM favorites WHERE user_id = ? AND product_type = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_type, $product_id]);
    if (!$stmt->fetch()) {
        $stmt = $pdo->prepare("INSERT INTO favorites (user_id, product_type, product_id) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_type, $product_id]);
    }
}

function remove_from_favorites($pdo, $user_id, $product_type, $product_id)
{
    $stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND product_type = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_type, $product_id]);
}

function get_favorites($pdo, $user_id)
{
    $stmt = $pdo->prepare("SELECT * FROM favorites WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function is_favorite($pdo, $user_id, $product_type, $product_id)
{
    $stmt = $pdo->prepare("SELECT id FROM favorites WHERE user_id = ? AND product_type = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_type, $product_id]);
    return (bool) $stmt->fetch();
}