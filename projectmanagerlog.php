<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: blue; 
            
            font-family: Arial, sans-serif;
            padding: 50px 20px ;
            margin: 150px 0px 0px 600px ;
            
        }

        .box{
            padding: 20px ;
            background-color: #ffffff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            width: 410px;
            max-width: 100%;
            box-sizing: border-box;
        
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-group label {
            position: absolute;
            top: 12px;
            left: 15px;
            font-size: 14px;
            color: #888;
            pointer-events: none;
            transition: 0.3s;
        }

        .form-group input:focus ~ label,
        .form-group input:valid ~ label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .registerbutton {
            margin-top: 10px;
            text-align: center;
        }

        .registerbutton p {
            font-size: 14px;
            color: #333;
        }

        .registerbutton a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .registerbutton a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
   <div class="container">
    <div class= "row">
    <div class="box">
        <div class="col-lg-12">
        <form action="" method="post" autocomplete="off">
            <div class="form-group">
                <label>Email</label><br><br>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password</label><br><br>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" value="login" name="login">Login</button>
            <div class="registerbutton">
                <p>Don't have an account? <a href="projectmanagerRegister.php">Register</a></p>
                <p><a href="passwordrecovery.php">Forgot Password?</a></p>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
