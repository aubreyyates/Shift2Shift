<?php
    // Put header in the page
    include_once 'header.php';
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // Check to make sure an admin is logged in
    if (isset($_GET['project_id']) && isset($_SESSION['u_id'])) {
        // put the project_id into $pid
        $pid = $_GET['project_id'];
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Prepare a statement
        $stmt = $conn->prepare("SELECT * FROM projects WHERE project_id =? AND org_id =? AND status=?;");
        // Set status
        $status = 'active';
        // Set the variables that go into the statement
        $stmt->bind_param('sis', $pid, $org_id, $status); // 's' specifies the variable type => 'string'
        // Execute the statement
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();   
        // Get the number of results
        $resultCheck = mysqli_num_rows($result);
        // Check if there were any results
        if ($resultCheck == 0) {
            // Leave the code
            exit();
        }
        // Get the project id
        $_SESSION['project_id'] = $_GET['project_id'];
    } else {
        // Leave the code
        exit();
    }


    // Go through results
    while ($row = $result->fetch_assoc()) {
        // Get the project name
        $_SESSION['project_name'] = $row['project_name'];
        // put the project_name into $project_name
        $project_name = $row['project_name'];
        // Get the description
        $description = $row['description'];
        // Get the job code
        $job_code = $row['job_code'];
        // Get the date
        $date = $row['date'];
        // Get the substring
        $date = substr($date, 0 , 10);
    }


    
?>

<input type='hidden' id="project_id" value=<?php echo $_SESSION['project_id']; ?>>



<!-- Main part of page -->
<section class="main-container" style=''>
    
    <?php
        // Put navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>          

        <div class='shadow'>
        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4 id='header-line'><?php 
                $project_name=$_SESSION['project_name'];
                echo htmlspecialchars($project_name, ENT_QUOTES, 'UTF-8'); ?>

            </h4>
                
                <button id='delete_project_button' class='delete_button_can' value=<?php echo $pid ?>></button>
                <button id='edit_main' class='button-style-7' >Edit</button>
            </div>
        </div>


        <div class='space20' style=' background-color:rgb(247, 247, 247);'></div>

        <!-- <div class='box-create' style='width:100%; height:20px; background-color:rgb(247, 247, 247)'>
        </div>       -->

        <!-- Top row 60px: 3 buttons and 2 dropdown menus -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the filter button -->
                <button id ='filter-button' class='button-style-4 right'>
                    <a style ='color:#fff;' >Filter</a>
                </button>

                <!-- Creates the drop down to select filter type -->
                <select id='filter-type' class='dropdown-style-3'>
                    <option>all</option>
                    <option>day</option>
                    <option>week</option>
                    <option>month</option>
                    <option>year</option>
                    <option>pay period</option>
                </select>
 
                <!-- Form to delete the entire project -->
                <!-- <form style='' id='' method='POST'> -->
                    <input type='hidden' name='project_id' value=<?php echo $pid ?>>
                    <!-- Button to delete the entire project -->
                    <!-- <button type ='submit' id='delete_project_button' value=<?php echo $pid ?> name='delete_project' style='width: 150px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;'>
                        Delete Project
                    </button> -->
                <!-- </form>  -->

                <!-- <form method='POST' action='add_manager.php'> -->
                <!-- Creates the drop down to select a manager -->
                <div id='manager_load'>
                    <select id='manager_id' class='dropdown-style-3-left' name='manager_id'>
                        <?php 

                            // Get the company id 
                            $org_id = $_SESSION['u_org_id'];
                            // Get all the managers from that company
                            $sql = "SELECT * FROM managers WHERE manager_org_id = '$org_id' AND status ='active';";
                            // Put the result into $result
                            $result = mysqli_query($conn, $sql);
                            

                            // Put each manager into an option 
                            while ($row = $result->fetch_assoc()) {
                                // Default $added to no text
                                $added = "";  
                                // Get the manager's email 
                                $email = $row['manager_email'];
                                // Get the manager's id
                                $manager_id = $row['manager_id'];
                                // Find if this manager is assigned to this project already
                                $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
                                // Put the result into $result2
                                $result2 = mysqli_query($conn, $sql2);
                                // Put the number of results into $resultCheck
                                $resultCheck = mysqli_num_rows($result2);
                                // See if there is more than 0 results
                                if ($resultCheck > 0){
                                    // More than 0, so tell user in the option they have already been added
                                    $added = " (Already added to project)";
                                }
                                // Give the manager in an option
                                echo "<option value='$manager_id'>$email $added</option>";
                            }
                        ?>

                    </select>
                </div>
                    
                
                    <!-- Button to add the selected manager to a project -->
                    <button class='button-style-4 wide200' name='manager_added' id='add_manager'>
                        Add/Remove Manager
                    </button>

                <div style='float:left;margin-left:20px;line-height:60px;'>
                    <p style='display:none' id='manager_alert'>Manager Added</p>
                </div>
                <!-- </form>   -->
            </div>
        </div>
        <!-- End top or 1st row -->
        




        <!-- 2nd row 50px : 3 buttons 2 dropdown menus -->
        <div class='box-create' style='width:100%;height:60px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Button to make an export of the project -->
                <button id='export' class='button-style-4 right'>
                    Export
                </button>

                <!-- Drop down menu to choose export type -->
                <select id='export-type' class='dropdown-style-3'>
                    <option value='csv'>csv</option>
                    <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option>
                </select>



                <!-- <form method='POST' action='add_employee.php'> -->
                <!-- Creates the drop down to select a manager -->
                <div id='employee_load'>
                    <select id='employee_id' class='dropdown-style-3-left' name='employee_id'>
                        <?php 
                            // Get the company id
                            $org_id = $_SESSION['u_org_id'];
                            // Get all the managers from that company
                            $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status ='active';";
                            // Put the result into $result
                            $result = mysqli_query($conn, $sql);
                            

                            // Put each employee into an option 
                            while ($row = $result->fetch_assoc()) {
                                // Set added to no set
                                $added = "";
                                // Get the employee's email
                                $email = $row['emp_email'];
                                // Get the employee's id
                                $emp_id = $row['emp_id'];
                                // Find if the employee has been assigned to this project already
                                $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
                                // Put result in to $result2
                                $result2 = mysqli_query($conn, $sql2);
                                // Get the number of results
                                $resultCheck = mysqli_num_rows($result2);
                                // If there is more than 0, they have been added
                                if ($resultCheck > 0){
                                    // Let the user know they have been added
                                    $added = " (Already added to project)";
                                }
                                // Put the employee in an option
                                echo "<option value='$emp_id'>$email $added</option>";
                            }
                            //echo "<input type='hidden' name='added_emp' value='$add'>";

                        ?>


                    </select>
                </div>
                
                    <!-- Button to add the selected employee to a project -->
                    <button class='button-style-4 wide200' type='submit' name='employee_added' id='add_employee'>
                        Add/Remove Employee
                    </button>
                <!-- </form> -->
                <div style='float:left;margin-left:20px;line-height:60px;'>
                    <p style='display:none' id='employee_alert'>Employee Added</p>
                </div>
            </div>
        </div>
        <!-- End of 2nd row -->
        

        <!-- 3rd row: 1 button -->
        <div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>
                <!-- Button to delete entry -->        
                <button id='delete_selected' class='button-style-4 wide200' name='delete2'>Delete Selected</button>

                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Create</option>
                    <option>Date</option>
                    <option>Alphabetical</option>
                    <option>Length</option>
                </select>
            </div>

            <div>
                <h5 class='sort-by'> sort by: </h5>
            </div>

            
        </div>
        <!-- 3rd row end -->







            
        <?php
            include "arrows_filter_date.html";
        ?>







        <!-- Begin List Div. Displays every entry of the entries for the project -->
        <div id='list'>
        </div>
        <!-- End list div -->

          


            
            
            <?php
                include 'add_entry_button.html';
            ?>
            
        </div>


        <?php
            include 'clock_total_time.html'
        ?>

                
        <?php
            include 'arrows_pagination.html';
        ?>






    </div>
</section>
<!-- End main part of page -->


<!-- javascript library to make pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<!-- javascript library to zip files -->
<script type="text/javascript" src="jszip.js"></script>
<!-- javascript library to save files -->
<script type="text/javascript" src="FileSaver.js"></script>
<!-- javascript library to make excel files -->
<script type="text/javascript" src="myexcel.js"></script>
<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Add a moment format -->
<script src="duration_format.js"></script>
<!-- Add important project managing functinos -->
<script src="project_manage.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Javascript functions -->
<script type="text/javascript" src="functions_entry.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>

<script>


                            
        // Create moment object for earliest entry to be shown
        var date = moment().startOf('day');
        // Create moment object for latest entry to be shown
        var date_end = moment().endOf('day');
        // Set type to none
        var type = 'none';
        // Initialize date_format
        var date_format;
        // Initialize project_load
        var project_load;
        // Default filter_date to false
        var filter_date = false;
        // Total viewable entries
        var total_view = 0;
        // Create time
        var time
        // Create date_for_new
        var date_for_new
        // Create date_for_edit
        var date_for_edit
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

    // When the page is ready do this
    $(document).ready(function() {
        
        // Initialize click_project_id
        var clicked_project_id;
        


        // Get all of the entries from the project
        $.post('load_project_entries_to_objects.php', {project_load:project_load}, function(result) {
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


        



       
        // $('#date').val(moment().format('YYYY-MM-DD'))

        // found = $('#found_entries').val()

        // if (found == 'not_found'){
        //     $("#export").attr("disabled","disabled");
        // }









        // What happends if the cancel button is clicked on a project
        $( "#cancel_edit" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
        })

        // What happens when you click the cancel_add_entry button
        $( "#delete_selected" ).click( function() {
            // Get an array of with the ids of all the checkboxs selected
            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                // Get the checkbox value. This is the entry id
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


        // What happens if the export button is clicked
        $("#delete_project_button").click(function() {
            
            var check = confirm("Are you sure you want to DELETE this project? (Can be recovered)")
            project_delete = 'yes';
            if (check == true){
                $.post('delete_project.php',{project_delete:project_delete}, function(){
                    window.location.replace('http://localhost/phplessons/view_projects.php')
                })
                
            }
            

        })

        $("#edit_main").click(function() {
            // Display the edit project modal
            $(document.getElementById('myModal2')).css('display','block');
        })


        // What happens if the data button is clicked
        $("#data_button").click(function() {
            $(document.getElementById('data_modal')).css('display','block');
        });
        // What happens if the exit button is clicked
        $( "#exit_data_modal" ).click(function() {
            $(document.getElementById('data_modal')).css('display','none');            
        });
        $( ".info_button_managetime" ).click( function() {
            time_id = $(this).val();
            $("#entry_info").load("load_entry_info.php", { time_id:time_id });
            $("#info_modal").css("display","block");
        });
        // What happens if the add_manager button is clicked
        $( "#add_manager" ).click( function() {
            
            manager_id = $('#manager_id').val()
            manager_added = 'set';
            $.post('add_manager.php', {manager_id:manager_id,manager_added:manager_added}, function(result){
                $("#manager_load").load("manager_load.php");
                // Check if an employee was added or not
                if (result =='add') {
                    // Stop any animation
                    $('#manager_alert').stop()
                    // Set opacity back to 1
                    $('#manager_alert').css('opacity', '1')
                    // Change the text
                    $("#manager_alert").text("Manager Added")
                    // Set display to block
                    $('#manager_alert').css('display', 'block')
                    // Fade out the words in 3 seconds
                    $('#manager_alert').fadeOut(3000)
                } else {
                    // Stop any animation
                    $('#manager_alert').stop()
                    // Set opacity back to 1
                    $('#manager_alert').css('opacity', '1')
                    // Change the text
                    $("#manager_alert").text("Manager Already Added!")
                    // Set display to block
                    $('#manager_alert').css('display', 'block')
                    // Fade out the words in 3 seconds
                    $('#manager_alert').fadeOut(3000)
                }
            });

        });
        // What happens if the add_manager button is clicked
        $( "#add_employee" ).click( function() {
            
            employee_id = $('#employee_id').val()
            employee_added = 'set';
            $.post('add_employee.php', {employee_id:employee_id,employee_added:employee_added}, function(result) {
                $("#employee_load").load("employee_load.php");
                // Check if an employee was added or not
                if (result=='add') {
                    // Stop any animation
                    $('#employee_alert').stop()
                    // Set opacity back to 1
                    $('#employee_alert').css('opacity', '1')
                    // Change the text
                    $("#employee_alert").text("Employee Added")
                    // Set display to block
                    $('#employee_alert').css('display', 'block')
                    // Fade out the words in 3 seconds
                    $('#employee_alert').fadeOut(3000)
                } else {
                    // Stop any animation
                    $('#employee_alert').stop()
                    // Set opacity back to 1
                    $('#employee_alert').css('opacity', '1')
                    // Change the text
                    $("#employee_alert").text("Employee Already Added!")
                    // Set display to block
                    $('#employee_alert').css('display', 'block')
                    // Fade out the words in 3 seconds
                    $('#employee_alert').fadeOut(3000)
                }
            });
    
        });

        $( ".info_project" ).click(function() {
            //
            $('.info_project').css('display','none');
        });
        // What happens if the exit_info button is clicked
        $( "#exit_data" ).click( function() {
            // stop displaying the info_modal modal
            $("#info_modal").css("display","none");
        });
        // What happens if the add_employee_small_button button is clicked
        $( "#add_employee_small_button" ).click( function() {
            // Display the small_Modal modal
            $("#small_Modal").css("display","block");
        });
        // What happens if the exit_small_modal button is clicked
        $( "#exit_small_modal" ).click( function() {
            // stop displaying the small_Modal modal
            $("#small_Modal").css("display","none");  
        });
        // What happens if the add_manager_small_button button is clicked
        $( "#add_manager_small_button" ).click( function() {
            // Display the small_modal_manager modal
            $("#small_modal_manager").css("display","block");
        });
        // What happens if the exit_small_modal_manager button is clicked
        $( "#exit_small_modal_manager" ).click( function() {
            // stop displaying the small_modal_manager modal
            $("#small_modal_manager").css("display","none");     
        });
        // What happens if the add_entry button is clicked
        $( "#add_entry" ).click( function() {
            // Display the add_entry_modal
            $("#add_entry_modal").css("display","block"); 
            // Set the date picker to today 
            $("#date").val(moment().format('YYYY-MM-DD'))
        });
        
        // What happens if the cancel_add_entry button is clicked
        $( "#cancel_add_entry" ).click( function() {
            // stop displaying the add_entry_modal modal
            $("#add_entry_modal").css("display","none"); 
        });
        
        // What happens if the save button on the editing project modal (myModal2) is clicked
        $( "#save_edit_project" ).click(function() {
            // Get the new project name
            project_name = $("#project_name_edit").val()
            // Check to make sure the project name is not empty
            if (project_name != '') {
                // Check to make sure the project name is not empty
                if (project_name.length < 101) {
                    // Set the valid characters
                    var letterNumber = /^[0-9a-zA-Z\s]+$/;
                    // Check to make sure they use only letters and numbers in the project name
                    if (project_name.match(letterNumber)) {
                        // Set project_edit
                        project_edit = 'set'
                        // Get the project id
                        project_id = $("#project_id").val()
                        // Get the new date
                        date = $("#date_edit_project").val()
                        // Get the new description
                        description = $("#description_edit_project").val()
                        // Check description length
                        if (description.length > 250) {
                            // Let them know the description is too long
                            alert("Your description can't be more than 250 characters long.")
                            // Leave function
                            return;
                        }
                        // Get the new job code
                        job_code = $("#job_code_edit").val()
                        // Check job code length
                        if (job_code.length > 100) {
                            // Let them know the description is too long
                            alert("Your job code can't be more than 100 characters long. How is anyone ever going to remember it?!")
                            // Leave function
                            return;
                        }
                        // Put the new info into the database
                        $.post('edit_project_info.php', {project_edit:project_id,project_id:project_id, project_name:project_name,date:date,description:description, job_code:job_code})

                        $("#header-line").text(project_name)
                        // Stop displaying myModal2
                        $(document.getElementById('myModal2')).css('display','none');
                    } else {
                        // Let the user know they need valid characters
                        alert("You can only use letters, numbers, and spaces in the project name.")
                    }
                } else {
                // Let the user know that their project needs a name
                alert("Your project name can't be more than 100 characters long. More than 100 characters would be really hard to remember!")
                }
            } else {
                // Let the user know that their project needs a name
                alert('Your project must at least have a name.')
            }
        })
        // What happens if the cancel button on the editing project modal (myModal2) is clicked
        $( "#cancel_edit_project" ).click(function() {
            // Stop displaying myModal2
            $(document.getElementById('myModal2')).css('display','none');
            
        })
        // What happens if the cancel_add_entry button is clicked
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
                    // Make sure the end time is a valid time
                    if (moment(date_for_new+" "+end+" "+end_diem).isValid()) {
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
                            // Get the employee's first name
                            first = $('#emp_id').find(':selected').attr('data-first')
                            // Get the employee's last name
                            last = $('#emp_id').find(':selected').attr('data-last')
                            // Add the entry to the database

                            description = description.replace(/'/g, "`")          
                            // Sanitize the code, prevent XSS              
                            description = DOMPurify.sanitize(description);
                            date_for_edit = DOMPurify.sanitize(date_for_edit);
                            time = DOMPurify.sanitize(time);
                            start = DOMPurify.sanitize(start);
                            end = DOMPurify.sanitize(end);
                            start_diem = DOMPurify.sanitize(start_diem);                
                            end_diem = DOMPurify.sanitize(end_diem);

                            $.post('add_new_entry_to_project.php', {date:date_for_new,start:start,end:end,start_diem:start_diem,end_diem:end_diem,emp_id:emp_id,description:description}, function(result){
                                // Create a new entry object
                                entry = {id:result,first:first,last:last,time:time,date:date_for_new,start:start,startdiem:start_diem,end:end,enddiem:end_diem,description:description}
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
                        alert("Your end time is not a valid time")
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
            // Stop displaying data_modal
            $(document.getElementById('myModal')).css('display','none');
            $(document.getElementById('moveable_edit')).css('display','none');
            $(document.getElementById('myModal2')).css('display','none');
            $(document.getElementById('add_entry_modal')).css('display','none');
            
        })
        //Make the DIV element draggagle, makes data_modal draggable :
dragElement(document.getElementById(("moveable_myModal")));
dragElement(document.getElementById(("moveable_edit")));
dragElement(document.getElementById(("moveable_info_modal")));
dragElement(document.getElementById(("moveable_add_entry_modal")));

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
    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseleave', '.long_text' , function() {
        $('.show_long_text').css('display','none')
    })


</script>




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
<div id="data_modal" class="modal">



    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:90%; background-color:#fff; margin-top:2%;'>
            
        <div style='height:20px; margin-top:20px;'>
            
        </div>
        <div style='height:20px;'>
            <p style='float:left;margin-left:20px;padding:0;'>Total Entries</p>
            <p style='float:left'><?php echo ": "; echo $resultCheck; ?></p>
            <p style='float:left;margin-left:50px;padding:0;'>Total Time Entered</p>
            <p style='float:left'> <?php echo ": "; echo $totalHours; ?></p>
            <p id ='total-hours-data' style='float:left'></p>
        </div>

        <div style='height:20px;'>
            <p style='text-decoration: underline;float:left;margin-left:20px;padding:0;'>Employees Assigned To Project</p>
            <p style='text-decoration: underline;float:left;margin-left:120px;padding:0;'>Managers Assigned To Project</p>
        </div>
        <div style='height:500px; margin-left:20px;'>
        
        <div style='float:left; width:230px;'>
        <?php 
        
        $sql = "SELECT * FROM employees WHERE emp_org_name = '$org_name';";
        $result = mysqli_query($conn, $sql);
                        

        // Put each employee into an option 
        while ($row = $result->fetch_assoc()) {
            
            $email = $row['emp_email'];
            $emp_id = $row['emp_id'];
            $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            if ($resultCheck > 0){
                echo "
                <div style='height:27px;'>
                <div style='width: 100%; height:25px;
                
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'><p style='margin-left:30px; line-height:25px;'>$email
                </p></div></div>";
            }
        
        }




        ?>
        <div style='height:27px;'>
            <button id='add_employee_small_button' style='width: 100%; height:25px;
                background-color: rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'><p style='cursor:pointer;'>+ Add Employee
                </p>
            </button>
        </div>



        </div>        
        <div style='float:left; margin-left: 70px; width:230px;'>
        <?php 
        
        $sql = "SELECT * FROM managers WHERE manager_org_name = '$org_name';";
        $result = mysqli_query($conn, $sql);
                        

        // Put each employee into an option 
        while ($row = $result->fetch_assoc()) {
            
            $email = $row['manager_email'];
            $manager_id = $row['manager_id'];
            $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            if ($resultCheck > 0){
                echo "
                <div style='height:27px;'>
                <div style='width: 100%; height:25px;
                
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'><p style='margin-left:30px; line-height:25px;'>$email
                </p></div></div>";
            }
        }



        ?>

        <div style='height:27px;'>
            <button id='add_manager_small_button' style='width: 100%; height:25px;
                background-color:  rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'><p style='cursor:pointer;'>+ Add Manager
                </p>
            </button>
        </div>

        </div>


        </div>

        <div style='height:20px;'>
            <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                
                cursor: pointer;'>Export</button>
        
            <button id='exit_data_modal' style='float:left; margin-left:20px;width: 100px;
                margin-top:-15px;
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






<div id="small_Modal" class="modal" style='display:none; z-index:6'>
    <div id='add_emp_id_small' style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:93px; width:150px;'>
    <select  name='employee_id' style='width: 150px;
        height: 40px;
        float:left;
        margin:0 auto;
        border: none;
        background-color:white;
        font-family: arial;
        font-size: 16px;'>
        <?php 
            // Get the company name 
            $org_name = $_SESSION['u_org_name'];
            // Get all the managers from that company
            $sql = "SELECT * FROM employees WHERE emp_org_name = '$org_name';";
            $result = mysqli_query($conn, $sql);
            

            // Put each employee into an option 
            while ($row = $result->fetch_assoc()) {
                
                $added = "";
                $add = 'not added';
                $email = $row['emp_email'];
                $emp_id = $row['emp_id'];
                $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
                $result2 = mysqli_query($conn, $sql2);
                $resultCheck = mysqli_num_rows($result2);
                if ($resultCheck > 0){
                    $added = " (Already added to project)";
                    $add = "added";
                }
                echo "<option value='$emp_id'>$email $added</option>";
            }
            //echo "<input type='hidden' name='added_emp' value='$add'>";

        ?>
    </select>
    <button type='sumbit' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Add</button>
    <button type='sumbit' id='exit_small_modal' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Cancel</button>

    </div>

    </div>


<div id="small_modal_manager" class="modal" style='display:none; z-index:6'>
    <div style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:93px; width:150px;'>
    <select name='manager_id' style='width: 150px;
    height: 40px;
    float:left;
    border: none;
    background-color: white;
    font-family: arial;
    font-size: 16px;'>
    <?php 
        // Get the company name 
        $org_name = $_SESSION['u_org_name'];
        // Get all the managers from that company
        $sql = "SELECT * FROM managers WHERE manager_org_name = '$org_name';";
        $result = mysqli_query($conn, $sql);
        

        // Put each manager into an option 
        while ($row = $result->fetch_assoc()) {
            
            $added = "";
            $email = $row['manager_email'];
            $manager_id = $row['manager_id'];
            $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            if ($resultCheck > 0){
                $added = " (Already added to project)";
            }
            echo "<option value='$manager_id'>$email $added</option>";
        }
        //echo "<input type='hidden' name='added' value='$add'>";

    ?>
</select>
    <button type='sumbit' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Add</button>
    <button type='sumbit' id='exit_small_modal_manager' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Cancel</button>

    </div>

    </div>



<?php 
    include "edit_modal_employee_entries.html";
?>

<?php
    include "edit_project_modal.php"
?>




<!-- Modal to enter more entries -->
<div id="add_entry_modal" class="modal">
    <div style='display:block;' class='outside_of_modal'></div>

    <div class='centering-modal'>
    <!-- Modal content -->
        <div style='line-height:20px;'class='moveable_modal' id='moveable_add_entry_modal'>

            <div id='moveable_add_entry_modalheader' class='modal_header'>
                <p id='myModal_text' class='modal_header_text'>Add New Entry</p>
            </div>
            
            <div class='space20'>
            </div>

            <input id='tid' value='' type='hidden'>

            <div class='space20'>
                <p style='float:left;margin-left:20px;padding:0;'>Enter Date</p>
                <p style='float:left;margin-left:91px;padding:0;'>Enter Start</p>
                <p style='float:left;margin-left:57px;padding:0;'>Enter Finish</p>
            </div>

            
            <div style='height:34px;'>
                <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 140px;' type=date>
                <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 60px;' type=text>
                <select id='start_diem' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <input name='end' value='2:00' id='end' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px;  height:30px; width: 60px;' type=text>
                <select id='end_diem' name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px;  height:34px; width: 40px;'>
                    <option>AM</option>
                    <option selected>PM</option>
                </select>
            </div>

            <div class='space20'>
            </div>


            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>Select Employee</p>
            </div>

            <div style='height:34px; margin-left:20px;'>
                <select id='emp_id' name='emp_id' form='new_entry' style='float:left;padding: 0 0 0 4px; height:34px; width: 148px;'>
                    <?php 
                        // Get the company name 
                        $org_name = $_SESSION['u_org_id'];
                        // Get all the managers from that company
                        $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status='active';";
                        // Put the result into $result
                        $result = mysqli_query($conn, $sql);
                        // Put each employee into an option 
                        while ($row = $result->fetch_assoc()) {
                            // Get the employee's email
                            $email = $row['emp_email'];
                            // Get the employee's id
                            $emp_id = $row['emp_id'];
                            // Get the employee's first name
                            $first = $row['emp_first'];
                            // Get the employee's last name
                            $last = $row['emp_last'];
                            // Put the employee in an option
                            echo "<option data-last='$last' data-first='$first' value='$emp_id'>$email</option>";
                        }

                    ?>
                </select>
            </div>


            <div class='space20'>
            </div>


            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>Description</p>
            </div>

            <div style='height:66px; margin-left:20px;'>
                <textarea form='new_entry' name='desciption' id='description' style='resize:none;float:left;width: 654px;height: 60px;'></textarea>
            </div>

            <div class='space20'>
            </div>

            <div style='height:54px; margin-left:20px;'>
                <button form='new_entry' type='sumbit' id='save_new_entry' name='project_submit' class='button-style-4-2 right'>Save</button>
            
                <button id='cancel_add_entry' class='button-style-4-2 right'>Cancel
                </button>
            </div>

        <!-- <form id='new_entry' method='POST' action='add_new_entry_to_project.php'>
        </form> -->
        
        
    </div>
</div>
</div>


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




<div style='display:none;'>

</div>




