<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(isset($_GET['id'])) {


        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
        $select->execute();
        $profile = $select->fetch(PDO::FETCH_OBJ);


        //jobs created by this company 

        $jobs = $conn->query("SELECT * FROM jobs WHERE company_id = '$id' AND status = 1 LIMIT 5");
        $jobs->execute();
        $moreJobs = $jobs->fetchAll(PDO::FETCH_OBJ);


    } else {
        echo "404";
    }


?>
<section class="view-company">

<h1 class="heading">Profile</h1>

  <div class="details">

    <div class="info">

      <img src="user-images/<?php echo $profile->img; ?>" width="100" class="rounded-circle">
      
      <h3><?php echo $profile->fname; ?> <?php echo $profile->lname; ?></h3> 
      <p><?php echo $profile->username; ?></p>
      
      
      
        <div class="socials">
          <a href="<?php echo $profile->facebook; ?>"><i class="fa-brands fa-facebook"></i> </a>
          <a href="<?php echo $profile->twitter; ?>"><i class="fa-brands fa-twitter"></i></a>
          <a href="<?php echo $profile->linkedin; ?>"><i class="fa-brands fa-linkedin"></i></a>

        </div>
          <p><i style="margin-right: 1rem;" class="fas fa-user"></i> <span>Member since</span> <?php echo date('M', strtotime($profile->created_at))  . ' ' .  date('d', strtotime($profile->created_at)) . ', ' . date('Y', strtotime($profile->created_at)); ?></p>
      
    </div>
        
      </div>
        


    
  </div>
</section>

<section class="jobs-container">

      <h1 class="heading">Job(s) they offer</h1>


  <div class="box-container">
  <?php foreach($moreJobs as $oneJob) : ?>

    
    <div class="box">
        <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob->id; ?>"></a>
        
        <div class="company">
        <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob->id; ?>">
          <img src="user-images/<?php echo $oneJob->company_image; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
          
            <div>
                <h3><?php echo $oneJob->company_name; ?></h3>
                <p><i class="fas fa-calendar"></i> <?php echo date('M', strtotime($oneJob->created_at))  . ' ' .  date('d', strtotime($oneJob->created_at)) . ', ' . date('Y', strtotime($oneJob->created_at)); ?></p>
            
              </div>

        </div>
        <h3 class="job-title"><?php echo $oneJob->job_title; ?></h3>

        <div class="description">
            <p><?php echo $oneJob->job_description; ?>..<span>see more</span></p>
          </div>

        <div class="tags">
          <p style="<?php if($oneJob->job_type == 'Part Time') { echo 'background-color: #4472ca; color:white'; } elseif($oneJob->job_type == 'Full Time') { echo 'background-color: green; color:white;'; } ?>"><i class="fas fa-clock"></i> <?php echo $oneJob->job_type; ?></p>
        </div>

        </a>

  </div>
  <?php endforeach; ?>

<div>
</section>

<?php require "../includes/footer.php"; ?>
