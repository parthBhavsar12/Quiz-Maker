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
    <title>Admin Panel - Check Feedbacks</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <!-- <nav>
            <div class="item"><a href="admin_home.php" title="GO HOME">HOME</a></div>
            <div class="item"><a href="admin_check_feedbacks.php" title="CHECK FEEDBACKS">CHECK FEEDBACKS</a></div>
            <div class="item"><a href="admin_check_contacts.php" title="CHECK CONTACTS">CHECK CONTACTS</a></div>
            <div class="item"><a href="admin_check_database.php" title="CHECK DATABASE">CHECK DATABASE</a></div>
            <div class="item"><a href="admin_block.php" title="BLOCK/UNBLOCK USER">BLOCK/UNBLOCK USER</a></div>
            <div class="item"><a href='admin_login.php?action=logOut' title="GET LOGGED OUT">LOG OUT</a></div>
        </nav> -->

        <?php
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $sql = "SELECT * FROM `feedback`";
                $result = mysqli_query($con,$sql);
                echo '
                <table class="data">
                    <caption>Feedbacks</caption>
                        <tr>
                            <th>Full Name</th>
                            <th>User Id</th>
                            <th>Email Id</th>
                            <th>Ratings</th>
                            <th>Recommendation</th>
                            <th>Experience</th>
                            <th>Message</th>
                            <th>Attachment</th>
                            <th>Time</th>
                        </tr>';
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result)){
                            echo '
                            <tr>
                                <td>'.$row['FULL_NAME'].'</td>
                                <td>'.$row['USER_ID'].'</td>
                                <td>'.$row['EMAIL'].'</td>
                                <td>'.$row['RATINGS'].'</td>
                                <td>'.$row['RECOMMENDATION'].'</td>
                                <td>'.$row['EXPERIENCE'].'</td>
                                <td>'.$row['MESSAGE'].'</td>';
                                if($row['ATTACHMENT']!=NULL){
                                    // header("Content-type: image/*");
                                    // echo '<td><img src="'.$row['ATTACHMENT'].'" alt="attachment"></td>';
                                    echo '<td><img src="../Uploads/'.$row['ATTACHMENT'].'" alt="attachment" style="width:6em;height:6em;"></td>';
                                    // data:image/*;base64,base64_encode()
                                    // echo '<td>'.$row['ATTACHMENT'].'</td>';
                                }
                                else{
                                    echo '<td>-</td>';
                                }
                                echo '<td>'.$row['TIME'].'</td>
                            </tr>
                            ';
                        }
                        echo '</table>';
                    }
                    else{
                        echo "</table><p class='red'>No records found...</p>";
                    }
            }
        ?>
    </main>

    <?php include "footer.php"; ?>
    <script src="../js/menu.js"></script>
</body>
</html>