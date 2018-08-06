<?php

    // Put the header into the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
    // Create the connection to the database
    include 'includes/dbh.inc.php';

?>


<!-- Add the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Put in many of the need functions for the page -->
<script src='function_1.js'></script>
<!-- For the arrows style on the page -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!-- Start of main part of page -->
<section class="main-container">
    <div style='width:1000px; margin:0 auto; '>          

        <!-- Create 3 columns for buttons -->
        <div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>
            <!-- Button to recover -->
            <a href='database_options.php' id='recover_projects'>
                Recover Deleted Projects
            </a>

            <!-- Button to make an export of the project -->
            <a href='database_options_employees.php' id='recover_employees'>
                Recover Deleted E Accounts
            </a>

            <!-- Button to make an export of the project -->
            <a href='database_options_admins.php' id='recover_admins'>
                Recover Deleted Admins
            </a>

            <!-- Button to make an export of the project -->
            <a href='database_options_entries.php' id='recover_entries'>
                Recover Deleted Entries
            </a>

            <!-- Button to make an export of the project -->
            <a href='database_options_managers.php' id='recover_managers'>
                Recover Deleted M Accounts
            </a>
        </div>
        <!-- End columns -->

    

        <!-- Button to make an export of the project -->
        <!-- <div style='float:left;'>
            <button type='submit' id='recover_all' style='width:180px;' class ='button-style-2'>
                Recover All Projects
            </button>
        </div>
        <br>
        <br> -->

        <!-- Top row 60px: 3 buttons and 2 dropdown menus -->
        <div style='width:100%; height:60px;'>
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the filter button -->
                <button id ='filter-button' name='commentSubmit' 
                    style=' width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    margin-right:20px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    <a style ='color:#fff;' >Filter</a>
                </button>

                <!-- Creates the drop down to select filter type -->
                <select id='filter-type' style='width: 150px;
                    margin-top:20px;
                    margin-right:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: #fff;
                    font-family: arial;
                    font-size: 16px;'>
                    <option>all</option>
                    <option>day</option>
                    <option>week</option>
                    <option>month</option>
                    <option>year</option>
                    <option>pay period</option>
                </select>
            </div>
        </div>


        <div  style='width:100%; height:74px;'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the drop down to select sorting type -->
                <select id='sorting_accounts' style='width: 150px;
                    margin-right:20px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: #fff;
                    font-family: arial;
                    font-size: 16px;'>
                    <option>Date Created</option>
                    <option>First</option>
                    <option>Last</option>
                    <option>E-mail</option>
                </select>
            </div>

            <div>
                <h5 style='float:right; margin-right:20px; line-height:74px;'> sort by: </h5>
            </div>

        </div>

        <div>
            <h3 id='view_type'>Viewing Deleted Admins</h3>
        </div>



        <div id='white_top' style='height:5px; width:100%;background-color:rgb(247, 247, 247); display:none'></div>

        <div class='alert_none' id ='none'><h3>There are no deleted admins! Time to celebrate!</h3></div>

        <?php
            include "arrows_filter_date.html";
        ?>

        <!-- Start list div -->
        <div id='list'>
        </div>
        <!-- End list div -->

        <?php
            include "arrows_pagination.html";
        ?>

    </div>
</section>
<!-- End main part of page -->




<script>

    // Create a canvas
    var canvas = document.createElement('canvas');
    // Create a canvas
    var ctx = canvas.getContext("2d");
    // Set the font of canvas
    ctx.font = "12px Arial";
    // Set filter date to false by default
    var filter_date = false
    // Set the current projects viewed
    var vnum_s = 0;
    // Set the last project to view
    var vnum_e = 25;  
    // Variable that can contain new objects for searching
    var search_objects = []   
    // Create moment object for earliest entry to be shown
    var date = moment();
    // Create moment object for latest entry to be shown
    var date_end = moment();

    var lines = []

    // When the page is ready do this
    $(document).ready(function() {
        // Set deleted load to load accounts
        deleted_load = 'set'


        $.post('load_deleted_admins_to_objects.php', {deleted_load:deleted_load}, function(result) {
            // Turn the result into JSON objects
            lines = JSON.parse(result)
            // Create an original
            original = lines
            // Display all managers 
            display_all()
            // Check to see if you need to put arrows to view more employees
            if (lines.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })
        

    });


    // What happens if the recover button is clicked
    $('#list').on('click', '.recover' , function() {
        // Get the manager email
        email = $(this).attr("data-email");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover admin " + email + " ?") == true) {
            // Get the id of the manager
            id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all projects in the database to active
            $.post('recover_admin.php', {recover:recover,id:id})
            // Go through projects
            for (i = 0; i < lines.length; i++) {
                // Find the entry with the same value
                if (id == lines[i].id) {
                    // Remove the entry
                    lines.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }

            // Check if they are filtering dates
            if (filter_date == false) {
                // If not, display all entries

                if (lines.length <= vnum_s && lines.length > 0) {
                    vnum_s -= 25
                    vnum_e -= 25
                }

                // Check if they are on first page
                if (vnum_s == 0) {
                    // Stop displaying the backward arrow as there are no more to see
                    $('#view-backward').css('display','none')
                }
                
                display_all()
            } else {
                // If so, display in that date range
                if (search_objects.length <= vnum_s && search_objects.length > 0) {
                    vnum_s -= 25
                    vnum_e -= 25
                }
                // Check if they are on first page
                if (vnum_s == 0) {
                    // Stop displaying the backward arrow as there are no more to see
                    $('#view-backward').css('display','none')
                }
                date_compare()
            }
        }
    });

</script>

<div class='show_long_text' style='display:none;'>
  
    <div class='info_content-2'><span id='height-measure'>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <p id='info_description_long'></p>
    </span></div>
    <div class='info_long_tip'></div>
</div>