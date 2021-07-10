<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 8){
    $password_err = "Password cannot be less than 8 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sign Up | FlixHour</title>
    <style>
        html {
            scroll-behavior: smooth;
        }

        #logo {
  margin: 10px 20px;
}
#logo img {
  height: 60px;
  margin: 4px 7px;
  border-radius: 1000%;
}

        #button:hover {
          background: rgb(80, 80, 196);
            cursor: pointer;
            color: white;
        }
        .Register{
          width:20%;
          background-color:black;
          display:inline-block;
          text-align:center;
          margin-left:1350px;
          margin-top:-135px;
          padding:50px;
          color:white;
          opacity: 0.7;
        }
        .center {
  text-align: center;
}
        body {
  background-image: url('background_login.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size:100% 100%;
}
.form-control{
    width:70%;
    height: 45px;
}
.signup{
    text-decoration:none;
    color:white;
}
.signup:hover{
    text-decoration:underline;
}
.learn{
    text-decoration:none;
    color:blue;
}
.learn:hover{
    text-decoration:underline;
}
.help{
    text-decoration:none;
    color:grey;
    margin-left:-53%;
    font-size:91%;
}
.help:hover{
    text-decoration:underline;
}
    </style>
  </head>
  <body>
  <header>
        <nav class="navbar">
        <div id="logo">
            <img  src="logo_flixhour.jpeg" alt="FlixHour" style="
            width: 120px;
            height: 120px; cursor: pointer;" href="FlixHour.html">
        </div>
        </nav>
    </header><br><br><br><br><br><br><br><br><br>

<div class="Register">
<h1 style="margin-left:-40%">Sign Up</h1><br>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Email or Phone number" required>
    </div>
    <br>
    <div class="form-group col-md-6">
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
    </div><br>
    <div class="form-group col-md-6">
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password" required  required>
    </div><br><br><br>
  </div>
  <button type="submit" class="btn btn-primary" id="button" style="background-color:red;font-size: 18px; color: white;cursor: pointer;border-radius: 2px; border-color:black;width: 75%;height: 45px;text-align: center;">Sign up</button>
</form>
<a href="#Need Help" class="help"> Need help?</a>
<br>
<br>
<div style="color:grey ;margin-left:-5%">
This page is protected by Google <br>reCAPTCHA to ensure you're not <br>a bot.<a href="#learn" class="learn"> Learn more.</a>
</div>
</div>
<br><br><br><br><br><br>

<footer>
        <div class="center">
            Copyright &copy; FlixHour.com All rights reserved!
        </div>
    </footer> 

   </body>
</html>