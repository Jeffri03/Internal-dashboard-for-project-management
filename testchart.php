<?php
// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'projectmanagement');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Fetch project progress and status counts
$taskSql = "SELECT 
                projectname,
                SUM(CASE WHEN status = 'Not Started' THEN 1 ELSE 0 END) AS statusNotStarted,
                SUM(CASE WHEN status = 'In Progress' THEN 1 ELSE 0 END) AS statusInProgress,
                SUM(CASE WHEN status = 'Completed' THEN 1 ELSE 0 END) AS statusCompleted
            FROM project
            GROUP BY projectid";
$taskResult = $mysqli->query($taskSql);

$projectNames = [];
$statusNotStarted = [];
$statusInProgress = [];
$statusCompleted = [];

while ($taskRow = $taskResult->fetch_assoc()) {
    $projectNames[] = $taskRow['projectname'];
    $statusNotStarted[] = $taskRow['statusNotStarted'];
    $statusInProgress[] = $taskRow['statusInProgress'];
    $statusCompleted[] = $taskRow['statusCompleted'];
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Progress Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="progressChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare data for Chart.js
            const data = {
                labels: <?php echo json_encode($projectNames); ?>,
                datasets: [
                    {
                        label: 'Not Started',
                        data: <?php echo json_encode($statusNotStarted); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'In Progress',
                        data: <?php echo json_encode($statusInProgress); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Completed',
                        data: <?php echo json_encode($statusCompleted); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ]
            };

            // Configuring the chart
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true
                        }
                    }
                }
            };

            // Render the chart
            const progressChart = new Chart(
                document.getElementById('progressChart'),
                config
            );
        });
    </script>
</body>
</html>
