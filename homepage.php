<?php
    include "session_start.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navigation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/attendquiz.css">
    <link rel="stylesheet" href="./css/homescreen.css">
    <link rel="icon" href="Attachments/light_logo.png">
    <title>Quiz maker home page</title>
</head>
<body>
    <?php include "nav.php"; ?>
    <?php include "header.php"; ?>
    <main>
        <section class="quiz-data">
            <div class="created-quiz">
                <h2>List of Quiz Created by You :</h2>
                <?php
                    $con = mysqli_connect("localhost","root","","quiz_maker");
                    if($con){   
                        $user_name = $_SESSION['user_name'];

                        $sql = "SELECT count(user) as 'count' FROM `log_in` WHERE user='$user_name'";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_array($result);
                        $count = $row['count'];

                        $sql = "SELECT `QUIZ_CODE` FROM `registered_quiz` WHERE CREATOR_ID='$user_name'";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            $show_details = array();
                            while($row = mysqli_fetch_array($result)){
                            array_push($show_details,$row['QUIZ_CODE']);
                            }
                            $count = 0;
                            foreach($show_details as $val){
                                $sql = "SELECT `MODE` FROM `registered_quiz` WHERE QUIZ_CODE='$val'";
                                $result = mysqli_query($con,$sql);
                                $mode = mysqli_fetch_array($result);
                                if($mode['MODE'] == "ON"){
                                    $r_mode = "OFF";
                                }
                                elseif($mode['MODE'] == "OFF"){
                                    $r_mode = "ON";
                                }
                                $count += 1;
                                echo "<p>[ ".$count." ] ".$val." : <a href='quiz_mode.php?quiz=$val' style='text-decoration: underline;'>Turn ".$r_mode."</a>";
                                // <a href='add_questions.php?quiz=$val'>Add Questions</a>, <a href='check_responses.php?quiz=$val'>Check Responses</a></p>";." <a href=''>Copy Info</a>"
                            }
                        }
                        else{
                            if($count==1){
                                echo "<p class='red'>Welcome to Quiz Maker...</p><p>You can make your own quiz...</p><p>Click <a href='makequiz.php' style='text-decoration: underline;'>here</a> to make a new quiz...</p>";
                            }
                            else{
                                echo "<p class='red'>No Quiz is created by you yet far.</p><p>You can make your own quiz...</p><p>Click <a href='makequiz.php' style='text-decoration: underline;'>here</a> to make a new quiz...</p>";
                            }
                        }
                    }
                ?>
            </div>
            <div class="attended-quiz">
                <h2>List of Quiz Attended by You :</h2>
                <?php
                    if($con){       
                        $user_name = $_SESSION['user_name'];
                        $sql = "SELECT `QUIZ_CODE`,`OBTAINED_POINTS`,`DESC_POINT`,`TIME` FROM `responses` WHERE  ATTENDEE_ID='$user_name'";
                        $result = mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)>0){
                            // $show_details = array();
                            $count = 0;
                            while($row = mysqli_fetch_array($result)){
                            // array_push($show_details,$row['QUIZ_CODE']);
                                $count += 1;
                                echo "<p>[ ".$count." ] ".$row['QUIZ_CODE']." (Time : ".$row['TIME'].")</p>";
                                echo "<p>MCQs Result : ".$row['OBTAINED_POINTS']."</p>";
                                echo "<p>Descriptive Result : ".$row['DESC_POINT']."</p>";
                                echo "<p>Combined Result : ".$row['OBTAINED_POINTS']+$row['DESC_POINT']."</p><hr>";
                            }
                            // foreach($show_details as $val){
                                
                            // }
                        }
                        else{
                            if($count==1){
                                echo "<p class='red'>Welcome to Quiz Maker...</p><p>You can attend any quiz by clicking <a href='#attend-quiz' class='attendquizbtn' style='text-decoration: underline;'>here</a></p>";
                            }
                            else{
                                echo "<p class='red'>No Quiz is attended by you yet far.</p><p>You can attend any quiz by clicking <a href='#attend-quiz' class='attendquizbtn' style='text-decoration: underline;'>here</a></p>";
                            }
                        }
                    }
                ?>
            </div>
            <div class="theme">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?> " class="theme-data">
                    <h2>THEME</h2>
                    <div class="selectTheme">
                        <label for="theme">Select Theme : </label>
                        <select title="Select Theme" name="theme" id="theme">
                            <option value="light" title="Light Theme will be applied to the whole website">Light</option>
                            <option value="dark" title="Dark Theme will be applied to the whole website">Dark</option>
                        </select>          
                    </div>  
                    <h2>FONT</h2>
                    <div class="selectFont">
                        <label for="font">Select Font : </label>
                        <select title="Select Font Style" name="font_style" id="font">
                            <option value="Default" title="Default Font style will be applied to the whole website">Default</option>
                            <option value="Poppins" title="Arial Font style will be applied to the whole website">Poppins</option>
                            <option value="Roboto" title="Sans Serif Font style will be applied to the whole website">Roboto</option>
                            <option value="Open Sans" title="Sans Serif Font style will be applied to the whole website">Open Sans</option>
                            <option value="Lato" title="Times New Roman Font style will be applied to the whole website">Lato</option>
                            <!-- <option value="Verdana" title="Verdana Font style will be applied to the whole website">Verdana</option> -->
                            <!-- <option value="Courier New" title="Courier New Font style will be applied to the whole website">Courier New</option> -->
                            <option value="Montserrat" title="Segoe UI Font style will be applied to the whole website">Montserrat</option>
                            <option value="Raleway" title="Calibri Font style will be applied to the whole website">Raleway</option>
                        </select>
                    </div>
                    <!-- <a href="#" class="primary-button">Save</a> -->
                    <!-- <input type="submit" value="Save" class="theme-button"> -->
                    <div class="themebtn">
                        <button type="submit" class="theme-button">Save</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include "footer.php"; ?>
    <?php include "enter_quiz.php"; ?>
    <script src="js/menu.js"></script>
    <script src="js/theme.js"></script>
</body>
</html>