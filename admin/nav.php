<?php
echo '
<nav class="container">
    <a href="admin_home.php" title="Go on Admin Home Page"><p class="logo"><img src="../Attachments/light_logo.png">QUIZMAKER<br>ADMIN PANEL</img></p></a>
    <ul class="primary-nav">
        <li class="nav-item">
            <a href="admin_check_feedbacks.php" title="CHECK FEEDBACKS">CHECK FEEDBACKS</a>
        </li>   
        <li class="nav-item">
            <a href="admin_check_contacts.php" title="CHECK CONTACTS">CHECK CONTACTS</a>
        </li>
        <li class="nav-item">
            <a href="admin_check_database.php" title="CHECK DATABASE">CHECK DATABASE</a>
        </li>
        <li class="nav-item">
            <a href="admin_block.php" title="BLOCK/UNBLOCK USER">BLOCK/UNBLOCK USER</a>
        </li>
    </ul>
    <ul class="login-nav">
        <li class="nav-item">';
                if(isset($_SESSION['admin'])){
                    echo '<p class="username" title="Your Admin Id is '.$_SESSION['admin'].'">Hi, '.$_SESSION['admin'].'</p>';
                }
echo '
        </li>
        <li class="nav-item">';
        if(!isset($_SESSION['admin'])){
            echo '<li title="Get Logged In"><a href="index.php" class="primary-button">LOG IN</a></li>';
        }
        else{
          echo '<li title="Get Logged Out"><a href="index.php?action=logOut" title="LOG OUT" class="primary-button">LOG OUT</a></li>';
        }
            
        echo '</li>
    </ul>
    <span class="user-nav">';
            if(isset($_SESSION['admin'])){
                echo '<p class="username" title="Your Admin Id is '.$_SESSION['admin'].'">Hi, '.$_SESSION['admin'].'</p>';
            }
echo '
    </span>
    <img class="mobile-nav" src="../assets/hamburger-icon.svg" alt="Mobile menu" title="Open Menu">
</nav>
';
?>