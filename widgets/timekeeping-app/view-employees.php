<link href="css/timekeeping-app/view-employees.css" rel="stylesheet">

<div class='space70'></div>
    
<div class='form_area wide-form'>

    <h3>Manage Employees</h3>

    <div class='divider'></div>

    <div class='timekeeping-app-view-employees-container'>

        <div class='space20'></div>
        
        <?php

            $page = "timekeeping-app-item-finder-bar-employees";
            $item_type = 'Employee';
            $search_box_shown = true;
            include "item-finder-bar.php";

        ?>

        <div class='space20'></div>
        <div class='space20'></div>
        <div class='space10'></div>

        <div id='timekeeping-app-view-employees-load' class='font-1'></div>

    </div>

</div>

<script src='js/timekeeping-app/view-employees.js'></script>




