<?php require "../includes/header.php"; ?>           
<?php require "../../config/config.php"; ?>


<?php 

if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM categories WHERE id = '$id'");
    $select->execute();

    $category = $select->fetch(PDO::FETCH_OBJ);


    if(isset($_POST['submit'])) {
   
      if(empty($_POST['name'])) {
  
        echo "<script>alert('input is empty'); </script>";
  
      } else {
        
        $name = $_POST['name'];
  
        $update = $conn->prepare("UPDATE categories SET name = :name WHERE id = '$id'");
        $update->execute([
  
          ':name' => $name
  
        ]);
      
        header("location: ".ADMINURL."/admin-categories/categories.php");
  
      }
     
    }

    
  } else {

    header("location: http://localhost/jobsite/404.php");

  }

?>


<section class="playlist-form">

   <h1 class="heading">Update category</h1>

   <form action="update-category.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

      
      <p>Category name</p>
      <input type="text" value="<?php echo $category->name; ?>" name="name" maxlength="100" class="box"> 

      <input type="submit" value="Update" name="submit" class="btn">
   </form>

</section>










<?php require "../includes/footer.php"; ?>           
