<?php

$invalid=""; //Variable to Store error message;

if(isset($_POST["submit"])){
    if(empty($_POST["admin_name"]) || empty($_POST["admin_email"]) || empty($_POST["admin_password"])) {
        $invalid = "Must fill all areas";
        }
        else
        {
            $conn = mysqli_connect ("localhost", "root", "");
            $db = mysqli_select_db($conn, "satisfactionsurvey");

            $username=$_POST['admin_name'];
            $email=$_POST['admin_email'];
            $password = password_hash($_POST['admin_password'], PASSWORD_BCRYPT); // Hash the password

           //check if email or username already existed in database
           $duplicate_query = "SELECT * FROM `admin` WHERE `admin_name` = '$username' OR `admin_email` = '$email'";
           $duplicate_result = mysqli_query($conn, $duplicate_query);

           if (mysqli_num_rows($duplicate_result) > 0) {
            echo '<script>
                    alert("Email or username is already taken.");
                    window.location.href = "adminregister.php"; // Redirect to the registration page
                  </script>';
           } else {
            $register_query = "INSERT INTO `admin`(`admin_name`, `admin_email`, `admin_password`) VALUES ('$username', '$email', '$password')";

            try {
                $register_result = mysqli_query($conn, $register_query);
                if ($register_result && mysqli_affected_rows($conn) > 0) {
                    header("Location: adminlogin.php");
                } else {
                    echo "Registration failed";
                }
            } catch(Exception $ex) {
                echo("error".$ex->getMessage());
            }
           }
           
        }
}

?>

<!doctype html
<html>
    <head>
    <meta charset="UTF-8">
       <!-- ===== Iconscout CSS ===== -->
       <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <title>Register </title>
        <style>
        /* ===== Google Font Import - Poppins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lato', sans-serif;
        }

        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            position: relative;
            max-width: 430px;
            width: 100%;
            height: auto;
            background: #D3F3FC;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .container .title {
            font-size: 27px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .input-field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
        }

        .input-field input {
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

        .input-field input:focus {
            border-bottom-color: #0F75BD;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 23px;
            color: #999;
        }

        .input-field i.icon {
            left: 10px;
        }

        .input-field i.showHidePw {
            right: 10px;
            cursor: pointer;
        }

        .button input {
            width: 100%;
            height: 50px;
            border: none;
            background-color: #0F75BD;
            color: white;
            font-size: 17px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .button input:hover {
            background-color: #fff;
            color: #0F75BD;
            border: 2px solid #0F75BD;
        }

        .login-signup {
            margin-top: 20px;
            font-size: 14px;
        }

        .login-signup a {
            color: #4070f4;
            text-decoration: none;
        }

        .login-signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <span class="title">Sign Up as Admin</span>
        <form action="" method="post">
            <div class="input-field">
                <input type="text" required placeholder="Enter your username" id="admin_name" name="admin_name">
                <i class="uil uil-user icon"></i>
            </div>
            <div class="input-field">
                <input type="email" required placeholder="Enter your email" id="admin_email" name="admin_email">
                <i class="uil uil-envelope icon"></i>
            </div>
            <div class="input-field">
                <input type="password" required placeholder="Create a password" id="admin_password" name="admin_password">
                <i class="uil uil-lock icon"></i>
                <i class="uil uil-eye-slash showHidePw" id="showHideIcon" onclick="togglePassword()"></i>
            </div>
            <div class="button">
                <input type="submit" name="submit" value="Sign up">
            </div>
        </form>
        <div class="login-signup">
            <span>Already have an account? 
                <a href="adminlogin.php">Log in</a>
            </span>
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("admin_password");
            var icon = document.getElementById("showHideIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("uil-eye-slash");
                icon.classList.add("uil-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("uil-eye");
                icon.classList.add("uil-eye-slash");
            }
        }
    </script>
</body>

</html>