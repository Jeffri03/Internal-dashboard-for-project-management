 <?php
include("connect.php");
if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $password=$_POST['password'];
    $number=$_POST['number'];
    $email=$_POST['email'];



    $result=$mysqli->query("INSERT INTO projectmangerregister(name,password,number,email) VALUES('$name','$password','$number','$email')");
   if($result){
        echo "Register Successfully";
    }
    else{
      echo"something wrong tryagain!";
    }
}
?>         

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<style>
  body {
    background: skyblue; /* Light Blue */
    font-family: Arial, sans-serif;
}

.container {
    position: absolute;
    top: 20%;
    right: 40%;
    transform: translateX(-50%);
    padding: 20px;
    background-color:  #20b2aa; /* Light Sea Green */
    ; /* Mint Green */

    box-sizing: border-box;
    width: 500px;
    border-radius: 15px;
}

.container .form-group {
    position: relative;
}

.container .form-group input {
    width: 98%;
    padding: 10px;
    font-size: 14px;
    border: none;
    border-bottom: 1px solid #00796b; /* Darker Teal */
    outline: none;
    background: #ffffff; /* White Background for Inputs */
}

.container .form-group label {
    position: absolute;
    left: 0;
    padding: 10px 0;
    font-size: 17px;
    color: black; /* Darker Teal for Labels */
    margin: 26px;
    pointer-events: none;
    transition: .5s;
    transform: translateY(-50%);
}

button {
    width: 30%;
    height: 30px;
    font-weight: 400;
    border-radius: 80px;
    font-size: large;
    background-color: black; /* Soft Green */
    color: white; /* White Text */
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #388e3c; /* Darker Green on Hover */
}

.registerbutton, p {
    color: black; /* White Text */
    padding: 10px;
}

.registerbutton, a {
    padding: 10px;
    color: white; /* Light Coral */
}

a:hover {
    background-color: red; /* Light Coral Background on Hover */
    border-radius: 30px;
    width: 100%;
}

h2 {
    color: black; /* White */
    font-family: Arial, sans-serif;
}
.note{
   padding:200px;
   font-size:28px;
   word-spacing:10px;
}
.i .img{
    width:20%;
}
</style>
<body img src:"./young.jpg">
    <br>
    <div className='i'>
        <img src="./young.jpg">
</div>
        <div class="container">
        <form action="" method="post" autofill="off">
    <div class="form-group">
    <label>Name </label><br><br>
    <input type="text" name="name" place="Enter your name" required>
    </div>

    <div class="form-group">
        <label>Email </label><br><br>
    <input type="text" name="email" place="enter your placeholder" required>
    </div>
    <div class="form-group">
        <label>Number</label><br><br>
    <input type="text" name="number" place="enter your placeholder" required>
    </div>
    <div class="form-group">
        <label>password </label><br><br>
        <input type="password" name="password" place="enter your placeholder" required>
    </div>
    <br>
   
    <center>
    
    <button type="submit" value="login" name="register">Register</button><br

    <div class="regsiterbutton">
    <p>If you already Registered  <a href="Projectmanagerlog.php">Login</a></p>
    </div>
    </center>
</div>
    </div>
</div>
    <h3 class ="note" align=right>Project  Managers  Login</h3>
</body>
</html>
