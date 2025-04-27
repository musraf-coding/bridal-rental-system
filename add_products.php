<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $pro_description = $_POST['pro_description'];
    $user_id = $_SESSION['user_id'];
    
    // Image upload handling
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    
    // Insert into database
    $sql = "INSERT INTO products (user_id, name, brand, description, price, image, category, pro_description) 
            VALUES ('$user_id', '$name', '$brand', '$description', '$price', '$image', '$category', '$pro_description')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<p class='success'>Product added successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>

        .container {
            width: 50%;
            margin: 2% auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
          
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            background: #fff;
            color: black;
            padding: 10px;
            border: none;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>


    <div class="container">
        <h2>Add Product</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Brand:</label>
            <input type="text" name="brand" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Price:</label>
            <input type="number" name="price" required>
            <label>Category:</label>
            <input type="text" name="category" required>
            <label>Product Description:</label>
            <textarea name="pro_description" required></textarea>
            <label>Image:</label>
            <input type="file" name="image" required>
            <button type="submit">Add Product</button>
        </form>
    </div>
    

    </footer>
</body>
</html>
