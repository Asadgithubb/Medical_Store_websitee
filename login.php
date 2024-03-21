<?php
// Database connection parameters
$servername = "localhost"; // Hostname or IP address of the MySQL server
$username = "root"; // MySQL username
$password = ""; // MySQL password (leave it empty if you don't have a password)
$dbname = "asad"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate form data (you can add more validation if needed)
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill out all fields.');</script>";
    } else {
        // Check if user exists in the database
        $sql = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User exists, redirect to webstore.html
            echo "<script>alert('Login successful! Redirecting to Webstore...');</script>";
            echo "<script>window.location.href = 'index.html'</script>";
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    }
}

// Close connection
$conn->close();
?>
