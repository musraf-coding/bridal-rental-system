<?php
session_start();
include_once "db.php"; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = (int) $_POST['product_id'];
    $owner_id = (int) $_POST['owner_id'];
    $buyer_id = (int) $_POST['buyer_id'];
    $days = isset($_POST['days']) ? (int)$_POST['days'] : 1;
    $total_price = isset($_POST['total_price']) ? (float)$_POST['total_price'] : 0.0;
    $address = trim($_POST['address']);
    $mobile = trim($_POST['mobile']);

    // Generate unique order ID
    $order_id = uniqid('ORD_');

    // Calculate return date (today + $days)
    $return_date = date('Y-m-d', strtotime("+$days days"));

    $sql = "INSERT INTO orders (order_id, product_id, owner_id, buyer_id, days, total_price, address, mobile, return_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    // Corrected format string
    $stmt->bind_param("siiidssss", $order_id, $product_id, $owner_id, $buyer_id, $days, $total_price, $address, $mobile, $return_date);

    if ($stmt->execute()) {
        echo "<script>
        alert('Order placed successfully. Return date: $return_date');
        window.location.href = 'index.php'; 
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
