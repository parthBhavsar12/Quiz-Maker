<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/errorpopup.css">
</head>
<body>
    <div id="authentication-error" class="authentication-error">
        <div class="authenticationerror-popup" id="authenticationerror-popup">
            <h2 class="errortitle">Error</h2>
            <h4 class="errormessage"></h4>
            <button type="submit" name="OK" class="close-errorpopup" title="Close the error popup">OK</button>
        </div>
        </div>
        <script>
            
        history.pushState(null, document.title, location.href);
        window.addEventListener('popstate', function ()
        {
        history.pushState(null, document.title, location.href);
        });
        const errorpopupCard = document.querySelector(".authentication-error");
        const errorTitle = document.querySelector(".errortitle");
        const errorSubtitle = document.querySelector(".errormessage"); 
        const closeBtn = document.querySelector(".close-errorpopup");
        let urlPath = document.location.pathname;
        console.log(urlPath);
        if(urlPath == "/quizmaker/signin.php"){
            let userActive ='<?php if(isset($is_active)){ echo $is_active;} ?>';
            errorSubtitle.innerText = "Wrong Username Or Password\nPlease Try again..";
            if(userActive === "No"){
                errorSubtitle.innerText = "Sorry...We can't let you Log In...\nYou are blocked by Admin\nYou should contact Admin...";
            }
        }else if(urlPath === "/quizmaker/signup.php"){
            let userExists = '<?php if(isset($count)){ echo $count;} ?>';
            let checkPasswordMatch = '<?php if(isset($confirm_password)){if(isset($password)){echo $password<>$confirm_password;}}?>';
            let emailExists = '<?php  if(isset($email_count)){echo $email_count>0;} ?>';
            console.log(userExists);
            console.log(checkPasswordMatch);
            
            if(userExists==1){
                errorSubtitle.innerText = "User name already exists\nPlease enter unique User name.";
            }else if(checkPasswordMatch == 1){
                errorSubtitle.innerText = "Password and Confirm Password\n Must be same...";
            }else if(emailExists == 1){
                errorSubtitle.innerText = "This Email-Id is already in use\nPlease use unique Email-Id..."
            }
        }else if(urlPath === "/quizmaker/add_questions.php"){
            errorTitle.innerText = "Add Question";
            errorSubtitle.innerText = "Question is added successfully...";
        }else if(urlPath === "/quizmaker/attend_quiz.php"){
            let checkQuizCode = '<?php if(isset($count)){echo $count;} ?>';
            let checkQuizAvailable = '<?php if(isset($mode['MODE'])){ echo $mode["MODE"];} ?>';
            let checkQuizTime = '<?php if(isset($sch_time['SCHEDULED_TIME'])){if($now['now'] < $sch_time['SCHEDULED_TIME']){echo 1;}} ?>';
            let quizTime = '<?php if(isset($sch_time['SCHEDULED_TIME'])){echo $sch_time['SCHEDULED_TIME'];} ?>';
            errorTitle.innerText = "Warning";
            if(checkQuizCode == 0){
                errorSubtitle.innerText = "Quiz is not found\nEnter valid Quiz Code...";
                closeBtn.addEventListener("click",function(e){
                    e.preventDefault();
                    window.location.href = "homepage.php";
                })

            }else if(checkQuizAvailable == "OFF"){
                errorSubtitle.innerText = "Quiz is turned Off by Quiz Creator\nYou can\'t attend it...";
                closeBtn.addEventListener("click",function(e){
                    e.preventDefault();
                    window.location.href = "homepage.php";
                })
            }else if(checkQuizTime == 1){
                errorSubtitle.innerText = `Quiz is scheduled at ${quizTime}\nYou can\'t attend it now...`;
                closeBtn.addEventListener("click",function(e){
                    e.preventDefault();
                    window.location.href = "homepage.php";
                })
            }else {
                errorSubtitle.innerText = "No Questions Found";
                closeBtn.addEventListener("click",function(e){
                    e.preventDefault();
                    window.location.href = "homepage.php";
                })
            }
        }
        else if(urlPath === "/quizmaker/contact_us.php" || urlPath === "/quizmaker/feedback.php"){
            errorTitle.innerText = "Response Submitted";
            errorSubtitle.innerText = "Thank You for your Response.";
        }else if(urlPath === "/quizmaker/forgot_password.php"){
            let checkEmailExists = '<?php if(isset($user_email)){if(isset($email)){echo $user_email <> $email;}}?>';
            let passwordChanged = '<?php if(isset($forgotPasswordResult)){echo $forgotPasswordResult;} ?>';
            errorTitle.innerText = "Reset Password";
            if(checkEmailExists == 1){
                errorSubtitle.innerText = "Email id does not exists or incorrect email.";
            }else if(passwordChanged == 1){
                errorSubtitle.innerText = "Your Password has been updated\nYou can now Log in";
            }else {
                errorSubtitle.innerText = "New Password and Confirm Password must be same";
            }
        }else if(urlPath === "/quizmaker/makequiz.php"){
            let checkQuizCount = '<?php if(isset($quiz_count)){echo $quiz_count;}?>';
            let checkQuizCreated = '<?php if(isset($quizCreated)){echo $quizCreated;} ?>';
            let quizCode = '<?php if(isset($quiz_code)){echo $quiz_code;}?>';
            console.log(checkQuizCount);
            errorTitle.innerText = "Make Quiz";
            if(checkQuizCount>0){
                errorSubtitle.innerText = "This Quiz already exists\nPlease use unique Quiz Code...";
            }
            if(checkQuizCreated == 1){
                errorSubtitle.innerText = `Quiz ${quizCode} has been Created successfully`;
            }
        }else if(urlPath === "/quizmaker/admin/admin_forgot_password.php"){
            let checkAdminPasswordUpdated = '<?php if(isset($checkAdminPasswordUpdated)){echo $checkAdminPasswordUpdated;}?>';
            if(checkAdminPasswordUpdated == 1){
                errorSubtitle.innerText = "Your Password has been updated\nYou can now Log in";
            }else {
                errorSubtitle.innerText = "New Password and Confirm Password must be same";
            }
        }else if(urlPath === "/quizmaker/admin/index.php"){
            errorSubtitle.innerText = "Wrong Admin ID or Password";
        }
        closeBtn.addEventListener("click",function(){
            errorpopupCard.style.opacity = 0;
            errorpopupCard.style.pointerEvents = "none";
            // errorpopupCard.style.display = none;
        })
        
        </script>
        
</body>
</html>
