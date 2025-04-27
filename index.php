<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>

<body>

    <?php
    include_once"head.php";
    ?>
    <section id="hero">
        <h4>Bridal Product Rentals</h4>
        <h2>Exclusive Bridal Wear</h2>
    <!-- <h1>For Your Dream Function</h1> -->
    <p>Rent premium bridal products at amazing prices!</p>
    <button>Explore Our Collection</button>
    </section>
   
    

    <section id="product1" class="section-p1">
        <h2>Featured Model</h2>
        <p>Elegant bridal outfits for a timeless wedding look!</p>
        <div class="pro-container">

            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bridal";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch products from the database
            $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 10";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pro'>";
                    echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>";

                    echo "<div class='des'>";
                    echo "<span>" . $row['brand'] . "</span>";
                    echo "<h5>" . $row['name'] . "</h5>";
                    echo "<div class='star'>";
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo "<i class='bx bxs-star'></i>";
                    }
                    echo "</div>";
                    echo "<h4>INR " . $row['price'] . "</h4>";
                    echo "</div>";
                    

                    echo "<a  href='product-details.php?id=" . $row['id'] . "'><i class='bx bx-cart cart'></i></a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>

        </div>
    </section>
    <section id="banner" class="section-m1">
        <h4>Bridal Rental Services</h4>
        <h2> Exclusive <span>designer</span>   bridal wear for your special day!</h2>
        <button class="normal"> <a href="./shop.php">Explore More</a></button>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Model</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">

            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bridal";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch products from the database
            $sql = $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 5 ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pro'>";
                    echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>";

                    echo "<div class='des'>";
                    echo "<span>" . $row['brand'] . "</span>";
                    echo "<h5>" . $row['name'] . "</h5>";
                    echo "<div class='star'>";
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo "<i class='bx bxs-star'></i>";
                    }
                    echo "</div>";
                    echo "<h4>INR " . $row['price'] . "</h4>";
                    echo "</div>";
                    echo "<a  href='product-details.php?id=" . $row['id'] . "'><i class='bx bx-cart cart'></i></a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>

        </div>
    </section>

  
    <section id="banner3">
        <div class="banner-box  ">
            <h2>Bridal Collection on Rent</h2>
            <h3>Walk down the aisle in elegance and style!</h3>
        </div>
        <div class="banner-box  banner-box2 ">
            <h2>Bridal Wear for Rent</h2>
            <h3>Look breathtaking on your big day! </h3>
        </div>
        <div class="banner-box banner-box3 ">
            <h2>Graceful & Gorgeous</h2>
            <h3> Rent the perfect bridal attire today!  </h3>
        </div>

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            
            <h4>We Value Your <a href="./contact.php">Feedback!</a></h4>
           
        </div>

    </section>
    <footer class="section-p1">
        <div class="col col1">
        <img class="logo" src="./asset/logo.webp" alt="">            
            <h4>About us</h4>
<p>Our Bridal Rental System offers a stylish, affordable, and eco-friendly solution for modern brides. Rent high-quality bridal dresses, jewelry, and makeup with ease through our user-friendly platform. Enjoy a seamless experience from secure payments to timely delivery and hassle-free returns, making luxury bridal fashion accessible without compromising on quality or budget.</p>
           
           
        </div>

        <div class="col">
            <h4>About</h4>

            <a href="./index">Home</a>
            <a href="./shop.php">Shop</a>
            <a href="./about.php">About </a>
            <a href="./contact.php">Feedback</a>
           <a href="./cart.php">Cart</a>
            <a href="#"></a>
        </div>
        <div class="col">
        <div class="follow">
                <h4>Follow us</h4>
                <div class="icons">
                    <i class='bx bxl-facebook-circle'></i>
                    <i class='bx bxl-instagram'></i>
                    <i class='bx bxl-whatsapp'></i>
                </div>
            </div>
        </div>

     

      

        <div class="copyright">
            <p> @copyright  , Developed by  Thanushika-  Bridal Rental System</p>
        </div>

    </footer>
    <!-- Rest of your HTML content -->
     
    <script src="script.js"></script>
   
</body>

</html>