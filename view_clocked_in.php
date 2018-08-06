<?php
    // Include the header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // If not, exit the code
        exit;
    }
?>

<!-- Main part of page -->
<section class="main-container">
    
    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper">
    
        <div class='shadow'>
            
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4 >Currently Clocked In</h4>
            </div>
        </div>

        <div class='space20' style='background-color:rgb(247, 247, 247)'></div>

        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                

                <!-- <form id='search-form' method='GET'> -->
                <button id='employee-search' type='submit'class='button-style-4 right'
                    >Search
                </button>

                <input  class='searchbar-style-2' id='search-input' placeholder='Search employees'type='text' name='search'>
                <!-- </form> -->

                <button id='all_button' class='button-style-5 right'>
                    All
                </button>
                
  

                <!-- <button name='commentSubmit' 
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

                
                <select style='width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option>Project</option>
                    <option>Position</option>
                </select> -->
        
            </div>
        </div>

        <!-- 2nd row: 1 button -->
        <div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  




            <div id='top-bar' style='margin-left:20px;'>
                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Created</option>
                    <option>Last</option>
                    <option>First</option>
                    <option>E-mail</option>
                </select>
            </div>

            <div>
                <h5 style='float:right; margin-right:20px; line-height:74px;'> sort by: </h5>
            </div>
        </div>
        <!-- 2nd row end -->

        <div id='list'>
        </div>

        </div>

        <?php
            include "arrows_pagination.html";
        ?>

    </div>
</section>
<!-- End main part of page -->


<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>


            
    // When the page is ready, do this
    $(document).ready(function() {
    

        // Initialize variables 
        var input;
        // Default searching to false 
        var searching = false;
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

        // Get all of the entries from the project
        $.post('load_clocked_employees_to_objects.php', function(result) {
            // Turn the result into JSON objects
            employees = JSON.parse(result)
            // Save the original object order
            employees_original = employees
            // Display all of these projects at the start of page
            display_all()
            // Check to see if you need to put arrows to view more projects
            if (employees.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })

        // Function to display all of the entries
        function display_all() {
            
            // Clear all managers
            $('#list').html('')
            // Check to see how far to make lines
            if (employees.length > vnum_e) {
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
                max_view = employees.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + employees.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }
            // Go through every entry
            for (i = vnum_s ; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
        }


        function display_search() {
            // Clear all managers
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {  
                // Check if the search is in the name
                if ( employees[i].email.toLowerCase().includes(input.toLowerCase()) ) {
                    // Add to the search objects
                    search_objects.push(employees[i])
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
            } else {
                // Set max view to length of project
                max_view = search_objects.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }            
            // Go through every entry
            for (i = vnum_s ; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(search_objects[i].first, search_objects[i].last, search_objects[i].id, search_objects[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
            // Reset the search objects 
            search_objects = []   
        }

        // What happens if the arrow forward button is clicked
        $( "#view-forward" ).click(function() {
            // Display the back arrow to view previous
            $('#view-backward').css('display','inline')
            vnum_s += 25
            vnum_e += 25
            if (searching == false) {
                // Display all of these projects at the start of page
                display_all()
            } else {
                // Display the search
                display_search()
            }
        })

        // What happens if the arrow backward button is clicked
        $( "#view-backward" ).click(function() {
            // Display the foward arrow to view more
            $('#view-forward').css('display','inline')
            vnum_s -= 25
            vnum_e -= 25
            if (searching == false) {
                // Display all of these projects at the start of page
                display_all()
            } else {
                // Display the search
                display_search()
            }
        })

        // Create the entry lines with html
        function prepare_entry_line(first, last, id, email) {
            // Sanitize all of the entries. This helps prevent injections and XSS
            first = first.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            last = last.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            id = id.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            email = email.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            
            // Create the text needed to create an entry
            text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
            // Get the line data
            line_data =  "First Name: " + first + " | Last Name: " + last + " | Email: " + email
            // Get the length of the string in pixels
            var len = ctx.measureText(line_data).width;
            // Check if it is greater than 425
            if (len > 425) {
                // Keep removing letters until it is less than 420 pixels long
                while (len > 420) {
                    // Remove the last letter
                    line_data = line_data.substring(0, line_data.length - 1);
                    // Get the new length of string in pixels
                    len = ctx.measureText(line_data).width;
                }
                // Add dots at end
                line_data += "..."
            }
            
            text_2 ="</div><form style='position:relative; float:right; margin-right:26px;' method='GET' action='employee_entries.php'><input type='hidden' name='emp_id' value='" + id + "'><button type='submit' class='entry-button-style-2 wide200'>Select Employee</button></form></div></div>";
            
            text = text_1 + line_data + text_2
            // Return the text
            return text
        }

        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            // Check the sorting type is alphabetical
            if ($('#sorting').val() == 'Last') {

                // Sort alphabetically
                employees = merge_alphabetical(employees)
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            // Check if the sorting type is none
            } else if ($('#sorting').val() == 'Date Created') {
                // Set to original order
                employees = employees_original
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            } else if ($('#sorting').val() == 'First') {
                // Sort alphabetically
                employees = merge_alphabetical_first(employees)               
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            } else if ($('#sorting').val() == 'E-mail') {
                // Sort alphabetically
                employees = merge_alphabetical_email(employees)                
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            }
        })


        // What happens if you click the search button
        $( "#employee-search" ).click(function() {
            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Get the search typed in
            input = $('#search-input').val()
            // Clear all projects
            $('#list').html('')
            // Display the all button
            $(document.getElementById('all_button')).css('display','block');
            // Display projects that have names like the search word
            display_search()
            // Set searching to true
            searching = true;
            // Check to see if you need to put arrows to view more projects
        })

        // When happens if a key on while on the search bar is pressed
        $("#search-input").keyup(function(event) {
            // Check if it was enter
            if (event.keyCode === 13) {
                // Set the current projects viewed
                vnum_s = 0;
                // Set the last project to view
                vnum_e = 25;
                // Get the search typed in
                input = $('#search-input').val()
                // Clear all projects
                $('#list').html('')
                // Display the all button
                $(document.getElementById('all_button')).css('display','block');
                // Display projects that have names like the search word
                display_search()
                // Set searching to true
                searching = true;
            }
        })

        // What happens if the all button is clicked
        $( "#all_button" ).click(function() {
            // Reset searching objects
            search_objects = []
            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Display all of these projects at the start of page
            display_all()
            // Stop displaying the all button
            $(document.getElementById('all_button')).css('display','none');
            // Set searching to false
            searching = false;
            // Check if there are more than 25 employees to show
            if (employees.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })
    });
    // End document.ready

</script>