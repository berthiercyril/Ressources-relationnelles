<?php
    session_start();
    session_unset();
    session_destroy();
    header('location: ../view/Back-office/BO_login.php');
?>