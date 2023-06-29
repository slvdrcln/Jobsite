<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>

<?php 

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM categories WHERE id = '$id'");
    $delete->execute();
    header("location: ".ADMINURL."/admin-categories/categories.php");

} else {
    header("location: http://localhost/jobsite/404.php");
}



?>

















<?php require "../includes/footer.php"; ?>           
