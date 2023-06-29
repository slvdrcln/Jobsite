<?php require "../config/config.php"; ?>

<?php require "../includes/header.php"; ?>

<?php 

  if(isset($_SESSION['username'])) {
        
    header("location: ".APPURL."");

  }

  if(isset($_POST['submit'])) {

    if(empty($_POST['username']) OR empty($_POST['fname']) OR empty($_POST['lname']) OR empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['re-password'])) {
      echo "<script>alert('some inputs are empty')</script>";
    } else {

      $username = $_POST['username'];
      $fname = $_POST['fname'];
      $terms = $_POST['terms'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $repassword = $_POST['re-password'];
      $img = 'avatar.png';
      $type= $_POST['type'];

      //checking for password match
      if($password == $repassword) {

        
        //checking for username 
        if(strlen($email) > 22 OR strlen($username) > 15 ) {
          echo "<script>alert('Email or username is too long')</script>";

        } else {


          //checking for username or pass avaialibilty
          $validate = $conn->query("SELECT * FROM users WHERE email = '$email' OR username = '$username'");
          $validate->execute();

          if($validate->rowCount() > 0) {
            echo "<script>alert('Email or username is already taken, try another one')</script>";

          } else {

            $insert = $conn->prepare("INSERT INTO users (fname, lname, username, email, terms, mypassword, img, type) 
            VALUES (:fname, :lname, :username, :email, :terms, :mypassword, :img, :type)");
  
            $insert->execute([
              ':fname' => $fname,
              ':lname' => $lname,
              ':username' => $username,
              ':terms' => $terms,
              ':email' => $email,
              ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
              ':img' => $img,
              ':type' => $type,
            ]);  
  
            header("location: login.php");
          }
          
         

        }

       

      } else {
        echo "<script>alert('Password do not match')</script>";

      }


    }
  }


?>
    <!-- HOME -->

    <div class="account-form-container">
    <section class="account-form">

        <form action="register.php" method="POST">
            <h3>Create a new account</h3>
            <input type="text" placeholder="First name" class="input" required name="fname" maxlength="100">
            <input type="text" placeholder="Last name" class="input" required name="lname" maxlength="100">
            <input type="text" placeholder="Username" class="input" required name="username" maxlength="50">
            <input type="email" placeholder="Email" class="input" required name="email" maxlength="50">
            <select name="type" class="input" id="" required>
                <option value="Job type" disabled selected>Select job type</option>
                <option value="Worker">Worker</option>
                <option value="Company">Company</option>
            </select>
            <input type="password" placeholder="Password" class="input" required name="password" maxlength="20">
            <input type="password" placeholder="Confirm password" class="input" required name="re-password" maxlength="20">

             <div class="checkbox">
            <input type="checkbox" name="terms" value="agree" required>
            <!-- TODO: terms and condition page -->
              <h2>I agree to <a href="">terms and conditions</a>.</h2>

            </div>
            <p>Already have an account? <a href="login.php">Login</a></p>
            <input id="submit" type="submit" value="Register" name="submit" class="btn">
        </form>


    </section>
</div>
    

<?php require "../includes/footer.php"; ?>
