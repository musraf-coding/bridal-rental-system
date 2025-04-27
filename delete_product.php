<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$loggedInUserId = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if product belongs to logged-in user
    $checkQuery = "SELECT * FROM products WHERE id='$id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $deleteQuery = "DELETE FROM products WHERE id='$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            header("Location: dashboard.php");
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access!";
    }
}
?>
