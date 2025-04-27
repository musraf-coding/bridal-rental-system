<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolgs</title>
    <style>
        /* styles.css */

/* Blog List Page */
.blog-post {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
}

.blog-post h2 {
    color: #333;
    font-size: 24px;
}

.blog-post p {
    color: #666;
    font-size: 16px;
}

.read-more {
    display: inline-block;
    margin-top: 10px;
    font-size: 16px;
    color: #007bff;
    text-decoration: none;
}

.read-more:hover {
    text-decoration: underline;
}

/* Blog Details Page */
.blog-details {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
}

.blog-details h1 {
    font-size: 26px;
    text-align: center;
    color: #333;
}

.blog-image {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
    margin-left: 10%;
}

.blog-content {
    text-align: justify;
    margin-top: 20px;
    font-size: 18px;
    color: #444;
}

.blog-details p {
    line-height: 1.6;
}

    </style>
</head>
<body>
<?php  include_once"head.php"; ?>
<!-- blog_details.php -->
<?php
include 'db.php'; // Include your database connection

// Get the blog ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the specific blog details from the database
    $sql = "SELECT * FROM blogs WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo '<div class="blog-details">';
        echo '<h1>' . $row['title'] . '</h1>';
        echo '<img src="' . $row['image'] . '" alt="Blog Image" class="blog-image">';
        echo '<p><strong>Published on: </strong>' . $row['date'] . '</p>';
        echo '<div class="blog-content">';
        echo '<p style="color:#333;">' . nl2br($row['content']) . '</p>'; // Display the full content with line breaks
        echo '</div>';
        echo '</div>';
    } else {
        echo "Blog not found.";
    }
} else {
    echo "No blog selected.";
}
?>
 
</body>
</html>