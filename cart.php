<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bridal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_ id'])) {
    echo "<script>alert('Please log in first!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders for logged-in user
$sql = "SELECT o.id, p.name AS product_name, p.image,o.* 
        FROM orders o 
        JOIN products p ON o.product_id = p.id 
        WHERE o.buyer_id = ? ORDER BY o.order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
<?php
    include_once"head.php";
    ?>

    <section id="page-header" class="contact-header">

        <h2>#let's_buy</h2>
        <p>A budget tells us what we can't afford, but it doesn't keep us from buying it</p>

    </section>
<section id="cart" class="section-p1">
        
        <table  width="100%">
            <tr>
                <th>Order ID</th>
                <th>Priduct Image</th>
                <th>Product Name</th>
                <th>Rental Days</th>
                
                <th>Delivery Address</th>
                <th>Mobile</th>
                <th>Total Amount (INR)</th>
                <th>Order Date</th>
<th>Return Date</th>
            </tr>
            <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><img src='uploads/" . $row['image'] . "' width='100'></td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['days'] . "</td>";
               
                echo "<td>" . $row['address'] . "</td>";
                echo "<td> " . $row['mobile'] . "</td>";
                echo "<td>INR " . $row['total_price'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
 echo "       <td>" . $row['return_date'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No orders found.</td></tr>";
        }
        $conn->close();
        ?>
        </table>
    
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

    <script src="script.js"></script>
</body>
</html>


