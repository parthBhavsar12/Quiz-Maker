<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/indexCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="icon" href="../Attachments/light_logo.png">
    <title>Admin Panel - Reset Password</title>
</head>
<body>
    <main>
        <div class="split-screen">
            <div class="left">
                <section class="copy">
                <h1>Admin Panel</h1>
                </section>
            </div>
            <div class="right">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <section class="copy">
                        <h2>Reset Password</h2>
                        <div class="forgotpassword-container">
                            <p><a href="index.php"><strong>Back to Admin Panel Log In</strong></a></p>
                        </div>
                    </section>
                    <div class="input-container user_name">
                        <label for="admin">Admin Id</label>
                        <input type="text" name="admin" id="admin" placeholder="Enter Admin Id" title="Admin Id" autofocus required
                        value="<?php 
                                    if (isset($_COOKIE['admin']))
                                    echo $_COOKIE['admin'];
                                ?>"/>        
                    </div>
                    <div class="input-container password">
                        <label for="password">Password</label>
                        <input type="password" name="new_password" id="password" placeholder="Enter Password" title="Password" required/>
                    </div>
                    <div class="input-container password">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_new_password" id="confirm_password" placeholder="Confirm Password" title="Confirm Password" required/>
                    </div>
                    <input type="submit" class="signup-btn" name="submit" value="Reset Password" title="Get Logged In"/>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/menu.js"></script>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        if(isset($_POST['new_password'])){
            $new_password = $_POST['new_password'];
        }
        if(isset($_POST['confirm_new_password'])){
            $confirm_new_password = $_POST['confirm_new_password'];
        }
        if(isset($_POST['admin'])){
            $admin = $_POST['admin'];
        }
        if($new_password == $confirm_new_password){
            //make connection
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $new_password = password_hash($new_password,PASSWORD_DEFAULT);
                $sql = "UPDATE `admin_info` SET `ADMIN_PASSWORD`= '$new_password' WHERE `ADMIN_ID`='$admin'";
                //run query
                $checkAdminPasswordUpdated = mysqli_query($con,$sql);
                if($checkAdminPasswordUpdated){
                    include("../errorpopup.php");
                }
                // echo "<p  class='successful'>Your Password has been updated...<br>You can now <a href='index.php'>Log in</a></p>";
            }
        }
        else{
            include "../errorpopup.php";
            // echo "<p class='error'>Error : New Password and Confirm New Password must be same</p>";
        }      
    }
?>