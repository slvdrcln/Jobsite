
<footer class="footer">
    <section class="grid">
        <div class="box">
            <h3>Quick links</h3>
                <a href="<?php echo APPURL; ?>"><i class="fas fa-angle-right"></i> Home</a>
                <a href="#"><i class="fas fa-angle-right"></i> About</a>
                <a href="<?php echo APPURL; ?>/jobs/all-jobs.php"><i class="fas fa-angle-right"></i> Jobs</a>
                <a href="<?php echo APPURL; ?>/contact.php"><i class="fas fa-angle-right"></i> Contact us</a>
                <a href="<?php echo APPURL; ?>"><i class="fas fa-angle-right"></i> Filter search</a>
        </div>

        <div class="box">
            <h3>Extra links</h3>
            <?php if(isset($_SESSION['username'])) : ?>
                <a href="<?php echo APPURL; ?>/users/public-profile.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-angle-right"></i> Account</a>
                <?php endif; ?>
                <a href="<?php echo APPURL; ?>/auth/login.php"><i class="fas fa-angle-right"></i> Login</a>
                <a href="<?php echo APPURL; ?>/auth/register.php"><i class="fas fa-angle-right"></i> Register</a>
            <?php if(isset($_SESSION['username'])) : ?>
                    <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company") : ?>
                        <a href="<?php echo APPURL; ?>/jobs/post-job.php"><i class="fas fa-angle-right"></i> Post job</a>
                    <?php endif; ?>
            <?php endif; ?>
                <a href="#"><i class="fas fa-angle-right"></i> Dashboard</a>
        </div>

        <div class="box">
            <h3>Social media</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-linkedin"></i> LinkedIn</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-tiktok"></i> Tiktok</a>
        </div>
    </section>
    <div class="credit">&copy; Copyright @ 2023 by <span><a target="_blank" href="https://darinphillips.com">darinphillips.com</a></span> | All rights reserved </div>
</footer>



<script src="http://localhost/jobsite/js/script.js"></script>
