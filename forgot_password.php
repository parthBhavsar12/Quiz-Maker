<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="css/indexCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="icon" href="Attachments/light_logo.png">
</head>
<body>
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
                <h2>Reset Password</h2>
                <div class="forgotpassword-container">
                    <p><a href="signin.php"><strong>Back to Log In</strong></a></p>
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
            <div class="input-container user_name">
                <label for="email">Email Id</label>
                <input type="email" name="email" id="email" placeholder="Enter Email Id" title="Email Id" required/>        
            </div>
            <div class="input-container password">
                <label for="password">Password</label>
                <input type="password" name="new_password" id="password" placeholder="Enter Password" title="Password" minlength="8" required/>
            </div>
            <div class="input-container password">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_new_password" id="confirm_password" placeholder="Confirm Password" title="Confirm Password" minlength="8" required/>
            </div>
            <input type="submit" class="signup-btn" name="register" value="Reset Password" title="Get Logged In"/>
        </form>
    </div>
</div>
</body>
</html>
<?php
    if(isset($_POST['register'])){
        if(isset($_POST['new_password'])){
            $new_password = $_POST['new_password'];
        }
        if(isset($_POST['confirm_new_password'])){
            $confirm_new_password = $_POST['confirm_new_password'];
        }
        if(isset($_POST['user_name'])){
            $user_name = $_POST['user_name'];
        }
        if(isset($_POST['email'])){
            $email = $_POST['email'];
        }
        if($new_password == $confirm_new_password){
            //make connection
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $sql = "SELECT EMAIL FROM user_details WHERE `USER_ID`='$user_name'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
                $user_email=$row['EMAIL'];
                if($user_email <> $email){
                    include "errorpopup.php";
                    // echo "<p class='error'>Error : Email Id is not correct for this account</p>";
                }
                else{
                    $new_password = password_hash($new_password,PASSWORD_DEFAULT);
                    $sql = "UPDATE `user_details` SET `PASSWORD`= '$new_password' WHERE `USER_ID`='$user_name'";
                    //run query
                    $forgotPasswordResult = mysqli_query($con,$sql);
                    if($forgotPasswordResult){
                        include("errorpopup.php");
                    }
                    // echo "<p  class='successful'>Your Password has been updated...<br>You can now <a href='signin.php'>Log in</a></p>";
                }
            }
        }
        else{
            include "errorpopup.php";
            // echo "<p class='error'>Error : New Password and Confirm New Password must be same</p>";
        }
        
    }
?>