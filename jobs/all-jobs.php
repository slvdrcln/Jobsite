<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

  $select = $conn->query("SELECT * FROM jobs WHERE status = 1 ORDER BY created_at DESC");

  $select->execute();

  $jobs = $select->fetchAll(PDO::FETCH_OBJ);





?>
<section class="jobs-container">

    <h1 class="heading">All jobs</h1>

      <div class="box-container">
      <?php
      $i=0;
      foreach($jobs as $job) : ?>
        
        <div class="box">

            <div class="company">
            <a href="job-single.php?id=<?php echo $job->id; ?>">
              <img src="../users/user-images/<?php echo $job->company_image; ?>" alt="../users/user-images/<?php echo $job->company_image; ?>">
            
              <div>
                <h3><?php echo $job->company_name; ?></h3>

                <p><i class="fas fa-calendar"></i> <?php echo date('M', strtotime($job->created_at))  . ' ' .  date('d', strtotime($job->created_at)) . ', ' . date('Y', strtotime($job->created_at)); ?></p>

              </div>
            </div>

            <h3 class="job-title"><?php echo $job->job_title; ?></h3>

              <div class="description">
                <p><?php echo $job->job_description; ?>..<span>see more</span></p>
              </div>
            <div class="tags">
            <p style="<?php if($job->job_type == 'Part Time') { echo 'background-color: #4472ca; color:white'; } elseif($job->job_type == 'Full Time') { echo 'background-color: green; color:white;'; } ?>"><i class="fas fa-clock"></i> <?php echo $job->job_type; ?></p>
            <p><i class="fas fa-money-bill"></i> <span><?php echo $job->salary; ?></span></p>

            </div>
          </a>
        
        </div>
        <?php 
      endforeach; ?>

  </div>
</section>

<?php require "../includes/footer.php"; ?>
