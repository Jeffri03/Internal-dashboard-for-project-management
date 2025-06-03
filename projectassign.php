<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'vendor/autoload.php';

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'projectmanagement');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Fetch team members for the dropdown
$taskmemberregisterQuery = "SELECT name, email FROM taskmemberregister";
$taskmemberregisterResult = $mysqli->query($taskmemberregisterQuery);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $projectid = $_POST['projectid'];
    $projectname = $_POST['projectname'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $deadline = $_POST['deadline'];
    $teammember = $_POST['teammember'];
    $projectdetail = isset($_POST['projectdetail']) ? $mysqli->real_escape_string($_POST['projectdetail']) : '';

    // Insert project assignment into database
    $sql = "INSERT INTO project (projectid, projectname, startdate, enddate, deadline, teammember, projectdetail)
            VALUES ('$projectid', '$projectname', '$startdate', '$enddate', '$deadline', '$teammember', '$projectdetail')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Project assigned successfully!";
        
        // Fetch the email of the selected team member
        $emailQuery = "SELECT email FROM taskmemberregister WHERE name = '$teammember'";
        $emailResult = $mysqli->query($emailQuery);

        if ($emailResult->num_rows > 0) {
            $emailRow = $emailResult->fetch_assoc();
            $to = $emailRow['email'];
            $subject = "New Project Assigned: $projectname";
            $message = "Hello $teammember,\n\nYou have been assigned a new project:\n\n";
            $message .= "Project ID: $projectid\n";
            $message .= "Project Name: $projectname\n";
            $message .= "Start Date: $startdate\n";
            $message .= "End Date: $enddate\n";
            $message .= "Deadline: $deadline\n";
            $message .= "Details: $projectdetail\n\n";
            $message .= "Please log in to your dashboard for more details.\n\nBest Regards,\nProject Management Team";

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jeffridavid9@gmail.com';
                $mail->Password = 'vnjt dbsn pbho slpw';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('your-email@gmail.com', 'Project Management');
                $mail->addAddress($to);

                // Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo ' Email notification sent to ' . $teammember;
            } catch (Exception $e) {
                echo " Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo " Failed to retrieve email for $teammember.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Close the connection after all operations
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
            height: 100px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assign Project to Team Member</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="projectid">Project ID:</label>
                <input type="text" id="projectid" name="projectid" placeholder="Enter project ID" required>
            </div>
            <div class="form-group">
                <label for="projectname">Project Name:</label>
                <input type="text" id="projectname" name="projectname" placeholder="Enter project name" required>
            </div>
            <div class="form-group">
                <label for="startdate">Start Date:</label>
                <input type="date" id="startdate" name="startdate" placeholder="Enter start date" required>
            </div>
            <div class="form-group">
                <label for="enddate">End Date:</label>
                <input type="date" id="enddate" name="enddate" placeholder="Enter end date" required>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" placeholder="Enter deadline" required>
            </div>
            <div class="form-group">
                <label for="teammember">Team Member:</label>
                <select id="teammember" name="teammember" required>
                    <option value="">Select a team member</option>
                    <?php
                    if ($taskmemberregisterResult->num_rows > 0) {
                        while ($row = $taskmemberregisterResult->fetch_assoc()) {
                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No team members available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="projectdetail">Project Details:</label>
                <textarea id="projectdetail" name="projectdetail" placeholder="Enter project details" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Assign Project</button>
            </div>
        </form>
    </div>
</body>
</html>
