<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php 

    if(isset($_POST['submit'])) {
        // echo "submitted";

        $job_title =  $_POST['job-title'];
            $job_type =  $_POST['job-type'];

            //doind trending keywords
            $insert = $conn->prepare("INSERT INTO searches (keyword) VALUES(:keyword)");
            $insert->execute([
                ':keyword' => $job_title
            ]);


            $search = $conn->query("SELECT * FROM jobs WHERE job_title LIKE '%$job_title%' AND job_type LIKE '%$job_type%' AND status = 1");

            $search->execute();

            $searchRes = $search->fetchAll(PDO::FETCH_OBJ);
    } else {
        header("location: ".APPURL."");
    }


?>
<div class="section-title">Search results</div>
<section class="jobs-container">

    <div class="box-container">
    <?php if(count($searchRes) > 0) : ?>

    <?php foreach($searchRes as $oneJob) : ?>
        
        <div class="box">
            
                <div class="company">
                <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob->id; ?>">
                    <img src="users/user-images/<?php echo $oneJob->company_image; ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
                    
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
                        <p><i class="fas fa-dollar"></i> <span><?php echo $oneJob->salary; ?></span></p>
                    </div>

                </a>
                    
        </div>
    <?php endforeach; ?>
            <?php else : ?>
                <h3 class="alert">There are no searches with this job just yet.</h3>
            <?php endif; ?>
        </div>

    <div>
</section>
<?php require "includes/footer.php"; ?>
