<!-- //- Creates three columns - -->
<div style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>

                
    <div>
        <!-- Button to take employee to their calender -->
        <div style='height:43px;'>
            <a href='calender.php' 
            class='button-style-8'>Calender
            </a>
        </div>
        <!-- // Button to take employee to manage time -->
        <div style='height:43px;'>
            <a class='button-style-8' href='managetime.php'>Manage Time
            </a>
        </div>
    </div>
    
    <div class='box2'>
        <?php
            include 'clock.php';
        ?>
    </div>

    <div>
        <div id='clocked_alerts'>
            <div id='clocked_alert_area'>
                <h5>History</h5>
            </div>
        </div>
    </div>
                
</div>