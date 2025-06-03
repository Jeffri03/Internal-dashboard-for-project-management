<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Validate token and check if it has expired
    $result = $mysqli->query("SELECT * FROM passwordresets WHERE token='$token'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (new DateTime() < new DateTime($row['token_expiry'])) {
            $email = $row['email'];
            $user_type = $row['user_type'];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            if ($user_type == 'task_member') {
                $mysqli->query("UPDATE taskmemberregister SET password='$hashed_password' WHERE email='$email'");
            } else if ($user_type == 'project_manager') {
                $mysqli->query("UPDATE projectmanagerregister SET password='$hashed_password' WHERE email='$email'");
            }

            echo "<script>alert('Password has been reset successfully.');</script>";
            $mysqli->query("DELETE FROM passwordresets WHERE token='$token'"); // Optional: remove the reset token after successful reset
        } else {
            echo "<script>alert('Token has expired. Please request a new password reset.');</script>";
        }
    } else {
        echo "<script>alert('Invalid token.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have styles.css -->
</head>
<body>
    <center><h1>Reset Password</h1></center>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label>New Password</label><br>
                <input type="password" name="password" placeholder="Enter your new password" required>
            </div>
            <center>
                <button type="submit" name="reset">Reset Password</button>
            </center>
        </form>
    </div>
</body>
</html>
