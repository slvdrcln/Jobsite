<?php require "includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if(!isset($_SESSION['adminname'])) {

   header("location: ".ADMINURL."/admins/admin-login.php");

}

$jobs = $conn->query("SELECT COUNT(*) AS count_jobs FROM jobs");
$jobs->execute();

$counJobs = $jobs->fetch(PDO::FETCH_OBJ);


$categories = $conn->query("SELECT COUNT(*) AS count_cats FROM categories");
$categories->execute();

$counCategories = $categories->fetch(PDO::FETCH_OBJ);


$admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
$admins->execute();

$counAdmins = $admins->fetch(PDO::FETCH_OBJ);


?>

<section class="dashboard">

   <h1 class="heading">Admin</h1>

   <div class="box-container">

      <div class="box">
         <h3><a href=""></a>Welcome!</h3>
         <p><?php echo $_SESSION['adminname']; ?></p>
      </div>

      <div class="box">
         <a href="<?php echo ADMINURL; ?>/admins/admins.php">

         <h3><?php echo $counAdmins->count_admins; ?></h3>
         <p>Total # of admin</p>
         </a>
      </div>

      <div class="box">
         <a href="<?php echo ADMINURL; ?>/admin-jobs/jobs.php">
         <h3><?php echo $counJobs->count_jobs; ?></h3>
         <p>Total # of jobs</p>
         </a>
      </div>

      <div class="box">
         <a href="<?php echo ADMINURL; ?>/admin-categories/categories.php">
         <h3><?php echo $counCategories->count_cats; ?></h3>
         <p>Total # of job categories</p>
         </a>
      </div>

      

   </div>

</section>
<?php require "includes/footer.php"; ?>           
