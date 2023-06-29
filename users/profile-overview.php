<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 


$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $skillData[] = $row; 
    } 
} 

echo json_encode($skillData); 

if(isset($_SESSION['type']) AND $_SESSION['type'] !== "Worker") {

  header("location: ".APPURL."");
  
} 

if(isset($_POST['submit'])) {
  $type_of_work = $_POST['type_of_work'];
  $hours = $_POST['hours'];
  $salary = $_POST['salary'];
  $worker_email = $_POST['worker_email'];
  $worker_id = $_POST['worker_id'];
  $worker_username = $_POST['worker_username'];
  $skills = $_POST['skills'];

  $selected_skills_arr = explode(',', $skills);

  foreach($skills as $i){
    $skills=$i;


    $insert = $conn->prepare("INSERT INTO `workers` (salary, type_of_work, hours, worker_email,
    worker_id, worker_username, skills) VALUES(:salary, :type_of_work, :hours, :worker_email, :worker_id, :worker_username, :skills
    )");

    $insert->execute([

     ':salary' => $salary,
     ':type_of_work' => $type_of_work,
     ':hours' => $hours,
     ':worker_email' => $worker_email,
     ':worker_id' => $worker_id,
     ':worker_username' => $worker_username,
     ':skills' => $skills

    ]);

    header("location: ".APPURL."/users/profile-overview.php");
   
 
  
  }




   
}


?>



<div class="section-title">Update account</div>


  <section class="contact">

            <form action="profile-overview.php" method="post" enctype="multipart/form-data">
              <h3>Update</h3>
              
              <div class="flex">
              <!-- type of work -->
                <div class="box">
                  <p>Type of work</p> 
                  <select name="type_of_work" class="input" required>
                    <option disabled selected>-</option>
                    <option>Full time</option>
                    <option>Part time</option>
                    <option>Freelance</option>
                  </select>
                </div>
                <!-- type of work end  -->


                <!-- hours -->
                <div class="box">
                  <p>Hours per day</p> 
                  <input required type="number" name="hours" max="24" min="1" class="input">
                </div>
                <!-- hours end -->
                  <!-- salary -->
                    <div class="box">
                      <p>Salary per hour</p> 
                      <input required type="number" name="salary" max="100" min="1" class="input">
                    </div>
                    <!-- salary end -->

<div class="box">
  
</div>
<div class="box">
  
<div class="flex">
      <div data-module="Tokens" data-module-endpoint="tokens.json?q=${term}" data-module-strict="false" data-action="focus" name="skills[]" data-module-initial="One, Two">
            <div name="skills[]" data-name="tokensContainer"></div>
            <input type="text"
            class="input"
                  name="skills[]"
                  data-name="input"
                  data-action="search"
                  data-action-type="input"
                  placeholder="Search for something">
            <div data-name="resultsContainer"></div>
          </div>
          </div>
</div>






                    <div class="box">
                      <input type="hidden" name="worker_email" value="<?php echo $_SESSION['email']; ?>" class="input">
                    </div>

                    <div class="box">
                      <input type="hidden" name="worker_username" value="<?php echo $_SESSION['username']; ?>" class="input">
                    </div>

                    <div class="box">
                      <input type="hidden" name="worker_id" value="<?php echo $_SESSION['id']; ?>" class="input">
                    </div>

                </div>
            <input type="submit" value="Update profile" name="submit" class="btn">
            </form>
        
      





    </section>


 
 
    <section>
    </section>


<?php require "../includes/footer.php"; ?>
