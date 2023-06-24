<?php
    include "session_start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/attendquiz.css">
    <link rel="stylesheet" href="./css/makequiz.css">
    <link rel="stylesheet" href="./css/homescreen.css">
    <link rel="stylesheet" href="./css/addquestion.css">
    <link rel="stylesheet" href="./css/checkresponsequiz.css">
    <!-- <link rel="stylesheet" href="./css/evaluate_desc_response.css"> -->
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Make Quiz</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <h2>Make Quiz</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <div class="make-quiz">
                <input type="text" name="quiz_code" class="form-control" placeholder="QUIZ CODE (E.g., Math_JAN_ch1)" title="Enter Quiz Code" required autofocus/>
                <textarea rows="2" name="quiz_desc" class="input-textarea" placeholder="QUIZ DESCRIPTION" title="Enter Quiz Description" autocomplete></textarea>
                <p><label>Select Quiz Level :
                    <select name="quiz_level" class="form-control">
                        <option title="Quiz is made at Easy level">Easy</option>
                        <option title="Quiz is made at Moderate level">Moderate</option>
                        <option title="Quiz is made at Tough level">Tough</option>
                    </select></label>
                </p>
                <p>
                    <label>Do you want to schedule the Quiz? If Yes, Select Date and Time : 
                    <input type="datetime-local" name="scheduled_time" title="Do you want to Schedule this Quiz?"/></label>
                </p>
                <!-- <p>
                    <input type="checkbox" name="limit" id="limit" title="Set limit to Single response"/>
                    <label for="limit"class="rememberMe">Set limit to Single response</label>
                </p> -->
                <p class="center">
                    <input type="checkbox" class="largerCheckbox" name="limit" id="limit" title="Set limit to Single response"/>
                    <label for="limit" class="rememberMe">Set limit to Single response</label>
                </p>
                <!-- <button type="submit" class="save" name="btnSave"><a class="primary-button">Save</a></button> -->
            </div>
            <div class="themebtn">
                <input type="submit" class="theme-button" name="btnSave" value="Save">
                <!-- <button type="submit" class="theme-button" name="btnSave">Save</a> -->
            </div>
        </form>
        <!-- <div class="add-question">
            <h4>Add Questions</h4>
            <h4>Check Response of your quiz</h4>
        </div> -->
        <?php
            if(isset($_POST['btnSave'])){
                if(isset($_POST['quiz_code'])){
                    $quiz_code = $_POST['quiz_code'];
                }
                if(isset($_POST['quiz_desc'])){
                    $quiz_desc = $_POST['quiz_desc'];
                }
                if(isset($_POST['quiz_level'])){
                    $quiz_level = $_POST['quiz_level'];
                }
                if(isset($_POST['scheduled_time'])){
                    $scheduled_time = $_POST['scheduled_time'];
                }
                else{
                    $scheduled_time = NULL;
                }
                if(isset($_POST['limit'])){
                    $limit = "Single";
                }
                else{
                    $limit = "Multiple";
                }
                $user_name = $_SESSION['user_name'];
                $con = mysqli_connect("localhost","root","","quiz_maker");
                $sql = "SELECT count(QUIZ_CODE) as 'quiz_count' FROM `registered_quiz` WHERE QUIZ_CODE='$quiz_code'";
                $result = mysqli_query($con,$sql);
                $quiz_count = 0;
                $row = mysqli_fetch_array($result);
                $quiz_count = $row['quiz_count'];

                if($quiz_count>0){
                    include "errorpopup.php";
                    // echo "<p class='error'>Error : This Quiz already exists...<br>Please use unique Quiz Code...</p>";
                }
                elseif($con)
                {       
                    $sql = "INSERT INTO `registered_quiz`(`QUIZ_CODE`, `QUIZ_DESC`, `SCHEDULED_TIME`, `QUIZ_LEVEL`, `CREATOR_ID`, `LIMIT`) VALUES ('$quiz_code','$quiz_desc','$scheduled_time','$quiz_level','$user_name','$limit')";
                    //run query--1
                    mysqli_query($con,$sql);
                    $quiz = "quiz_".$quiz_code;
                    $sql = "CREATE TABLE $quiz (
                        SR_NO INT(11) AUTO_INCREMENT,
                        QUESTION VARCHAR(100),
                        QUE_TYPE VARCHAR(30),
                        OPTION_A VARCHAR(100),
                        ATTCH_A LONGBLOB,
                        OPTION_B VARCHAR(100),
                        ATTCH_B LONGBLOB,
                        OPTION_C VARCHAR(100),
                        ATTCH_C LONGBLOB,
                        OPTION_D VARCHAR(100),
                        ATTCH_D LONGBLOB,
                        CORRECT_ANS VARCHAR(1),
                        POINT INT(5),
                        MEDIA_FILE LONGBLOB,
                        IS_REQUIRED VARCHAR(3),
                        PRIMARY KEY (SR_NO))";
                        //run query--2
                        // mysqli_query($con,$sql);
                        // include "errorpopup.php";  
                        $quizCreated = mysqli_query($con,$sql);
                        if($quizCreated){
                            include "errorpopup.php";   
                        }            
                        // echo "<p style='font-weight: bold;text-align: center;'>Quiz ".$quiz_code." has been Created successfully...</p>";               
                }
            }
        ?>
    </main>
    <div class="hyperlink">
        <a href="#add_questions" class="addquestionbtn">Add Questions in your Quiz</a>
        <a href="#check-responsequiz" class="checkresponsequizbtn">Check Responses of your Quiz</a>
        <!-- <a href="#evaluatequiz" class="evaluatequizbtn">Evaluate Descriptive Responses</a> -->
    </div>
    <div id="add-questions" class="add-questions">
        <div class="addquestions-popup">
            <h2 class="addquestion-title">Add Questions</h2>
            <button class="close-addquestion">X</button>
            <h4 class="add-questionlabel">Choose Quiz Code from given list : </h4>
            <form action="add_questions.php" method="post" name="enter_quiz">
                <select title="Select Quiz" name="quiz" id="selectquiz" required>
                    <?php
                        $con = mysqli_connect("localhost","root","","quiz_maker");
                        if($con){   
                            $user_name = $_SESSION['user_name'];

                            $sql = "SELECT `QUIZ_CODE` FROM `registered_quiz` WHERE CREATOR_ID='$user_name'";
                            $result = mysqli_query($con,$sql);
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    echo '<option value="'.$row['QUIZ_CODE'].'">'.$row['QUIZ_CODE'].'</option>';
                                }
                            }
                            else{
                                echo '<option value="No quiz is created by you">No quiz is created by you</option>';
                            }
                        }
                    ?>
                </select> 
                <button type="submit" name="btnAddQue" class="submit-addquestions" title="Click here to attend Quiz">Next</button>
            </form>
        </div>
    </div>
    <div id="check-responsequiz" class="check-responsequiz">
        <div class="checkresponsequiz-popup">
            <h2 class="checkresponsequiz-title">Check Responses</h2>
            <button class="close-checkresponsequiz">X</button>
            <h4 class="checkresponsequiz-label">Choose Quiz Code from given list : </h4>
            <form action="check_responses.php" method="post" name="enter_quiz">
                <select title="Select Quiz" name="quiz" id="selectquiz" required>
                <?php
                    $con = mysqli_connect("localhost","root","","quiz_maker");
                    if($con){   
                        $user_name = $_SESSION['user_name'];

                        $sql = "SELECT `QUIZ_CODE` FROM `registered_quiz` WHERE CREATOR_ID='$user_name'";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_array($result)){
                                echo '<option value="'.$row['QUIZ_CODE'].'">'.$row['QUIZ_CODE'].'</option>';
                            }
                        }
                        else{
                            echo '<option value="No quiz is created by you">No quiz is created by you</option>';
                        }
                    }
                ?>
                </select> 
                <button type="submit" name="btnCheckResponses" class="submit-checkresponsequiz" title="Click here to attend Quiz">Next</button>
            </form>
        </div>
    </div>
    <!-- <div id="evaluatequiz" class="evaluate-quiz">
        <div class="evaluatequiz-popup">
            <h2 class="evaluatequiz-title">Descriptive Responses</h2>
            <button class="close-evaluatequiz">X</button>
            <h4 class="evaluatequiz-label">Choose Quiz Code from given list : </h4>
            <form action="evaluate_desc_response.php" method="post" name="enter_quiz">
                <select title="Select Quiz" name="quiz" id="selectquiz" required>
                <?php
                    $con = mysqli_connect("localhost","root","","quiz_maker");
                    if($con){   
                        $user_name = $_SESSION['user_name'];

                        $sql = "SELECT `QUIZ_CODE` FROM `registered_quiz` WHERE CREATOR_ID='$user_name'";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_array($result)){
                                echo '<option value="'.$row['QUIZ_CODE'].'">'.$row['QUIZ_CODE'].'</option>';
                            }
                        }
                        else{
                            echo '<option value="No quiz is created by you">No quiz is created by you</option>';
                        }
                    }
                ?>
                </select> 
                <button type="submit" name="btnCheckResponses" class="submit-evaluatequiz" title="Click here to attend Quiz">Next</button>
            </form>
        </div>
    </div> -->
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/addquestions.js"></script>
    <script src="js/checkresponsequiz.js"></script>
    <!-- <script src="js/evaluate_desc_response.js"></script> -->
</body>
</html>