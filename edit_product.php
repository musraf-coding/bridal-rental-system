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
    $result = mysqli_query($conn, "SELECT * FROM products");
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Unauthorized access!";
        exit();
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . $_FILES['image']['name'];
        $imagePath = "uploads/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

        // Delete the old image
        if (!empty($product['image']) && file_exists("uploads/" . $product['image'])) {
            unlink("uploads/" . $product['image']);
        }

        $updateQuery = "UPDATE products SET name='$name', price='$price', description='$description', image='$imageName' WHERE id='$id'";
    } else {
        $updateQuery = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id='$id'";
    }

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Price:</label>
                <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control"><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Current Image:</label><br>
                <?php if (!empty($product['image'])) { ?>
                    <img src="uploads/<?php echo $product['image']; ?>" width="100" alt="Product Image">
                <?php } ?>
            </div>
            <div class="mb-3">
                <label>Upload New Image:</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
