<?php
    include "session_start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/attendquiz.css">
    <link rel="stylesheet" href="css/contact_us.css">
    <link rel="stylesheet" href="css/homescreen.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Contact Us</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <h2>Contact Us</h2>
        <form id="feedback-form"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="feedback-form">
                <div class="form-group">
                    <label for="first_name" id="first_name-label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter your First name" required>
                </div>
                <div class="form-group">
                    <label for="last_name" id="last_name-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter your Last name" required>
                </div>
                <div class="form-group">
                    <label for="userid" id="userid-label">User-name</label>
                    <input type="text" name="user_id" id="userid" class="form-control" placeholder="Enter your username" value="<?php 
                    if(isset($_SESSION['user_name'])){
                        echo $_SESSION['user_name'];
                    }?>" required>
                </div>
                <div class="form-group">
                    <label for="email" id="email-label">Email</label>
                    <input type="email" name="email_id" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="comments"><p>Any comments or suggestions?</p></label>
                    <textarea name="message" id="comments" class="input-textarea" placeholder="Enter your comment here..."></textarea>
                </div>
                <div class="form-group">
                    <label>Attach a Screen-Shot : &nbsp;<input type="file" name="attachment" value="Attach a Photo for any reference" accept="image/*"/></label>(Note : Only Image files are Accepted)
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" id="submit" class="submit-button">Submit</button>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['submit']))
            {
                if(isset($_POST['first_name'])){
                    $first_name = $_POST['first_name'];            
                }
                if(isset($_POST['last_name'])){
                    $last_name = $_POST['last_name'];
                }
                if(isset($_POST['user_id'])){
                    $user_id = $_POST['user_id'];
                }
                if(isset($_POST['email_id'])){
                    $email_id = $_POST['email_id'];
                }
                if(isset($_POST['message'])){
                    $message = $_POST['message'];
                }
                if(isset($_FILES['attachment']['name'])){
                    // $attachment = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
                    $attachment = $_FILES['attachment']['name'];
                }
                // echo alert('Thank You for writing to us...! We\'ll reply you as soon as possible...');
                //make connection
                $con = mysqli_connect("localhost","root","","quiz_maker");
                if($con)
                {
                    $sql = "INSERT INTO `contact_us`(`FIRST_NAME`, `LAST_NAME`, `USER_ID`, `EMAIL`, `MESSAGE`, `IMAGE`) VALUES ('$first_name','$last_name','$user_id','$email_id','$message','$attachment')";
                    //run query
                    mysqli_query($con,$sql);
                    $temp_file_path = $_FILES['attachment']['tmp_name'];
                    $temp_file_name = $_FILES['attachment']['name'];
                    move_uploaded_file($temp_file_path,"Uploads/".$_FILES['attachment']['name']);

                    include "errorpopup.php";
                    // echo "<p style='font-weight: bold;text-align: center;'>Thank You for your Response.</p>";
                }     
            }
        ?>
    </main>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>