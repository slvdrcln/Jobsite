<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['type']) AND $_SESSION['type'] !== "Company") {
      header("location: ".APPURL."");

    }

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


      $getApplicants = $conn->query("SELECT * FROM job_applications WHERE company_id = '$id'");
      $getApplicants->execute();

      $getApplicant = $getApplicants->fetchAll(PDO::FETCH_OBJ);

    } else {
      echo "404";
    }

?>

<div class="section-title">Applicants</div>

<section class="jobs-container">
      <div class="box-container">


          <?php foreach($getApplicant as $jobApp) : ?>
            <div class="box">

                <div class="company">
                  <a target="_blank" class="" href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $jobApp->job_id; ?>">
                    <img src="user-images/<?php echo $jobApp->worker_image; ?>" alt="user-images/<?php echo $jobApp->worker_image; ?>">
                  </a>

                  <div>
                    <h3><?php echo $jobApp->job_title; ?></h3>
                    <a target="_blank" href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $jobApp->worker_id; ?>"><?php echo $jobApp->username; ?></a>
                    <br>
                    <br>
                    <p><i style="margin-right: .5rem;" class="fas fa-calendar"></i> <span>Date applied</span> <?php echo date('M', strtotime($jobApp->create_at))  . ' ' .  date('d', strtotime($jobApp->create_at)) . ', ' . date('Y', strtotime($jobApp->create_at)); ?></p>
                  </div>
                </div>

                <div class="description">
                  <h2>Message from applicant</h2>
                  <p><?php echo ucfirst($jobApp->message); ?></p>
                </div>


                  <a class="btn" href="<?php echo APPURL; ?>/users/user-cvs/<?php echo $jobApp->cv; ?>" role="button" download>Download CV</a>

                
            </div>

          <?php endforeach; ?>
    </div>
</section>

<?php require "../includes/footer.php"; ?>
