<!-- <link href="css/timekeeping-app/view-clocked-time.css" rel="stylesheet"> -->

<div class='space70'></div>
    
<div class='form_area wide-form'>

    <h3 id='timekeeping-app-view-clocked-time-heading'>Clocked time</h3>

    <div class='divider'></div>

    <div class='timekeeping-app-view-employees-container'>

        <div class='space20'></div>
        
        <?php

            // Configure time finder bar
            // $employee_page_id = "timekeeping-app-item-finder-bar-clocked-time";
            // $search_box_shown = false;
            // include "item-finder-bar.php";

        ?>

        <div class='space20'></div>
        <div class='space20'></div>

        <?php

            $heading_page_id = "timekeeping-app-entry-data-heading-container-clocked-time";
            $number_of_buttons = 0;
            include "entry-data-heading-container.php";

        ?>

        <div class='space20'></div>

        <div id='timekeeping-app-view-clocked-time-load'></div>

    </div>

</div>

<script src='js/timekeeping-app/view-clocked-time.js'></script>