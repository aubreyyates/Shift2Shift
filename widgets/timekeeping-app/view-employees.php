<link href="css/timekeeping-app/view-employees.css" rel="stylesheet">

<div class='space70'></div>
    
<div class='form_area wide-form'>

    <h3>Manage Employees</h3>

    <div class='divider'></div>

    <div class='timekeeping-app-view-employees-container'>

        <div class='space20'></div>
        
        <?php

            $employee_page_id = "timekeeping-app-item-finder-bar-employees";
            include "item-finder-bar.php";

        ?>

        <div class='space20'></div>
        <div class='space20'></div>

        <?php

            $heading_page_id = "timekeeping-app-item-finder-bar-employees-heading";
            $number_of_buttons = 2;
            include "entry-data-heading-container.php";

        ?>

        <div class='space10'></div>

        <div id='timekeeping-app-view-employees-load'></div>

    </div>

</div>

<script src='js/timekeeping-app/view-employees.js'></script>




