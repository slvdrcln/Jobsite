<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>


<?php

    $select = $conn->query("SELECT * FROM users WHERE type = 'Worker' ORDER BY created_at DESC");
    $select->execute();
    $allProfiles = $select->fetchAll(PDO::FETCH_OBJ);

?>


<section class="jobs-container">

    <h1 class="heading">Jobseekers</h1>

      <div class="box-container">
      <?php
      $i=0;
      foreach($allProfiles as $profiles) : ?>
        
        <div class="box">

            <div class="company">
            <a href="users/public-profile.php?id=<?php echo $profiles->id; ?>">

              <img src="users/user-images/<?php echo $profiles->img; ?>" width="100" class="rounded-circle">
            
              <div>
                <h3><?php echo $profiles->title; ?></h3>
                <p><?php echo $profiles->fname; ?> <?php echo $profiles->lname; ?></p> 
                <p><i style="margin-right: 1rem;" class="fas fa-user"></i>Member since <?php echo date('M', strtotime($profiles->created_at))  . ' ' .  date('d', strtotime($profiles->created_at)) . ', ' . date('Y', strtotime($profiles->created_at)); ?></p>

              </div>
            </div>

            <h3 class="job-title"><?php echo $profiles->job_title; ?></h3>
            
            

              <div class="description">
            <p><?php echo $profiles->bio; ?></p>
              </div>
            <div class="tags">
              <p style="<?php if($job->job_type == 'Part Time') { echo 'background-color: #4472ca; color:white'; } elseif($job->job_type == 'Full Time') { echo 'background-color: green; color:white;'; } ?>"><i class="fas fa-clock"></i> Looking for<?php echo $job->job_type; ?></p>
              <p><i class="fas fa-money-bill"></i> <span><?php echo $job->salary; ?></span></p>
            </div>
      </a>

          

          
        </div>
        <?php 
      endforeach; ?>

  </div>
  <div class="button">

  </div>
</section>

<?php require "includes/footer.php"; ?>
