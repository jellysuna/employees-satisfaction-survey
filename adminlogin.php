<?php
session_start();

// Include the database configuration file
include('config.php');

if (isset($_POST["submit"])) {
    if (empty($_POST["admin_name"]) || empty($_POST['admin_password'])) {
        $invalid = "Incorrect";
    } else {
        $user = $_POST['admin_name'];
        $pass = $_POST['admin_password'];
        $conn = mysqli_connect ("localhost", "root", "");
        $db = mysqli_select_db($conn, "satisfactionsurvey");

        // Retrieve the hashed password from the database
        $query = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_name='$user'"); 
        $rows = mysqli_num_rows($query);

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($query);
            $hashed_password = $row['admin_password'];

            if (password_verify($pass, $hashed_password)) {
                $_SESSION['admin_id'] = $row['admin_id']; 
                header("Location: adminresponsesreport.php"); 
                exit(); 
            } else {
                $invalid = "Incorrect";
                echo "<script> alert('fail: Incorrect password');</script>";
            }
        } else {
            $invalid = "Incorrect";
            echo "<script> alert('fail: No such user');</script>";

        }

        mysqli_close($conn);
    }
}
?>


<!doctype html
<html>
<head>
        <meta charset="UTF-8">
         <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <title>Login</title>
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
        <script src="jstry.js"></script> 
    <style>
        /* ===== Google Font Import - Poformsins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Lato', sans-serif;
}

body {
    ;
    font-family: 'Lato', sans-serif;
    background-color: white;
}
/* Hide the 000webhost branding */
a[href*="000webhost.com"] {
    display: none;
}
.container {
    position: relative;
    max-width: 430px;
    width: 100%;
    height: 500px;
    background: #D3F3FC;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 0 20px;
    padding-top: 25px;
}

.container .forms {
    display: flex;
    align-items: center;
    height: 440px;
    width: 200%;
    transition: height 0.2s ease;
}


.container .form {
    width: 50%;
    padding: 30px;
    background: #D3F3FC;
    transition: margin-left 0.18s ease;
}

.container.active .login {
    margin-left: -50%;
    opacity: 0;
    transition: margin-left 0.18s ease, opacity 0.15s ease;
}

.container .signup {
    opacity: 0;
    transition: opacity 0.09s ease;
}

.container.active .signup {
    opacity: 1;
    transition: opacity 0.2s ease;
}

.container.active .forms {
    height: 600px;
}

.container .form .title {
    position: relative;
    font-size: 27px;
    font-weight: 600;
}

.form .title::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -3;
    height: 3px;
    width: 30px;
    background-color: #0F75BD;
    border-radius: 25px;
}

.form .input-field {
    position: relative;
    height: 50px;
    width: 100%;
    margin-top: 30px;
}

.input-field input {
    position: absolute;
    height: 100%;
    width: 100%;
    padding: 0 35px;
    border: none;
    outline: none;
    font-size: 16px;
    background-color: #D3F3FC;
    border-bottom: 2px solid #ccc;
    border-top: 2px solid transparent;
    transition: all 0.2s ease;
}

.input-field input:is(:focus, :valid) {
    border-bottom-color: #0F75BD;
}

.input-field i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 23px;
    transition: all 0.2s ease;
}

.input-field input:is(:focus, :valid)~i {
    color: #4070f4;
}

.input-field i.icon {
    left: 0;
}

.input-field i.showHidePw {
    right: 0;
    cursor: pointer;
    padding: 10px;
}

.form .text {
    color: #333;
    font-size: 14px;
}

.form a.text {
    color: #4070f4;
    text-decoration: none;
}

.form a:hover {
    text-decoration: underline;
}

.form .button {
    margin-top: 35px;
}

.form .button input {
    border: none;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    letter-spacing: 1px;
    border-radius: 6px;
    background-color: #0F75BD;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button input:hover {
    background-color: #fff;
        color: #0F75BD;
        border: 2px solid #0F75BD;}

.form .login-signup {
    margin-top: 30px;
    text-align: center;
}

.containers {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.logo {
    display: block;
    size: 40px;
}

@media (max-width: 800px) {
    .logo {
        display: none;
    }
    .flexcontainer {
        flex-direction: column;
        
    }
    .logo-text {
    display: none;
}
    .container{
        margin-left: -90px;

    }
}

.logo-text {
    margin-top: 10px;
    font-size: 32px;
    font-weight: bold;
    color: #332c38;
    font-family: cookie;
}

.space {
    margin-top: 30px;
    margin-right: 60px;
}


.cancel-button {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    background-color: #a99cdf;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    letter-spacing: 1px;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-left: 10px;
}

.cancel-button:hover {
    background-color: #b7adde;
}
.flexcontainer {
    display: flex;
    flex-direction: row;
    height: 100vh;
    align-items: center;
    justify-content: center;
}

    </style>
</head>
<body>
    <div class="flexcontainer">
    <div class="containers">
        <p class="logo-text">Welcome!</p>
        <div  class="space"></div>
        <a href="responsesreport.php"> 
        </a>
        
    </div>
    <div  class="space"></div>

   <div class="container">
     <div class="forms"> 
     <div class="form login">
     <span class="title">Log in as admin</span>
        <form action="" method="post" >
        <div class="input-field">
                <input type="text" required placeholder="Enter your username" id="admin_name" name="admin_name"><br/><br/>
                <i class="uil uil-user icon"></i>
        </div>
        <div class="input-field">
                <input type="password" required placeholder="Enter your password" id="admin_password" name="admin_password"><br/><br/>
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw" id="showHideIcon" onclick="myFunction()"></i>

        </div><br>

        <div class="input-field button">
            <input type="submit" value="Log in" name="submit">
        </div>
        <div class="login-signup">
            <span class="text">
                <a href="adminregister.php" class="text signup-link">Register as admin</a>
            </span><br><br>
            <span class="text">
                <a href="index.php" class="text signup-link">Cancel</a>
            </span>
        </div>

    </div>
</div> 
   </div>
   </div>
   <script src="jstry.js"></script> 
   <script>
function myFunction() {
  var x = document.getElementById("admin_password");
  var icon = document.getElementById("showHideIcon");
  
  if (x.type === "password") {
    x.type = "text";
    icon.classList.add("uil-eye");
    icon.classList.remove("uil-eye-slash");
  } else {
    x.type = "password";
    icon.classList.remove("uil-eye");
    icon.classList.add("uil-eye-slash");
  }
}
</script>

</body>
</html>