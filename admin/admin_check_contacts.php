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
    <title>Admin Panel - Check Contacts</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <?php
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $sql = "SELECT * FROM `contact_us`";
                $result = mysqli_query($con,$sql);
                echo '
                <table class="data">
                    <caption>Contacts</caption>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Id</th>
                        <th>Email Id</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Attachment</th>
                    </tr>';
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){
                        echo '
                        <tr>
                            <td>'.$row['FIRST_NAME'].'</td>
                            <td>'.$row['LAST_NAME'].'</td>
                            <td>'.$row['USER_ID'].'</td>
                            <td>'.$row['EMAIL'].'</td>
                            <td>'.$row['MESSAGE'].'</td>
                            <td>'.$row['TIME'].'</td>';
                            if($row['IMAGE']){
                                // echo '<td><img src="../Uploads/data:image;base64,'.base64_encode($row['IMAGE']).'" alt="attachment"></td>';
                                echo '<td><img src="../Uploads/'.$row['IMAGE'].'" alt="attachment" style="width:6em;height:6em;"></td>';
                                // echo '<td><img src=data:image/'.$row['IMAGE'].' alt="attachment"></td>';
                            }
                            else{
                                echo '<td>-</td>';
                            }
                            echo '</tr>
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