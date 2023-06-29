<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>  


<?php


if(isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."");

}

if(isset($_POST['submit'])) {

      if(empty($_POST['email']) OR empty($_POST['password'])) {
      echo "<script>alert('some inputs are empty')</script>";
      } else {

          //checked fot the form submission
          //we need to grap the data
          //do the query with the email only 
          //we are going to execute and then fetch the data
          //check for the rowcount
          //check for the password


          
          $email = $_POST['email'];
          $password = $_POST['password'];

          $login = $conn->query("SELECT * FROM admins WHERE email = '$email'");
          $login->execute();

          $select = $login->fetch(PDO::FETCH_ASSOC);

          if($login->rowCount() > 0) {
              if(password_verify($password, $select['mypassword'])) {
                
                $_SESSION['adminname'] = $select['adminname'];
               
                $_SESSION['email'] = $select['email'];
                
                header("location: ".ADMINURL."");
                
                //echo "<script>alert('logged in')</script>";

              } else {
                  echo "<script>alert('invalid user')</script>";

              }
          } else {
              echo "<script>alert('invalid user')</script>";

          }

      }
  }



?>


<section class="form-container">

<form action="" method="post" enctype="multipart/form-data" class="login">
    <h3>Admin.</h3>
    <p>Email <span>*</span></p>
    <input type="email" name="email" placeholder="enter your email" maxlength="20" required class="box">
      <p>Password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" maxlength="20" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>

<?php require '../includes/footer.php'; ?>