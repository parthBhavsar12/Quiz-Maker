<!DOCTYPE html>
<html>
<head>
    <title>LOG IN</title>
    <link rel="stylesheet" type="text/css" href="css/indexCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="icon" href="Attachments/light_logo.png">
</head>
<body>
<?php
    session_start();
    if (isset($_GET['action']))
    {
        if($_GET['action']='logOut')
        {
            session_destroy();
        }
    }
?>
<div class="split-screen">
    <div class="left">
        <section class="copy">
          <h1>Make your Quiz now...</h1>
          <p>Create any type of Quiz using our website</p>
        </section>
    </div>
    <div class="right">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

        <section class="copy">
            <h2>Sign in</h2>
            <div class="login-container">
                <p>New User?<a href="signup.php"> <strong>Register now</strong> </a> </p>
            </div>
        </section>

        <div class="input-container user_name">
            <label for="user_name">Username</label>
            <input type="text" name="user_name" id="user_name" placeholder="Enter Username" title="User Name" autofocus required 
            value="<?php 
                        if (isset($_COOKIE['user_name']))
                        echo $_COOKIE['user_name'];
                    ?>"/>        
        </div>

        <div class="input-container password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" title="Password" required/>
        </div>

        <div class="input-container cta">
            <label class="rememberMe">
                <input type="checkbox" name="rememberMe" value="remember" id="remember"  title="Remember Me"/>  
                <span class="checkmark"></span>
                Remember me
            </label>
        </div>

        <input type="submit" class="signup-btn" name="submit" value="LOG IN" title="Get Logged In"/>

        <div class="forgotpassword-container">
            <p><a href="forgot_password.php"> <strong>Forgot Password?</strong> </a> </p>
        </div>

<?php
    if(isset($_POST['submit'])){
        if(isset($_POST['user_name'])){
            $user_name = $_POST['user_name'];
        }
        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }

        //database connection
        $con = mysqli_connect("localhost","root","","quiz_maker");
        if($con){       
            $sql = "SELECT `PASSWORD`, `ACTIVE` FROM `user_details` WHERE USER_ID='$user_name'";
            //run query
            $row_password = '';
            $is_active = '';
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)){
                $row_password = $row['PASSWORD'];
                $is_active = $row['ACTIVE'];
            }
                if($is_active=="No"){
                    include("errorpopup.php");
                }
                else{
                    if(isset($_POST['rememberMe'])){
                        if(password_verify($password,$row_password)){
                            setcookie('user_name',$user_name,time()+3600*24*7);
                            $_SESSION['user_name'] = $user_name;
                            // echo $_SESSION['user_name'];
                            header("Location:homepage.php");
                            $sql = "INSERT INTO `log_in`(`user`) VALUES ('$user_name')";
                            //insert log
                            mysqli_query($con,$sql);
                        }
                        else{
                            include("errorpopup.php");
                        }
                    }
                    elseif(password_verify($password,$row_password)){
                        $_SESSION['user_name'] = $user_name;
                        header("Location:homepage.php");
                        $sql = "INSERT INTO `log_in`(`user`) VALUES ('$user_name')";
                        //insert log
                        mysqli_query($con,$sql);
                    }
                    else{
                        include("errorpopup.php");
                    }
                }
        }
    }
?>



</form>
    </div>
</div>
</body>
</html> 