<?php 

  session_start();



    define("APPURL", "http://localhost/jobsite");



?>


<!doctype html>
<html lang="en">
  <head>
    <title>Jobsite</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="ftco-32x32.png">


    <!-- MAIN CSS -->

    <link rel="stylesheet" href="<?php echo APPURL; ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo APPURL; ?>/css/tokens.css">
  </head>
  <body>
    
    <!-- NAVBAR -->
    <header class="header">
        <section class="flex">

            <div class="fas fa-bars-staggered" id="menu-btn"></div>
            <a href="<?php echo APPURL; ?>" class="logo"><i class="fas fa-briefcase"></i>JobSite.</a>

            <nav class="navbar">

                <?php if(isset($_SESSION['username'])) : ?>
                    <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                        <a href="<?php echo APPURL; ?>/jobs/post-job.php" style="margin-top: 0;"><i class="fas fa-plus"></i> Post job</a>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                            <a href="<?php echo APPURL; ?>/jobs/all-jobs.php"><i class="fas fa-search"></i> Find jobs</a>
                        <?php endif; ?>

                    <div class="hide">
                        
                        <a href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-user"></i> <span><?php echo $_SESSION['username']; ?></span></a>
                        <a href="<?php echo APPURL; ?>/users/update-profile.php?upd_id=<?php echo $_SESSION['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Edit profile</a>

                    <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                            <a href="<?php echo APPURL; ?>/users/show-applicants.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-users"></i> Applicants</a>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                            <a href="<?php echo APPURL; ?>/users/saved_jobs.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-bookmark"></i> Saved jobs</a>
                        <?php endif; ?>
                        <a href="<?php echo APPURL; ?>/auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </div>

                    <div class="dropdown-container">
                        <div class="dropdown">
                            <!-- <img src="user-images/<?php echo $profile->img; ?>" alt=""> -->
                            <input type="text" readonly placeholder="Account" name="date" maxlength="20" class="output">
                            <div class="lists">

                            <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                                <a class="items" href="<?php echo APPURL; ?>/users/company-profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-user"></i> <span><?php echo $_SESSION['username']; ?></span></a>

<?php else:?>
                                <a class="items" href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-user"></i> <span><?php echo $_SESSION['username']; ?></span></a>
                                <?php endif; ?>

                                <a class="items" href="<?php echo APPURL; ?>/users/update-profile.php?upd_id=<?php echo $_SESSION['id']; ?>"><i class="fa-regular fa-pen-to-square"></i> Edit profile</a>

                                
                                <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                                    <a class="items" href="<?php echo APPURL; ?>/users/show-applicants.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-users"></i> Applicants</a>
                                <?php endif; ?>

                                <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                                    <a class="items" href="<?php echo APPURL; ?>/users/saved_jobs.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-bookmark"></i> Saved jobs</a>
                                    <a class="items" href="<?php echo APPURL; ?>/users/profile-overview.php"><i class="fas fa-lock"></i> Edit account</a>
                                <?php endif; ?>
                                <a class="items" href="<?php echo APPURL; ?>/auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>

                        </div>
                    </div>

            </div>

                    <?php else: ?>
                        <a href="<?php echo APPURL; ?>/jobs/all-jobs.php"><i class="fas fa-search"></i> Find jobs</a>
                        <a href="<?php echo APPURL; ?>/jobseekers.php"><i class="fas fa-graduation-cap"></i> Talent</a>
                        <a href="<?php echo APPURL; ?>/auth/login.php">Login</a>
                        <a href="<?php echo APPURL; ?>/auth/register.php">Register</a>


                    
                <?php endif; ?>


            </nav>





        </section>

        
    </header>

