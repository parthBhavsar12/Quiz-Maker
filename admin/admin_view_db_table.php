<?php
    include "session_start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/attendquiz.css">
    <link rel="stylesheet" href="../css/homescreen.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="icon" href="../Attachments/light_logo.png">
    <title>Admin Panel - View Database Table</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($_GET['view']=="admin_info"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                       <caption>Database Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>Admin Id</th>
                            <th>Admin Password</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['ADMIN_ID'].'</td>
                            <td class="no">********</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            else if($_GET['view']=="admin_log_in"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                        <caption>Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>Admin Id</th>
                            <th>Time</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['ADMIN'].'</td>
                            <td>'.$row['TIME'].'</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            // else if($_GET['view']=="faqs"){
            //     if($con){
            //         $sql = 'SELECT * FROM '.$_GET['view'];
            //         $result = mysqli_query($con,$sql);
            //         echo '
            //         <table class="data">
            //         <caption>Table : '.$_GET['view'].'</caption>
            //             <tr>
            //                 <th>Question</th>
            //                 <th>Answer</th>
            //             </tr>';
            //         while($row = mysqli_fetch_array($result)){
            //             echo '
            //             <tr>
            //                 <td class="justify">'.$row['QUESTION'].'</td>
            //                 <td class="justify">'.$row['ANSWER'].'</td>
            //             </tr>
            //             ';
            //         }
            //         echo '
            //         </table>';
            //     }
            // }
            else if($_GET['view']=="log_in"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                    <caption>Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>User Id</th>
                            <th>Time</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['user'].'</td>
                            <td>'.$row['time'].'</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            // else if($_GET['view']=="quiz_template"){
            //     if($con){
            //         $sql = 'SELECT * FROM '.$_GET['view'];
            //         $result = mysqli_query($con,$sql);
            //         echo '
            //         <table class="data">
            //         <caption>Table : '.$_GET['view'].'</caption>
            //             <tr>
            //                 <th>User Id</th>
            //                 <th>Font Style</th>
            //                 <th>Theme</th>
            //             </tr>';
            //         while($row = mysqli_fetch_array($result)){
            //             echo '
            //             <tr>
            //                 <td>'.$row['USER_ID'].'</td>
            //                 <td>'.$row['FONT_STYLE'].'</td>
            //                 <td>'.$row['THEME'].'</td>
            //             </tr>
            //             ';
            //         }
            //         echo '
            //         </table>';
            //     }
            // }
            else if($_GET['view']=="registered_quiz"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                    <caption>Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>Quiz Code</th>
                            <th>Quiz Description</th>
                            <th>Scheduled Time</th>
                            <th>Quiz Level</th>
                            <th>Creator Id</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['QUIZ_CODE'].'</td>
                            <td>'.$row['QUIZ_DESC'].'</td>
                            <td>'.$row['SCHEDULED_TIME'].'</td>
                            <td>'.$row['QUIZ_LEVEL'].'</td>
                            <td>'.$row['CREATOR_ID'].'</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            else if($_GET['view']=="responses"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                    <caption>Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>Attendee Id</th>
                            <th>Quiz Code</th>
                            <th>Response</th>
                            <th>Time</th>
                            <th>Total Points</th>
                            <th>Obtained Points</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['ATTENDEE_ID'].'</td>
                            <td>'.$row['QUIZ_CODE'].'</td>
                            <td>'.$row['RESPONSE'].'</td>
                            <td>'.$row['TIME'].'</td>
                            <td>'.$row['TOTAL_POINTS'].'</td>
                            <td>'.$row['OBTAINED_POINTS'].'</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            // else if($_GET['view']=="tncs"){
            //     if($con){
            //         $sql = 'SELECT * FROM '.$_GET['view'];
            //         $result = mysqli_query($con,$sql);
            //         echo '
            //         <table class="data">
            //         <caption>Table : '.$_GET['view'].'</caption>
            //             <tr>
            //                 <th>Term</th>
            //                 <th>Condition</th>
            //             </tr>';
            //         while($row = mysqli_fetch_array($result)){
            //             echo '
            //             <tr>
            //                 <td>'.$row['TERM'].'</td>
            //                 <td class="justify">'.$row['CONDITION'].'</td>
            //             </tr>
            //             ';
            //         }
            //         echo '
            //         </table>';
            //     }
            // }
            else if($_GET['view']=="user_details"){
                if($con){
                    $sql = 'SELECT * FROM '.$_GET['view'];
                    $result = mysqli_query($con,$sql);
                    echo '
                    <table class="data">
                    <caption>Table : '.$_GET['view'].'</caption>
                        <tr>
                            <th>User Id</th>
                            <th>Password</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Id</th>
                            <th>Active</th>
                            <th>Joining Date</th>
                        </tr>';
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['USER_ID'].'</td>
                            <td class="no">********</td>
                            <td>'.$row['FIRST_NAME'].'</td>
                            <td>'.$row['LAST_NAME'].'</td>
                            <td>'.$row['EMAIL'].'</td>
                            <td>'.$row['ACTIVE'].'</td>
                            <td>'.$row['joining_date'].'</td>
                        </tr>
                        ';
                    }
                    echo '
                    </table>';
                }
            }
            else{
                echo "<p class='error'>Sorry...There is no such Table stored in Database...!</p>";
            } 
            if(isset($result)){
                if(mysqli_num_rows($result)==0){
                    echo '<p class="error">No Records Found from this Table...</p>';
                }
            }
        ?>
        <!-- <a onclick="history.back()" title="Go Back"><img src="../Attachments/back.jpg"></a> -->
    </main>
    
    <?php include "footer.php"; ?>
    <script src="../js/menu.js"></script>
</body>
</html>