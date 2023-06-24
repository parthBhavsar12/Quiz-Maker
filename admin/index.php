<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/indexCSS.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="icon" href="../Attachments/light_logo.png">
    <title>Admin Panel - Sign in</title>
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
                        <h2>Sign in</h2>
                    </section>

                    <div class="input-container user_name">
                        <label for="user_name">Admin Id</label>
                        <input type="text" name="user_name" placeholder="Enter Admin Id" title="Admin Id" autofocus required 
                        value="<?php 
                                    if (isset($_COOKIE['admin']))
                                    echo $_COOKIE['admin'];
                                ?>"/>        
                    </div>

                    <div class="input-container password">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter Password" title="Password" required/>
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
                        <p><a href="admin_forgot_password.php"> <strong>Forgot Password?</strong> </a> </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/menu.js"></script>
</body>
</html>
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
        if($con)
        {       
            $sql = "SELECT ADMIN_PASSWORD FROM admin_info WHERE admin_id='$user_name'";
            //run query
            $result = mysqli_query($con,$sql);
            $row_password ='';
            while($row = mysqli_fetch_array($result))
            {
                $row_password = $row['ADMIN_PASSWORD'];
            }
            if(isset($_POST['rememberMe']))
            {
                if(password_verify($password,$row_password))
                {
                    setcookie('admin',$user_name,time()+3600*24*7);
                    $_SESSION['admin'] = $user_name;
                    // echo $_SESSION['admin'];
                    header("Location:admin_home.php");
                    $sql = "INSERT INTO `admin_log_in`(`ADMIN`) VALUES ('$user_name')";
                    //insert log
                    mysqli_query($con,$sql);
                }
            }
            elseif(password_verify($password,$row_password))
            {
                $_SESSION['admin'] = $user_name;
                header("Location:admin_home.php");
                $sql = "INSERT INTO `admin_log_in`(`ADMIN`) VALUES ('$user_name')";
                //insert log
                mysqli_query($con,$sql);
            }
            else
            {
                include "../errorpopup.php";
                // echo "<p class='error'>Error : Wrong Admin ID or Password....<br>Please try again....</p>";
            }
        }
    }
?>