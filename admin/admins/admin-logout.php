<?php 

    session_start();
    session_unset();
    session_destroy();

    header("location: http://localhost/jobsite/admin/admins/admin-login.php");

?>