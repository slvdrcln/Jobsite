<?php 

  session_start();

  define("ADMINURL", "http://localhost/jobsite/admin");

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Admin.</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="<?php echo ADMINURL; ?>/css/admin_style.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<header class="header">

   <section class="flex">

      <a href="<?php echo ADMINURL; ?>" class="logo"><i class="fas fa-user-tie"></i> Admin.</a>


      <div class="icons">
         <div id="menu-btn" class="fas fa-list"></div>
         <div id="user-btn" class="fas fa-user-tie"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
      <?php if(isset($_SESSION['adminname'])) : ?>

         <h3><?php echo $_SESSION['adminname']; ?></h3>
         <div class="flex-btn">
            <a class="btn" href="<?php echo ADMINURL; ?>/admins/admin-logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
         </div>
         <?php else : ?>
         <h3>Please login</h3>
         <div class="flex-btn">
            <a class="option-btn" href="<?php echo ADMINURL; ?>/admins/admin-login.php">Login</a>
         </div>
         <?php endif; ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <?php if(isset($_SESSION['adminname'])) : ?>

         <!-- <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt=""> -->
         <h3><?php echo $_SESSION['adminname']; ?></h3>
         <a class="btn" href="<?php echo ADMINURL; ?>/admins/admin-logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
         <?php else : ?>
         <h3>Please login</h3>
          <div class="flex-btn">
            <a href="<?php echo ADMINURL; ?>/admins/admin-login.php" class="option-btn">Login</a>
         </div>
         <?php endif; ?>
      </div>

   <nav class="navbar">
   <?php if(isset($_SESSION['adminname'])) : ?>

      <a href="<?php echo ADMINURL; ?>/admins/admins.php"><i class="fas fa-users"></i><span>Admins</span></a>
      <a href="<?php echo ADMINURL; ?>/admin-categories/categories.php"><i class="fas fa-table-cells-large"></i><span>Categories</span></a>
      <a href="<?php echo ADMINURL; ?>/admin-jobs/jobs.php"><i class="fas fa-suitcase"></i><span>Jobs</span></a>
      <?php endif; ?>
      
   </nav>

</div>