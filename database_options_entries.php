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
                <select id='sorting_entries' style='width: 150px;
                    margin-right:20px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: #fff;
                    font-family: arial;
                    font-size: 16px;'>
                    <option>Date Created</option>
                    <option>Date</option>
                    <option>E-mail</option>
                    <option>Length</option>
                </select>
            </div>

            <div>
                <h5 style='float:right; margin-right:20px; line-height:74px;'> sort by: </h5>
            </div>

        </div>

        <div>
            <h3 id='view_type'>Viewing Deleted Entries</h3>
        </div>


        <div id='white_top' style='height:5px; width:100%;background-color:rgb(247, 247, 247); display:none'></div>

        <div class='alert_none' id ='entries_none'><h3>There are no deleted entries! Time to celebrate!</h3></div>





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

    // Create a canvas to measure string length in pixels
    var canvas = document.createElement('canvas');
    // Create a canvas
    var ctx = canvas.getContext("2d");
    // Set the font of canvas
    ctx.font = "12px Arial";
    // Set filter date to false by default
    filter_date = false
    // Set the current projects viewed
    vnum_s = 0;
    // Set the last project to view
    vnum_e = 25;  
    // Variable that can contain new objects for searching
    var search_objects = []   
    // Create moment object for earliest entry to be shown
    var date = moment();
    // Create moment object for latest entry to be shown
    var date_end = moment();

    // When the page is ready do this
    $(document).ready(function() {
        
        // Set the project_deleted_load
        project_deleted_load = 'set'
        // Set the entries_deleted_load
        entries_deleted_load = 'set'
        // Set the employees_deleted_load
        employees_deleted_load = 'set'
        // Set the managers_deleted_load
        managers_deleted_load = 'set'
        // Set filter date to false by default
        filter_date = false

        $.post('load_deleted_entries_to_objects.php', {entries_deleted_load:entries_deleted_load}, function(result) {
            // Turn the result into JSON objects
            entries = JSON.parse(result)
            // Create an original
            entries_original = entries
            
            // Display all entries
            display_all()
            // Check to see if you need to put arrows to view more projects
            if (entries.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        }) 
    // What happens if the filter button is clicked
    $( "#filter-button" ).click(function() {
        
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        // Set filter date to true. This lets us know we are using a filter
        filter_date = true;
        // Gets what filter type the user selected
        type = $('#filter-type').val()
        // If the type was all the page is refreshed
        if (type == 'all'){
            location.reload();

        // What happens if the type was year
        } else if (type == 'year') {
            $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
            date_compare()
        
        
        // What happens if the type was month
        } else if (type == 'month') {
            $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
            date_compare()
            

        } else if (type == 'week') {
            
            $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
            date_compare()
            
        
        // What happens if the type was day
        } else {
            $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            date = moment().startOf('day');
            date_end = moment().endOf('day');
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        $(document.getElementById('filter-date-slide')).css('display','block')
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
        //add_click_handlers();
    })

    // What happens if the arrow forward on the time filter is clicked
    $( "#time-forward" ).click(function() {  
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        if (type=='year') {
            date.add(1, 'years').calendar();
            date_end.add(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.add(1, 'months').calendar();
            date_end.add(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.add(7, 'days').calendar();
            date_end.add(7, 'days').calendar()
            week()
            date_compare()
        } else if (type=='day') {
            date.add(1, 'days').calendar();
            date_end.add(1, 'days').calendar();
            day()
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type});
        //add_click_handlers();
    })

    // What happens if the arrow backward on the time filter is clicked
    $( "#time-back" ).click(function() {
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        if (type=='year') {
            date.subtract(1, 'years').calendar();
            date_end.subtract(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.subtract(1, 'months').calendar();
            date_end.subtract(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.subtract(7, 'days').calendar();
            date_end.subtract(7, 'days').calendar();
            week()
            date_compare()
        } else if (type=='day') {
            date.subtract(1, 'days').calendar();
            date_end.subtract(1, 'days').calendar();
            day()
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
        //add_click_handlers();
    })

        // What happens if the arrow forward button is clicked
        $( "#view-forward" ).click(function() {
        // Display the back arrow to view previous
        $('#view-backward').css('display','inline')
        vnum_s += 25
        vnum_e += 25
        // Check if date filter is on
        if (filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })
    // What happens if the arrow backward button is clicked
    $( "#view-backward" ).click(function() {
        // Display the foward arrow to view more
        $('#view-forward').css('display','inline')
        vnum_s -= 25
        vnum_e -= 25
        // Check if date filter is on
        if (filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })


    });



    // Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
    function date_compare() {
        // Clear out the entries
        $('#list').html('')
        // Stop displaying info box that show decription
        $('.info_project').css('display','none')
        // Go through every entry
        
        for (i = 0; i < entries.length; i++) {  
            // Check if the search is in the name
            if ( moment(entries[i].date_deleted).unix() >= date.unix() && moment(entries[i].date_deleted).unix() < date_end.unix() ) {
                // Add to the search objects
                search_objects.push(entries[i])
            }
        }    
        // Check to see how far to make lines
        if (search_objects.length > vnum_e) {
            // Set max view to num_e
            max_view = vnum_e
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
            // Check if they are viewing the first projects
            if (vnum_s == 0) {
                // Stop displaying the backward arrow as there are no more to see
                $('#view-backward').css('display','none')
            }
            // Display the foward arrow
            $('#view-forward').css('display','inline')
        } else {
            // Set max view to length of project
            max_view = search_objects.length
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display','none')
        }      
                 
        for (i = vnum_s; i < max_view; i++) {
            
            // Get the html for the entry
            text = prepare_entry_line(search_objects[i].date, search_objects[i].time, search_objects[i].project_name, search_objects[i].email, search_objects[i].id)
            // Put the entry on #list
            var entry = $('#list').append(text)
            
        }
        // Reset the search objects 
        search_objects = []   
    }


    // What happens if the sorting menu is changed
    $('#sorting_entries').change(function() {
        
        if ($('#sorting_entries').val() == 'Length'){
            
            // Order by alphabetical last name
            entries = merge_length(entries)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }


        } else if ($('#sorting_entries').val() == 'Date'){
            
            // Order by alphabetical first name
            entries = merge_date(entries)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            } 
        } else if ($('#sorting_entries').val() == 'E-mail'){
            
            // Order by alphabetical email
            entries = merge_alphabetical_email(entries)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }
        } else if ($('#sorting_entries').val() == 'Date Created'){
            
            // Set back to original order
            entries = entries_original

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }
        }
    });


function year(){

    $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
    date_format = date.format('YYYY');
}
function month(){

    $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM');
}
function week() {

    $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM-DD');
}
function day(){

    $(document.getElementById('start-display')).val(date.startOf('day').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('end').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM-DD');        

}
    

    // Function to display all of the entries
    function display_all() {
        // Clear all projects
        $('#list').html('')

        if (entries.length == 0) {
            $('.alert_none').css('display','none')
            $('#white_top').css('display','none')
            $('#entries_none').css('display','block')
        } else {
            $('#white_top').css('display','block')
            $('.alert_none').css('display','none')
        }
        // Check to see how far to make lines
        if (entries.length > vnum_e) {
            // Set max view to num_e
            max_view = vnum_e
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
            // Check if they are viewing the first projects
            if (vnum_s == 0) {
                // Stop displaying the backward arrow as there are no more to see
                $('#view-backward').css('display','none')
            }
            
        } else {
            // Set max view to length of project
            max_view = entries.length
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1) + " - " + entries.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display','none')
            
        }     
        // Go through every entry
        for (i = vnum_s; i < max_view; i++) {
            // Get the html for the entry
            text = prepare_entry_line(entries[i].date, entries[i].time, entries[i].project_name, entries[i].email, entries[i].id)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
    }


    // Create the entry lines with html
    function prepare_entry_line(date, time, project_name, email, id) {

        // Create the text needed to create an entry
        text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
        line_data = " Date: " + date + " | Length: " + time + " | Project: " + project_name + " | Employee E-mail: " + email 
        text_2 = "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + id + "'><button value='" + id + "' data-project='" + id + "' data-email='" + email + "' style='float:right; margin-top:11px;' class='entry-button-style-2 recover_entry' type ='submit'>Recover</button></div></div>";
        // Get the length of the string in pixels
        var len = ctx.measureText(line_data).width;
        
        // Check if it is greater than 380
        if (len > 600) {
            
            
            // Keep removing letters until it is less than 375 pixels long
            while (len > 595) {
                // Remove the last letter
                line_data = line_data.substring(0, line_data.length - 1);
                // Get the new length of string in pixels
                len = ctx.measureText(line_data).width;
            }
            // Add dots at end
            line_data += "..."
            // Add a class to allow a float box 
            text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' data-project_name='" + project_name + "' data-date='" + date + "' data-time='" + time + "' data-email='" + email + "' style='float:left;margin-left:12px;font-size:16px;'>"
        }
        // Combine all three parts to one string
        text = text_1 + line_data + text_2
        // Return the text
        return text

    }


    // What happens if the recover button is clicked
    $('#list').on('click', '.recover_entry' , function() {
        // Get the project name
        employee_email = $(this).attr("data-email");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover the entry for " + employee_email + " ?") == true) {
            // Get the id of the project
            time_id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all the entry to active
            $.post('recover_entry.php', {recover:recover,time_id:time_id})
            // Go through projects
            for (i = 0; i < entries.length; i++) {
                // Find the entry with the same value
                if (time_id == entries[i].id) {
                    // Remove the entry
                    entries.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }
            // Display all of these entries at the start of page
            display_all()
            // Check if they are filtering dates
            if (filter_date == false) {
                // If not, display all entries
                if (entries.length <= vnum_s) {
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
                if (search_objects.length <= vnum_s) {
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
    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseenter', '.long_text' , function() {
        
        project_name = $(this).data('project_name')
        date = $(this).data('date')
        time = $(this).data('time')
        email = $(this).data('email')
        
        $('#info_description_long').text( "Date: " + date + " | Length: " + time + " | Project Name: " + project_name + " | E-mail: " + email)    
        // Get the height
        height = $('.show_long_text').height()

        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".show_long_text").css({
            position: "absolute",
            top: (topOffset - height)+ "px",
            left: (offset.left) + "px",
        });
        $('.show_long_text').css('display','block')
        
    })
    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseleave', '.long_text' , function() {
        $('.show_long_text').css('display','none')
    })

</script>

<div class='show_long_text' style='display:none;'>
  
    <div class='info_content-2'><span id='height-measure'>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <p id='info_description_long'></p>
    </span></div>
    <div class='info_long_tip'></div>
</div>
