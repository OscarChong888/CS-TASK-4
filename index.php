<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Form</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #3E4E5A, #2C3E50); /* Elegant gradient */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #1C2833; /* Dark blue-gray for contrast */
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #F7DC6F; /* Warm gold */
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            text-align: left;
            margin-bottom: 5px;
            font-size: 14px;
            color: #ddd;
        }

        input[type="text"], 
        input[type="email"], 
        textarea, 
        select {
            background: #4A5668; /* Softer contrast for inputs */
            color: #fff;
            padding: 10px;
            border: 1px solid #6D7A8D; /* Subtle border */
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        input:focus, 
        textarea:focus, 
        select:focus {
            border-color: #F7DC6F;
            outline: none;
            background-color: #5C6979; /* Slightly lighter on focus */
        }

        button[type="submit"] {
            background-color: #F7DC6F; /* Warm gold for button */
            color: #333;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #E4C565;
        }

        .banner-message {
            background-color: #F7DC6F;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submit Your Review</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = ""; // Default password for XAMPP
            $dbname = "reviews_db";

            // Connect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Sanitize and collect form data
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $rating = $conn->real_escape_string($_POST['rating']);
            $review = $conn->real_escape_string($_POST['review']);

            // Insert data into the database
            $sql = "INSERT INTO reviews (name, email, rating, review) VALUES ('$name', '$email', '$rating', '$review')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='banner-message'>Thank you for your review!</div>";
            } else {
                echo "<div class='banner-message'>Error: " . $conn->error . "</div>";
            }

            $conn->close();
        }
        ?>

        <form action="index.php" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="rating">Rating:</label>
            <select id="rating" name="rating">
                <option value="5">★★★★★ - Excellent</option>
                <option value="4">★★★★☆ - Very Good</option>
                <option value="3">★★★☆☆ - Average</option>
                <option value="2">★★☆☆☆ - Poor</option>
                <option value="1">★☆☆☆☆ - Terrible</option>
            </select>

            <label for="review">Your Review:</label>
            <textarea id="review" name="review" rows="5" placeholder="Write your review here..." required></textarea>

            <button type="submit">Submit Review</button>
        </form>
    </div>
</body>
</html>
