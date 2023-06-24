<?php
    include "session_start.php";
?>
<?php
    if(isset($_POST['btnEvalSave'])){
        // print_r($_POST);
        $eval_points = $_POST;
        array_pop($eval_points);
        // print_r($eval_points);
        $temp = '';
        $point_arr = array();
        foreach($eval_points as $key=>$val){
            $temp = $temp.' Que. '.substr($key,10).' - Point. '.$val.' | ';
            array_push($point_arr,$val);
        }
        // echo '<br>'.$temp;
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // print_r($point_arr);echo '<br>';
        // echo '<br>';
        // echo '<br>';
        $sum_of_points = 0;
        foreach($point_arr as $val){
            $sum_of_points += $val;
        }
        // echo $sum_of_points;
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        $con = mysqli_connect("localhost","root","","quiz_maker");
        if($con){
            if(isset($_SESSION['attendee'])){
                $attendee = $_SESSION['attendee'];
            }
            if(isset($_SESSION['response'])){
                $response = $_SESSION['response'];
                // $response = str_replace('>','',$response);
            }
            if(isset($_SESSION['time'])){
                $time = $_SESSION['time'];
            }
            if(isset($_SESSION['quiz'])){
                $quiz_code = $_SESSION['quiz'];
            }
            // UPDATE `responses` SET `ATTENDEE_ID`=[value-1],`QUIZ_CODE`=[value-2],`RESPONSE`=[value-3],`TIME`=[value-4],`TOTAL_POINTS`=[value-5],`OBTAINED_POINTS`=[value-6],`DESC_EVALUATION`=[value-7],`DESC_POINT`=[value-8] WHERE 1
            $sql = "UPDATE `responses` SET `DESC_EVALUATION`='".$temp."',`DESC_POINT`=".$sum_of_points." WHERE ATTENDEE_ID='".$attendee."' AND RESPONSE='".$response."' AND TIME='".$time."' AND QUIZ_CODE='".$quiz_code."'";
            mysqli_query($con,$sql);
            // echo $sql;
        }            
    }
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
    <link rel="stylesheet" href="css/table.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Check Responses of Your Quiz</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php
            if(isset($_SESSION['quiz'])){
                $quiz_code = $_SESSION['quiz'];
            }
            if(isset($_POST['btnCheckResponses'])){
                if(isset($_POST['quiz'])){
                    $quiz_code = $_POST['quiz'];
                }
            }
            $user_name = $_SESSION['user_name'];
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                echo '
                <table class="check_responses">
                <caption>Checking Responses from Quiz : '.$quiz_code.'</caption>
                <tr>
                    <th>ATTENDEE_ID</th>
                    <th>QUIZ CODE</th>
                    <th>RESPONSE</th>
                    <th>DESCRIPTIVE EVALUATION</th>
                    <th>TIME</th>
                    <th>TOTAL POSSIBLE POINTS</th>
                    <th>OBTAINED POINTS (MCQs Only)</th>
                    <th>DESCRIPTIVE POINTS</th>
                    <th>TOTAL OBTAINED POINTS</th>
                </tr>
                ';
                $sql = "SELECT * FROM `responses` WHERE QUIZ_CODE='$quiz_code'";
                $result = mysqli_query($con,$sql);
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['ATTENDEE_ID'].'</td>
                            <td>'.$row['QUIZ_CODE'].'</td>
                            <td style="text-align:justify;">'.$row['RESPONSE'].'</td>
                            <td>'.$row['DESC_EVALUATION'].'</td>
                            <td>'.$row['TIME'].'</td>
                            <td>'.$row['TOTAL_POINTS'].'</td>
                            <td>'.$row['OBTAINED_POINTS'].'</td>';
                            if($row['DESC_EVALUATION']=='-'){
                                $_SESSION['attendee'] = $row['ATTENDEE_ID'];
                                $_SESSION['response'] = $row['RESPONSE'];
                                $_SESSION['time'] = $row['TIME'];
                                $_SESSION['quiz'] = $row['QUIZ_CODE'];
                                echo '<td><a href="evaluate_desc_response.php">Evaluate</a></td>';
                            }
                            else{
                                echo '<td>'.$row['DESC_POINT'].'</td>';
                            }
                            echo '<td>'.$row['OBTAINED_POINTS']+$row['DESC_POINT'].'</td>
                            </tr>';
                        if(isset($_POST['btnSave'])){
                            if(isset($_POST['desc_eval'])){
                                $desc_eval = $_POST['desc_eval'];
                            }
                            if(isset($_POST['desc_total'])){
                                $desc_total = $_POST['desc_total'];
                            }
                            $time = $row['TIME'];
                            $user_name = $_SESSION['user_name'];
                            // echo '<td>'.$sql.'</td>';
                            $con = mysqli_connect("localhost","root","","quiz_maker");
                            $sql = "UPDATE responses SET `DESC_EVALUATION`='$desc_eval',`DESC_POINT`='$desc_total' WHERE QUIZ_CODE='$quiz_code' AND ATTENDEE_ID='$user_name' AND TIME='$time'";
                            mysqli_query($con,$sql);
                            header("Location:homepage.php");
                        }
                    }
                }
                else{
                    echo '<tr><td colspan="9">No Responses found...</td></tr>';
                }
                echo '</table>';
            }
        ?>
    </main>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>