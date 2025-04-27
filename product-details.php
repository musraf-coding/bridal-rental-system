<?php

session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-commerce</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
<?php
    include_once"head.php";
    ?>


    <section id="prodetails" class="section-p1">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bridal";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get product ID from URL parameter
        $product_id = $_GET['id'];

        // SQL query to fetch product details
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            $row = $result->fetch_assoc();
        ?>
            <div class="single-pro-image">

                <img src="uploads/<?php echo $row['image']; ?>" width="100%" id="MainImg" alt="">
               
            </div>

            <div class="single-pro-details">
                <h6><?php echo $row['category']; ?></h6>
                <h4><?php echo $row['name']; ?></h4>
                <h2>INR <?php echo $row['price']; ?></h2>
                
                
                <h4>Product Details</h4>
                <span><?php echo $row['pro_description']; ?></span><br><br>

                <button class="normal" onclick="window.location.href='order.php?id=<?php echo $row['id']; ?>'">Rent</button>

            </div>
        <?php
        } else {
            echo "Product not found.";
        }
        $conn->close();
        ?>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured products</h2>
        
        <div class="pro-container">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bridal";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch only four random products
            $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 4";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pro'>";
                    echo "<a href='product-details.php?id=" . $row['id'] . "'>";
                    echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                   
                    echo "</a>";
                    echo "<div class='des'>";
                    echo "<span>" . $row['brand'] . "</span>";
                    echo "<h5>" . $row['name'] . "</h5>";
                    // Add other product details as needed
                    echo "<h4>INR " . $row['price'] . "</h4>";
                    echo "</div>";
                    echo "<a href='product-details.php?id=" . $row['id'] . "'><i class='bx bx-cart cart'></i></a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </section>



    <!-- Include other sections and footer -->

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
            <p> @copyright  , Developed by  Tanusika-  Bridal Rental System</p>
        </div>

    </footer>

    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");

        // Add event listeners for small images if needed
        for (var i = 0; i < smallimg.length; i++) {
            smallimg[i].onclick = function() {
                MainImg.src = this.src;
            }
        }
    </script>

    <script src="script.js"></script>
</body>

</html>