<?php
    if(isset($_GET['quiz'])){
        $quiz = $_GET['quiz'];
    }
    echo $quiz;
    $con = mysqli_connect("localhost","root","","quiz_maker");
    if($con){   
        $sql = "SELECT `MODE` FROM `registered_quiz` WHERE QUIZ_CODE='$quiz'";
        $result = mysqli_query($con,$sql);
        $mode = mysqli_fetch_array($result);
        if($mode['MODE'] == "ON"){
            $r_mode = "OFF";
        }
        elseif($mode['MODE'] == "OFF"){
            $r_mode = "ON";
        }
        $sql = "UPDATE `registered_quiz` SET `MODE`='$r_mode' WHERE QUIZ_CODE='$quiz'";
        mysqli_query($con,$sql);
    }
    header("Location: homepage.php");
?>