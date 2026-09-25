<?php

// 1. Kết nối MySQL bằng PDO
$pdo = new PDO(
    "mysql:host=localhost;charset=utf8mb4",
    "root",
    ""
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// 2. Tạo database nếu chưa có
$pdo->exec("CREATE DATABASE IF NOT EXISTS php_kiemtra CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");


// 3. Kết nối vào database
$pdo = new PDO(
    "mysql:host=localhost;dbname=php_kiemtra;charset=utf8mb4",
    "root",
    ""
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// 4. Tạo bảng sản phẩm
$pdo->exec("
    CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price INT NOT NULL,
        quantity INT NOT NULL
    )
");


// 5. Tạo mảng kết hợp
$products = [
    ["name" => "Bàn phím cơ", "price" => 750000, "quantity" => 4],
    ["name" => "Chuột không dây", "price" => 350000, "quantity" => 6],
    ["name" => "USB 64GB", "price" => 180000, "quantity" => 10]
];


// 6. Xóa dữ liệu cũ
$pdo->exec("DELETE FROM products");


// 7. Thêm sản phẩm vào database
$stmt = $pdo->prepare("
    INSERT INTO products (name, price, quantity)
    VALUES (?, ?, ?)
");

foreach ($products as $product) {
    $stmt->execute([
        $product["name"],
        $product["price"],
        $product["quantity"]
    ]);
}


// 8. Hiển thị sản phẩm
foreach ($products as $product) {
    echo "Tên: " . $product["name"] . "<br>";
    echo "Giá: " . $product["price"] . " VNĐ<br>";
    echo "Số lượng: " . $product["quantity"] . "<br><br>";
}


// 9. Hàm tính tổng giá trị
function calculateTotal($products)
{
    $total = 0;

    foreach ($products as $product) {
        $total += $product["price"] * $product["quantity"];
    }

    return $total;
}


// 10. Hiển thị tổng
echo "Tổng giá trị: " . calculateTotal($products) . " VNĐ";

?>