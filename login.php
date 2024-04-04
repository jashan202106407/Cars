<?php
session_start();


include 'dbinfo.php';


$con = mysqli_connect($host, $username, $password, $dbname);


if (!$con) {
    die("Connection failed!" . mysqli_connect_error());
}


$login_message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            
            $_SESSION['username'] = $username;
            header("Location: car-index.php");
            exit();;
        } else {
            
            $login_message = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url('image2.jpg'); 
        background-size: cover; 
        background-position: center; 
        font-family: Arial, sans-serif; 
    }
    .login-box {
        text-align: center;
        border: 2px solid #ccc;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); 
        border-radius: 10px; 
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
        max-width: 400px; 
        width: 80%; 
    }
    h2 {
        margin-top: 0; 
        color: #333;
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #666; 
        font-weight: bold; 
    }
    input[type="text"],
    input[type="password"] {
        width: 100%; 
        padding: 8px; 
        margin-bottom: 15px; 
        border: 1px solid #ccc; 
        border-radius: 5px; 
        box-sizing: border-box; 
    }
    input[type="submit"] {
        width: 100%; 
        padding: 10px; 
        border: none; 
        background-color: #007bff; 
        color: #fff; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: background-color 0.3s; 
    }
    input[type="submit"]:hover {
        background-color: #0056b3; 
    }
    .error-message {
        color: #ff0000;
        margin-top: 10px; 
    }
</style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <div class="error-message"><?php echo $login_message; ?></div>
</div>

</body>
</html>
