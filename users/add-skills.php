<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

    if(isset($_SESSION['type']) AND $_SESSION['type'] !== "Worker") {

        header("location: ".APPURL."");
        
    } 

    if(isset($_POST['add_skills'])){

        $skills = $_POST['skills'];
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_id = $_POST['user_id'];
        $user_image = $_POST['user_image'];


        foreach($skills as $i){
            $skills = $i;
            $insert = $conn->prepare("INSERT INTO skills SET skills='$skills', user_email='$user_email', user_name='$user_name', user_id='$user_id', user_image='$user_image'");

        }

        insert->execute([
            ':skills'=> $skills,
            ':user_email'=> $user_email,
            ':user_name'=> $user_name,
            ':user_id'=> $user_id,
            ':user_image'=> $user_image,

        ]);

        header("location: ".APPURL."");

    }




    
?>

<div class="section-title">Skills</div>    
    <section class="contact">

            <form action="add-skills.php" method="post">            
            <div class="box">
                <p>Skills</p>
                <input type="text" multiple class="input">
                <select type="text" id="skills" class="input" name="skills[]"  placeholder="Product Designer">
                <option value="">jhklj</option>
                <option value="">hello</option>
                <option value="">anneoyeong</option>
                <option value="">waso</option>
                </select>
            </div>
        
            <div class="box">
                <input type="hidden" value="<?php echo $_SESSION['email']; ?>"name="user_email" class="input" id="" placeholder="user email">
              </div>
              <div class="box">
                <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>" class="input" id="" placeholder="user name">
              </div>
              <div class="box">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" class="input" id="" placeholder="user ID">
              </div>
              <div class="box">
                <input type="hidden" name="user_image" value="<?php echo $_SESSION['image']; ?>" class="input" id="" placeholder="user Image">
              </div>
            
            <div class="col-lg-4 ml-auto">
                <div class="row">  
                    <div class="col-6">
                        <input type="submit" name="add_skills" class="btn" value="Add skills">
                    </div>
                </div>
            </div>


            </form>
    </section>
</div>

<?php require "../includes/footer.php"; ?>