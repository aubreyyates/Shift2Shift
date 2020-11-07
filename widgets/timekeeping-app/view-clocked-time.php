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

            $page = "timekeeping-app-item-finder-bar-timestamp";
            $item_type = 'Timestamp';
            $search_box_shown = false;
            include "item-finder-bar.php";

        ?>

        <div class='space20'></div>
        <div class='space20'></div>
        <div class='space10'></div>

        <div id='timekeeping-app-view-clocked-time-load'></div>

    </div>

</div>

<script src='js/timekeeping-app/view-clocked-time.js'></script>