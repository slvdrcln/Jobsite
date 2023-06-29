<?php require '../../config/config.php';?>
<?php require '../includes/header.php'; ?>

<?php 

if(!isset($_SESSION['adminname'])) {
        
    header("location: ".ADMINURL."");

  }

if(isset($_POST['submit'])) {

    if(empty($_POST['adminname']) OR empty($_POST['email']) OR empty($_POST['password'])) {
      echo "<script>alert('some inputs are empty')</script>";
    } else {

      $adminname = $_POST['adminname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
     


       $insert = $conn->prepare("INSERT INTO admins (adminname, email, mypassword) 
            VALUES (:adminname, :email, :mypassword)");
  
      $insert->execute([
              ':adminname' =>  $adminname,
              ':email' =>  $email,
              ':mypassword' =>  password_hash($password, PASSWORD_DEFAULT),
            
      ]);  
  
     
          
         

       

       
          }
      }

?>

   
<section class="playlist-form">

   <h1 class="heading">Create admin</h1>

   <form action="create-admin.php" method="POST" enctype="multipart/form-data">

      
      <p>Email</p>
      <input type="text" name="email" maxlength="100" class="box">
      <p>Name</p>
      <input type="text" name="adminname" maxlength="100" class="box">
      <p>Password</p>
      <input type="password" name="password" maxlength="100" class="box"> 

      <input type="submit" value="Create" name="submit" class="btn">
   </form>

</section>