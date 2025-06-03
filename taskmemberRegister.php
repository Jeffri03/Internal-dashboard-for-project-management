<?php
include("connect.php");
if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $password=$_POST['password'];
    $number=$_POST['number'];
    $email=$_POST['email'];



    $result=$mysqli->query("INSERT INTO taskmemberregister(name,password,number,email) VALUES('$name','$password','$number','$email')");
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
    .container{
        position:absolute;
        top:20%;
        left:34%;
        padding:20px;
        background-color:  #20b2aa; /* Light Sea Green */
        box-sizing:border-box;
        width:500px;
       
        border-radius:15px;
        
    }
    .container .form-group{
            position:relative;

   }
    .container .form-group input{
     width:98%;
     padding:10px ;
     font-size:14px;
     border:none;
     border-bottom: 1px solid #fff;
     outline: none;
    }
    .container .form-group label{
        position: absolute;
        left:0;
        padding:10px 0;
        font-size: 17px;
        color:#fff;
        margin:26px;
        pointer-events: none;
        transition:.5s;
        transform:translateY(-50%);
    }
    
    button{
        color:white;
        background-color:black;
        width:30%;
        height: 30px;
        font-weight:400;
        border-radius: 80px;
        font-size: large;
    }
    .registerbutton{
      background-color: black;
      text-decoration:none;
      color:white;
      width:100%;
      height: 45px;
      border: none;
      font-weight: bold;
      font-family:sans-serif;
      font-size:18px;
      border-radius: 0px;
    }
    .registerbutton:hover {
        background-color: cyan;
    }

   .registerbutton ,p{
      color: black;
      padding:10px;

    }
    .registerbutton, a{
        padding: 10px;
        color: white;
    }
    .registerbutton, a:hover{
        background-color:red;
        border-radius:30px;
    }
    body{
        background: skyblue; /* Light Blue */
    }
    .login{
        padding:0px 10px 10px 10px;
        font-size:16px;
        color:white;
        margin:0px 20px 70px;
    }
    h2{
        color:black;
        font-family:sans-serif;
        
        
    }
    h1{
        color:black;
        font-family:sans-serif;
        
        
    }

    

</style>
<body><br>
        <center><h1>Team Member Reg</h1></center>
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
    <p>If you already registered...<a href="taskmemberlog.php">Login</a></p>
    </div>
    </center>
</div>
    </div>
    
</body>
</html>







