<?php require "../config/config.php"; ?>

<?php require "../includes/header.php"; ?>

<?php 

    if(isset($_SESSION['username'])) {

      header("location: ".APPURL."");

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

            $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $login->execute();

            $select = $login->fetch(PDO::FETCH_ASSOC);

            if($login->rowCount() > 0) {
                if(password_verify($password, $select['mypassword'])) {
                  
                  $_SESSION['username'] = $select['username'];
                  $_SESSION['id'] = $select['id'];
                  $_SESSION['type'] = $select['type'];
                  $_SESSION['email'] = $select['email'];
                  $_SESSION['image'] = $select['img'];
                  $_SESSION['cv'] = $select['cv'];

                  header("location: ".APPURL."");
                  
                } else {
                    echo "<script>alert('invalid user')</script>";

                }
            } else {
                echo "<script>alert('invalid user')</script>";

            }

        }
    }



?>


    <!-- HOME -->

    <div class="account-form-container">
    <section class="account-form">

        <form action="" method="post">
            <h3>Aloha!</h3>
            <input type="text" placeholder="Email" class="input" required name="email" maxlength="50">
            <input type="password" placeholder="Password" class="input" required name="password" maxlength="30">
            <p>Don't have an account yet? <a href="register.php">Register now</a></p>
            <input type="submit" value="Login" name="submit" class="btn">
        </form>

    </section>
</div>


<?php require "../includes/footer.php"; ?>
