<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $email = $mysqli->real_escape_string($email);

    // Check if email exists in task member table
    $result_task = $mysqli->query("SELECT id FROM taskmemberregister WHERE email='$email'");
    
    // Check if email exists in project manager table
    $result_manager = $mysqli->query("SELECT id FROM projectmanagerregister WHERE email='$email'");
    
    // Determine the user type
    if ($result_task->num_rows > 0) {
        $user_type = 'task_member';
        $user_id = $result_task->fetch_assoc()['id'];
    } elseif ($result_manager->num_rows > 0) {
        $user_type = 'project_manager';
        $user_id = $result_manager->fetch_assoc()['id'];
    } else {
        echo "<script>alert('No account found with that email address.');</script>";
        exit;
    }

    // Generate a unique token
    $token = bin2hex(random_bytes(50));
    $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    // Insert reset request into the database
    $mysqli->query("INSERT INTO passwordresets (email, token, token_expiry, user_type) VALUES ('$email', '$token', '$token_expiry', '$user_type')");

    // Send email with reset link
    $reset_link = "http://localhost:8080/demo/Internal%20dashboard/resetpassword.php?token=" . $token;
    $subject = "Password Reset Request";
    $message = "Click the following link to reset your password: $reset_link";

    // PHPMailer setup
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'jeffridavid9@gmail.com'; // SMTP username
        $mail->Password = 'vnjt dbsn pbho slpw';      // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('jeffridavid9@gmail.com', 'Password Recovery');
        $mail->addAddress($email); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "<script>alert('Password reset link has been sent to your email.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
/* styles.css */

/* General Reset */
* {
    box-sizing: border-box;
}

body {
    background-color: #f7f9fc; /* Light Gray-Blue */
    font-family: 'Roboto', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center; 
    padding:100px 20px 200px ;
}

h1 {
    color: #2c3e50; 
    font-size: 28px;
    font-weight: 700;
    margin:10px 40px 200px;
}

.container {
    width: 100%;
    max-width: 420px;
    padding: 40px 40px  ;
    background-color: #ffffff; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin:2px 3px 10px 40px ;
    text-align: left;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-size: 15px;
    color: #34495e; 
    font-weight: 500;
}

.form-group input[type="email"] {
    width: 100%;
    padding: 12px 15px;
    font-size: 14px;
    border: 1px solid #d1d5db; /* Light Gray */
    border-radius: 6px;
    transition: border-color 0.3s ease;
}

.form-group input[type="email"]:focus {
    border-color: #3498db; /* Blue when focused */
    outline: none;
}

button {
    width: 100%;
    background-color: #3498db; 
    color: white;
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-weight: 600;
}

button:hover {
    background-color: #2980b9; /* Darker Blue */
    transform: translateY(-2px);
}

button:active {
    transform: translateY(0);
}

p {
    color: #7f8c8d; /* Medium Gray */
    font-size: 14px;
    margin-top: 25px;
    text-align: center;
    line-height: 1.6;
}
</style>
<body>
    <center><h1>Password Recovery</h1>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <center>
                <button type="submit" name="submit">Submit</button>
            </center>
        </form>
    </div>
</body>
</html>
