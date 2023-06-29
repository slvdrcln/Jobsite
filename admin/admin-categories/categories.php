<?php require "../../config/config.php"; ?>
<?php require "../includes/header.php"; ?>           

<?php

if(!isset($_SESSION['adminname'])) {

   header("location: ".ADMINURL."/admins/admin-login.php");

 }

$select = $conn->query("SELECT * FROM categories");
$select->execute();

$categories = $select->fetchAll(PDO::FETCH_OBJ);


?>


<section class="playlist-form">
    

   <h1 class="heading">Job categories</h1>
   <p class="description"><a href="<?php echo ADMINURL; ?>/admin-categories/add-category.php"><i class="fas fa-plus"></i> Add category</a></p>

   <table class="table">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">update</th>
            <th scope="col">delete</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach($categories as $category) : ?>
         <tr>
            <th scope="row"><?php echo $category->id; ?></th>
            <td><?php echo $category->name; ?></td>

            <td>
               <a href="<?php echo ADMINURL; ?>/admin-categories/update-category.php?id=<?php echo $category->id; ?>"><span style="color: green;"><i style="cursor: pointer;" class="fas fa-pen-to-square"></i></span></a>
            </td>

            <td>
               <a href="<?php echo ADMINURL; ?>/admin-categories/delete-category.php?id=<?php echo $category->id; ?>"><span style="color: #e74c3c;"><i style="cursor: pointer;" class="fas fa-trash"></i></span></a>
            </td>

            

         </tr>
         <?php endforeach; ?>
      </tbody>
   </table> 
   

</section>




















<?php require "../includes/footer.php"; ?>           

