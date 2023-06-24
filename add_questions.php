<?php
    include "session_start.php";
    if(isset($_POST['btnAddQue'])){
        if(isset($_POST['quiz'])){
            $quiz = $_POST['quiz'];
            $_SESSION['quiz'] = $quiz;
        }
    }
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
    <link rel="stylesheet" href="./css/table.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Add Questions into Quiz</title>
    <style>
        .make-quiz{
            /* border: 1px solid #233975; */
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <h2>Add Questions in Quiz : <?php echo $_SESSION['quiz'];?></h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <div class="enter-question">
                <label for="question">Write down Your Question : </label>
                <input type="text" name="question" id="question" placeholder="Question" title="Write Your Question Here" required/>
                <label for="attachment_for_question">Add Reference for this Question : (Not Required)</label>
                <input type="file" name="attachment_for_question" id="attachment_for_question" value="Attach a Photo for any reference" accept="image/*" title="Add Reference for this Question" />
                <label>Select Type of this Question :
                <select name="type_of_question" class="questiontype" title="Select Type of this Question">
                    <option title="MCQs" value="mcq">MCQs</option>
                    <option title="Short Answer" value="short">Short Answer</option>
                    <option title="Long Answer" value="long">Long Answer</option>
                </select></label>
            </div>
            <div class="make-quiz">
                <label for="txt_option1">Write down your Option 1 : </label>
                <input type="text" name="txt_option1" id="txt_option1" placeholder="Option 1" title="Write Option1"/>
                <label for="attachment_option1">Add Reference for Option 1 : (Not Required)</label>
                <input type="file" name="attachment_option1" id="attachment_option1" value="Attach a Photo for any reference" accept="image/*" title="Add Reference for Option1" />
            </div>
            <div class="make-quiz">
                <label for="txt_option2">Write down your Option 2 : </label>
                <input type="text" name="txt_option2" id="txt_option2" placeholder="Option 2" title="Write Option2"/>
                <label for="attachment_option2">Add Reference for Option 2 : (Not Required)</label>
                <input type="file" name="attachment_option2" id="attachment_option2" value="Attach a Photo for any reference" accept="image/*" title="Add Reference for Option2" />
            </div>
            <div class="make-quiz">
                <label for="txt_option3">Write down your Option 3 : </label>
                <input type="text" name="txt_option3" id="txt_option3" placeholder="Option 3" title="Write Option3"/>
                <label for="attachment_option3">Add Reference for Option 3 : (Not Required)</label>
                <input type="file" name="attachment_option3" id="attachment_option3" value="Attach a Photo for any reference" accept="image/*" title="Add Reference for Option3" />
            </div>
            <div class="make-quiz">
                <label for="txt_option4">Write down your Option 4 : </label>
                <input type="text" name="txt_option4" id="txt_option4" placeholder="Option 4" title="Write Option4"/>
                <label for="attachment_option4">Add Reference for Option 4 : (Not Required)</label>
                <input type="file" name="attachment_option4" id="attachment_option4" value="Attach a Photo for any reference" accept="image/*" title="Add Reference for Option4" />
            </div>
            <div class="right-answer">
                <label class="selectRightAnswer">Select Right Answer : 
                <select name="right_answer" title="Select the right answer of this Question" class="selectRightAnswerOption">
                    <option title="1st Option is correct">1</option>
                    <option title="2nd Option is correct">2</option>
                    <option title="3rd Option is correct">3</option>
                    <option title="4th Option is correct">4</option>
                </select></label>
                <label for="points">Enter Points for this Question : </label>
                <input type="number" min="1" name="points" id="points" required placeholder="Points" title="Enter Points for this Question" />
                <label>Is this Question Required ? 
                <select name="is_this_required" title="Is this Question Required ?">
                    <option title="Yes">Yes</option>
                    <option title="No">No</option>
                </select></label>
            </div>
            <div class="themebtn">    
                <input type="reset" class="theme-button" name="btnClear" value="Clear" title="Clear All Entered Data" />
            </div>
            <div class="themebtn">    
                <input type="submit" class="theme-button" name="btnAddQuestion" value="Add Question">
            </div>
        </form>
        <?php
            if(isset($_POST['btnAddQuestion'])){
                // if(isset($_POST['quiz_code'])){
                //     $quiz_code = $_POST['quiz_code'];
                        $quiz = "quiz_".$_SESSION['quiz'];
                //     $_SESSION['quiz'] = $quiz;
                // }
                // if(isset($_POST['password'])){
                //     $password = $_POST['password'];
                // }
                if(isset($_POST['question'])){
                    $question = $_POST['question'];
                }
                if(isset($_POST['attachment_for_question'])){
                    $attachment_for_question = $_POST['attachment_for_question'];
                }
                if(isset($_POST['type_of_question'])){
                    $type_of_question = $_POST['type_of_question'];
                }
                if(isset($_POST['txt_option1'])){
                    $txt_option1 = $_POST['txt_option1'];
                }
                if(isset($_POST['attachment_option1'])){
                    $attachment_option1 = $_POST['attachment_option1'];
                }
                if(isset($_POST['right_answer'])){
                    $right_answer = $_POST['right_answer'];
                }
                if(isset($_POST['txt_option2'])){
                    $txt_option2 = $_POST['txt_option2'];
                }
                if(isset($_POST['attachment_option2'])){
                    $attachment_option2 = $_POST['attachment_option2'];
                }
                if(isset($_POST['txt_option3'])){
                    $txt_option3 = $_POST['txt_option3'];
                }
                if(isset($_POST['attachment_option3'])){
                    $attachment_option3 = $_POST['attachment_option3'];
                }
                if(isset($_POST['txt_option4'])){
                    $txt_option4 = $_POST['txt_option4'];
                }
                if(isset($_POST['attachment_option4'])){
                    $attachment_option4 = $_POST['attachment_option4'];
                }
                if(isset($_POST['points'])){
                    $points = $_POST['points'];
                }
                if(isset($_POST['is_this_required'])){
                    $is_this_required = $_POST['is_this_required'];
                }
                $con = mysqli_connect("localhost","root","","quiz_maker");
                if($con){       
                    // $user_name = $_SESSION['user_name'];
                    // $sql = "SELECT `CREATOR_ID` FROM `registered_quiz` WHERE QUIZ_CODE='$quiz_code'";
                    // $creator = mysqli_query($con,$sql);
                    // while($row = mysqli_fetch_array($creator)){
                    //     $creator_id = $row['CREATOR_ID'];
                    // }
                    // $sql = "SELECT password FROM user_details WHERE user_id='$user_name'";
                    // $result = mysqli_query($con,$sql);
                    // while($row = mysqli_fetch_array($result)){
                    //     $row_password = $row['password'];
                    // }
                    // if($user_name==$creator_id && password_verify($password,$row_password)){
                    $sql = "INSERT INTO $quiz (`QUESTION`,`QUE_TYPE`, `OPTION_A`,`ATTCH_A`,`OPTION_B`,`ATTCH_B`, `OPTION_C`,`ATTCH_C`, `OPTION_D`,`ATTCH_D`, `CORRECT_ANS`, `POINT`, `MEDIA_FILE`, `IS_REQUIRED`) VALUES ('$question','$type_of_question','$txt_option1','$attachment_option1','$txt_option2','$attachment_option2','$txt_option3','$attachment_option3','$txt_option4','$attachment_option4','$right_answer','$points','$attachment_for_question','$is_this_required')";
                    mysqli_query($con,$sql);
                    include("errorpopup.php");
                    // }
                    // elseif($user_name<>$creator_id){
                    //     echo "<p class='error'>Error : You can't add questions in this quiz...<br>Only Creator of quiz can add new questions...</p>";
                    // }
                    // else{
                    // echo "<p class='error'>Error : Invalid Password...<br>Please try again....</p>";
                    // }
                }
            }
        ?>
    </main>
    <?php
        $quiz_code = $_SESSION['quiz'];
        $quiz = 'quiz_'.$quiz_code;
        echo "<div class='make-quiz'>
        <table class='show_questions'>
            <caption>Questions Added in Quiz : ".$quiz_code."</caption>
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Points</th>
            </tr>
        ";
        $con = mysqli_connect("localhost","root","","quiz_maker");
        if($con){
            $sql = "SELECT * FROM $quiz";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".$row['SR_NO']."</td>";
                    echo "<td>".$row['QUESTION']."</td>";
                    if($row['QUE_TYPE']=="mcq"){
                        if($row['OPTION_A'] <> NULL){
                            echo "<td>".$row['OPTION_A']."</td>";                   
                        }else{
                            echo "<td><img style='width:12em;height:20em;' src='Uploads/".$row['ATTCH_A']."' alt='Option 1'></td>";
                            // echo "img src='",$row['filename'],"' width='175' height='200' />";
                        }
                        if($row['OPTION_B'] <> NULL){
                            echo "<td>".$row['OPTION_B']."</td>";                   
                        }else{
                            echo "<td><img style='width:12em;height:20em;' src='Uploads/".$row['ATTCH_B']."' alt='Option 2'></td>";
                        }
                        if($row['OPTION_C'] <> NULL){
                            echo "<td>".$row['OPTION_C']."</td>";                   
                        }else{
                            echo "<td><img style='width:12em;height:20em;' src='Uploads/".$row['ATTCH_C']."' alt='Option 3'></td>";
                        }
                        if($row['OPTION_D'] <> NULL){
                            echo "<td>".$row['OPTION_D']."</td>";                   
                        }else{
                            echo "<td><img style='width:12em;height:20em;' src='Uploads/".$row['ATTCH_D']."' alt='Option 4'></td>";
                        }
                    }
                    elseif($row['QUE_TYPE']=="short"){
                        echo '<td colspan="4">Short Question</td>';
                    }
                    else{
                        echo '<td colspan="4">Long Question</td>';                 
                    }
                    echo "<td>".$row['POINT']."</td></tr>";
                }
            }
            else{
                echo '<tr><td colspan="7">No Questions found...</td></tr>';
            }
            echo "</table></div>";
        }
    ?>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/checkquestiontype.js"></script>
</body>
</html>