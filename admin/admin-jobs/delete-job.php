<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>

<?php 

    if(!isset($_SESSION['adminname'])) {

        header("location: ".ADMINURL."/admins/admin-login.php");

    }

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $delete = $conn->prepare("DELETE FROM jobs WHERE id = '$id'");
        $delete->execute();
        header("location: ".ADMINURL."/admin-jobs/jobs.php");

    } else {
        header("location: http://localhost/jobsite/404.php");
    }


?>


<?php require "../includes/footer.php"; ?>       