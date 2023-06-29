<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 



    if(isset($_SESSION['type']) AND $_SESSION['type'] !== "Company") {

      header("location: ".APPURL."");
      
    } 


    $get_categories = $conn->query("SELECT * FROM categories");
    $get_categories->execute();

    $get_category = $get_categories->fetchAll(PDO::FETCH_OBJ);

    if(isset($_GET['id'])) {
        $id = $_GET['id'];


        $select = $conn->query("SELECT * FROM jobs WHERE id = '$id'");
        $select->execute();

        $singleJob = $select->fetch(PDO::FETCH_OBJ);

        if(isset($_SESSION['id']) AND $singleJob->company_id !== $_SESSION['id']) {
            header("location: ".APPURL."");
        }


    } else {
      header("location: ".APPURL."/404.php");
    }

    if(isset($_POST['submit'])) {

      if(empty($_POST['job_title']) OR empty($_POST['job_type']) OR empty($_POST['vacancy']) OR empty($_POST['experience']) 
      OR empty($_POST['salary']) OR empty($_POST['application_deadline']) OR empty($_POST['job_description'])
      OR empty($_POST['company_email']) OR empty($_POST['company_name']) OR empty($_POST['company_id']) OR empty($_POST['company_image']
      OR empty($_POST['job_category'])) 
      ) {
        echo "<script>alert('One or more inputs are empty')</script>";
      } else {

        $job_title = $_POST['job_title'];
        $job_type = $_POST['job_type'];
        $vacancy = $_POST['vacancy'];
        $job_category = $_POST['job_category'];
        $experience = $_POST['experience'];
        $salary = $_POST['salary'];
        $application_deadline = $_POST['application_deadline'];
        $job_description = $_POST['job_description'];
        $company_email = $_POST['company_email'];
        $company_name = $_POST['company_name'];
        $company_id = $_POST['company_id'];
        $company_image = $_POST['company_image'];


        $update = $conn->prepare("UPDATE jobs SET job_title = :job_title, job_type = :job_type, vacancy = :vacancy,
         job_category = :job_category, experience = :experience, salary = :salary, application_deadline = :application_deadline,
         job_description = :job_description, company_email = :company_email, company_name = :company_name, company_id = :company_id, company_image = :company_image WHERE id='$id'");

         $update->execute([

          ':job_title' => $job_title,
          ':job_type' => $job_type,
          ':vacancy' => $vacancy,
          ':job_category' => $job_category,
          ':experience' => $experience,
          ':salary' => $salary,
          ':application_deadline' => $application_deadline,
          ':job_description' => $job_description,
          ':company_email' => $company_email,
          ':company_name' => $company_name,
          ':company_id' => $company_id,
          ':company_image' => $company_image

         ]);

         header("location: ".APPURL."/jobs/job-update.php?id=".$id."");
        
      }
    }



?>

    <!-- HOME -->
<div class="section-title">Update job</div>    
    <section class="contact">

            <form action="job-update.php?id=<?php echo $id; ?>" method="post">
            
              <!--job details-->
            
              <div class="box">
                <p>Job Title</p>
                <input type="text" value="<?php echo $singleJob->job_title; ?>" name="job_title" class="input" id="job-title" placeholder="Product Designer">
              </div>

              <div class="box">
                <p>Job Type</p>
                <select name="job_type" class="input" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                  <option style="color: gray;" selected hidden><?php echo $singleJob->job_type; ?></option>
                  <option>Freelance</option>
                  <option>Part Time</option>
                  <option>Full Time</option>
                </select>
              </div>
              <div class="box">
                <p>Vacancy</p>
                <input name="vacancy" value="<?php echo $singleJob->vacancy; ?>" type="text" class="input" id="job-location" placeholder="e.g. 3">
              </div>
              <div class="box">
                <p>Job Category</p>
                <select name="job_category" class="input" id="job-type" data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Category">
                  <option style="color: gray;" selected hidden><?php echo $singleJob->job_category; ?></option>
                 <?php foreach($get_category as $category) : ?>
                  <option><?php echo ucfirst($category->name); ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="box">
                <p>Experience</p>
                <input type="text" name="experience" class="input" value="<?php echo $singleJob->experience; ?>">
              </div>
              <div class="box">
                <p>Salary</p>
                <input type="text" name="salary" class="input" value="<?php echo $singleJob->salary; ?>">
              </div>

              <div class="box">
                <p>Application Deadline</p>
                <input value="<?php echo $singleJob->application_deadline; ?>" name="application_deadline" type="text" class="input" id="" placeholder="e.g. 20-12-2022">
              </div>

              <div class="row box">
                <div class="col-md-12">
                  <p class="text-black">Job Description</p> 
                  <textarea name="job_description" id="" cols="30" rows="7" class="input" placeholder="Write Job Description..."><?php echo $singleJob->job_description; ?></textarea>
                </div>
              </div>
           
              <!--company details-->


              <div class="box">
                <input type="hidden" value="<?php echo $_SESSION['email']; ?>"name="company_email" class="input" id="" placeholder="Company Email">
              </div>
              <div class="box">
                <input type="hidden" name="company_name" value="<?php echo $_SESSION['username']; ?>" class="input" id="" placeholder="Company Name">
              </div>
              <div class="box">
                <input type="hidden" name="company_id" value="<?php echo $_SESSION['id']; ?>" class="input" id="" placeholder="Company ID">
              </div>
              <div class="box">
                <input type="hidden" name="company_image" value="<?php echo $_SESSION['image']; ?>" class="input" id="" placeholder="Company Image">
              </div>
        
              
              <div class="col-lg-4 ml-auto">
                  <div class="row">  
                    <div class="col-6">
                      <input type="submit" name="submit" class="btn" value="Update Job">
                    </div>
                  </div>
              </div>


            </form>
    </section>

    
    
<?php require "../includes/footer.php"; ?>