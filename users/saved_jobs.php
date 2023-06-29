<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

//  if(!isset($_SESSION['type']) AND $_SESSION['type'] !== "Worker") {
            
//     header("location: ".APPURL."");

//   }

// if(isset($_SESSION['type']) AND $_SESSION['type'] == 'Worker'){
//   $type = $_SESSION['type']['Worker'];
// } else {
//   $type = '';
//   header("location: ".APPURL."");
// }

if(isset($_GET['id'])) {


    $id = $_GET['id'];

    if($_SESSION['id'] == $id ) {
      $id = $_SESSION['id'];
  } else {
    header("location: ".APPURL."");
  }

    $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
    $select->execute();
    $profile = $select->fetch(PDO::FETCH_OBJ);


    //grapping saved_jobs

    $saved_jobs = $conn->query("SELECT jobs.id AS id, jobs.company_image AS company_image, jobs.company_name AS company_name,
    jobs.job_type AS job_type, jobs.salary AS salary, jobs.created_at AS created_at, jobs.job_description AS job_description, jobs.job_title AS job_title FROM jobs JOIN saved_jobs 
    ON jobs.id = saved_jobs.job_id WHERE worker_id = '$id'");
    $saved_jobs->execute();

    $jobs = $saved_jobs->fetchAll(PDO::FETCH_OBJ);



}


?>

<div class="section-title">Saved Jobs</div>

<section class="jobs-container">
      <div class="box-container">
      <?php foreach($jobs as $oneJob) : ?>
        
          <div class="box">
            
              <div class="company">
              <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob->id; ?>">
                <img src="user-images/<?php echo $oneJob->company_image; ?>" alt="/<?php echo $oneJob->company_image; ?>" class="img-fluid">
              
                  <div>
                    <h3><?php echo $oneJob->job_title; ?></h3>
                    <p><?php echo $oneJob->company_name; ?></p>
                    <br>
                    <p><i class="fas fa-flag"></i> Posted on <?php echo date('M', strtotime($oneJob->created_at))  . ' ' .  date('d', strtotime($oneJob->created_at)) . ', ' . date('Y', strtotime($oneJob->created_at)); ?></p>
                  </div>
              </div>

              <h3 class="job-title"></h3>

              <div class="description">
                <p><?php echo $oneJob->job_description; ?>..<span>see more</span></p>
              </div>
              </a>
              <div class="tags">
                <p style="<?php if($oneJob->job_type == 'Part Time') { echo 'background-color: #4472ca; color:white'; } else { echo 'background-color: green; color:white;'; } ?>"><i class="fas fa-clock"></i> <?php echo $oneJob->job_type; ?></p>
                <p><?php echo $oneJob->salary; ?></p>
              </div>
              
              </div>


        <?php endforeach; ?>
        </div>
      <div>
</section>
<?php require "../includes/footer.php"; ?>