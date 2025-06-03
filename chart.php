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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Add your existing styles here */
        /* Reset some default styles */
        body, h1, h2, ul, li, a {
            margin: 0;
            padding: 0;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
        }

        /* Body and container styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .container {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            margin-left: 250px; /* Ensure this matches the width of the side-menu */
            width: calc(100% - 250px); /* Ensures container width adjusts correctly */
        }

        /* Side menu styling */
        .side-menu {
            position: fixed;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            left: 0; /* Fixes the side menu to the left */
            top: 0; /* Ensures the side menu starts from the top */
            bottom: 0; /* Ensures the side menu spans the full height */
            z-index: 1000; /* Ensures it stays on top of other elements */
        }

        .brand-name {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand-name h1 {
            font-size: 24px;
            letter-spacing: 2px;
        }

        .side-menu ul {
            padding-left: 0;
        }

        .side-menu ul li {
            padding: 15px 20px;
            font-size: 16px;
            color: white;
            border-bottom: 1px solid #495057;
            transition: background 0.3s, padding-left 0.3s;
        }

        .side-menu ul li:hover {
            background-color: #495057;
        }

        .side-menu ul li i {
            margin-right: 10px;
        }

        .side-menu ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #20b2aa;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
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

    <div class="side-menu">
        <div class="brand-name">
            <h1>ADMIN</h1>
        </div>
        <ul>
            <li><a href="#" id="load-dashboard"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
            <li><a href="#" id="load-project-manager-profiles"><i class="fa fa-user"></i>&nbsp;Project Manager Profiles</a></li>
            <li><a href="#" id="load-team-profiles"><i class="fa fa-users"></i>&nbsp;Team Member Profiles</a></li>
            <li><a href="#" id="load-assign-projects"><i class="fa fa-bullhorn"></i>&nbsp;Assign Projects</a></li>
            <li><a href="chart.php"><i class="fa fa-bullhorn"></i>&nbsp;Project Progress</a></li>
        </ul>
    </div>

    <div class="container" id="content">
        <h1>Welcome to the Admin Panel</h1>
        <p>Select an option from the sidebar to view content.</p>
        <div class="chart-container">
        <canvas id="progressChart"></canvas>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('load-dashboard').addEventListener('click', function(event) {
                event.preventDefault();
                loadContent('membertable.php');
                setActiveLink(this);
            });

            document.getElementById('load-project-manager-profiles').addEventListener('click', function(event) {
                event.preventDefault();
                loadContent('projectmamagerprofiles.php');
                setActiveLink(this);
            });

            document.getElementById('load-team-profiles').addEventListener('click', function(event) {
                event.preventDefault();
                loadContent('teammemberprofiles.php');
                setActiveLink(this);
            });

            document.getElementById('load-assign-projects').addEventListener('click', function(event) {
                event.preventDefault();
                loadContent('projectassign.php');
                setActiveLink(this);
            });

            document.getElementById('load-project-progress').addEventListener('click', function(event) {
                event.preventDefault();
                loadContent('testchart.php');
                setActiveLink(this);
            });

            function loadContent(url) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', url, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log('Loaded content from', url);
                        document.getElementById('content').innerHTML = xhr.responseText;
                    } else {
                        console.error('Failed to load content from', url);
                    }
                };
                xhr.onerror = function() {
                    console.error('An error occurred during the AJAX request');
                };
                xhr.send();
            }

            function setActiveLink(link) {
                var links = document.querySelectorAll('.side-menu ul li a');
                links.forEach(function(l) {
                    l.style.backgroundColor = '';
                });
                link.style.backgroundColor = '#495057';
            }
        });
    </script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Prepare data for Chart.js
            const data = {
    labels: <?php echo json_encode($projectNames); ?>,
    datasets: [
        {
            label: 'Not Started',
            data: <?php echo json_encode($statusNotStarted); ?>,
            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange color
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        },
        {
            label: 'In Progress',
            data: <?php echo json_encode($statusInProgress); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Teal color
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'Completed',
            data: <?php echo json_encode($statusCompleted); ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.2)', // Purple color
            borderColor: 'rgba(153, 102, 255, 1)',
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
