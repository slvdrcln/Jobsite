<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['adminname'])) {

      header("location: ".ADMINURL."/admins/admin-login.php");

    }

    $select = $conn->query("SELECT * FROM jobs");
    $select->execute();

    $jobs = $select->fetchAll(PDO::FETCH_OBJ);

?>

<section class="playlist-form">
    

   <h1 class="heading">Jobs posted</h1>
   <?php foreach($jobs as $job) : ?>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Company</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($jobs as $job) : ?>
                  <tr>
                    <th scope="row"><?php echo $job->id; ?></th>
                    <td><?php echo $job->job_title; ?></td>
                    <td><?php echo $job->job_category; ?></td>
                    <td><?php echo $job->company_name; ?></td>
                    <?php if($job->status == 1) : ?>
                      <td><a href="<?php echo ADMINURL; ?>/admin-jobs/job-status.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>"><span style="color: green;"><i class="fa-solid fa-circle-check"></i></span></a></td>
                    <?php else : ?>

                     <td><a href="<?php echo ADMINURL; ?>/admin-jobs/job-status.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>"><span style="color: #e74c3c;"><i class="fa-regular fa-circle-check"></i></span></a></td>
                    <?php endif; ?>
                     <td><a href="<?php echo ADMINURL; ?>/admin-jobs/delete-job.php?id=<?php echo $job->id; ?>"><span style="color: #e74c3c;"><i class="fas fa-trash"></i></span></a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
<!-- 
   <div class="view">
   <a href="<?php echo ADMINURL; ?>/admin-categories/delete-job.php?id=<?php echo $category->id; ?>"><span style="float: right; padding-top: 1rem; font-size: 1.8rem; color: #e74c3c;"><i style="cursor: pointer;" class="fas fa-trash"></i></span></a>

            <?php if($job->status == 1) : ?>
            <a href="<?php echo ADMINURL; ?>/admin-jobs/status-jobs.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>"><span style="float: right; margin-right:1rem; padding-top: 1rem; font-size: 2rem; color: green;"><i style="cursor: pointer;" class="fa-solid fa-circle-check"></i></span></a>
            <?php else : ?>
            <a href="<?php echo ADMINURL; ?>/admin-jobs/status-jobs.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>"><span style="float: right; margin-right:1rem; padding-top: 1rem; font-size: 2rem; color: #e74c3c;"><i style="cursor: pointer;" class="fa-regular fa-circle-check"></i></span></a>
            <?php endif; ?>
            

        <div class="name"># <?php echo $job->id; ?></div>
         <div class="name">Job Title: <?php echo $job->job_title; ?></div>
         <p class="description"></p>
         <p class="description"><?php echo $job->job_category; ?></p>
         <p class="description"><?php echo $job->company_name; ?></p>

         <div class="flex-btn">
        <a href="<?php echo ADMINURL; ?>/admin-jobs/status-jobs.php?id=<?php echo $job->id; ?>&status=<?php echo $job->status; ?>" style="background-color: #e74c3c;" class="btn">reject</a>
        <a href="<?php echo ADMINURL; ?>/admin-jobs/delete-jobs.php?id=<?php echo $job->id; ?>" style="background-color: #e74c3c;" class="btn">delete</a>
        </div>
<hr style="border-top: 3px solid #bbb;">
   </div>
   <?php endforeach; ?> -->


</section>















<?php require "../includes/footer.php"; ?>           
