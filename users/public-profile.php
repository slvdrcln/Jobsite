<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(isset($_GET['id'])) {


        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
        $select->execute();
        $profile = $select->fetch(PDO::FETCH_OBJ);


        $overview = $conn->query("SELECT * FROM workers WHERE worker_id = '$id'");
        $overview->execute();
        $view = $overview->fetch(PDO::FETCH_OBJ);

        //jobs created by this company 

        $jobs = $conn->query("SELECT * FROM jobs WHERE company_id = '$id' AND status = 1 LIMIT 5");
        $jobs->execute();
        $moreJobs = $jobs->fetchAll(PDO::FETCH_OBJ);


    } else {
        echo "404";
    }

    

?>

   <!-- HOME -->


<section class="view-company">

    <h1 class="heading">Profile</h1>

      <div class="details">

        <div class="info">

          <img src="user-images/<?php echo $profile->img; ?>" width="100" class="rounded-circle">
          
          <h3><?php echo $profile->fname; ?> <?php echo $profile->lname; ?></h3>           
            <p><?php echo $profile->title; ?></p>
          
          
            <div class="socials">
              <a href="<?php echo $profile->facebook; ?>"><i class="fa-brands fa-facebook"></i> </a>
              <a href="<?php echo $profile->twitter; ?>"><i class="fa-brands fa-twitter"></i></a>
              <a href="<?php echo $profile->linkedin; ?>"><i class="fa-brands fa-linkedin"></i></a>

            </div>
        </div>
        
          <div class="description">
            <h3>Overview</h3>
            <p><i class="fas fa-graduation-cap"></i> <?php echo $profile->education; ?></p>
            <p><i class="fas fa-user"></i> <span>Member since</span> <?php echo date('M', strtotime($profile->created_at))  . ' ' .  date('d', strtotime($profile->created_at)) . ', ' . date('Y', strtotime($profile->created_at)); ?></p>
            <p><i class="fas fa-suitcase"></i> Looking for <b><?php echo $view->type_of_work; ?></b> work <b>(<?php echo $view->hours; ?> hours/day)</b> at <b>$<?php echo $view->salary; ?>/hour</b></p>
          </div>

          <div class="description">
            <h3>Profile description</h3>
            <p><?php echo $profile->bio; ?></p>
          </div>

          <div class="tags">
            <h3 class="job-title">Skills</h3>
            <p>PHP</p>
            <p>HTML</p>
            <p>Firebase</p>
            <p>English</p>
          </div>



            
          </div>
      </div>
</section>


<?php require "../includes/footer.php"; ?>
