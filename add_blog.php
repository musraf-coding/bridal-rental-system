<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    
     

     .add-blog-form {
         max-width: 600px;
         margin: 20px auto;
         padding: 20px;
         background-color: #f4f4f4;
         border: 1px solid #ddd;
         border-radius: 5px;
     
     }
     
     .add-blog-form h2 {
         font-size: 28px;
         color: #333;
         text-align: center;
     }
     
     .add-blog-form label {
         font-size: 16px;
         color: #555;
     }
     
     .add-blog-form input[type="text"],
     .add-blog-form textarea {
         width: 100%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ddd;
         border-radius: 5px;
     }
     
     .add-blog-form textarea {
         resize: vertical;
     }
     
     .add-blog-form input[type="submit"] {
         background-color: #007bff;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
     }
     
     .add-blog-form input[type="submit"]:hover {
         background-color: #0056b3;
     }
     
         </style>
    
</head>
<body>
    <?php
include 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle file upload
    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_error = $_FILES['image']['error'];

        // Set upload directory
        $upload_dir = 'uploads/';  // Make sure this directory exists and is writable
        $file_path = $upload_dir . basename($file_name);

        // Check if the file was uploaded without errors
        if ($file_error === UPLOAD_ERR_OK) {
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file_tmp, $file_path)) {
                // File upload success
                // Insert data into the database

                // Escape special characters
$title = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);


$sql = "INSERT INTO blogs (title, content, image, date) 
        VALUES ('$title', '$content', '$file_path', NOW())";


                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('New blog added successfully!'); window.location.href='blog.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error uploading file!";
            }
        } else {
            echo "Error: " . $file_error;
        }
    } else {
        echo "Please upload an image!";
    }
}
?>
<?php  include_once"head.php"; ?>
<!-- Blog Add Form -->
<div class="add-blog-form">
    <h2>Add New Blog</h2>
    <form method="POST" action="add_blog.php" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Image:</label><br>
        <input type="file" name="image" required><br><br>

        <input type="submit" value="Add Blog">
    </form>
</div>

</body>
</html>