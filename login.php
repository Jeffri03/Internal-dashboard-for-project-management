<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling with background image */
        body {
            background-image: url('operations-manager-develops-sales-strategies-targets.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        /* Flexbox container for registration options */
        .flex-container {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .flex-item {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            padding: 20px;
            width: 250px;
            margin: 10px;
            animation: fadeIn 1s ease-in;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Button styling */
        button {
            width: 100%;
            height: 60px; /* Consistent height for all buttons */
            font-weight: 600;
            border-radius: 5px;
            font-size: 18px; /* Adjusted font size for better alignment */
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            margin: 10px 0; /* Ensuring margin for spacing */
        }

        /* Project Manager button styling */
        .projectmanagerbutton {
            background-color: #007bff;
            color: white;
            border: none;
            font-family: sans-serif;
        }

        .projectmanagerbutton:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Team Member button styling */
        .teammemberbutton {
            background-color: #ffc107;
            color: black;
            border: none;
            font-family: sans-serif;
        }

        .teammemberbutton:hover {
            background-color: #e0a800;
            transform: scale(1.05);
        }

        /* Admin button styling */
        .adminbutton {
            background-color: #28a745;
            color: white;
            border: none;
            font-family: sans-serif;
        }

        .adminbutton:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        /* Link styling */
        a {
            color: inherit;
            text-decoration: none;
            width: 100%;
            display: block;
        }

        /* Navigation bar styling */
        nav {
            background-color: #343a40;
            width: 100%;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        nav h2 {
            margin: 0;
            color: #fff;
        }
    </style>

<body>
    <nav>
        <h2>Internal Dashboard for Project Management</h2>
    </nav>
    <div class="flex-container">
        <div class="flex-item">
            <a href="ProjectmanagerRegister.php"><button class="projectmanagerbutton"><b>PROJECT MANAGER</b></button></a>
        </div>
        <div class="flex-item">
            <a href="taskmemberRegister.php"><button class="teammemberbutton"><b>TEAM MEMBER</b></button></a>
        </div>
        <div class="flex-item">
            <button class="adminbutton" onclick="window.location.href='adminlogin.php'"><b>ADMIN LOGIN</b></button>
        </div>
    </div>
</body>
</html>
