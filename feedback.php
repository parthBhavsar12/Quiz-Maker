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
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="css/homescreen.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Feedback form</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <h2>Feedback</h2>
        <form id="feedback-form"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <div class="feedback-form">
                <div class="form-group">
                    <label for="name" id="name-label">Name</label>
                    <input type="text" name="full_name" id="name" class="form-control" placeholder="Enter your full name" required/>
                </div>
                <div class="form-group">
                    <label for="userid" id="userid-label">User-name</label>
                    <input type="text" name="user_id" id="userid" class="form-control" placeholder="Enter your username" value="<?php 
                    if(isset($_SESSION['user_name'])){
                        echo $_SESSION['user_name'];
                    }?>" required/>
                </div>
                <div class="form-group">
                    <label for="email" id="email-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required/>
                </div>
                <div class="form-group">
                    <label for="rating" id="rating">Rate our website</label>
                    <input type="range" name="ratings" id="rating" class="form-control" min="1" max="5" list="tickmarks" required/>
                    <datalist id="tickmarks">
                        <option value="1" label="20%"></option>
                        <option value="2" label="40%"></option>
                        <option value="3" label="60%"></option>
                        <option value="4" label="80%"></option>
                        <option value="5" label="100%"></option>
                    </datalist>
                </div>
                <div class="form-group">
                    <p>Would you recommend quizmaker to a family member / friend?</p>
                    <label><input type="radio" class="input-radio" name="recommendation" value="definitely" checked required/>Definitely</label>
                    <label><input type="radio" class="input-radio" name="recommendation" value="maybe" required/>Maybe</label>
                    <label><input type="radio" class="input-radio" name="recommendation" value="not-sure" required/>Not sure</label>
                </div>
                <div class="form-group">
                    <p>How is your experience with our Application?</p>
                    <label><input type="radio" class="input-radio" name="experience" value="very-good" checked required/>Very good</label>
                    <label><input type="radio" class="input-radio" name="experience" value="good" required/>Good</label>
                    <label><input type="radio" class="input-radio" name="experience" value="bad" required/>Bad</label>
                </div>
                <div class="form-group">
                    <label for="comments"><p>Any comments or suggestions?</p></label>
                    <textarea name="message" id="comments" class="input-textarea" placeholder="Enter your comment here..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Attach a Screen-Shot : &nbsp;<input type="file" name="attachment" value="Attach a Photo for any reference" accept="image/*"/></label>(Note : Only Image files are Accepted)
                </div>
                <div class="form-group">
                    <button type="submit" name="btnSubmit" id="submit" class="submit-button">Submit</button>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['btnSubmit'])){
                if(isset($_POST['full_name'])){
                    $full_name = $_POST['full_name'];
                }
                if(isset($_POST['user_id'])){
                    $user_id = $_POST['user_id'];
                }
                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                }
                if(isset($_POST['ratings'])){
                    $ratings = $_POST['ratings'];
                }
                if(isset($_POST['recommendation'])){
                    $recommendation = $_POST['recommendation'];
                }
                if(isset($_POST['experience'])){
                    $experience = $_POST['experience'];
                }
                if(isset($_POST['message'])){
                    $message = $_POST['message'];
                }
                if(isset($_FILES['attachment']['name'])){
                    $attachment = $_FILES['attachment']['name'];
                }
                else{
                    $attachment = NULL;
                }
                $con = mysqli_connect("localhost","root","","quiz_maker");
                if($con){
                    $sql = "INSERT INTO `feedback`(`FULL_NAME`, `USER_ID`, `EMAIL`, `RATINGS`, `RECOMMENDATION`, `EXPERIENCE`, `MESSAGE`, `ATTACHMENT`) VALUES ('$full_name','$user_id','$email','$ratings','$recommendation','$experience','$message','$attachment')";
                    mysqli_query($con,$sql);
                    $temp_file_path = $_FILES['attachment']['tmp_name'];
                    $temp_file_name = $_FILES['attachment']['name'];
                    move_uploaded_file($temp_file_path,"Uploads/".$_FILES['attachment']['name']);
                    // echo "<p style='font-weight: bold;text-align: center;'>Thank You for giving your Feedback.</p>";
                    include "errorpopup.php";
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