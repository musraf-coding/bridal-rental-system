<?php
session_start();
include_once "db.php"; // Include your DB connection file

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if user not logged in
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

// Fetch product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Product</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function updateTotal() {
            let price = <?php echo $product['price']; ?>;
            let days = document.getElementById("days").value;
            document.getElementById("total_amount").innerText = "INR " + (price * days);
            document.getElementById("total_price").value = price * days;
        }
    </script>
    
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

<?php
    include_once"head.php";
    ?>
<div class="container">
<h2>Order Details</h2>
<form action="order_process.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    <input type="hidden" name="owner_id" value="<?php echo $product['user_id']; ?>">
    <input type="hidden" name="buyer_id" value="<?php echo $user_id; ?>">
    
    <label>Product Name:</label>
    <input type="text" value="<?php echo $product['name']; ?>" readonly>

    <label>Price per day:</label>
    <input type="text" value="INR <?php echo $product['price']; ?>" readonly>

    <label>No. of days:</label>
    <input type="number" id="days" name="days" value="1" min="1" onchange="updateTotal()" required>

   <label>Return Date:</label>
    <input type="Date" name="return_date" id="return_date">

    <label>Delivery Address:</label>
    <textarea name="address" required></textarea>

    <label>Mobile Number:</label>
    <input type="text" name="mobile" required>

    <label>Total Amount:</label>
    <p   style="color:#333;" id="total_amount">INR <?php echo $product['price']; ?></p>
    <input type="hidden" id="total_price" name="total_price" value="<?php echo $product['price']; ?>">


    <button type="submit">Place Order</button>
</form>
</div>

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
    <script src="script.js"></script>
</body>
</html>
