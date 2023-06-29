<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

    if(isset($_GET['name'])) {
        $name = $_GET['name'];


        $getJobs = $conn->query("SELECT * FROM jobs WHERE job_category = '$name' AND status = 1");
        $getJobs->execute();

        $getAllJobs = $getJobs->fetchAll(PDO::FETCH_OBJ);
    }


?>

<div class="section-title"><?php echo ucfirst($name); ?> jobs</div>    


<section class="jobs-container" id="next">
      <div class="box-container">
      <?php foreach($getAllJobs as $job) :?>

        <div class="box">
          
            <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $job->id; ?>"></a>
            <div class="company">
            <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $job->id; ?>">
              <img src="../users/user-images/<?php echo $job->company_image; ?>" alt="Image">
              
              <div>
                <h3><?php echo $job->job_title; ?></h3>
                <p><?php echo $job->company_name; ?></p>
                <br>
                <p><i class="fas fa-calendar"></i> <?php echo date('M', strtotime($job->created_at))  . ' ' .  date('d', strtotime($job->created_at)) . ', ' . date('Y', strtotime($job->created_at)); ?></p>

              </div>
            </div>

           

          
              <div class="description">
                <p><?php echo $job->job_description; ?>...<span>see more</span></p>
              </div>

              <div class="tags">
              <p style="<?php if($job->job_type == 'Part Time') { echo 'background-color: #4472ca; color:white'; } else { echo 'background-color: green; color:white;'; } ?>"><i class="fas fa-clock"></i> <?php echo $job->job_type; ?></p>
              <p><i class="fas fa-dollar"></i> <span><?php echo $job->salary; ?></span></p>
              
            </div>

            </a>
        </div>
          <?php endforeach; ?>

          
        </div>

     

      </div>
</section>
    

<?php require "../includes/footer.php"; ?>
