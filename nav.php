<?php
echo '
<nav class="container">
    <a href="homepage.php" title="Go on Home Page"><p class="logo"><img src="Attachments/light_logo.png">QUIZMAKER</img></p></a>
    <ul class="primary-nav">
        <li class="nav-item">
            <a href="makequiz.php">MAKE QUIZ</a>
        </li>   
        <li class="nav-item">
            <a href="#attend-quiz" class="attendquizbtn">ATTEND QUIZ</a>
        </li>
        <li class="nav-item">
            <a href="feedback.php">FEEDBACK</a>
        </li>
        <li class="nav-item">
            <a href="contact_us.php">CONTACT US</a>
        </li>
    </ul>
    <ul class="login-nav">
        <li class="nav-item">';
                if(isset($_SESSION['user_name'])){
                    echo '<p class="username" title="Your Username is '.$_SESSION['user_name'].'">Hi, '.$_SESSION['user_name'].'</p>';
                }
echo '
        </li>
        <li class="nav-item">';
        if(!isset($_SESSION['user_name'])){
            echo '<li title="Get Logged In"><a href="signin.php" class="primary-button">LOG IN</a></li>';
        }
        else{
          echo '<li title="Get Logged Out"><a href="signin.php?action=logOut" title="LOG OUT" class="primary-button">LOG OUT</a></li>';
        }
            
        echo '</li>
    </ul>
    <span class="user-nav">';
            if(isset($_SESSION['user_name'])){
                echo '<p class="username" title="Your Username is '.$_SESSION['user_name'].'">Hi, '.$_SESSION['user_name'].'</p>';
            }
echo '
    </span>
    <img class="mobile-nav" src="./assets/hamburger-icon.svg" alt="Mobile menu" title="Open Menu">
</nav>
';
?>