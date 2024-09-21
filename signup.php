<?php
$servername = "your-rds-endpoint"; // Replace with your RDS endpoint
$username = "admin"; // Your DB username
$password = "yourpassword"; // Your DB password
$dbname = "userdb"; // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $email);

// Set parameters and execute
$username = $_POST['username'];
$email = $_POST['email'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt->execute();

echo "New record created successfully. <a href='login.html'>Log in now.</a>";
$stmt->close();
$conn->close();
?>
