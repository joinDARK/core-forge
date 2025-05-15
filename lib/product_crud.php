<?php
require '../../connect/connect.php';

$allowedCategories = [
    'processors' => 'cpus',      // Процессоры
    'videocards' => 'gpus',            // Видеокарты
    'motherboards' => 'motherboards',    // Материнские платы
    'rams' => 'rams',             // Оперативная память
    'psus' => 'psus',  // Блоки питания
    'cases' => 'cases',           // Корпуса
    'ssds' => 'ssds',            // SSD-диски
    'hdds' => 'hdds',            // HDD-диски
];

function getTableName(string $category): string
{
    global $allowedCategories;
    if (!isset($allowedCategories[$category])) {
        throw new Exception("Неверная категория товара: {$category}");
    }
    // Безопасно возвращаем имя таблицы из whitelist
    return $allowedCategories[$category];
}

function getAllProducts(string $category): array
{
    global $connect;
    $table = getTableName($category);
    $sql = "SELECT * FROM `{$table}`";
    return $connect->query($sql)->fetchAll();
}

function getProductById(string $category, int $id): ?array
{
    global $connect;
    $table = getTableName($category);
    $stmt = $connect->prepare("SELECT * FROM `{$table}` WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch();
    return $product ?: null;
}

function createProduct(string $category, array $data): int
{
    global $connect;
    $table = getTableName($category);
    $columns = array_keys($data);
    $fields = implode(', ', array_map(fn($col) => "`{$col}`", $columns));
    $places = implode(', ', array_map(fn($col) => ":{$col}", $columns));
    $sql = "INSERT INTO `{$table}` ({$fields}) VALUES ({$places})";
    $stmt = $connect->prepare($sql);
    if (!$stmt->execute($data)) {
        throw new Exception("Не удалось добавить продукт в {$table}");
    }
    return (int) $connect->lastInsertId();
}

function updateProduct(string $category, int $id, array $data): bool
{
    global $connect;
    $table = getTableName($category);
    $set = implode(', ', array_map(fn($col) => "`{$col}` = :{$col}", array_keys($data)));
    $sql = "UPDATE `{$table}` SET {$set} WHERE id = :id";
    $stmt = $connect->prepare($sql);
    $data['id'] = $id;
    if (!$stmt->execute($data)) {
        throw new Exception("Не удалось обновить продукт с ID {$id} в {$table}");
    }
    return true;
}

function deleteProduct(string $category, int $id): bool
{
    global $connect;
    $table = getTableName($category);
    $stmt = $connect->prepare("DELETE FROM `{$table}` WHERE id = :id");
    if (!$stmt->execute([':id' => $id])) {
        throw new Exception("Не удалось удалить продукт с ID {$id} из {$table}");
    }
    return true;
}