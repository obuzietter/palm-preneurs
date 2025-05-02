<?php
if (isset($_POST['submit'])) {
    
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'tuk_preneurs_db';

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password match in the database
    $loginQuery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($loginQuery);

    if ($result->num_rows > 0) {
        // Login successful
        echo "<script>alert('Login successful!')</script>";
        echo "<script>window.location.href='index.html'</script>";
    } else {
        // Login failed
        echo "<script>alert('Invalid email or password. Please try again.')</script>";
        echo "<script>window.location.href='login.html'</script>";
    }

    $conn->close();
}
?>
