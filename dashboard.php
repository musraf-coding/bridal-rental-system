<?php
session_start();
include 'db.php'; // Database connection

// Check if user is logged in


$loggedInUserId = $_SESSION['user_id'];

// Fetch total counts for logged-in user
$totalOrders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$totalCustomers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(DISTINCT buyer_id) as total FROM orders"))['total'];
$totalProducts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products "))['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
        <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Dashboard Counts -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Orders <i class="fas fa-shopping-cart"></i></h5>
                    <p class="card-text"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Customers <i class="fas fa-users"></i></h5>
                    <p class="card-text"><?php echo $totalCustomers; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Products <i class="fas fa-box"></i></h5>
                    <p class="card-text"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Menu -->
    <div class="btn-group d-flex justify-content-center mb-3">
        <button class="btn btn-primary toggle-btn" data-target="addProduct">Add Product</button>
        <button class="btn btn-secondary toggle-btn" data-target="manageProducts">Manage Products</button>
        <button class="btn btn-secondary toggle-btn" data-target="manageOrders">Manage Orders</button>
    </div>

    <!-- Add Product (Default) -->
    <div id="addProduct" class="toggle-section">
        <h4>Add Product</h4>
        <a href="add_products.php" class="btn btn-success mb-2">Go to Add Product Page</a>
    </div>

    <!-- Manage Products -->
    <div id="manageProducts" class="toggle-section hidden">
        <h4>Manage Products</h4>
        <table class="table table-bordered">
            <tr>
                <th>ID</th><th>Image</th><th>Name</th><th>Price</th><th>Action</th>
            </tr>
            <?php
            $products = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($products)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><img src='uploads/{$row['image']}' width='50' height='50' alt='Product Image'></td>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>
                            <a href='edit_product.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_product.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>

    <!-- Manage Orders -->
    <div id="manageOrders" class="toggle-section hidden">
        <h4>Manage Orders</h4>
        <table class="table table-bordered">
            <tr>
                <th>Order ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Rental Days</th>
                <th>Delivery Address</th>
                <th>Mobile</th>
                <th>Total Amount (INR)</th>
                <th>Order Date</th>
                <th>Return Date</th>
            </tr>
            <?php
            $sql = "SELECT o.id, p.name AS product_name, p.image, o.days, o.address, 
                            o.mobile, o.total_price, o.order_date, o.return_date
                    FROM orders o 
                    JOIN products p ON o.product_id = p.id 
                    ORDER BY o.order_date DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><img src='uploads/" . $row['image'] . "' width='80' height='80'></td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['days'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>INR " . $row['total_price'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No orders found.</td></tr>";
            }
            ?>
        </table>
    </div>

</div>

<script>
$(document).ready(function(){
    $(".toggle-btn").click(function(){
        var target = $(this).data("target");

        // Hide all sections
        $(".toggle-section").addClass("hidden");

        // Show the selected section
        $("#" + target).removeClass("hidden");

        // Change button colors
        $(".toggle-btn").removeClass("btn-primary").addClass("btn-secondary");
        $(this).removeClass("btn-secondary").addClass("btn-primary");
    });
});
</script>

</body>
</html>
