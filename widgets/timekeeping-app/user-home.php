<?php

    include './backend/timekeeping-app/get-user-session-data.php'; 

?>

    <script src='js/timekeeping-app/moment.min.js'></script>
    <script src="js/timekeeping-app/duration-format.js"></script>
    <script src="js/timekeeping-app/display-items.js"></script>
    <script src="js/timekeeping-app/search-items.js"></script>
    <script src="js/timekeeping-app/sort-items.js"></script>
    <script src="js/timekeeping-app/search-for-item.js"></script>
    <script src="js/timekeeping-app/prepare-entry-line.js"></script>
    <script src="js/timekeeping-app/prepare-entry-headings.js"></script>
    <script src="js/timekeeping-app/prepare-empty-line.js"></script>
    <script src="js/timekeeping-app/create-employee-edit-form.js"></script>

    <link href="css/timekeeping-app/user-home.css" rel="stylesheet">
    <link href="css/timekeeping-app/edit-form.css" rel="stylesheet">
    <link href="css/timekeeping-app/entry-line.css" rel="stylesheet">
    <link href="css/timekeeping-app/item-finder-bar.css" rel="stylesheet">
    <link href="css/timekeeping-app/notify-widget.css" rel="stylesheet">
    <link href="css/timekeeping-app/entry-data-heading-container.css" rel="stylesheet">

    <div>

        
        <div id='nav-panel-container'>
            <?php 

                include './widgets/timekeeping-app/nav-panel.php'; 

            ?>
        </div>

        <div id='main-window-container'>

            <div id='user-stats-div' style='<?php if ($_SESSION['authority_level'] == 0) { echo "display:none"; } ?>'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include './widgets/timekeeping-app/header-display.php';
                        include './widgets/timekeeping-app/company-stats.php';

                    }
                    
                ?>
            </div>

            <div id='create-account-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include './widgets/timekeeping-app/create-account.php'; 

                    }
                    
                ?>
            </div>

            <div id='view-employees-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include './widgets/timekeeping-app/view-employees.php'; 

                    }
                    
                ?>
            </div>

            <div id='view-projects-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include './widgets/timekeeping-app/view-projects/view-projects.php'; 

                    }
                    
                ?>
            </div>

            <div id='view-clocked-time-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include './widgets/timekeeping-app/view-clocked-time.php'; 

                    }
                    
                ?>
            </div>

            <div id='user-timekeeping-clock-div' style='<?php if ($_SESSION['authority_level'] == 0) { echo "display:block"; } ?>'>
                <?php 

                    include './widgets/timekeeping-app/user-timekeeping-clock.php'; 
                    
                ?>
            </div>

            <?php 

                include './widgets/timekeeping-app/main-modal.php'; 

            ?>

        </div>
    </div>
