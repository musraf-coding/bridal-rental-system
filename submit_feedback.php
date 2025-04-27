<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bridal";  // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rating = $_POST['rating'];
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    $sql = "INSERT INTO feedback (name, email, rating, feedback) VALUES ('$name', '$email', '$rating', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for your feedback!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
