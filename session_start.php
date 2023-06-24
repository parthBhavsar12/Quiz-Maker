<?php
    session_start();
    if(!isset($_SESSION['user_name']))
    {
        session_destroy();
        header("Location:signin.php");
    }
    // $f_fonts = "Default";
    // $f_theme = "Light";
    // $con = mysqli_connect("localhost","root","","quiz_maker");
    // if($con){
    //     $sql = "SELECT `FONT_STYLE`, `THEME` FROM `quiz_template` WHERE USER_ID='".$_SESSION['user_name']."'";
    //     $result = mysqli_query($con,$sql);
    //     while($row = mysqli_fetch_array($result)){
    //         $f_fonts = $row['FONT_STYLE'];
    //         $f_theme = $row['THEME'];
    //     }
    // }
?>