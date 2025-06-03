<?php
// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'projectmanagement');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Handle filters
$projectFilter = isset($_GET['project']) ? $_GET['project'] : '';
$dateFilter = isset($_GET['date']) ? $_GET['date'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

// SQL query to fetch projects with filters
$sql = "SELECT * FROM project WHERE 1=1";

if ($projectFilter) {
    $sql .= " AND projectname LIKE '%" . $mysqli->real_escape_string($projectFilter) . "%'";
}

if ($dateFilter) {
    $sql .= " AND DATE(startdate) = '" . $mysqli->real_escape_string($dateFilter) . "'";
}

if ($statusFilter) {
    $sql .= " AND status = '" . $mysqli->real_escape_string($statusFilter) . "'";
}

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dashboard</title>
    <style>
       /* Reset some default styles */
body, h2, table {
    margin: 0;
    padding: 0;
}

/* Basic styling for the dashboard container */
.dashboard-container {
    font-family: Arial, sans-serif;
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

/* Header styling */
h2 {
    text-align: center;
    color: #333;
}

/* Filter form styling */
#filterForm {
    margin-bottom: 20px;
    text-align: center;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.filters input[type="text"],
.filters input[type="date"],
.filters select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.filters button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.filters button:hover {
    background-color: #0056b3;
}

/* Table styling */
.feedback-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.feedback-table th,
.feedback-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.feedback-table th {
    background-color: #f4f4f4;
    color: #333;
}

.feedback-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.feedback-table tr:hover {
    background-color: #f1f1f1;
}

/* Responsive table styling */
@media (max-width: 768px) {
    .feedback-table thead {
        display: none;
    }

    .feedback-table, .feedback-table tbody, .feedback-table tr, .feedback-table td {
        display: block;
        width: 100%;
    }

    .feedback-table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    .feedback-table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 10px;
        font-weight: bold;
        text-align: left;
    }
}
a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #28a745; /* Green background */
    color: white; /* White text */
    text-align: center;
    text-decoration: none; /* Remove underline */
    border-radius: 4px; /* Rounded corners */
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
}

a:hover {
    background-color: #218838; /* Darker green on hover */
    transform: scale(1.05); /* Slight zoom effect */
}

a:active {
    background-color: #1e7e34; /* Even darker green on click */
    transform: scale(1); /* Reset zoom effect */
}
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Project Dashboard</h2>
        <a href="projectassign.php">ASSIGN TASK</a>
        <!-- Filter Form -->
        <form id="filterForm" method="GET" action="">
            <div class="filters">
                <input type="text" name="project" id="projectFilter" placeholder="Filter by Project" value="<?= htmlspecialchars($projectFilter) ?>">
                <input type="date" name="date" id="dateFilter" value="<?= htmlspecialchars($dateFilter) ?>">
                <select name="status" id="statusFilter">
                    <option value="">Filter by Status</option>
                    <option value="Not Started" <?= $statusFilter == 'Not Started' ? 'selected' : '' ?>>Not Started</option>
                    <option value="Pending" <?= $statusFilter == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Completed" <?= $statusFilter == 'Completed' ? 'selected' : '' ?>>Completed</option>
                </select>
                <button type="submit">Apply Filters</button>
            </div>
        </form>

        <!-- Feedback Table -->
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Project Detail</th>
                    <th>Team Member</th>
                    <th>Deadline</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="feedbackTableBody">
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['projectid']) ?></td>
                    <td><?= htmlspecialchars($row['projectname']) ?></td>
                    <td><?= htmlspecialchars($row['projectdetail']) ?></td>
                    <td><?= htmlspecialchars($row['teammember']) ?></td>
                    <td><?= date('F j, Y', strtotime($row['deadline'])) ?></td>
                    <td><?= date('F j, Y', strtotime($row['startdate'])) ?></td>
                    <td><?= date('F j, Y', strtotime($row['enddate'])) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <form method="POST" action="update_status.php" class="status-form">
                            <input type="hidden" name="projectid" value="<?= $row['projectid'] ?>">
                        
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
