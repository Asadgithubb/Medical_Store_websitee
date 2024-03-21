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
        // Check if user already exists in the database
        $check_user_sql = "SELECT * FROM signup WHERE email='$email'";
        $check_user_result = $conn->query($check_user_sql);

        if ($check_user_result->num_rows > 0) {
            echo "<script>alert('User already exists with this email.');</script>";
        } else {
            // Insert new user into the database
            $insert_sql = "INSERT INTO signup (email, password) VALUES ('$email', '$password')";
            if ($conn->query($insert_sql) === TRUE) {
                // Registration successful, redirect to login page with alert
                echo "<script>alert('Registration successful! Please login.'); window.location.href='login.html';</script>";
            } else {
                echo "<script>alert('Error: " . $insert_sql . "<br>" . $conn->error . "');</script>";
            }
        }
    }
}

// Close connection
$conn->close();
?>
