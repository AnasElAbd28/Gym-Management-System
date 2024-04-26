<?php 
    session_start();

    session_unset();
    session_destroy();
    header("Location: member_login_page.php");
?>