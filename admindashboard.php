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
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centers content vertically */
            align-items: center; /* Centers content horizontally */
            height: 100vh; /* Ensures container takes full viewport height */
            box-sizing: border-box;
        }

        /* Side menu styling */
        .side-menu {
            position: fixed;
            width: 250px;
            height: 100%;
            background-color: #a05aff;
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
            <li><a href="chart.php"><i class="fa fa-bar-chart"></i>&nbsp;Project Progress</a></li>
            <li><a href="adminlogout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li> <!-- Added Logout option -->
        </ul>
    </div>

    <div class="container" id="content">
        <h1>Welcome to the Admin Panel</h1>
        <p>Select an option from the sidebar to view content.</p>
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
                loadContent('chart.php');
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
</body>
</html>
