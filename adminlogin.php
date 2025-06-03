<?php
// Pre-set admin credentials
$admin_username = "Jeffri";
$admin_password = "Jeffri123";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if($username === $admin_username && $password === $admin_password){
        // Start session
        session_start();
    
        // Set session variables
        $_SESSION['admin_logged_in'] = true;

        // Redirect to the admin dashboard or homepage
        header("Location: adminDashboard.php");
        exit();
    }
    else{
        echo "<p class='error-message'>Invalid Credentials, try again!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container styling */
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            border-radius: 10px;
            text-align: center;
            animation: fadeIn 1s ease-in;
        }

        /* Input styling */
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        /* Button styling */
        button {
            width: 100%;
            height: 40px;
            font-weight: 600;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Admin button styling */
        .adminbutton {
            background-color: #28a745;
            color: white;
            border: none;
            font-family: sans-serif;
            font-size: 18px;
        }

        .adminbutton:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Messages */
        .success-message, .error-message {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 16px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>Admin Login</h2>
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Admin Password" required>
            <button type="submit" name="login" class="adminbutton"><b>LOGIN</b></button>
        </form>
    </div>
</body>
</html>
