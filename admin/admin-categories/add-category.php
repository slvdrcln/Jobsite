<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>


<?php  

  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }

  if(isset($_POST['submit'])) {
   
    if(empty($_POST['name'])) {

      echo "<script>alert('input is empty'); </script>";

    } else {
      
      $name = $_POST['name'];

      $insert = $conn->prepare("INSERT INTO categories (name) VALUES(:name)");
      $insert->execute([

        ':name' => $name

      ]);
    
      header("location: ".ADMINURL."/admin-categories/categories.php");

    }
   
  }
 



?>





<section class="playlist-form">

   <h1 class="heading">Add category</h1>

   <form action="add-category.php" method="POST" enctype="multipart/form-data">

      
      <p>Category name</p>
      <input type="text" name="name" maxlength="100" class="box"> 

      <input type="submit" value="Create" name="submit" class="btn">
   </form>

</section>



















<?php require "../includes/footer.php"; ?>           
