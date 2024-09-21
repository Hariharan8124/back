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

// Prepare and execute
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$username = $_POST['username'];
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);
$stmt->fetch();

// Verify password
if (password_verify($_POST['password'], $hashed_password)) {
    header("Location: index.html"); // Redirect to home page on success
    exit();
} else {
    echo "Invalid username or password. <a href='login.html'>Try again.</a>";
}

$stmt->close();
$conn->close();
?>
