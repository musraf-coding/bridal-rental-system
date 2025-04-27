
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Display</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

.blog-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.blogs {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}

.blog-post {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 48%;
    transition: transform 0.3s ease;
}

.blog-post:hover {
    transform: translateY(-10px);
}

.blog-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 3px solid #f1f1f1;
}

.blog-title {
    font-size: 1.8em;
    color: #333;
    padding: 20px;
}

.blog-date {
    font-size: 1em;
    color: #999;
    margin-bottom: 20px;
    padding-left: 20px;
}

.blog-content  {
    padding: 0 20px 20px 20px;
    font-size: 1.1em;
    line-height: 1.6;
    color: #555;
}
p{
    color: #333;
}
.read-more {
    display: inline-block;
    margin: 20px;
    padding: 10px 20px;
    background-color: #ff6b6b;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.read-more:hover {
    background-color: #ff4b4b;
}
.bcon{
    padding: 10px;
}

    </style>
</head>
<body>
<?php  include_once"head.php"; ?>
    <div class="blog-container">
        <div class="blogs">
            <!-- Blog posts will be displayed here -->
            <?php
                // Connect to your database
                include('db.php');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Fetch blogs
                $sql = "SELECT * FROM blogs ORDER BY date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="blog-post">';
                       
                        echo '<img src="' . $row['image'] . '" alt="Blog Image" class="blog-image">';
                        echo "<div class=bcon>";
                        echo '<h2>' . $row['title'] . '</h2>';
                        echo '<p style="color:#333;">' . substr($row['content'], 0, 200) . '...</p>'; 
                       echo "</div>";
                        echo '<a href="blog_details.php?id=' . $row['id'] . '" class="read-more">Read More</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No blogs available</p>";
                }

                $conn->close();
            ?>
        </div>
    </div>
   
</body>
</html>
