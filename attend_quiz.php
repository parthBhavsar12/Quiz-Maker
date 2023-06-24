<?php
    include "session_start.php";
    if(isset($_POST['next'])){
        if(isset($_POST['quiz_code'])){
            $quiz_code = $_POST['quiz_code'];
            $quiz = "quiz_".$quiz_code;
            $_SESSION['quiz_code'] = $quiz_code;
        }
        $con = mysqli_connect("localhost","root","","quiz_maker");
        if($con){
            $sql = "SELECT count(QUIZ_CODE) as 'count' FROM `registered_quiz` WHERE QUIZ_CODE='".$quiz_code."'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $count = $row['count'];
            if(!$count){
                include "errorpopup.php";
                // echo '<p class="error">Quiz is not found...<br>Enter valid Quiz Code...</p>';
            }
            else{
                $sql = "SELECT * FROM registered_quiz where QUIZ_CODE='".$quiz_code."'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
                $quiz_desc = $row['QUIZ_DESC'];
                $scheduled_time = $row['SCHEDULED_TIME'];
                $quiz_level = $row['QUIZ_LEVEL'];
    
                $sql = "SELECT sum(point) as 'total_points' FROM $quiz";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
                $total_points = $row['total_points'];
            }
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
    <title>Attend Quiz</title>
    <style>
        table{
            width: 70% !important;
            margin: 20px auto;
        }
        td,th{
            padding: 5px !important;
        }
        span.star{
            font-weight: bold;
            color: red;
        }
        td.star{
            text-align: right;
            /* padding: 10px; */
            font-weight: bold;
            border: none !important;
        }
        p.red{
            /* padding: 10px; */
            font-size: 30px;
            font-weight: bold;
            color: red;
        }
        td.left{
            width: 5em !important;
            text-align: left;
            padding-left: 20px !important;
        }
        table tr td{
            padding: 5px !important;
        }
        td.que,td.desc{
            text-align: left;
        }
        td.right{
            width: 7em;
        }
        input[type="text"],textarea{
            width: 100% !important;
            margin: 0 !important;
        }
        /* .submit-quiz{
            width: 600px;
        } */
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if(isset($_POST['quiz_code'])){
                $quiz_code = $_POST['quiz_code'];            
                $sql = "SELECT count(QUIZ_CODE) as 'count' FROM `registered_quiz` WHERE QUIZ_CODE='".$quiz_code."'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
            }
            $count = $row['count'];
            if($con && $count){
                echo '
                <h2>Attend Quiz</h2>
                <table>
                    <tr>
                        <td class="desc" colspan="2">
                            QUIZ : '.$quiz_code;
                            $_SESSION['quiz_code'] = $quiz_code;
                        echo '</td>
                    </tr>
                    <tr>
                        <td class="desc" colspan="2">
                            QUIZ DESCRIPTION : '.$quiz_desc.'
                        </td>
                    </tr>
                    <tr>
                        <td class="desc">
                            SCHEDULED TIME : '.$scheduled_time.'
                        </td>
                        <td class="desc">
                            QUIZ LEVEL : '.$quiz_level.'
                        </td>
                    </tr>
                    <tr>
                        <td class="star" colspan="2">
                            <span class="star">* Required | Total Possible Points : ';
                            if($total_points){
                                echo $total_points;
                            }
                            else{
                                echo 0;
                            }
                        echo '</span>
                        </td>
                    </tr>
                </table>';
            }
        ?>
        <!-- <form method="post" action="">
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
                <button type="submit" class="save" name="btnSave"><a class="primary-button">Save</a></button>
            </div>
        </form> -->
        <form method="post" action="make_result.php">
            <?php
                $is_required = '';
                $con = mysqli_connect("localhost","root","","quiz_maker");
                $sql = "select now() as 'now'";
                $result = mysqli_query($con,$sql);
                $now = mysqli_fetch_array($result);
                $sql = "SELECT `SCHEDULED_TIME` FROM `registered_quiz` WHERE QUIZ_CODE='$quiz_code'";
                $result = mysqli_query($con,$sql);
                $sch_time = mysqli_fetch_array($result);
                $sql = "SELECT `MODE` FROM `registered_quiz` WHERE QUIZ_CODE='$quiz_code'";
                $result = mysqli_query($con,$sql);
                $mode = mysqli_fetch_array($result);
                $sql = "SELECT `LIMIT` FROM `registered_quiz` WHERE QUIZ_CODE='$quiz_code'";
                $result1 = mysqli_query($con,$sql);
                $limit = mysqli_fetch_array($result1);
                $user = $_SESSION['user_name'];
                if(isset($limit['LIMIT']) == "Single"){
                    $sql = "SELECT * FROM `responses` WHERE QUIZ_CODE='$quiz_code' AND ATTENDEE_ID='$user'";
                    // echo $sql;
                    $result2 = mysqli_query($con,$sql);
                    $check_limit = mysqli_fetch_array($result2);
                    // echo $check_limit;
                    if($check_limit == 0){
                        $sql = "SELECT *,LENGTH(MEDIA_FILE) as 'length' FROM $quiz";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_array($result)){
                                if($row['IS_REQUIRED']=="Yes"){
                                    $is_required = "true";
                                }
                                else{
                                    $is_required = "false";
                                }
                                $point = $row['POINT'];

                                $selected_opt = 'selected_option'.$row['SR_NO'];
                                // $correct_opt = 'correct_option'.$row['SR_NO'];
                                echo '
                                <table class="quiz">
                                <tr>
                                    <td class="left">#'.$row['SR_NO'].'</td>';
                                    if($is_required == "true"){
                                        echo '<td class="que"><span class="star">*</span> '.$row['QUESTION'];
                                        if($row['length']>0){
                                            echo "<img style='width:12em;height:20em;' src='Uploads/".$row['MEDIA_FILE']."' alt='Option 1'>";
                                        }
                                        echo '</td>';
                                    }
                                    else{
                                        echo '<td class="que">'.$row['QUESTION'];
                                        if($row['length']>0){
                                            echo "<img style='width:12em;height:20em;' src='Uploads/".$row['MEDIA_FILE']."' alt='Option 1'>";
                                        }
                                        echo '</td>';
                                    }
                                echo '<td class="right">' .$point.' Point(s)</td></tr>';
                                if($row['QUE_TYPE']=="MCQs"){
                                    if($row['OPTION_A'] <> NULL){
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1" id="'.$selected_opt.'1" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'1">'.$row['OPTION_A']."</label></td></tr>";                   
                                    }else{
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1"  id="'.$selected_opt.'1" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'1"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_A'].'" alt="Option 1"></label></td></tr>';
                                    }
                                    if($row['OPTION_B'] <> NULL){
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2"  id="'.$selected_opt.'2" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'2">'.$row['OPTION_B']."</label></td></tr>";                   
                                    }else{
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2" id="'.$selected_opt.'2" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'2"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_B'].'" alt="Option 2"></label></td></tr>';
                                    }
                                    if($row['OPTION_C'] <> NULL){
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'3">'.$row['OPTION_C']."</label></td></tr>";                   
                                    }else{
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'3"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_C'].'" alt="Option 3"></label></td></tr>';
                                    }
                                    if($row['OPTION_D'] <> NULL){
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'4">'.$row['OPTION_D']."</label></td></tr>";                   
                                    }else{
                                        echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/>
                                        <td colspan="2" class="left"><label for="'.$selected_opt.'4"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_D'].'" alt="Option 4"></label></td></tr>';
                                    }
                                    // echo '<input type="hidden" name='.$correct_opt.' value="'.$row['CORRECT_ANS'].'"/>';
                                }
                                elseif($row['QUE_TYPE']=="Short Answer"){
                                    echo '<tr><td colspan="3"><input type="text" name='.$selected_opt.' placeholder="Type your Answer here..." ';
                                    if($is_required == "true"){
                                        echo 'required='.$is_required; 
                                        
                                    }echo '/></td></tr>';
                                    // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                }
                                else{
                                    echo '<tr><td colspan="3"><textarea name='.$selected_opt.' placeholder="Type your Answer here..." rows="5" ';
                                    if($is_required == "true"){
                                        echo 'required='.$is_required; 
                                        
                                    }echo '></textarea></td></tr>';
                                    // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                }
                                echo '</table>';
                            }
                            echo '<div style="text-align: center;" class="validation">
                            <input type="submit" name="btnSubmit" value="SUBMIT" title="Submit your Responses" class="submit-quiz"/>
                            <input type="reset" value="CLEAR" title="Reset the Quiz Form" class="submit-quiz"/>
                            </div>';
                        }
                        elseif(mysqli_num_rows($result)==0){
                            include "errorpopup.php";
                            // echo '<p class="error">No Questions Found</p>';
                        }                       
                    }
                    else{
                        echo '<p>You can attend this quiz only once...</p>';
                    } 
                    // include "errorpopup.php";
                    // echo '<p class="error">Quiz is turned Off by Quiz Creator...<br>You can\'t attend it...</p>';
                }
                if(isset($mode['MODE']) && $mode['MODE'] == "OFF"){
                    include "errorpopup.php";
                    // echo '<p class="error">Quiz is turned Off by Quiz Creator...<br>You can\'t attend it...</p>';
                }
                elseif($con && $count){
                    if($sch_time['SCHEDULED_TIME'] <> '0000-00-00 00:00:00' && $count){
                        if($now['now'] < $sch_time['SCHEDULED_TIME']){
                            include "errorpopup.php";
                            // echo '<p class="error">Quiz is scheduled at '.$sch_time['SCHEDULED_TIME'].',<br>You can\'t attend it now...</p>';
                        }
                        else{
                            $sql = "SELECT *,LENGTH(MEDIA_FILE) as 'length' FROM $quiz";
                            $result = mysqli_query($con,$sql);
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    if($row['IS_REQUIRED']=="Yes"){
                                        $is_required = "true";
                                    }
                                    else{
                                        $is_required = "false";
                                    }
                                    $point = $row['POINT'];
    
                                    $selected_opt = 'selected_option'.$row['SR_NO'];
                                    // $correct_opt = 'correct_option'.$row['SR_NO'];
                                    echo '
                                    <table class="quiz">
                                    <tr>
                                        <td class="left">#'.$row['SR_NO'].'</td>';
                                        if($is_required == "true"){
                                            echo '<td class="que"><span class="star">*</span> '.$row['QUESTION'];
                                            if($row['length']>0){
                                                echo "<img style='width:12em;height:20em;' src='Uploads/".$row['MEDIA_FILE']."' alt='Option 1'>";
                                            }
                                            echo '</td>';
                                        }
                                        else{
                                            echo '<td class="que">'.$row['QUESTION'];
                                            if($row['length']>0){
                                                echo "<img style='width:12em;height:20em;' src='Uploads/".$row['MEDIA_FILE']."' alt='Option 1'>";
                                            }
                                            echo '</td>';
                                        }
                                    echo '<td class="right">' .$point.' Point(s)</td></tr>';
                                    if($row['QUE_TYPE']=="MCQs"){
                                        if($row['OPTION_A'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1" id="'.$selected_opt.'1" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'1">'.$row['OPTION_A']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1"  id="'.$selected_opt.'1" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'1"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_A'].'" alt="Option 1"></label></td></tr>';
                                        }
                                        if($row['OPTION_B'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2"  id="'.$selected_opt.'2" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'2">'.$row['OPTION_B']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2" id="'.$selected_opt.'2" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'2"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_B'].'" alt="Option 2"></label></td></tr>';
                                        }
                                        if($row['OPTION_C'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'3">'.$row['OPTION_C']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'3"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_C'].'" alt="Option 3"></label></td></tr>';
                                        }
                                        if($row['OPTION_D'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'4">'.$row['OPTION_D']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'4"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_D'].'" alt="Option 4"></label></td></tr>';
                                        }
                                        // echo '<input type="hidden" name='.$correct_opt.' value="'.$row['CORRECT_ANS'].'"/>';
                                    }
                                    elseif($row['QUE_TYPE']=="Short Answer"){
                                        echo '<tr><td colspan="3"><input type="text" name='.$selected_opt.' placeholder="Type your Answer here..." ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/></td></tr>';
                                        // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                    }
                                    else{
                                        echo '<tr><td colspan="3"><textarea name='.$selected_opt.' placeholder="Type your Answer here..." rows="5" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '></textarea></td></tr>';
                                        // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                    }
                                    echo '</table>';
                                }
                                echo '<div style="text-align: center;" class="validation">
                                <input type="submit" name="btnSubmit" value="SUBMIT" title="Submit your Responses" class="submit-quiz"/>
                                <input type="reset" value="CLEAR" title="Reset the Quiz Form" class="submit-quiz"/>
                                </div>';
                            }
                            elseif(mysqli_num_rows($result)==0){
                                include "errorpopup.php";
                                // echo '<p class="error">No Questions Found</p>';
                            }
                        }                  
                    }elseif($sch_time['SCHEDULED_TIME'] == '0000-00-00 00:00:00' && $count){
                        $sql = "SELECT * FROM $quiz";
                            $result = mysqli_query($con,$sql);
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_array($result)){
                                    if($row['IS_REQUIRED']=="Yes"){
                                        $is_required = "true";
                                    }
                                    else{
                                        $is_required = "false";
                                    }
                                    $point = $row['POINT'];
    
                                    $selected_opt = 'selected_option'.$row['SR_NO'];
                                    // $correct_opt = 'correct_option'.$row['SR_NO'];
                                    echo '
                                    <table class="quiz">
                                    <tr>
                                        <td class="left">#'.$row['SR_NO'].'</td>';
                                        if($is_required == "true"){
                                            echo '<td class="que"><span class="star">*</span> '.$row['QUESTION']. '</td>';
                                        }
                                        else{
                                            echo '<td class="que">'.$row['QUESTION']. '</td>';
                                        }
                                    echo '<td class="right">' .$point.' Point(s)</td></tr>';
                                    if($row['QUE_TYPE']=="MCQs"){
                                        if($row['OPTION_A'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1" id="'.$selected_opt.'1" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'1">'.$row['OPTION_A']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="1"  id="'.$selected_opt.'1" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'1"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_A'].'" alt="Option 1"></label></td></tr>';
                                        }
                                        if($row['OPTION_B'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2"  id="'.$selected_opt.'2" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'2">'.$row['OPTION_B']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="2" id="'.$selected_opt.'2" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'2"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_B'].'" alt="Option 2"></label></td></tr>';
                                        }
                                        if($row['OPTION_C'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'3">'.$row['OPTION_C']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="3" id="'.$selected_opt.'3" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'3"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_C'].'" alt="Option 3"></label></td></tr>';
                                        }
                                        if($row['OPTION_D'] <> NULL){
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'4">'.$row['OPTION_D']."</label></td></tr>";                   
                                        }else{
                                            echo '<tr><td class="left"><input type="radio" name='.$selected_opt.' value="4" id="'.$selected_opt.'4" ';
                                            if($is_required == "true"){
                                                echo 'required='.$is_required; 
                                                
                                            }echo '/>
                                            <td colspan="2" class="left"><label for="'.$selected_opt.'4"><img style="width:12em;height:20em;" src="Uploads/'.$row['ATTCH_D'].'" alt="Option 4"></label></td></tr>';
                                        }
                                        // echo '<input type="hidden" name='.$correct_opt.' value="'.$row['CORRECT_ANS'].'"/>';
                                    }
                                    elseif($row['QUE_TYPE']=="Short Answer"){
                                        echo '<tr><td colspan="3"><input type="text" name='.$selected_opt.' placeholder="Type your Answer here..." ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '/></td></tr>';
                                        // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                    }
                                    else{
                                        echo '<tr><td colspan="3"><textarea name='.$selected_opt.' placeholder="Type your Answer here..." rows="5" ';
                                        if($is_required == "true"){
                                            echo 'required='.$is_required; 
                                            
                                        }echo '></textarea></td></tr>';
                                        // echo '<input type="hidden" name='.$correct_opt.' value="-"/>';
                                    }
                                    echo '</table>';
                                }
                                echo '<div style="text-align: center;" class="validation">
                                <input type="submit" name="btnSubmit" value="SUBMIT" title="Submit your Responses" class="submit-quiz"/>
                                <input type="reset" value="CLEAR" title="Reset the Quiz Form" class="submit-quiz"/>
                                </div>';
                            }
                            elseif(mysqli_num_rows($result)==0){
                                include "errorpopup.php";
                                // echo '<p class="error">No Questions Found</p>';
                            }
                    }
                }
            ?>
            <a href="homepage.php" class="primary-button">EXIT</a>
        </form>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>