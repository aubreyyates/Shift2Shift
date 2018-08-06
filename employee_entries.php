<?php
    // Put the header in the page
    include_once 'header.php';
    // Creates database connection
    include 'includes/dbh.inc.php';
    // Checking to see if the page the user came from sent information about the employee they want to view
    if (isset($_GET['emp_id']) && isset($_SESSION['u_id'])) {
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get the employee id
        $emp_id = $_GET['emp_id'];
        // Prepare a statement
        $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id = ? AND emp_org = ? AND status=?;");
        // Set status
        $status = 'active';
        // Set the variables that go into the statement
        $stmt->bind_param('iis', $emp_id, $org_id, $status); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();        
        // Get the number of results
        $resultCheck = mysqli_num_rows($result);
        // Check if there were any results
        if ($resultCheck == 0) {
            // Send them to the home page
            exit;
        }
        // put emp_id into session variable 'current_emp_id'
        $_SESSION['current_emp_id'] = $_GET['emp_id'];
        // Go through results
        while ($row = $result->fetch_assoc()) {
            // Set a session for emp last
            $_SESSION['current_emp_first'] = $row['emp_first'];
            // Set a session for emp first
            $_SESSION['current_emp_last'] = $row['emp_last'];
            // Get the emp email
            $_SESSION['current_emp_email'] = $row['emp_email'];
        }
    } else {
        // Leave code
        exit();
    }
    //!!!
    // put emp_id into $emp_id
    $emp_id = $_SESSION['current_emp_id'];//where does this come from if no POST information set?

    
    //Maybe we should have error handling for this, just in case
    //Or use Get method
     



?>


<!-- Main part of page -->
<section class="main-container">

    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    <!-- main wrapper -->
    <div class="main-wrapper">
        

        <div class='shadow'>
        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <!-- Display employee's first and last name from current session variables -->
                <h4 id='header-line'><?php 
                    $first=$_SESSION['current_emp_first']; 
                    $last=$_SESSION['current_emp_last'];
                    $email=$_SESSION['current_emp_email']; 
                    echo htmlspecialchars($first, ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($last, ENT_QUOTES, 'UTF-8').' - '.htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>      
                </h4>
                
                <button id='delete_employee' class='delete_button_can'></button>
                <button id='edit_main' class='button-style-7' >Edit</button>

            </div>
        </div>

        <div class='space20' style=' background-color:rgb(247, 247, 247);'></div>

        <!-- Top row or 1st row 60px: 2 buttons 1 hidden button 1 dropdown menu 
        1 filter button
        1 employee calendar button
        1 filter dropdown-->
        <div class='box-create' style='width:100%; height:62px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>

                <!-- Creates the filter button
                id: filter-button 
                name: commentSubmit-->
                <button id ='filter-button' class='button-style-4 right'>
                    <a style ='color:#fff;' >Filter</a>
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

                <!-- Creates the button to go to the employee's calendar
                link to employeeshift.php -->
                <a class='button-style-4 wide200' style ='line-height:40px;' href='employeeshift.php'>Calendar</a>


                <!-- The all button to see all employee's entries 
                id: all_button
                name: commentSubmit-->
                <button id='all_button' name='commentSubmit' class='button-style-3'>
                    All
                </button>
            </div>
        </div>   
        <!-- End 1st row -->


        <!-- 2nd row 120px: 2 buttons 1 dropdown menu -->
        <!-- Export button, export type dropdown, delete selected entries button -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the button to export page's data to a selected type -->
                <!-- id: export, name: delete3 -->
                <button id='export' type='submit' class='button-style-4 right'>
                    Export
                </button>

                <!-- Creates dropdown menu to select export type -->
                <!-- id: export-type -->
                <select id='export-type' class='dropdown-style-3' style='float:right;'>
                    <option>csv</option>
                    <option>excel</option>
                    <option>pdf</option>
                </select>

                <!-- Creates the button to delete selected entries if pressed -->
                <!-- id: delete_selected, name: delete2 -->
                <button type='submit' id='delete_selected' class='button-style-4 wide200' form='delete_selected' name='delete2'>
                    Delete Selected
                </button>
            </div>
        </div> 
        <!-- End 2nd row -->

        <!-- 3rd row: 1 button , 1 dropdown menu-->
        <div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>
                <a class='button-style-4 wide200' style ='line-height:40px;' href='assign_projects_to_employees.php' >Assign Projects</a>
                <!-- <button id='data_button' type='submit' name='commentSubmit' 
                    style=' width: 100px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    Data
                </button> -->
                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Created</option>
                    <option>Date</option>
                    <option>Alphabetical</option>
                    <option>Length</option>
                </select>
            </div>

            <div>
            <h5 style='float:right; margin-right:20px; line-height:14px; padding:12px;'> sort by: </h5>
        </div>

        </div>
        <!-- 3rd row end -->


        <?php
            include "arrows_filter_date.html";
        ?>


        <!-- Begin List Div that lists all of the entries from the employee -->
        <!-- id: list -->
        <div id='list'>


        </div>
        <!-- End list Div -->

        <?php
            include 'add_entry_button.html';
        ?>

        </div>

        <?php
            include 'clock_total_time.html'
        ?>

        <!-- php code -->
        <?php
            include 'arrows_pagination.html';
        ?>
        <!-- end php code -->


</section>
<!-- End main part of page -->







<!-- !!! -->
<!-- should list what each of these does -->
<!-- Gets the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Gets jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Gets jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add a moment format -->
<script src="duration_format.js"></script>
<!-- javascript library to make pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<!-- javascript library to zip files -->
<script type="text/javascript" src="jszip.js"></script>
<!-- javascript library to save files -->
<script type="text/javascript" src="FileSaver.js"></script>
<!-- javascript library to make excel files -->
<script type="text/javascript" src="myexcel.js"></script>
<!-- Add function to page -->
<script type="text/javascript" src="test_1.js"></script>
<!-- javascript for employee view functions -->
<script type="text/javascript" src="employee_manage.js"></script>
<!-- Javascript functions -->
<script type="text/javascript" src="functions_entry.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>


<!-- start javascript -->
<script>

    // Variable that can contain new objects for searching
    var search_objects = []
    // Default filter_date to false
    var filter_date = false;
    // Total viewable entries
    var total_view = 0;
    var clicked_project_id;
    //get current date and time
    var date = moment();
    var type = 'none';
    var date_format;

    // Create moment object for latest entry to be shown
    var date_end = moment();
    // Create a canvas to measure string length in pixels
    var canvas = document.createElement('canvas');
    // Create a canvas
    var ctx = canvas.getContext("2d");
    // Set the font of canvas
    ctx.font = "12px Arial";
    // Set the current projects viewed
    var vnum_s = 0;
    // Set the last project to view
    var vnum_e = 25;   

    $(document).ready(function() {
            
        //set data as current data in YYYY-MM-DD format
        $('#date').val(moment().format('YYYY-MM-DD'));
        var emp_load = 'set'


        // Get all of the entries from the project
        $.post('load_employee_entries_to_objects.php', {emp_load:emp_load}, function(result) {
            // Turn the result into JSON objects
            entries = JSON.parse(result)
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
            }
            // Create a copy 
            entries_original = entries
            // Display all of these entries at the start of page
            display_all()
            // Check to see if you need to put arrows to view more projects
            if (entries.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })



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



        $( ".info_project" ).click(function() {
            //
            $('.info_project').css('display','none');
        });
        // What happens when one of the edit buttons is clicked on a project
        $(".edit").click(function() {
            //set all values
            $(document.getElementById('myModal')).css('display','block')
            $('#tid').val($(this).val()) 
            $('#date_edit').val($(this).attr("data-date"))
            $('#description_edit').val($(this).attr("data-description"))
            $('#start_edit').val($(this).attr("data-start"))
            $('#end_edit').val($(this).attr("data-end"))
            $('#start_diem_edit').val($(this).attr("data-startdiem"))
            $('#end_diem_edit').val($(this).attr("data-enddiem"))
        })
        // What happends if the cancel button is clicked on a project
        $( "#cancel_edit" ).click(function() {
            $(document.getElementById('myModal')).css('display','none');
        })

        //!!!
        //If manage time button is clicked
        $( ".info_button_managetime" ).click( function() {
    
            time_id = $(this).val();
            //load entry info
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            //display as a modal
            $("#info_modal").css("display","block");
            
        });
        $("#edit_main").click(function() {
            // Display the edit employee info modal
            $(document.getElementById('edit_main_modal')).css('display','block');
        })

        // What happens if the exit_data button is clicked
        $( "#exit_data" ).click( function() {
            // Stop displaying the info_modal
            $("#info_modal").css("display","none");
            
        });
        // What happens when you click the add_entry button
        $( "#add_entry" ).click( function() {
            // Display the add_entry_modal modal
            $("#add_entry_modal").css("display","block");
        });
        // What happens when you click the cancel_add_entry button
        $( "#cancel_add_entry" ).click( function() {
            // Stop displaying the add_entry_modal
            $("#add_entry_modal").css("display","none");
        });
        // What happens if the cancel button on the editing project modal (employee edit) is clicked
        $( "#cancel_edit_main" ).click(function() {
            // Stop displaying employee_edit
            $(document.getElementById('edit_main_modal')).css('display','none');
            
        })
        // What happens when you click the cancel_add_entry button
        $( "#delete_selected" ).click( function() {
            
            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                return checkbox.value;
            })
            // Set delete_set to set to show a proper submission
            var delete_set = "set";
            // Delete the entries from the database
            $.post('deleted_selected_entries.php', {arr:arr,delete_set:delete_set}, function() {
                // Go through the array of selected entries
                for (i = 0; i < arr.length; i++) {
                    // Go through entries
                    for (j = 0; j < entries.length; j++) {
                        // Find the entry with the same value
                        if (arr[i] == entries[j].id) {
                            // Remove the entry
                            entries.splice(j, 1);
                            // Leave the j for loop
                            break;
                        }
                    }
                }
                // Check if they are filtering dates
                if ( filter_date == false){
                    // If not, display all entries
                    if (entries.length <= vnum_s && entries.length > 0) {
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
            });
        });

        // What happens if the add_entry button is clicked
        $( "#save_main" ).click( function() {

            var test = test_account()

            
            
            if (test == true) {
                var first = $('#first_edit').val()
                var last = $('#last_edit').val()
                var email = $('#email_edit').val()
                var update = 'set'
                
                $.post('update_employee.php',{update:update,first:first,last:last,email:email}, function(result){
                    if (result=='taken') {
                        alert('This E-mail is already taken')
                    } else {
                        // Stop displaying employee_edit
                        $(document.getElementById('edit_main_modal')).css('display','none');
                        $('#header-line').text(first + " " + last + " - " + email)
                    }
                })
            }
        })

        // What happens when you click the delete employee button
        $( "#delete_employee" ).click( function() {
            var check = confirm("Are you sure you want to DELETE this employee? (Can be recovered) You will no longer be charged for it.")
            employee_delete = 'yes';
            if (check == true){
                $.post('delete_employee.php',{employee_delete :employee_delete}, function(){
                    window.location.replace('http://localhost/phplessons/view_employees.php')
                })
                
            }
        });

        // What happens if the add_entry button is clicked
        $( "#save_new_entry" ).click( function() {
            // Get the selected date
            date_for_new = $('#date').val()
            // Check to make sure it is not empty
            if (date_for_new != '') { 
                // Get the entered start time  
                start = $('#start').val()
                // Get the entered end time
                end = $('#end').val()
                // Get the chosen AM/PM for start
                start_diem = $('#start_diem').val()
                // Get the chosen AM/PM for end
                end_diem = $('#end_diem').val()
                // Make sure the start time is a valid time
                if (moment(date_for_new+" "+start+" "+start_diem).isValid()) {
                    if (start.charAt(start.length-3) != ':' || start.length < 4 || start.length > 5) {
                        alert("Your start time is not a valid time.")
                        return
                    }
                    // Make sure the end time is a valid time
                    if (moment(date_for_new+" "+end+" "+end_diem).isValid()) {
                        if (end.charAt(end.length-3) != ':' || end.length < 4 || end.length > 5) {
                            alert("Your end time is not a valid time.")
                            return
                        }
                        // Check to make sure the end time is later than the start time
                        if (moment(date_for_new+" "+start+" "+start_diem).unix() < moment(date_for_new+" "+end+" "+end_diem).unix()) {
                            // Get the length of the entry
                            time = moment.duration(moment(date_for_new+" "+end+" "+end_diem).diff(moment(date_for_new+" "+start+" "+start_diem))).format('HH:mm:ss')
                            // Get the chosen employee's entry
                            emp_id = $('#emp_id').val()
                            // Get the entered description
                            description = $('#description').val()
                            // Check description length
                            if (description.length > 250) {
                                // Let them know the description is too long
                                alert("Your description can't be more than 250 characters long.")
                                // Leave function
                                return;
                            }
                            // Get the project id
                            project_id = $('#project_id').val()
                            // Get the project name
                            project_name = $('#project_id').find(':selected').attr('data-name')
                            description = description.replace(/'/g, "`")   
                            // Sanitize the code, prevent XSS           
                               
                            description = DOMPurify.sanitize(description);
                            date_for_new = DOMPurify.sanitize(date_for_new);
                            time = DOMPurify.sanitize(time);
                            start = DOMPurify.sanitize(start);
                            end = DOMPurify.sanitize(end);
                            start_diem = DOMPurify.sanitize(start_diem);                
                            end_diem = DOMPurify.sanitize(end_diem);

                            $.post('add_new_entry_to_employee.php', {date:date_for_new,project_id:project_id,start:start,end:end,start_diem:start_diem,end_diem:end_diem,emp_id:emp_id,description:description}, function(result){

                                // Create a new entry object
                                entry = {id:result,project_name:project_name,time:time,date:date_for_new,start:start,startdiem:start_diem,end:end,enddiem:end_diem,description:description}
                                // Put the object into the JSON
                                entries.push(entry)

                                // Check if they are filtering dates
                                if ( filter_date == false){
                                    // If not, display all entries
                                    display_all()
                                    if (entries.length > 25 && entries.length > vnum_e) {
                                    // Display the foward arrow to view more
                                        $('#view-forward').css('display','inline')
                                    }
                                } else {
                                    // If so, display in that date range
                                    date_compare()
                                    if (search_objects.length > 25 && search_objects.length > vnum_e) {
                                    // Display the foward arrow to view more
                                        $('#view-forward').css('display','inline')
                                    }
                                }
                            });
                            $("#add_entry_modal").css("display","none");
                        } else {
                            alert("Your start time is later than your end time.")
                        }
                    } else {
                        alert("Your end time is not a valid time.")
                    }
                } else {
                    alert("Your start time is not a valid time.")
                }
            } else {
                alert("You must enter a date.");
            }

        });
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
            // Stop displaying info_modal
            $(document.getElementById('info_modal')).css('display','none');
            // Stop displaying add_entry_modal  
            $(document.getElementById('add_entry_modal')).css('display','none');    
            // Stop displaying employee_edit 
            $(document.getElementById('edit_main_modal')).css('display','none'); 
        });


        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_myModal")));
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_edit_main")));
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

    //add entry function on click
    $('#list').on('click', '.add_entry' , function(){
        // Display the add_entry_modal
        $("#add_entry_modal").css("display","block"); 
    });

    //info button function on click
    $('#list').on('click', '.info_button_managetime' , function(){
        time_id = $(this).val(); //get time id
        //load entry info
        $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
        //display info in modal
        $("#info_modal").css("display","block");
    });

    //edit function on click
    //load all data and display in modal
    $('#list').on('click', '.edit' , function(){
        $(document.getElementById('myModal')).css('display','block');
        $('#tid').val($(this).val());
        $('#date_edit').val($(this).attr("data-date"))
        $('#description_edit').val($(this).attr("data-description"))
        $('#start_edit').val($(this).attr("data-start"))
        $('#end_edit').val($(this).attr("data-end"))
        $('#start_diem_edit').val($(this).attr("data-startdiem"))
        $('#end_diem_edit').val($(this).attr("data-enddiem"))
    });

    $("#list").on("mouseenter", '.entry-button-style-2', function () {
        $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry-button-style-2', function () {
        $(this).parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseenter", '.checkbox-container', function () {
        $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.checkbox-container', function () {
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

        // $('.info_project').stop()
        // $('.info_project').css('display','none')
        // $('.info_project').css('opacity','0')        
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




</script>
<!-- end javascript -->






<div class='info_project'>
    <div class='info_project_tip'></div>
    <div class='info_content'><span>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <h6>Description:</h6>
    <p id='info_description'></p>
    </span></div>
</div>

<div class='show_long_text' style='display:none;'>
  
    <div class='info_content-2'><span id='height-measure'>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <p id='info_description_long'></p>
    </span></div>
    <div class='info_long_tip'></div>
</div>

<!-- Hidden modals -->


<?php
    include "edit_modal_employee_entries.html";
    $header = "Edit Employee";
    include "edit_main_modal.php";
?>


<!-- Modal that appears when you click one of the info buttons -->
<div id="info_modal" class="modal">

    <div style='display:block;' class='outside_of_modal'></div>
    
    <div class='centering-modal' style='margin-top:2%;'>
        <div class='moveable_modal' style='height:256px; 'id='moveable_info_modal'>   
            
            
            <!-- Header to the modal -->
            <div id='moveable_info_modalheader' style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                <p id='myModal_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Entry Info</p>
            </div>
            
            <div style='height:20px; background-color:#f4f9ff;'></div>
            <div id='entry_info'></div>

            <div style='height:65px;  background-color:#f4f9ff;'>
                <!-- Export button -->
                <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                    margin-top:15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;                  
                    cursor: pointer;'>Export
                </button>
            <!-- Exit button -->
                <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                    margin-top:15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
            </div>               
        </div>
    </div>
</div>


<?php 
    include "add_entry_modal.php";
?>
