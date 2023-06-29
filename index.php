<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 

  $select = $conn->query("SELECT * FROM jobs WHERE status = 1 ORDER BY created_at DESC LIMIT 6");

  $select->execute();

  $jobs = $select->fetchAll(PDO::FETCH_OBJ);

  $searches = $conn->query("SELECT COUNT(keyword) AS count, keyword FROM searches
   GROUP BY keyword ORDER BY count DESC LIMIT 4");

  $searches->execute();

  $allSearches = $searches->fetchAll(PDO::FETCH_OBJ);



  $categories = $conn->query("SELECT * FROM categories");
  $categories->execute();

  $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);


?>
    <!-- HOME -->
    <div class="home-container" id="home-section">

      <section class="home">
            <form method="post" action="search.php">
              <h3>The easiest way to get your dream job</h3>
              <p>Job title</p>
                <input name="job-title" type="text" class="input" placeholder="Job title">
                
                  <p>Job type</p>
                  <select name="job-type" class="input" title="Select Job Type" required>
                    <option disabled selected>Select job type</option>
                    <option>Freelance</option>
                    <option>Part Time</option>
                    <option>Full Time</option>
                  </select>
                  
                  <input type="text" name="job-region" value="Anywhere" class="input" hidden>
                
                  <button type="submit" name="submit" class="btn"><i class="fas fa-search"></i> Search Job</button>
              
            </form>
      </section>

    </div>

    
<!--* Category -->

<section class="category">

    <h1 class="heading">Job categories</h1>

    <div class="box-container">
        <?php foreach( $allCategories as $category) : ?>
          <a class="box" target="_blank" href="<?php echo APPURL; ?>/categories/show-jobs.php?name=<?php echo $category->name; ?>">
            <!-- <i class="fas fa-briefcase"></i> -->
            <i class="<?php if($category->name == 'web development') { echo 'fas fa-window-restore'; } 
            elseif($category->name == 'graphics and multimedia') { echo 'fas fa-pen-nib'; } 
            elseif($category->name == 'design') { echo 'fas fa-pen'; } 
            elseif($category->name == 'office admin (Virtual Assistant)') {echo 'fas fa-clipboard';} 
            elseif($category->name == 'finance and management') {echo 'fas fa-coins';} 
            elseif($category->name == 'database') {echo 'fas fa-database';} 
            elseif($category->name == 'customer service') {echo 'fas fa-phone';} 
            elseif($category->name == 'sales and marketing') {echo 'fas fa-chart-simple';}
            elseif($category->name == 'email management') {echo 'fas fa-envelope';}
            elseif($category->name == 'advertising') {echo 'fas fa-rectangle-ad';}
            elseif($category->name == 'software development') {echo 'fas fa-code';}
            elseif($category->name == 'project management') {echo 'fas fa-file';}
            elseif($category->name == 'writing') {echo 'fas fa-keyboard';}?>"
            ><?php echo $job->job_type; ?></i>
            <div>
              <h3><?php echo ucfirst($category->name); ?></h3>
              <span><?php echo $category->count; ?></span>
            </div>
          </a>
        <?php endforeach; ?>


    </div>

</section>


<!--! Category ends -->

    

<section class="jobs-container">

    <h1 class="heading">Latest jobs</h1>

      <div class="box-container">
      <?php
      $i=0;
      foreach($jobs as $job) : ?>
        
        <div class="box">

            <div class="company">
            <a href="jobs/job-single.php?id=<?php echo $job->id; ?>">
              <img src="users/user-images/<?php echo $job->company_image; ?>" alt="users/user-images/<?php echo $job->company_image; ?>">
            
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
            <p style="<?php if($job->job_type == 'Part Time') { echo 'background-color: #009FBD; color:white'; } elseif($job->job_type == 'Full Time') { echo 'background-color: #54B435; color:white;'; } elseif($job->job_type == 'Freelance') {echo 'background-color: #F7E6C4; color: black;';}?>"><i class="fas fa-clock"></i> <?php echo $job->job_type; ?></p>
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

    <div class="homes-container" id="home-section">
      <section class="homes">
        <a href="jobs/all-jobs.php" class="btn">Browse job posts</a>
      </section>
    </div>
<?php require "includes/footer.php"; ?>