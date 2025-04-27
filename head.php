

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridal Rental</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">


</head>

<body>
<section id="header">
        <a href="#" class="logo"><img src="./asset/logo.webp" class="loga" alt="logo image"></a>

        <div>
            <ul id="navbar">
                <li><a  href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                
                
               
                <li><a href="about.php">Aboutus</a></li>
                <li><a href="contact.php">Feedback</a></li>
                
                <li id="lg-bag"><a href="cart.php"><i class='bx bx-shopping-bag'></i></a></li>
                
                <a href="#" id="close"><i class='bx bx-menu bx-x'></i></a>
                <?php  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <!-- Display when user is logged in -->
        <button class="normal"><a href="logout.php">Log Out</a></button>
        <span>Hey, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</span>
        
    <?php else: ?>
        <!-- Display when user is not logged in -->
        <button class="normal"><a href="login.php">Log In</a></button>
    <?php endif; ?>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class='bx bx-shopping-bag'></i></a>
            <i id="bar" class='bx bx-menu'></i>
        </div>
    </section>
</body>
</html>