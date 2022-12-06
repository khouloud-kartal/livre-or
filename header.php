<header>       
        <?php   
            if (session_status() == PHP_SESSION_NONE){
                session_start();}
        ?>
    <nav class="main-menu">
        <div class="scrollbar" id="style-1">
            <ul>
                <li><a href="index.php"><i class="fa fa-home fa-lg"></i><span class="nav-text">Home</span></a></li> 
                <?php if (!$_SESSION) {echo'<li><a href="signup.php"><i class="fa fa-user-plus fa-lg"></i><span class="nav-text">Sign Up</span></a></li>';}?>
                <?php if (!$_SESSION) {echo '<li><a href="login.php"><i class="fa fa-user fa-lg"></i><span class="nav-text">Login</span></a></li>';}?>
                <?php if ($_SESSION) {echo'<li><a href="profile.php"><i class="fa fa-user-pen fa-lg"></i><span class="nav-text">Profile</span></a></li>';}?>
                <li><a href="goldenbook.php"><i class="fa fa-comments fa-lg"></i><span class="nav-text">Golden Book</span></a></li>                
                <?php if ($_SESSION) {echo'<li><a href="comments.php"><i class="fa fa-comment fa-lg"></i><span class="nav-text">Comment</span></a></li>';}?>
                <?php if ($_SESSION) {echo'<li><a href="logout.php"><i class="fa fa-right-from-bracket fa-lg"></i><span class="nav-text">logout</span></a></li>';}?>
                <li><a href="mailto:khouloud.kartal@laplateforme.io"><i class="fa fa-envelope-o fa-lg"></i><span class="nav-text">Contact</span></a></li>     
            </ul>
        </div>
    </nav>   
</header>