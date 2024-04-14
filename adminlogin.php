<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form id="login-form" method="post" action="login.php">
            <p><b>Email :</b></p> <input type="text" placeholder="Email" name="Email" required>
            <p><b>Password :</b></p><input type="password" placeholder="Password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p><b>Don't have an account?</b> <a href="signup.html"><b>Sign Up</b></a></p>
    </div>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "users");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input
    $user = mysqli_real_escape_string($conn, $_POST['Email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE Email='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        $db_pass = $row['Password']; // Retrieve password from database
        if ($pass === $db_pass) {
            // Password is correct, redirect to home page
            header('Location: index-admin.html');
            exit;
        } else {
            // Password is incorrect
            echo "Incorrect password.";
        }
    } else {
        // User does not exist
        echo "User does not exist.";
    }

    $conn->close();
}
?>

</body>
</html>