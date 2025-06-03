<?php
include("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $email = $mysqli->real_escape_string($email);

    // Query to check user credentials
    $sql = "SELECT * FROM taskmemberregister WHERE email='$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if ($row['password'] == $password) {
            // Store user ID in session
            $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the column name for user ID in your table
            $_SESSION['email'] = $row['email'];

            // Redirect to dashboard
            echo "<script>alert('Login successful');</script>";
            echo "<script>window.location.href='memberdashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('Invalid email!');</script>";
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
            background: #a1c4fd; /* Light blue background */
            font-family: Arial, sans-serif;
            top:10%;
            padding:50px 20px 40px 30px;
            margin:40px;
            
        }
        .container {
            padding: 20px 30px 40px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            width: 400px;
            margin:100px 0px 0px 600px;
            right:120px;
            top:10%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .container .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        .container .form-group input {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }
        .container .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .container .form-group label {
            position: absolute;
            top: 1px;
            left: 15px;
            font-size: 14px;
            color: #888;
            pointer-events: none;
            transition: 0.3s;
        }
        .container .form-group input:focus ~ label,
        .container .form-group input:valid ~ label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
        }
        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .registerbutton {
            margin-top: 10px;
            text-align: center;
        }
        .registerbutton p {
            font-size: 14px;
            color: #333;
        }
        .registerbutton a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .registerbutton a:hover {
            text-decoration: underline;
        }
        h2 {
            color: #333;
            font-size: 24px;
        
            
        }    </style>
</head>
<body>
    <center><h1>Team Member Login</h1></center>
    
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <center>
                <button type="submit" name="login">Login</button>
                <div class="registerbutton">
                    <p>Don't have an account? <a href="taskmemberRegister.php">Register</a></p>
                    <p><a href="passwordrecovery.php">Forgot Password?</a></p>
                </div>
            </center>
        </form>
    </div>
</body>
</html>
