<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>



<div class="section-title">Contact us</div>


<section class="contact">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-phone"></i>
            <a href="tel:123456789">091-234-5789</a>
            <a href="tel:123456789">157-823-5889</a>
        </div>

        <div class="box">
            <i class="fas fa-envelope"></i>
            <a href="mailto:gds@mail.com">gds@gmail.com</a>
            <a href="mailto:gds@mail.com">gds@gmail.com</a>
            <!-- todo email address -->
        </div>

        <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <a href="#">
                951 Crandon Blvd. #553
                Key Biscayne, FL 33149-0553
                USA </a>
        </div>

    </div>

    <form action="" method="post">
        <h3>Message us</h3>
        <div class="flex">
            <div class="box">
                <p>Name <span>*</span></p>
                <input type="text" name="name" class="input" id="" maxlength="20" required>
            </div>

            <div class="box">
                <p>Email <span>*</span></p>
                <input type="email" name="email" class="input" id="" maxlength="20" required>
            </div>

            <div class="box">
                <p>Phone number <span>*</span></p>
                <input type="text" name="phone" class="input" id="" min="0" maxlength="9999999" required>
            </div>

            <div class="box">
                <p>Role: <span>*</span></p>
                <select name="role" id="" class="input" required>
                    <option value="employee">Worker</option>
                    <option value="employer">Company</option>
                </select>
            </div>
        </div>
        <p>Message <span>*</span></p>
        <textarea name="message" id="" name="message" cols="30" class="input" required rows="10" maxlength="1000"></textarea>
        <input type="submit" value="Send message" name="message" class="btn">
    </form>


</section>