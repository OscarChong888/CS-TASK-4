<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviews_db";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $review = $conn->real_escape_string($_POST['review']);
    $rating = (int)$_POST['rating'];

    // Insert the review into the database
    $sql = "INSERT INTO reviews (name, email, review, rating) VALUES ('$name', '$email', '$review', $rating)";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='text-align:center; padding:20px; font-family:Arial;'>
                <h1>Thank You for Your Review!</h1>
                <p>Your feedback has been recorded.</p>
                <a href='index.html' style='text-decoration:none; color:#007bff;'>Submit another review</a>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
