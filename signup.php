<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/indexCSS.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <style>
      .right{
        overflow-y: auto;
      }
    </style>
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
                <h2 class="h2-signUp">Sign Up</h2>
                <div class="login-container">
                    <p>Already have an account? <a href="signin.php"><strong>Login</strong></a></p>
                </div>
            </section>


            <div class="input-container username">
                <label for="username">Enter Username</label>
                <input type="text" name="username" id="username" placeholder="Enter Username" title="Enter Username" required/>
            </div>

            <div class="input-container name">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" title="First Name" autofocus required/>
            </div>

            <div class="input-container name">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" title="Last Name" required/>
            </div>

            <div class="input-container email">
                <label for="mail_id">Email</label>
                <input type="email" name="mail_id" id="mail_id" placeholder="Enter Email Address" title="Email Address" required/>
            </div>

            <div class="input-container password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" title="Password" minlength="8" required/>
                <!-- <i class="material-icons" id="visibility">visibility_off</i> -->
            </div>

            <div class="input-container password">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" title="Confirm Password" minlength="8" required/>
                <!-- <i class="material-icons" id="confirmPasswordVisibility">visibility_off</i> -->
            </div>

           

            <!-- <div class="input-container cta">
              <label class="checkbox-container">
                <input type="checkbox" required>
                <span class="checkmark"></span>
                Do you argee our T & C
              </label>
            </div> -->
            <div class="input-container cta" title="By continuing, you agree to accept our T&Cs">
                <label class="rememberMe">
                    <input type="checkbox" name="accept_tnc" value="accept_tnc" id="remember" required/>  
                    <span class="checkmark"></span>
                    Do you argee our T & C?
                </label>
            </div>

            <input type="submit" name="register" class="signup-btn" value="REGISTER" title="Register Yourself"/>
            <section class="copy submit">
              <p><span class="small">By continuing, you agree to accept our <br>
              <!-- <a href="#">Privacy Policy</a> &amp;  -->
              <a href="t&c.php">Terms of Service</a> </span></p>
            </section>

            </form>
        </div>
    </div>

</body>
</html>
<?php
    define("ERRORPOPUP","errorpopup.php");
    // print_r($_POST);
    if(isset($_POST['register'])){
        if(isset($_POST['first_name'])){
            $first_name = $_POST['first_name'];
        }
        if(isset($_POST['last_name'])){
            $last_name = $_POST['last_name'];
        }
        // if(isset($_POST['dob'])){
        //     $dob = $_POST['dob'];
        // }
        // if(isset($_POST['country_code'])){
        //     $country_code = $_POST['country_code'];
        // }
        // if(isset($_POST['mobile'])){
        //    $mobile = $_POST['mobile'];
        // }
        if(isset($_POST['mail_id'])){
           $mail_id = $_POST['mail_id'];
        }
        if(isset($_POST['password'])){
           $password = $_POST['password'];
        }
        if(isset($_POST['confirm_password'])){
           $confirm_password = $_POST['confirm_password'];
        }
        if(isset($_POST['username'])){
           $username = $_POST['username'];
        }
        // SELECT count(USER_ID) FROM `user_details` WHERE USER_ID="parth.bhavsar"
        //database connection
        $con = mysqli_connect("localhost","root","","quiz_maker");
        $sql = "SELECT count(USER_ID) AS 'count' FROM `user_details` WHERE USER_ID='$username'";
        // echo $sql."<br>";
        $result = mysqli_query($con,$sql);
        $count = 0;
        while($row = mysqli_fetch_array($result)){
            $count = $row['count'];
        }
        $sql = "SELECT count(EMAIL) as 'email_count' FROM `user_details` WHERE EMAIL='$mail_id'";
        $result = mysqli_query($con,$sql);
        $email_count = 0;
        $row = mysqli_fetch_array($result);
        $email_count = $row['email_count'];

        if($count == 1){
            include(ERRORPOPUP);
        }elseif($password<>$confirm_password){
            include(ERRORPOPUP);
        }elseif($email_count>0){
            include(ERRORPOPUP);
        }
        elseif($con && $password==$confirm_password){
            $hash_password = password_hash($password,PASSWORD_DEFAULT);
            
            //insert query
            // $sql = "INSERT INTO `user_details`(`USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`) VALUES ('$username','$hash_password','$first_name','$last_name','$mail_id')";// `DOB`,, `MOBILE`, `COUNTRY_CODE`,'$dob','$mobile','$country_code'
            $sql = "INSERT INTO `user_details`(`USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`) VALUES('$username','$hash_password','$first_name','$last_name','$mail_id')";
            //run query 
            // echo $sql."<br>";   
            $checkRegistrationDone =mysqli_query($con,$sql);
            if($checkRegistrationDone == 1){
                $_SESSION['user_name'] = $username;
                header("Location:homepage.php");
            }
            // $sql = "INSERT INTO `quiz_template`(`USER_ID`) VALUES ('$username')";
            //run query
            // mysqli_query($con,$sql);
        }
    }
?>