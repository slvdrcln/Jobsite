<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

  if(isset($_GET['id'])) {

    $id = $_GET['id'];

    //getting single job info
    $select = $conn->query("SELECT * FROM jobs WHERE id = '$id'");
    $select->execute();

    $row = $select->fetch(PDO::FETCH_OBJ);

   
    //getting related jobs
   $related_jobs = $conn->query("SELECT * FROM jobs WHERE job_category = '$row->job_category' AND status = 1 AND id != '$id'");
   $related_jobs->execute();

   $related_job = $related_jobs->fetchAll(PDO::FETCH_OBJ);



   //getting the count of related jobs 
   $job_count = $conn->query("SELECT COUNT(*) as job_count FROM jobs WHERE job_category = '$row->job_category' AND status = 1 AND id != '$id'");

   $job_count->execute();

   $job_num = $job_count->fetch(PDO::FETCH_OBJ);

   
    
   

 
  } else {
    header("location: ".APPURL."/404.php");
  }


  //submitting applications
  if(isset($_POST['submit_application'])) {

    $username = $_POST['username'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $cv = $_POST['cv'];
    $worker_id = $_POST['worker_id'];
    $worker_image = $_POST['worker_image'];
    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $company_id = $_POST['company_id'];


    $insert = $conn->prepare("INSERT INTO job_applications (username, message, email, cv, worker_id, worker_image,
     job_id, job_title, company_id) VALUES (:username, :message, :email, :cv, :worker_id, :worker_image, :job_id, :job_title, :company_id)");

    $insert->execute([
      ':username' =>  $username,
      ':message' =>  $message,
      ':email' =>  $email,
      ':cv' =>  $cv,
      ':worker_id' =>  $worker_id,
      ':worker_image' =>  $worker_image,
      ':job_id' =>  $job_id,
      ':job_title' =>  $job_title,
      ':company_id' =>  $company_id
    ]);
    
    echo "<script> alert('Application sent successfully');</script>";

    //header("location: ".APPURL."/jobs/job-single.php?id=".$id."");
  }

  //saving jobs 

 


  if(isset($_SESSION['id'])) {
    //checking for worker application 

    $checking_for_application = $conn->query("SELECT * FROM job_applications WHERE worker_id = '$_SESSION[id]' AND job_id = '$id'");
    $checking_for_application->execute();


    //checking for saved jobs 

    $checking_for_saved_jobs = $conn->query("SELECT * FROM saved_jobs WHERE worker_id = '$_SESSION[id]' AND job_id='$id'");
    $checking_for_saved_jobs->execute();
  
  }
 

  

  //getting categories 

   $categories = $conn->query("SELECT * FROM categories");
   $categories->execute();

   $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);



?>
    <!-- HOME -->
    
    <section class="job-details">

      <h1 class="heading">Job details</h1>
      
      <div class="details">

        <div class="job-info">
          <img src="../users/user-images/<?php echo $row->company_image; ?>" alt="">
          <h3><?php echo $row->job_title; ?></h3>
          <a href="../users/company-profile.php?id=<?php echo $row->company_id; ?>"><?php echo $row->company_name; ?></a> <!--todo: fetch company -->
          <p><i class="fas fa-clock"></i> <?php echo $row->job_type; ?></p> <!--todo: fetch company location -->
          <p><i class="fas fa-money-bill"></i> <?php echo $row->salary; ?></p>

        </div>

        <div class="basic-details">
        <h3><i class="fas fa-bars"></i> <span>Job overview</span></h3>
          <p><?php echo $row->job_description; ?></p>
            <!-- <h3>Application deadline</h3>
            <p><?php echo date('M', strtotime($row->application_deadline))  . '. ' .  date('d', strtotime($row->application_deadline)) . ', ' . date('Y', strtotime($row->application_deadline)); ?></p>
             -->
        </div>



    
        <div class="contact">
          <div class="col-lg-8">

            <ul>
            <br>
              <li><?php echo $row->vacancy; ?> candidate(s)</li>
              <li>Posted on: <?php echo date('M', strtotime($row->created_at))  . ' ' .  date('d', strtotime($row->created_at)) . ', ' . date('Y', strtotime($row->created_at)); ?></li>
            </ul>

            


            <?php if(isset($_SESSION['username'])) : ?>
              <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                


                    

                  <?php if($checking_for_application->rowCount() == 0) : ?>

                    <form action="job-single.php?id=<?php echo $id; ?>" method="post">
                      
                      <!--job details-->
                    
                      <div class="box">
                        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" class="input" id="" placeholder="username">
                      </div>
                      <div class="box">
                        <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>" class="input" id="" placeholder="email">
                      </div>
                      <div class="box">
                        <input type="hidden" name="cv" value="<?php echo $_SESSION['cv']; ?>" class="input" id="" placeholder="cv">
                      </div>
                      <div class="box">
                        <input type="hidden" name="worker_id" value="<?php echo $_SESSION['id']; ?>" class="input" id="" placeholder="worker_id">
                      </div>
                      <div class="box">
                        <input type="hidden" name="worker_image" value="<?php echo $_SESSION['image']; ?>" class="input" id="" placeholder="worker_image">
                      </div>
                      <div class="box">
                        <input type="hidden" name="job_id" value="<?php echo $id; ?>" class="input" id="" placeholder="job_id">
                      </div>
                      <div class="box">
                        <input type="hidden" name="job_title" value="<?php echo $row->job_title; ?>" class="input" id="" placeholder="job_title">
                      </div>

                      <div class="box">
                        <input type="hidden" name="company_id" value="<?php echo $row->company_id; ?>" class="input" id="" placeholder="company_id">
                      </div>

                      <div class="box">
                        <p style="padding-top: 0;">Message</p> 
                        <textarea name="message" id="" cols="30" rows="10" class="input"></textarea>
                      </div>
                      
                      <div class="box">
                        
                      </div>
                      <div class="flex-btn">
                        <button name="submit_application" type="submit" class="btn">Apply</button>
                        <?php if(  $checking_for_saved_jobs->rowCount() == 0) : ?>
                      <a href="job-save.php?job_id=<?php echo $id; ?>&worker_id=<?php echo $_SESSION['id']; ?>&status=save" class="save"><i class="far fa-heart"></i> Save job</a>

                    <?php else : ?>
                      <a href="job-save.php?job_id=<?php echo $id; ?>&worker_id=<?php echo $_SESSION['id']; ?>&status=delete" class="save"><i class="fa-solid fa-heart"></i> Saved job</a>
                    <?php endif; ?>
                      </div>
                    </form>

                  <?php else: ?> 
                      
                        <p style="font-size: 2rem; font-weight: 400; color: gray;"><i>You applied for this job</i></p>

                        <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php else : ?>
              <p style="font-size: 2rem; font-weight: 400; color: gray;">Login so you can apply for this job</p>
              <a href="<?php echo APPURL; ?>/auth/login.php" class="btn">Login</a>
            <?php endif; ?>  


            <?php if(isset($_SESSION['username'])) : ?>
              <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                <?php if(isset($_SESSION['id']) AND $_SESSION['id'] == $row->company_id) : ?>
                  <div>
                    
                      <a href="<?php echo APPURL; ?>/jobs/job-update.php?id=<?php echo $row->id; ?>" class="btn"><i class="fas fa-pen"></i> Update</a>
                    
                      <a href="<?php echo APPURL; ?>/jobs/job-delete.php?id=<?php echo $row->id; ?>" class="btn" style="background-color:red;"><i class="fas fa-trash"></i> Delete</a>
                    
                  </div>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>

          </div>

                <div class="tags">
                  <h3>Share</h3>
                  <a href="https://www.facebook.com/sharer/sharer.php?u=https://localhost/jobsite/jobs/job-single.php?id=<?php echo $row->id; ?>&quote=<?php echo $row->job_title; ?>"><i class="fa-brands fa-facebook"></i></a>
                  <a href="https://twitter.com/intent/tweet?text=<?php echo $row->job_title; ?>&url=<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $row->id; ?>"><i class="fa-brands fa-twitter"></i></a>
                  <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $row->id; ?>"><i class="fa-brands fa-linkedin"></i></a>
                </div>
          
                <div>

                <div class="tag">
                <h3>Category</h3>
                    <a href="<?php echo APPURL; ?>/categories/show-jobs.php?name=<?php echo $row->job_category; ?>"><?php echo ucfirst($row->job_category); ?></a>
                  
                </div>
                  <div class="tag">
                    <h3>Other categories</h3>
                    <?php foreach( $allCategories as $category) : ?>
                    <a target="_blank" href="<?php echo APPURL; ?>/categories/show-jobs.php?name=<?php echo $category->name; ?>"><p class="mb-2"><?php echo ucfirst($category->name); ?></p></a>
                  <?php endforeach; ?>
                  </div>
                </div>
        </div>
      </div>
    </section>




  <section class="jobs-container">
  <h3 class="heading"><?php echo $job_num->job_count; ?> related job(s)</h3>


    <div class="box-container">
    <?php foreach($related_job as $job) :?>


    <div class="box">

        
        <div class="company">
        <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $job->id; ?>">
          <img src="../users/user-images/<?php echo $job->company_image; ?>" alt="Free Website Template by Free-Template.co">
          
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
    <?php endforeach; ?>

    <div>
</section>



<?php require "../includes/footer.php"; ?>
