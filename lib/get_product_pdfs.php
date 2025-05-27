<?php
function get_product_pdfs($connect, $type, $id) {
    $stmt = $connect->prepare("SELECT * FROM product_files WHERE product_type = ? AND product_id = ?");
    $stmt->execute([$type, $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}