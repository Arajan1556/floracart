<?php
// Database connection
$host = 'localhost';
$db = 'flora_earth';
$user = 'root';
$pass = '';  // Your MySQL root password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Password validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO users (name, username, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $name, $username, $email, $phone, $address, $hashed_password);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect to sign-in page or login user
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
