<?php

    // Put head in the page
    include_once 'widgets/login-system/head.php';

?>

    <body>

        <!-- Start the header -->

        <?php 
            // Check if user is logged in
            if (isset($_SESSION['id'])) {
                echo "<header id='fixed-header'>";
            } else {
                echo "<header>";
            }
        ?>
            <nav>

                <div id='desktop' style='width:90%; margin:0 auto;'>

                    <ul>
                        <!-- The home button to go back to the home page which is index.php -->
                        <li><a href="index.php">Home</a></li>

                    </ul>
                    
                    <!-- The login part that is determined by what account type is logged in or if no one is logged in -->
                    <div class="nav-login">
                        <!-- Start php code -->
                        <?php
                            // Check if user is logged in
                            if (isset($_SESSION['id'])) {
                                // Create loggout button for admins
                                echo '<form action = "backend/login-system/logout-user.php" method="POST">
                                    <button type="submit" name="submit">Logout</button>
                                </form>';
                            } else {
                                // Create loggin area for someone
                                echo '
                                <div style="float:right;">
                                    <form id="account_admin" action = "backend/login-system/login-user.php" method="POST">
                                        <input id="input1" type="text" name="email" placeholder="Username/email">
                                        <input id="pwd1" type="password" name="pwd" placeholder="Password">
                                    </form>
                                    <button id="submit-form-login" name="submit">Login</button>
                                    <a href="signup.php">Signup</a>
                                </div>
                                <div id="header-spacing">
                                    <div id="login-alert">
                                            <div style="float:right;">
                                            <div class="info_alert_tip"></div>
                                        </div>
                                        <div class="info_alert"><span>
                                        
                                        <p id="info_description_alert">Invalid user or password</p>
                                        </span></div>
                                    </div>
                                </div>'; 
                            }

                        ?>
                        <!-- End php code -->
                    </div>

                    <?php 
                        // Check if user is logged in
                        if (isset($_SESSION['id'])) {
                            // Create the clock at the top
                            include "widgets/login-system/world-clock.php";
                        }
                    ?>

                </div>

                <div id='tablet-mobile'>
                    <button id='hamburger'><p class='fa fa-bars'></p></button>
                    <a href='index.php' id='shift2shift-homelink'>Shift2Shift</a>
                </div>
            </nav>
        </header>
        <!-- End of header -->


    
<?php 
    // Check if someone is logged in.
    if (isset($_SESSION['id'])) {
        include "widgets/login-system/hamburger-section-signed-in.php";
    } else {
        include "widgets/login-system/hamburger-section-signed-out.php";
    }
?>

<script src='js/login-system/header.js'></script>