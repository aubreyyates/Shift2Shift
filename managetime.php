<?php
    // Put the header on the page
    include_once 'header.php';
    // Check to make sure an employee is logged in
    if (!isset($_SESSION['e_id'])) {
        // If not, exit the code
        exit;
    }
    // Create database connection
    include 'includes/dbh.inc.php';
?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- Main part of page -->
<section class="main-container">
    <div class="centered-wrapper">


        <div class='shadow'>
        <!-- Creates the top header that says Manage Time -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Time</h4>
            </div>
        </div>

        <div class='space20' style=' background-color:rgb(247, 247, 247)'></div>
    
        <!-- 1st row or top row : 1 button 1 dropdown menu -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
            


                <!-- <form method='GET' action='managetime.php'>
                    <button  
                        style=' width: 150px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        margin-right:20px;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;'>
                        Filter
                    </button>

                    <select name='project_filter' id='project-select' class='dropdown-style-1' style='width: 150px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        border: none;
                        background-color: rgb(200, 200, 200);
                        font-family: arial;
                        font-size: 16px;'>
                            <option value='0'>No Project</option>
                            <?php
                                // // Get the employee's id
                                // $emp_id = $_SESSION['e_id'];
                                // // Get all the projects the employee is assigned to
                                // $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                                // // Put the result in result
                                // $result2 = mysqli_query($conn, $sql); 
                                // // Go through each result
                                // while ($row = $result2->fetch_assoc()) {
                                //     // Get the project id
                                //     $project_id = $row['project_id'];
                                //     // Find the project with that id
                                //     $sql = "SELECT project_name FROM projects WHERE project_id = '$project_id';";
                                //     // Put the result into $result3
                                //     $result3 = mysqli_query($conn, $sql);
                                //     // Go through the result
                                //     while ($row2 = $result3->fetch_assoc()) {
                                //         // Get the project name
                                //         $project_name = $row2['project_name'];
                                //     }
                                //     // Put the project into an option
                                //     echo "<option value='$project_id'>$project_name</option>";
                                // }
                            ?>
                    </select>
                </form> -->

                <?php


                        // echo"<a href='managetime.php'
                        // style=' width: 60px; line-height:40px;
                        // margin-top:20px;
                        // height: 40px;
                        // float:left;
                        // margin-right:20px;
                        // border: none;
                        // background-color: rgb(218, 218, 218);
                        // font-family: arial;
                        // font-size: 16px;
                        // color: #fff;
                        // cursor: pointer;'>
                        // All
                        // </a>";


                ?>

                <!-- Creates the filter button
                id: filter-button 
                name: commentSubmit-->
                <button id ='filter-button' name='commentSubmit' class='button-style-4 right'>
                    Filter
                </button>

                <!-- Creates the drop down to select filter type
                sets filter type to: all, day, month, or year
                id: filter-type -->
                <select id='filter-type' class='dropdown-style-3' style='float:right;'>
                    <option>all</option>
                    <option>day</option>
                    <option>week</option>
                    <option>month</option>
                    <option>year</option>
                    <option>pay period</option>
                </select>
            </div>            
        </div>
        
        
       <!-- 2nd row: 1 button , 1 dropdown menu-->
       <div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Created</option>
                    <option>Date</option>
                    <option>Alphabetical</option>
                    <option>Length</option>
                </select>
            </div>
        </div>
        
        <!-- Creates arrow buttons for filtering dates. Hidden until filter used -->
        <div style ='display:none; height:54px; margin-top:-54px; background-color:rgb(247, 247, 247);width:100%;'id='filter-date-slide' class='search-results'>
            <div style='float:left; margin-top:-3px; margin-left:24%;'>
                <button class='arrow-button' id='time-back' style=''><p class='fa fa-chevron-left'></p>
                </button>
            </div>
            <div style='float:right; margin-top:-3px; margin-right:24%;'>
                <button class='arrow-button' id='time-forward' style=''><p class='fa fa-chevron-right'></p>
                </button>
            </div>

            <div style='float:left; margin-left:4%;'>
                <input id='start-display' style='height:30px;width:150px;font-size:12px;' type='date'>
            </div>
            <div style='float:left; margin-left:1%;'><p>to:</p></div>
            <div style='float:right; margin-right:3%;'>
                <input id='end-display' style='height:30px;width:150px;font-size:12px;' type='date'>
            </div>
        </div>        
        
        <div id='list'>
        </div>
    </div>



        <?php
            include 'clock_total_time.html'
        ?>


        <?php
            include 'arrows_pagination.html';
        ?>



    </div>


    
</section>



<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Add a moment format -->
<script src="duration_format.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>

<script>

    // When the page is ready this is run
    $(document).ready(function readyDoc() {

        var clicked_project_id;
        //get current date and time
        var date = moment();
        
        var type = 'none';

        var date_format;
        // Default filter_date to false
        var filter_date = false;
        // Create moment object for latest entry to be shown
        var date_end = moment();
        // Create a canvas to measure string length in pixels
        var canvas = document.createElement('canvas');
        // Create a canvas
        var ctx = canvas.getContext("2d");
        // Set the font of canvas
        ctx.font = "12px Arial";
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;  
        // Variable that can contain new objects for searching
        var search_objects = [] 
        // Set emp load
        emp_load = 'set'


        // Get all of the entries from the project
        $.post('load_employee_entries_to_objects_employees.php', {emp_load:emp_load}, function(result) {
            // Turn the result into JSON objects
            entries = JSON.parse(result)
            // Create a copy 
            entries_original = entries
            // Display all of these entries at the start of page
            display_all()
            // Go through all entries
            for (i=0; i<entries.length;i++) {
                // Sanitize the code, prevent XSS              
                entries[i].description = DOMPurify.sanitize(entries[i].description);
                entries[i].date = DOMPurify.sanitize(entries[i].date);
                entries[i].time = DOMPurify.sanitize(entries[i].time);
                entries[i].start = DOMPurify.sanitize(entries[i].start);
                entries[i].end = DOMPurify.sanitize(entries[i].end);
                entries[i].startdiem = DOMPurify.sanitize(entries[i].startdiem);                
                entries[i].enddiem = DOMPurify.sanitize(entries[i].enddiem);
                entries[i].project_name = DOMPurify.sanitize(entries[i].project_name);
            }

            // Check to see if you need to put arrows to view more projects
            if (entries.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })

        // Create the entry lines with html
        function prepare_entry_line(project_name,date,time,id,start,startdiem,end,enddiem,description,project_id) {
            // Create the text for the entry
            text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
            line_data =  "Project Name: " + project_name + " | Date: " + date + " | Time: " + time 
            text_2 = "</div><button type='submit' value='" + id + "' class='info_button_managetime entry-button-style-2 wide60' name='time_id'>Info</button><button type='button' data-project_id='" + project_id + "'data-start='" + start +"' data-startdiem ='" + startdiem + "' data-end='" + end +"' data-enddiem='" + enddiem + "' data-date='" + date + "' data-description='" + description + "' value='" + id + "' class='edit_entry entry-button-style-2 wide60' name='time_id'>Edit</button></div></div>";
            // Get the length of the string in pixels
            var len = ctx.measureText(line_data).width;
            // Check if it is greater than 380
            if (len > 560) {
                // Keep removing letters until it is less than 375 pixels long
                while (len > 560) {
                    // Remove the last letter
                    line_data = line_data.substring(0, line_data.length - 1);
                    // Get the new length of string in pixels
                    len = ctx.measureText(line_data).width;
                }
                // Add dots at end
                line_data += "..."
                // Add a class to the text div so you can hover and see the rest
                text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' data-project_name='" + project_name + "' data-date='" + date + "' data-time='" + time + "' style='float:left;margin-left:12px;font-size:16px;'>"
            }
            text = text_1 + line_data + text_2
            // Return the text
            return text
        }
        
        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            
            if ($('#sorting').val() == 'Alphabetical') {
                

                entries = merge_alphabetical_project_name(entries)

                if ( filter_date == false){
                    
                    display_all()
                } else {
                    date_compare()
                }


            } else if ($('#sorting').val() == 'Date'){

            
                entries = merge_date(entries)
                if ( filter_date == false){
                 
                    display_all()
                } else {
                    date_compare()
                }
                

                            
            } else if ($('#sorting').val() == 'Length'){

                entries = merge_length(entries)
                if ( filter_date == false){
                    display_all()
                } else {
                    date_compare()
                }



            } else if ($('#sorting').val() == 'Date Created') {
                entries = entries_original
                if ( filter_date == false){
                    display_all()
                } else {
                    date_compare()
                }


            }
        })

        // Function to display all of the entries
        function display_all(){
            // Clear all entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
            // Check to see how far to make lines
            if (entries.length > vnum_e) {
                // Set max view to num_e
                max_view = vnum_e
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
                // Check if they are viewing the first entries
                if (vnum_s == 0) {
                    // Stop displaying the backward arrow as there are no more to see
                    $('#view-backward').css('display','none')
                }
                
            } else {
                // Set max view to length of entries
                max_view = entries.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + entries.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }
            // Go through every entry
            for (i = vnum_s; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(entries[i].project_name,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description,entries[i].project_id)
                // Put the entry on #list
                var entry = $('#list').append(text)
                // Create time entry object
                entry_time = moment.duration(entries[i].time)  
                // Add to the total time
                total_time.add(entry_time) 
            }
            // Put the total time at the bottum
            $('#total_time').html(total_time.format('HH:mm:ss'))
        }

        // Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
        function date_compare() {
            // Clear out the entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
            // Go through every entry
            for (i = 0; i < entries.length; i++) {  
                // Check if the search is in the name
                if ( moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix() ) {
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
            // Go through every entry
            for (i = vnum_s; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(search_objects[i].project_name,search_objects[i].date ,search_objects[i].time, search_objects[i].id, search_objects[i].start,search_objects[i].startdiem,search_objects[i].end,search_objects[i].enddiem ,search_objects[i].description,entries[i].project_id)
                // Put the entry on #list
                var entry = $('#list').append(text)
                // Create time entry object
                entry_time = moment.duration(search_objects[i].time)  
                // Add to the total time
                total_time.add(entry_time) 
            }
            // Put the total time at the bottum
            $('#total_time').html(total_time.format('HH:mm:ss'))
            // Reset the search objects 
            search_objects = []   
        }

        // What happens if the arrow forward button is clicked
        $( "#view-forward" ).click(function() {
            // Display the back arrow to view previous
            $('#view-backward').css('display','inline')
            vnum_s += 25
            vnum_e += 25
            // Check if date filter is on
            if ( filter_date == false){
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
            if ( filter_date == false){
                // Display all of these projects at the start of page
                display_all()
            } else {
                // Display only filtered dates
                date_compare()
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

            filter_date = true;

            // Gets what filter type the user selected
            //all, day, month, or year
            type = $('#filter-type').val()

            

            // If the type was 'all' the page is refreshed
            switch (type) { //should use switch statement
             
            case 'all': 
                // Refreshes page
                location.reload();
                break;
            
            // What happens if the type was year
            case 'year':
                $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
                date_compare()
                break;
            
            // What happens if the type was month
            case 'month':
                $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
                date_compare()
                break;

            // What happens if the type was month
            case 'week':
                $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
                date_compare()
                break;
            
            // What happens if the type was day
            default:
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
                date_compare()
                break;
            }
            // Load what is found for that date into the #search-results div
            $(document.getElementById('filter-date-slide')).css('display','block')
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
        })
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

        // What happens if the date is changed on the custom start calendar
        $('#start-display').change(function() {

            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Stop displaying the backward arrow
            $('#view-backward').css('display','none')

            if ( moment($('#start-display').val()).unix() < date_end.unix()) {
                date = moment($('#start-display').val())
                
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
                date_compare()
            } else {
                alert("Your start date is later than your end date.")
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            }
            
        })
        // What happens if the date is changed on the custom end calendar
        $('#end-display').change(function() {

            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Stop displaying the backward arrow
            $('#view-backward').css('display','none')

            if ( date.unix() < moment($('#end-display').val()).unix()) {
                date_end = moment($('#end-display').val())
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
                date_compare()
            } else {
                alert("Your start date is later than your end date.")
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            }
        })       
        // what happens if the info button on an entry is clicked
        $( ".info_button_managetime" ).click( function() {
            // Get the entrie's id
            time_id = $(this).val();
            // Load the entrie's info into the #entry_info on the info_modal
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            // Display the info modal
            $("#info_modal").css("display","block");
        });

        // What happens if you click the x on the info modal
        $( "#exit_data" ).click( function() {
            // Stop displaying the info modal
            $("#info_modal").css("display","none");  
        });
        // What happens if you click the cancel button on the edit entry modal
        $( "#cancel_edit_entry" ).click( function() {
            // Stop displaying the edit_entry_modal
            $("#edit_entry_modal").css("display","none"); 
        });
        // What happends if the save button is clicked while editing an entry
        $( "#save_edit" ).click(function() {
            
            // Get the date that was entered
            date_for_edit = $('#date_edit').val()
            // Make sure they enter a date
            if (date_for_edit != '') {     
                // Get the entered start time    
                start = $('#start_edit').val()
                // Get the entered end time
                end = $('#end_edit').val()
                // Get the chosen AM/PM for start
                start_diem = $('#start_diem_edit').val()
                // Get the chosen AM/PM for end
                end_diem = $('#end_diem_edit').val()
                // Make sure the start time is a valid time
                if (moment(date_for_edit+" "+start+" "+start_diem).isValid()) {
                    // Make sure the end time is a valid time
                    if (moment(date_for_edit+" "+end+" "+end_diem).isValid()) {
                        // Check to make sure the end time is later than the start time
                        if (moment(date_for_edit+" "+start+" "+start_diem).unix() < moment(date_for_edit+" "+end+" "+end_diem).unix()) {
                            
                            // Get the length of the entry
                            time = moment.duration(moment(date_for_edit+" "+end+" "+end_diem).diff(moment(date_for_edit+" "+start+" "+start_diem))).format('HH:mm:ss')
                            time_id = $('#tid2').val()
                            project_id = $('#project_id').val()
                            description = $('#description_edit').val()

                            
                            
                            project_name = $('#project_id').find(":selected").data('project_name')

                            $.post('edit_entry_for_employees.php', {date:date_for_edit,start:start,end:end,start_diem:start_diem,end_diem:end_diem,project_id:project_id,description:description,time_id:time_id}, function() {
                                
                                for (var i = 0; i < entries.length; i++) {
                                    
                                    if (entries[i].id === time_id) {
                                        
                                        entries[i].date = date_for_edit;
                                        entries[i].time = time;
                                        entries[i].start = start;
                                        entries[i].project_id = project_id;
                                        entries[i].project_name = project_name;
                                        entries[i].startdiem = start_diem;
                                        entries[i].end = end;
                                        entries[i].enddiem = end_diem;  
                                          
                                        entries[i].description = description;
                                        if ( filter_date == false){
                                            display_all()
                                        } else {
                                            date_compare()
                                        }
                                        break
                                    }
                                }
                            });

                            $(document.getElementById('edit_entry_modal')).css('display','none');
                        } else {
                            alert("Your start time is later than your end time.")
                        }
                    } else {
                        alert("Your end time is not a valid time")
                    }
                } else {
                    alert("Your start time is not a valid time.")
                }
            } else {
                alert("You must enter a date.");
            }
            
        })
        // What happends if the save button is clicked while editing an entry
        $( "#save_edit2" ).click(function() {
           
            filter = $('#filter').val()
            time_id = $('#tid2').val()
            project_id = $('#project_id').val()
            
            project_name = $('#project_id').find(":selected").data('project_name')
            description = $('#description_edit').val()
            $.post('edit_entry_for_employees.php', {project_id:project_id,description:description,time_id:time_id}, function() {
                for (var i = 0; i < entries.length; i++) {
                                    
                    if (entries[i].id === time_id) {
                        
                        entries[i].project_name = project_name
                            
                        entries[i].description = description;

                        if ( filter_date == false){
                            display_all()
                        } else {
                            date_compare()
                        }
                        break
                    }
                }
            });

            $(document.getElementById('edit_entry_modal')).css('display','none');

        })
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('edit_entry_modal')).css('display','none');
            // Stop displaying info_modal
            $(document.getElementById('info_modal')).css('display','none');
            // Stop displaying add_entry_modal  
            $(document.getElementById('add_entry_modal')).css('display','none');    
        });


        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_edit_entry_modal")));
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_add_entry_modal")));
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_info_modal")));
        
        function dragElement(elmnt) {
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        if (document.getElementById(elmnt.id + "header")) {
            /* if present, the header is where you move the DIV from:*/
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
        } else {
            /* otherwise, move the DIV from anywhere inside the DIV:*/
            elmnt.onmousedown = dragMouseDown;
        }

        function dragMouseDown(e) {
            e = e || window.event;
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }

        function elementDrag(e) {
            e = e || window.event;
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
        }

        function closeDragElement() {
            /* stop moving when mouse button is released:*/
            document.onmouseup = null;
            document.onmousemove = null;
        }
        }
    });



    $('#list').on('click', '.edit_entry' , function(){
        // Display the edit_entry_modal
        // Get the entrie's id
        $('#tid2').val($(this).val());
        $('#date_edit').val($(this).attr("data-date"))
        $('#description_edit').val($(this).attr("data-description"))
        $('#start_edit').val($(this).attr("data-start"))
        $('#end_edit').val($(this).attr("data-end"))
        $('#start_diem_edit').val($(this).attr("data-startdiem"))
        $('#end_diem_edit').val($(this).attr("data-enddiem")) 
        //$('#project_id').val($(this).attr('data-project_id'))
        $("#edit_entry_modal").css("display","block");
        project_id = $(this).attr('data-project_id')
        var optionValues = [];
        $('#project_id option').each(function() {
            optionValues.push($(this).val());
        });
        var found = $.inArray(project_id, optionValues)
        if (found != -1) {
            $('#project_id').val($(this).attr('data-project_id'))
        } else {
            $('#project_id').val(0)
        }

    });
    $("#list").on("mouseenter", '.entry-button-style-2', function () {
        $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry-button-style-2', function () {
        $(this).parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry_line', function () {
        $(this).css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseenter", '.entry_line', function () {
        $(this).css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $('#list').on('click', '.time_id' , function(){
        // Display the myModal
        $(document.getElementById('myModal')).css('display','block');
        $('#tid').val($(this).val());
        $('#date_edit').val($(this).attr("data-date"))
        $('#description_edit').val($(this).attr("data-description"))
        $('#start_edit').val($(this).attr("data-start"))
        $('#end_edit').val($(this).attr("data-end"))
        $('#start_diem_edit').val($(this).attr("data-startdiem"))
        $('#end_diem_edit').val($(this).attr("data-enddiem"))
    });
    $('#list').on('click', '.info_button_managetime' , function(){
        time_id = $(this).val();
        $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
        $("#info_modal").css("display","block");
    });
    $('#list').on('click', '.add_entry' , function(){
        // Display the add_entry_modal
        $("#add_entry_modal").css("display","block"); 
    });
    $("#list").on("click", '.entry-button-style-2', function () {
        // Prevent entry line from activating 
        stopPropagation() 
    });
    $("#list").on("click", '.checkbox-container', function () {
        // Prevent entry line from activating 
        stopPropagation() 
    });
    // What happens when an edit button on one of the projects in clicked
    $('#list').on('click', '.entry_line' , function() {
        description = $(this).children( ".edit" ).data('description')
        // date = $(this).children( ".box-button" ).data('date')
        // $('#info_date').text(date)
        $('#info_description').text(description)
        //$('.info_project').css('opacity','0')
        $('.info_project').css('display','none')     
        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".info_project").css({
            position: "absolute",
            top: (topOffset)+ "px",
            left: (offset.left-323) + "px",
        });
        $('.info_project').css('display','block')
    })

    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseenter', '.long_text' , function() {
        
        project_name = $(this).data('project_name')
        date = $(this).data('date')
        time = $(this).data('time')
        
        $('#info_description_long').text("Project Name: " + project_name + " | Date: " + date + " | Time: " + time)    
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

    // Start the continuous clock at the top of the page. It ticks once per a second
    setInterval(function(){ continuous_clock() }, 1000);
    // Put the clock into a variable
    var clockDisplay = document.getElementById('world_clock');
    // Set the clock to the current time
    clockDisplay.innerHTML = moment().format('hh:mm:ss A');
    // Function to run clock at the top of the page that displays the time
    function continuous_clock() {
        // Put the clock into a variable
        var clockDisplay = document.getElementById('world_clock');
        // Set the clock to the current time
        clockDisplay.innerHTML = moment().format('hh:mm:ss A');
    }

        
  
</script>



<!-- Hidden modals -->

<div class='show_long_text' style='display:none;'>

  <div class='info_content-2'><span id='height-measure'>
  <!-- <p>Date:</p><p id='info_date'></p> -->
  <p id='info_description_long'></p>
  </span></div>
  <div class='info_long_tip'></div>
</div>


<div id="info_modal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:630px; background-color:#fff; margin-top:2%;'>
    
    <input  name='emp_id' id='emp_id' value=<?php echo $emp_id; ?> type='hidden'>

    <input  name='time_id' id='tid' value='' type='hidden'>

    <div style='height:20px; background-color:#f4f9ff;'></div>
    <div id='entry_info'>
    
    </div>
        <div style='height:65px;  background-color:#f4f9ff;'>
            <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                margin-top:15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                
                cursor: pointer;'>Export</button>
        
            <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                margin-top:15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Exit</button>
        </div>     
    </div>
</div>


<?php


    // Creates database connection
    include 'includes/dbh.inc.php';
    // Get the current id
    $org_id = $_SESSION['e_org_id'];
    // Get all the sumbitted entries of the employee
    $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    // Go through the results 
    while ($row = $result->fetch_assoc()) {
        // Get if the employee should be allowed to edit time
        $employee_allow_edit = $row['allow_employee_time_edit'];
    }


?>


<!-- Modal that appears when you click the + ADD ENTRY button -->
<div id="edit_entry_modal" class="modal" style='display:none;'>  
    <div style='display:block;' class='outside_of_modal'></div>
        
    <div class='centering-modal'>

        <div class='moveable_modal' id='moveable_edit_entry_modal'>

            <div id='moveable_edit_entry_modalheader' class='modal_header'>
                <p id='myModal_text' class='modal_header_text'>Edit Entry</p>
            </div>

  
            <input form='new_entry' name='emp_id' id='tid2' value='' type='hidden'>
            <?php

            if ($employee_allow_edit == 'yes') {
                echo 
                "
                <div style='height:50px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Enter Date</p>
                    <p style='float:left;margin-left:108px;padding:0;'>Enter Start</p>
                    <p style='float:left;margin-left:73px;padding:0;'>Enter Finish</p>
                </div>

                
                <div style='height:20px;'>
                    <!-- start date -->
                    <input name='date_edit' id='date_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 140px;' type=date>
                    <input name='start_edit' value='10:00'id='start_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 60px;' type=text>
                    <!-- select AM or PM -->
                    <select id='start_diem_edit' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; height:34px; width: 40px;'>
                        <option>AM</option>
                        <option>PM</option>
                    </select>
                    <!-- end date -->
                    <input name='end' value='2:00'id='end_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px;; height:30px; width: 60px;' type=text>
                    <!-- select AM or PM -->
                    <select name='end_diem'form='new_entry' id='end_diem_edit' style='padding: 0 0 0 4px; float:left; margin-left:5px; height:34px; width: 40px;'>
                        <option>AM</option>
                        <option selected>PM</option>
                    </select>
                </div>
                ";
                }
            ?>

            <div class='space20'></div>

            <!-- select properties -->
            <div style='height:20px; margin-left:20px;'>
                <p style='float:left;padding:0;'>Select Project</p>
            </div>

                <div style='height:34px; margin-left:20px;'>
                    <select id='project_id' style='float:left;padding: 0 0 0 4px; height:34px; width: 148px;'>

                        <?php 
                            echo "<option data-project_name='---- No Project ----' value='0'>---- No Project ----</option>";
                            // Get the employee's id
                            $emp_id = $_SESSION['e_id'];
                            // Get all the projects the employee is assigned to
                            $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                            // Put the result in result
                            $result2 = mysqli_query($conn, $sql); 
                            // Go through each result
                            while ($row = $result2->fetch_assoc()) {
                                // Get the project id
                                $project_id = $row['project_id'];
                                // Find the project with that id
                                $sql = "SELECT project_name FROM projects WHERE project_id = '$project_id';";
                                // Put the result into $result3
                                $result3 = mysqli_query($conn, $sql);
                                // Go through the result
                                while ($row2 = $result3->fetch_assoc()) {
                                    // Get the project name
                                    $project_name = $row2['project_name'];
                                }
                                // Put the project into an option
                                echo "<option data-project_name='$project_name' value='$project_id'>$project_name</option>";
                            }
                            
                        ?>
                    </select>
                    <!-- <input name='date' id='date' form='save_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 105px;' type=text>
                    <input name='start' id='start' form='save_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 105px;' type=text> -->
                </div>

                <div class='space20'></div>

                <div style='height:20px; margin-left:20px;'>
                    <p style='float:left;padding:0;'>Description</p>
                
            </div>
            <div style='height:66px; margin-left:20px;'>
                <textarea name='desciption' id='description_edit'  class='textarea-style-1'></textarea>
            </div>

            <div class='space20'>
            </div>

            <div style='height:54px; margin-left:20px;'>
            <?php 
                if ($employee_allow_edit == 'yes') {
                    echo "
                    <button type='sumbit' id='save_edit' class='button-style-4-2 right'>Save
                    </button>";
                } else {
                    echo "
                    <button type='sumbit' id='save_edit2' class='button-style-4-2 right'>Save
                    </button>";
                }
            ?>
            
                <button id='cancel_edit_entry'  class='button-style-4-2 right'>Cancel</button>
            </div>    
        </div>
    </div>
</div>

<?php
    include_once 'footer.php';
?>



