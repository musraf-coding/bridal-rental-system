<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        #filter-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 15px;
    background: #f8f8f8;
    border-radius: 8px;
    margin: 20px auto;
    width: 90%;
    flex-wrap: wrap;
}

#filter-bar input[type="text"],
#filter-bar select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 200px;
}

#filter-bar button {
    background: #d63384;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s ease;
}

#filter-bar button:hover {
    background: #c2185b;
}

@media (max-width: 768px) {
    #filter-bar {
        flex-direction: column;
        align-items: stretch;
    }

    #filter-bar input[type="text"],
    #filter-bar select,
    #filter-bar button {
        width: 100%;
    }
}

    </style>
</head>

<body>

<?php
include_once "head.php";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bridal";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch brands
$brand_query = "SELECT DISTINCT brand FROM products";
$brand_result = $conn->query($brand_query);

// Fetch categories
$category_query = "SELECT DISTINCT category FROM products";
$category_result = $conn->query($category_query);

?>

<section id="page-header">
    <h2>#Effortless Bridal Glam</h2>
    <p> Rent stunning bridal outfits hassle-free!</p>
</section>

<!-- Search and Filter Section -->
<section id="filter-bar" class="section-p1">
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search products..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">

        <select name="brand">
            <option value="">All Brands</option>
            <?php while ($brand_row = $brand_result->fetch_assoc()): ?>
                <option value="<?= $brand_row['brand']; ?>" <?= isset($_GET['brand']) && $_GET['brand'] == $brand_row['brand'] ? 'selected' : '' ?>><?= $brand_row['brand']; ?></option>
            <?php endwhile; ?>
        </select>

        <select name="category">
            <option value="">All Categories</option>
            <?php while ($category_row = $category_result->fetch_assoc()): ?>
                <option value="<?= $category_row['category']; ?>" <?= isset($_GET['category']) && $_GET['category'] == $category_row['category'] ? 'selected' : '' ?>><?= $category_row['category']; ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Filter</button>
    </form>
</section>

<!-- Product Display -->
<section id="product1" class="section-p1">
    <div class="pro-container">
        <?php
        $where_conditions = [];

        if (!empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $where_conditions[] = "(name LIKE '%$search%' OR brand LIKE '%$search%' OR category LIKE '%$search%')";
        }

        if (!empty($_GET['brand'])) {
            $brand = $conn->real_escape_string($_GET['brand']);
            $where_conditions[] = "brand = '$brand'";
        }

        if (!empty($_GET['category'])) {
            $category = $conn->real_escape_string($_GET['category']);
            $where_conditions[] = "category = '$category'";
        }

        $where_sql = count($where_conditions) > 0 ? "WHERE " . implode(" AND ", $where_conditions) : "";
        $sql = "SELECT * FROM products $where_sql";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='pro'>";
                echo "<a href='product-details.php?id=" . $row['id'] . "'>";
                echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "</a>";
                echo "<div class='des'>";
                echo "<span>" . $row['brand'] . "</span>";
                echo "<h5>" . $row['name'] . "</h5>";
                echo "<h4>INR " . $row['price'] . "</h4>";
                echo "</div>";
                echo "<a href='product-details.php?id=" . $row['id'] . "'><i class='bx bx-cart cart'></i></a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }

        $conn->close();
        ?>
    </div>
</section>

<script src="script.js"></script>
</body>
</html>
