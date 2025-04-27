<?php

session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> e-commerce</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

    <style>
        #feedback {
            width: 50%;
            margin: 2% auto;
    padding: 40px;
    background-color: #f7f7f7;
    text-align: center;
    border-radius: 8px;
}

#feedback h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    margin: 20px 0;
    text-align: left;
    font-size: 1.1rem;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-group textarea {
    width: 100%;
    resize: vertical;
}

.submit-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 1.2rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.fas {
    margin-right: 10px;
}

    </style>
</head>

<body>
<?php
    include_once"head.php";
    ?>
    <section id="feedback">
    <h2>We Value Your Feedback!</h2>
    <form action="submit_feedback.php" method="POST">
        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Your Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
        </div>

        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Your Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label for="rating"><i class="fas fa-star"></i> Rating:</label>
            <select id="rating" name="rating" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
        </div>

        <div class="form-group">
            <label for="feedback"><i class="fas fa-comment-dots"></i> Your Feedback:</label>
            <textarea id="feedback" name="feedback" required placeholder="Share your thoughts here..." rows="4"></textarea>
        </div>

        <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Submit Feedback</button>
    </form>
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