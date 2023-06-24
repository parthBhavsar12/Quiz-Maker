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
    <link rel="stylesheet" href="../css/contact_us.css">
    <link rel="stylesheet" href="../css/homescreen.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="icon" href="../Attachments/light_logo.png">
    <title>Admin Panel - Block / Unblock Users</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <h1 style="text-align: center;">Block / Unblock Users</h1>
        <!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label for="user">Enter User Id which you want to block : </label>
            <input type="text" id="user" name="user" title="Enter User id which you want to block" placeholder="Enter User Id" autofocus required/>
            <p>
                <input type="submit" name="btnSubmit" title="Block User" value="Block"/>
            </p>
        </form> -->
        <form id="feedback-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" style="text-align: center;">
            <div class="feedback-form">
                <div class="form-group">
                    <label for="user" style="display: block; margin: auto; padding: 10px;">Enter User Id which you want to block : </label>
                    <input type="text" id="user" name="user" title="Enter User id which you want to block" placeholder="Enter User Id" autofocus required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" title="Block User" value="Block"/>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['btnSubmit'])){
                if(isset($_POST['user'])){
                    $user = $_POST['user'];
                }
                $con = mysqli_connect("localhost","root","","quiz_maker");
                if($con){
                    $sql = "UPDATE `user_details` SET `ACTIVE`='No' WHERE `USER_ID` = '".$user."'";
                    mysqli_query($con,$sql);
                    // echo "<p class='green'>".$user." has been blocked by you...</p>";
                }
            }
            // SELECT `USER_ID`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `DOB`, `EMAIL`, `MOBILE`, `COUNTRY_CODE`, `ACTIVE`, `joining_date` FROM `user_details` WHERE 1
            $con = mysqli_connect("localhost","root","","quiz_maker");
            if($con){
                $sql = "SELECT `USER_ID` FROM `user_details` WHERE `ACTIVE`='No'";
                $result = mysqli_query($con,$sql);
                echo '
                <table class="data">
                    <tr>
                        <th>User Id</th>
                        <th>Unblock</th>
                    </tr>
                ';
                while($row = mysqli_fetch_array($result)){
                    echo '
                        <tr>
                            <td>'.$row['USER_ID'].'</td>
                            <td><a class="blocked_user" href="?user='.$row['USER_ID'].'">Unblock</a></td>
                        </tr>
                    ';
                }
                if(mysqli_num_rows($result)==0){
                    echo '<tr><td colspan="2">No one user has been blocked...</td></tr>';
                }
                if(isset($_GET['user'])){
                    $sql = "UPDATE `user_details` SET `ACTIVE`='Yes' WHERE `USER_ID` = '".$_GET['user']."'";
                    mysqli_query($con,$sql);
                    echo "<script type='text/javascript'>
                    window.onload = function() {
                        if(!window.location.hash) {
                            window.location = window.location + '#loaded';
                            window.location.reload();
                        }
                    }
                    </script>";
                }
                echo '</table>';
            }
        ?>
    </main> 
    <?php include "footer.php"; ?>
    <script src="../js/menu.js"></script>
</body>
</html>