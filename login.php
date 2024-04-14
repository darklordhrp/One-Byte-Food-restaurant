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
        <p><b>Don't have an account?</b> <a href="signup.php"><b>Sign Up</b></a></p>
    </div>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "users");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $user = mysqli_real_escape_string($conn, $_POST['Email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM signup WHERE Email='$user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_pass = $row['Password']; 
        if ($pass === $db_pass) {
            header('Location: Mainpage.html');
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User does not exist.";
    }

    $conn->close();
}
?>

</body>
</html>