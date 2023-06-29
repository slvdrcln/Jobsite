<?php require '../../config/config.php';?>
<?php require '../includes/header.php'; ?>

<?php 
  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/admin-login.php");

  }

$select = $conn->query("SELECT * FROM admins");
$select->execute();

$admins = $select->fetchAll(PDO::FETCH_OBJ);
?>



<section class="playlist-form">

<h1 class="heading">List of admins</h1>
      <p class="description"><a href="<?php echo ADMINURL; ?>/admins/create-admin.php"><i class="fas fa-plus"></i> Add admin</a></p>

<table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">adminname</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($admins as $admin) : ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                   
                  </tr>
                  <?php endforeach; ?>
                
                </tbody>
              </table> 
</section>

<?php require '../includes/footer.php'; ?>
