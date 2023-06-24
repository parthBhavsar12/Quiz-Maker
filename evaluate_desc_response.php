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
    <link rel="stylesheet" href="css/makequiz.css">
    <link rel="stylesheet" href="css/homescreen.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/evaluatequestion.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Evaluate Desciptive Responses</title>
    <style>
        table{
            width: 100% !important;
        }
    </style>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php      
            if(isset($_SESSION['attendee'])){
                $attendee = $_SESSION['attendee'];
            }
            if(isset($_SESSION['response'])){
                $response = $_SESSION['response'];
            }
            if(isset($_SESSION['time'])){
                $time = $_SESSION['time'];
            }
            if(isset($_SESSION['quiz'])){
                $quiz_code = $_SESSION['quiz'];
                $quiz = 'quiz_'.$_SESSION['quiz'];
            }
            echo '<h2>Checking Desciptive Responses from Quiz : '.$quiz_code.'</h2>';              
            echo '<div class="make-quiz">
            <table>                     
                <tr>
                    <th>ATTENDEE_ID</th>
                    <th>RESPONSE</th>
                    <th>TIME</th>
                </tr>
                <tr>
                    <td>'.$attendee.'</td>
                    <td style="text-align:justify;">'.$response.'</td>
                    <td>'.$time.'</td>
                </tr>
            </table>';
        ?>
        <!-- <form action=" echo $_SERVER['PHP_SELF']?>" method="post"> -->
        <form action="check_responses.php" method="post">
            <?php
                $con = mysqli_connect("localhost","root","","quiz_maker");
                if($con){
                    $sql = "SELECT `SR_NO`, `QUESTION`, `POINT` FROM ".$quiz." WHERE QUE_TYPE!='MCQs'";
                    $result1 = mysqli_query($con,$sql);                      
                    echo '<table>
                            <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Points</th>
                            <th>Evaluate Response</th>
                        </tr>';
                    if(mysqli_num_rows($result1)>0){
                        while($row1=mysqli_fetch_array($result1)){
                            $sr_no = $row1['SR_NO'];
                            $point = $row1['POINT'];
                            echo '<tr>
                                    <td>'.$sr_no.'</td>
                                    <td>'.$row1['QUESTION'].'</td>
                                    <td>'.$point.'</td>
                                    <td><input style="width: 100px;" type="number" min="0" max='.$point.' name="desc_total'.$sr_no.'" placeholder="Points" required/></td>
                                </tr>';
                        }
                    }
                    else{
                        echo '<tr><td colspan="4">No Descriptive Questions found...</td></tr>';
                    }
                    echo '</table></div>';
                }
            ?>
            <input type="submit" name="btnEvalSave" class="themebtn" id="evaluateBtn" value="SAVE"/>
            <!-- <a href="#evaluatequestion" name="btnEvalSave" class="themebtn" id="evaluateBtn">Save</a> -->
        </form>
    </main>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
     <!-- include "evaluatepopup.php"; ?> -->
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>
<?php
    // if(isset($_POST['btnEvalSave'])){
    //     // print_r($_POST);
    //     $eval_points = $_POST;
    //     array_pop($eval_points);
    //     // print_r($eval_points);
    //     $temp = '';
    //     $point_arr = array();
    //     foreach($eval_points as $key=>$val){
    //         $temp = $temp.' Que. '.substr($key,10).' - Point. '.$val.' | ';
    //         array_push($point_arr,$val);
    //     }
    //     // echo '<br>'.$temp;
    //     // echo '<br>';
    //     // echo '<br>';
    //     // echo '<br>';
    //     // print_r($point_arr);echo '<br>';
    //     // echo '<br>';
    //     // echo '<br>';
    //     $sum_of_points = 0;
    //     foreach($point_arr as $val){
    //         $sum_of_points += $val;
    //     }
    //     // echo $sum_of_points;
    //     // echo '<br>';
    //     // echo '<br>';
    //     // echo '<br>';
    //     $con = mysqli_connect("localhost","root","","quiz_maker");
    //     if($con){
    //         if(isset($_SESSION['attendee'])){
    //             $attendee = $_SESSION['attendee'];
    //         }
    //         if(isset($_SESSION['response'])){
    //             $response = $_SESSION['response'];
    //             // $response = str_replace('>','',$response);
    //         }
    //         if(isset($_SESSION['time'])){
    //             $time = $_SESSION['time'];
    //         }
    //         if(isset($_SESSION['quiz'])){
    //             $quiz_code = $_SESSION['quiz'];
    //         }
    //         // UPDATE `responses` SET `ATTENDEE_ID`=[value-1],`QUIZ_CODE`=[value-2],`RESPONSE`=[value-3],`TIME`=[value-4],`TOTAL_POINTS`=[value-5],`OBTAINED_POINTS`=[value-6],`DESC_EVALUATION`=[value-7],`DESC_POINT`=[value-8] WHERE 1
    //         $sql = "UPDATE `responses` SET `DESC_EVALUATION`='".$temp."',`DESC_POINT`=".$sum_of_points." WHERE ATTENDEE_ID='".$attendee."' AND RESPONSE='".$response."' AND TIME='".$time."' AND QUIZ_CODE='".$quiz_code."'";
    //         mysqli_query($con,$sql);
    //         // echo $sql;
    //     }            
    // }
// ?>