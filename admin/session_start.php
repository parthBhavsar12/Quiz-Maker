<?php
    session_start();
    if(!$_SESSION['admin'])
    {
        session_destroy();
        header("Location:index.php");
    }
?>