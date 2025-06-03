<?php
include("connect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle status update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $project_id = $_POST['project_id'];
    $new_status = $_POST['status'];

    $update_sql = "UPDATE project SET status='$new_status' WHERE projectid='$project_id' AND teammember = (SELECT name FROM taskmemberregister WHERE id = '$user_id')";
    if ($mysqli->query($update_sql) === TRUE) {
        echo "<script>alert('Status updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating status: " . $mysqli->error . "');</script>";
    }
}

// Query to get the projects assigned to the logged-in user
$sql = "SELECT * FROM project WHERE teammember = (SELECT name FROM taskmemberregister WHERE id = '$user_id')";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Member Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .logout-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .logout-button a {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button a:hover {
            background-color: #0056b3;
        }
        .status-update-form select {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .status-update-form button {
            padding: 5px 10px;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .status-update-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assigned Projects</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Deadline</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['projectid']; ?></td>
                            <td><?php echo $row['projectname']; ?></td>
                            <td><?php echo $row['startdate']; ?></td>
                            <td><?php echo $row['enddate']; ?></td>
                            <td><?php echo $row['deadline']; ?></td>
                            <td><?php echo $row['projectdetail']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form action="" method="post" class="status-update-form">
                                    <input type="hidden" name="project_id" value="<?php echo $row['projectid']; ?>">
                                    <select name="status" required>
                                        <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="In Progress" <?php echo ($row['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="Completed" <?php echo ($row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                    <button type="submit" name="update_status">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No projects have been assigned to you yet.</p>
        <?php endif; ?>

        <div class="logout-button">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$mysqli->close();
?>
