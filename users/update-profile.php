<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 

    if(isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
    } else {
      $username = '';
      header("location: ".APPURL."");
    }


    

    if(isset($_GET['upd_id'])) {

        $id = $_GET['upd_id'];

        if($_SESSION['id'] == $id ) {
            $id = $_SESSION['id'];
        } else {
          header("location: ".APPURL."");
        }

        $select = $conn->query("SELECT * FROM users WHERE id='$id'");
        $select->execute();

        $row = $select->fetch(PDO::FETCH_OBJ);

        if(isset($_POST['submit'])) {

            if(empty($_POST['username']) OR empty($_POST['email'])) {
                echo "<script>alert('username or email are empty')</scribt>";
            } else {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $title = $_POST['title'];
                $education = $_POST['education'];
                $bio = $_POST['bio'];
                $facebook = $_POST['facebook'];
                $twitter = $_POST['twitter'];
                $linkedin = $_POST['linkedin'];
                $img = $_FILES['img']['name'];
                
                // condition ?  perform smth : perform smth else

                $row->type == "Worker" ? $cv = $_FILES['cv']['name'] : $cv = 'NULL'; 

                $dir_img = 'user-images/' . basename($img);
                $dir_cv = 'user-cvs/' . basename($cv);

                $update = $conn->prepare("UPDATE users SET username = :username, email = :email, title = :title, education = :education,
                 bio = :bio, facebook = :facebook, twitter = :twitter, linkedin = :linkedin, img = :img, cv = :cv WHERE id = '$id'");


                if($img !== '' AND $cv !== '') {

                    unlink("user-images/".$row->img."");
                    unlink("user-cvs/".$row->cv."");
                    
                    $update->execute([
                        ':username' => $username,
                        ':email' => $email,
                        ':title' => $title,
                        ':education' => $education,
                        ':bio' => $bio,
                        ':facebook' => $facebook,
                        ':twitter' => $twitter,
                        ':linkedin' => $linkedin,
                        ':img' => $img,
                        ':cv' => $cv,
                    ]);
                } else {
                    $update->execute([
                        ':username' => $username,
                        ':email' => $email,
                        ':title' => $title,
                        ':education' => $education,
                        ':bio' => $bio,
                        ':facebook' => $facebook,
                        ':twitter' => $twitter,
                        ':linkedin' => $linkedin,
                        ':img' => $row->img,
                        ':cv' => $row->cv,
                    ]);

                    header("location: ".APPURL."/users/public-profile.php?id=$id");

                }
              
               
                

                 if(move_uploaded_file($_FILES['img']['tmp_name'], $dir_img) AND move_uploaded_file($_FILES['cv']['tmp_name'], $dir_cv)) {
                    header("location: ".APPURL."");
                 }

            }
        }

        
    } else {

        echo "404";
    }


?>

<div class="section-title">Update profile</div>

  <section class="contact">

      
        
            <form action="update-profile.php?upd_id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="">
              <h3>Update</h3>
              <div class="flex">

              <div class="box">
                  <p>Name</p>
                  <input style="color:gray;" type="text" id="fname" value="<?php echo $row->fname; ?> <?php echo $row->lname; ?>" class="input" disabled>
                </div>
              
                <div class="box">
                  <p>Username</p>
                  <input type="text" id="fname" value="<?php echo $row->username; ?>" name="username" class="input">
                </div>

                <div class="box">
                  <p>Email</p>
                  <input type="text" id="lname" value="<?php echo $row->email; ?>" name="email" class="input">
                </div>
                
                <div class="box">
                  <p>Facebook</p> 
                  <input type="subject" name="facebook" value="<?php echo $row->facebook; ?>" id="subject" class="input">
                </div>

                <div class="box">
                  <p>Twitter</p> 
                  <input type="subject" name="twitter" value="<?php echo $row->twitter; ?>" id="subject" class="input">
                </div>

                <div class="box">
                  <p>Linkedin</p> 
                  <input type="subject" name="linkedin" value="<?php echo $row->twitter; ?>" id="subject" class="input">
                </div>


                <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                
                    
                <div class="box">
                <p>Title</p> 
                <input type="text" id="" value="<?php echo $row->title; ?>" name="title" class="input">
                </div>
            
          <?php else: ?>

            
                
                <div class="box">
                <input type="hidden" id="" value="NULL" name="title" class="input">
                </div>
            
          <?php endif; ?>


          <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>
                
                    
                <div class="box">
                <p>Education</p> 
                <select name="education" class="input" id="">
                <option selected hidden><?php echo $row->education; ?></option>
                  <option disabled>-</option>
                  <option>I did not graduate on high school</option>
                  <option>High school diploma</option>
                  <option>Associates degree</option>
                  <option>Bachelors degree</option>
                  <option>Post-graduate degree (Doctorate, Masters etc.)</option>
                </select>
                </div>
            
          <?php else: ?>

            
                
                <div class="box">
                <input type="hidden" id="" value="NULL" name="education" class="input">
                </div>
            
          <?php endif; ?>

                    <div class="box">
                  <p>Image</p> 
                  <input type="file" name="img" id="" class="input">
                </div>

                <!-- cv -->

              <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>

                <div class="box">
                  <p>CV <span></span></p> 
                  <input type="file" name="cv" id="" class="input">
                </div>

                <?php else: ?>

                <div class="box">
                  <input type="hidden" value="NULL" name="cv" id="" class="input">
                </div>

                <?php endif; ?>

                <!-- cv end -->

        </div>

              <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker") : ?>

                <p>Profile overview</p>
              <?php else: ?>
                <p>About the company</p>
                <?php endif; ?>
              <textarea id="" name="bio" cols="30" class="input" rows="10" maxlength="1000"><?php echo $row->bio; ?></textarea>
            <input type="submit" value="Update profile" name="submit" class="btn">
            </form>
          
          <!-- <div class="col-lg-5 ml-auto">
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">youremail@domain.com</a></p>

            </div>
          </div> -->
        
      
    </section>
<?php require "../includes/footer.php"; ?>
