<?php
function add_to_cart($pdo, $user_id, $product_type, $product_id, $quantity = 1)
{
    // Проверяем, есть ли уже такой товар у пользователя
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE user_id = ? AND product_type = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_type, $product_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Если есть — обновляем количество
        $stmt = $pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?");
        $stmt->execute([$quantity, $row['id']]);
    } else {
        // Если нет — добавляем новую запись
        $stmt = $pdo->prepare("INSERT INTO cart_items (user_id, product_type, product_id, quantity) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $product_type, $product_id, $quantity]);
    }
}
function remove_from_cart($pdo, $user_id, $product_type, $product_id)
{
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_type = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_type, $product_id]);
}
function clear_cart($pdo, $user_id)
{
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
}
function get_cart($pdo, $user_id)
{
    $stmt = $pdo->prepare("SELECT * FROM cart_items WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_product_info($pdo, $product_type, $product_id)
{
    $allowed_types = ['gpus', 'cpus', 'motherboards', 'rams', 'psus', 'cases', 'ssds', 'hdds'];
    if (!in_array($product_type, $allowed_types))
        return null;
    $stmt = $pdo->prepare("SELECT * FROM `$product_type` WHERE id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}