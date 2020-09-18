<?php

    // Put header in the page
    include_once 'widgets/header.php';

?>

<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">

<!-- Main part of page -->
<section class="main-container-index">

        <?php
            
        // -------------------------------- Checks if an users is logged in --------------------------------
            if (isset($_SESSION['id'])) {

                $dir = "./timekeeping-app/";
                // This is an attempt to make this project modularized.
                include "timekeeping-app/user-home.php";
            
            // -------------------------------- End of user Code --------------------------------

                   

            // If no one is logged in, display the home page
            } else {

                include "widgets/home-page.php";

            }
        ?>
</section>

<!-- End main part of page -->

<?php
    // Put the footer in the page
    include_once 'footer.php';
?>











