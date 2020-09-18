<?php

    $dir = "timekeeping-app";
    include dirname(__DIR__).'/'.$dir.'/backend/get-user-session-data.php'; 

?>

    <script src='timekeeping-app/js/moment.min.js'></script>
    <script src="timekeeping-app/js/duration-format.js"></script>
    
    <link href="timekeeping-app/css/user-home.css" rel="stylesheet">

    <div>

        
        <div id='nav-panel-container'>
            <?php 

                include dirname(__DIR__).'/'.$dir.'/widgets/nav-panel/nav-panel.php'; 

            ?>
        </div>

        <div id='main-window-container'>

            <div id='user-stats-div'>
                <?php 

                    include dirname(__DIR__).'/'.$dir.'/widgets/header-display/header-display.php'; 
                    include dirname(__DIR__).'/'.$dir.'/widgets/user-stats/user-stats.php'; 
                    
                ?>
            </div>

            <div id='create-account-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include dirname(__DIR__).'/'.$dir.'/widgets/create-account/create-account.php'; 

                    }
                    
                ?>
            </div>

            <div id='view-projects-div'>
                <?php 

                    if ($_SESSION['authority_level'] >= 2) {

                        include dirname(__DIR__).'/'.$dir.'/widgets/view-projects/view-projects.php'; 

                    }
                    
                ?>
            </div>

            <div id='user-timekeeping-clock-div'>
                <?php 

                    include dirname(__DIR__).'/'.$dir.'/widgets/user-timekeeping-clock/user-timekeeping-clock.php'; 
                    
                ?>
            </div>



        </div>
    
    </div>
