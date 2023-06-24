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
    <title>Admin Panel - Check Database</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $sql = 'show TABLES where Tables_in_quiz_maker="admin_info" or Tables_in_quiz_maker="admin_log_in" or Tables_in_quiz_maker="log_in" or Tables_in_quiz_maker="registered_quiz" or Tables_in_quiz_maker="responses" or Tables_in_quiz_maker="user_details"';
                // Tables_in_quiz_maker="quiz_details" or Tables_in_quiz_maker="contact_us" or Tables_in_quiz_maker="feedback" or Tables_in_quiz_maker="quiz_result" or or Tables_in_quiz_maker="tncs" or Tables_in_quiz_maker="faqs" or Tables_in_quiz_maker="quiz_template" 
                $result = mysqli_query($con,$sql);
                echo '
                <table class="data">
                    <caption>Database</caption>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Tables</th>
                        <th>View Table</th>
                    </tr>';
                    $count = 1;
                while($row = mysqli_fetch_array($result)){
                    echo '
                    <tr>
                        <td class="serial">'.$count.'</td>
                        <td>'.$row['Tables_in_quiz_maker'].'</td>
                        <td><a href="admin_view_db_table.php?view='.$row['Tables_in_quiz_maker'].'" class="table">View Table</a></td>
                    </tr>
                    ';
                    $count += 1;
                }
                echo '
                </table>';
            }
        ?>
    </main>

    <?php include "footer.php"; ?>
    <script src="../js/menu.js"></script>
</body>
</html>