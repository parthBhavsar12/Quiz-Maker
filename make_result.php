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
    <link rel="stylesheet" href="css/table.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Feedback form</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
    <?php
        $quiz_code = $_SESSION['quiz_code'];
        $quiz = "quiz_".$quiz_code;
        echo '<p style="font-weight: bold; margin: 1em; padding: 1em; background-color: #bfd691; text-align: center;">Dear User, Your responses have been submitted successfully...</p>
        <table>
        <caption>Quiz Code : '.$quiz_code.'</caption>
        <tr><th>Attended Question Sr. No.</th><th>Selected Option</th><th>Correct Option</th><th>Point(s)</th><th>Correct/Incorrect ?</th></tr>';
        $responses = $_POST;
        $correct_option = '';
        $obtained_points = 0;
        array_pop($responses);
        $con = mysqli_connect("localhost","root","","quiz_maker");
        if($con){
            foreach($responses as $key => $value){
                $sql = "SELECT CORRECT_ANS,POINT,QUE_TYPE,SUM(POINT) FROM $quiz WHERE SR_NO='".substr($key,15)."'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
                echo '<tr><td>';
                echo substr($key,15);
                echo '</td><td>';
                echo $value;
                // $correct_option = 'correct_option'.substr($key,15);
                // echo '</td><td>'.$_POST[$correct_option].'</td><td>-</td></tr>';
                echo '</td><td>'.$row['CORRECT_ANS'].'</td><td>'.$row['POINT'].'</td>';
                if($row['QUE_TYPE'] == "MCQs"){
                    if($row['CORRECT_ANS'] == $value){
                        echo "<td style='color: green; font-weight: bold;'>Correct</td>";
                        $obtained_points += $row['POINT'];
                    }
                    else{
                        echo "<td style='color: red; font-weight: bold;'>Incorrect</td>";
                    }
                }
                else{
                    echo "<td>-</td>";
                }
                echo '</tr>';
            }
            $sql = "SELECT SUM(POINT) FROM $quiz WHERE QUE_TYPE='MCQs'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $total_points = $row['SUM(POINT)'];
            echo '<tr><th colspan="3">Total Obtained Points (MCQs Only) : </th><th colspan="2">'. $obtained_points.'/'.$total_points.'</th></tr>';
            $sql = "SELECT SUM(POINT) FROM $quiz";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $t_points = $row['SUM(POINT)'];
            echo '<tr><th colspan="3">Descriptive Points Possible : </th><th colspan="2">'.($t_points-$total_points).'</th></tr></table>';
            $var_responses = '';
            foreach($responses as $key => $value){
                $var_responses = $var_responses.' Que. '.substr($key,15).' - Ans. '.$value.' | ';
            }
            $sql = "SELECT SUM(POINT) FROM $quiz";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $total_points = $row['SUM(POINT)'];
            $user_name = $_SESSION['user_name'];      
            $sql = "INSERT INTO `responses`(`ATTENDEE_ID`, `QUIZ_CODE`, `RESPONSE`, `TOTAL_POINTS`,`OBTAINED_POINTS`) VALUES ('$user_name','$quiz_code','$var_responses','$total_points','$obtained_points')";
            mysqli_query($con,$sql);
        }
    ?>
    </main>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>