<?php
    // Put header in page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        exit();
    }

    // put the sessions current_manager_id into $manager_id
    $emp_id = $_SESSION['current_emp_id'];
    $email = $_SESSION['current_emp_email'];
?>

<!-- Main part of page -->
<section class="main-container">
    
    <?php
        // Include the navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
       

        <div class='shadow'>
        
            <!-- Creates the top of the form where the managers's name is displayed -->
            <div class='box-create-2'>
                <div id='top-bar' style='margin-left:20px;'>
                    <h4 id='header-line'><?php 
                        $emp_first=$_SESSION['current_emp_first']; 
                        $emp_last=$_SESSION['current_emp_last'];
                        echo htmlspecialchars($emp_first, ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($emp_last, ENT_QUOTES, 'UTF-8').' - '.htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>          
                    </h4>
                    
                    <!-- <button id='edit_main' class='button-style-7' >Edit</button> -->
                    <a class='button-style-7' style='line-height:26px; height:26px;' href='<?php echo "employee_entries.php?emp_id=".$emp_id; ?>'>Back</a>
                </div>
            </div>





            <!-- Blank area 20px -->
            <div class='box-create' style='width:100%; height:20px; background-color:rgb(247, 247, 247);'>
                <div id='top-bar' style='margin-left:20px;'>
                </div> 
            </div>

            
            <!-- 3rd row: 1 heading, says that assigned projects are under it-->
            <div class='box-create' style=' margin-top:-20px; width:100%; height:40px;  background-color:rgb(247, 247, 247)'>
                <div id='top-bar' style='margin-left:20px;'>
                    <h1 style='font-size:20px; line-height:40px;'>Assigned Projects</h1>
                </div>
            </div>

            
            <div id='list_projects'>
            </div>


            <!-- Area for the button to add more projects to the manager -->
            <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                <div id='assign_project_box' style='width: 97%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px;cursor:pointer;'>
                    
                    <button id='add_project_small_button'style='cursor:pointer;width: 100%; height:50px;
                        margin:0 auto;
                        background-color: rgb(218, 218, 218);
                        border-radius: 4px;font-size:16px; '>
                        + ADD PROJECT
                    </button>
                
                </div>
            </div>

        </div>

        <?php 
            include "arrows_pagination.php";
        ?>

           
        
    </div>
</section>
<!-- End main part of page -->










<!-- Hidden modals -->
<div id="assign_employee_Modal" class="modal" style='display:none; z-index:6'>
    <div id='add_emp_id_small' style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:220px; width:340px;'>
        
            <div>
            <!-- </select> -->
            <input id='search_employees' type='text' placeholder='Search' style='width: 328px;
                margin-top:1px;
                height: 34px;
                border: none;
                
                padding: 0px 0px 0px 12px;
                font-family: arial;
                
                font-size: 14px;
               '>
            </div>

            <div style='overflow-y:scroll;height:150px;'>
                <ul id='search_results_employees'>
                </ul>
            </div>

            <div>
            <button type='sumbit' id='add_employee' style=';width: 148px;
                height: 34px;
                border: none;
                margin-left:1px;
                float:left;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Add
            </button>
        
        <button type='sumbit' id='exit_small_modal_employee' style=';width: 148px;
            height: 34px;
            border: none;
            margin-right:1px;
            float:right;
            background-color: rgb(66, 85, 252);
            font-family: arial;
            color: #fff;
            font-size: 14px;
            cursor: pointer;'>Cancel
        </button>
        </div>

    </div>
</div>

<!-- Hidden modals -->
<div id="assign_project_Modal" class="modal" style='display:none; z-index:6'>
    <div id='add_emp_id_small' style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218);height:220px; width:340px;'>
        
            <div>
            <!-- </select> -->
            <input id='search_projects' type='text' placeholder='Search' style='width: 328px;
                margin-top:1px;
                height: 34px;
                border: none;
                
                padding: 0px 0px 0px 12px;
                font-family: arial;
                
                font-size: 14px;
               '>
            </div>
        

            <div style='overflow-y:scroll;height:150px;'>
                <ul id='search_results_projects'>

                </ul>
            </div>

            <div>
            <button type='sumbit' id='add_project' style=';width: 148px;
                height: 34px;
                border: none;
                margin-left:1px;
                float:left;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Add
            </button>
        
            <button type='sumbit' id='exit_small_modal_project' style=';width: 148px;
                height: 34px;
                border: none;
                margin-right:1px;
                float:right;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Cancel
            </button>
        </div>

    </div>
</div>












<!-- Get the JQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Get a test for manager info change -->
<script src="test_1.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>

<script>

    // Add list
    var add_list_projects = []
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
    



    // When the page is ready, do the following
    $(document).ready(function() {




        


        
        // Get all of the entries from the project
        $.post('load_employees_assigned_projects_to_objects.php', function(result) {
            // Turn the result into JSON objects
            assigned_project = JSON.parse(result)
            // Go through each project
            for (i=0; i<assigned_project.length;i++) {
                // Sanitize the code, prevent XSS              
                assigned_project[i].project_name = DOMPurify.sanitize(assigned_project[i].project_name);
                assigned_project[i].description = DOMPurify.sanitize(assigned_project[i].description);
                assigned_project[i].job_code = DOMPurify.sanitize(assigned_project[i].job_code);
                assigned_project[i].date = DOMPurify.sanitize(assigned_project[i].date);
            }
            // Display all of these projects at the start of page
            display_all_assigned_projects()
            // Check to see if you need to put arrows to view more projects
            if (assigned_project.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })

        // Get all of the projects from the company
        $.post('load_projects_to_objects.php', function(result) {
            // Turn the result into JSON objects
            project = JSON.parse(result)
            // Display all projects
            display_all_projects()
        })



        // What happens if the arrow forward button is clicked
        $( "#view-forward" ).click(function() {
            // Display the back arrow to view previous
            $('#view-backward').css('display','inline')
            vnum_s += 25
            vnum_e += 25

            display_all_assigned_projects()
        })
        // What happens if the arrow backward button is clicked
        $( "#view-backward" ).click(function() {
            // Display the foward arrow to view more
            $('#view-forward').css('display','inline')
            vnum_s -= 25
            vnum_e -= 25

            display_all_assigned_projects()
            
        })



        $("#edit_main").click(function() {
            // Display the edit project modal
            $(document.getElementById('manager_edit')).css('display','block');
        })
        // What happens if the cancel button on the editing project modal (employee edit) is clicked
        $( "#cancel_edit_main" ).click(function() {
            // Stop displaying employee_edit
            $(document.getElementById('manager_edit')).css('display','none');
            
        })
        // What happens if the add_entry button is clicked
        $( "#save_manager" ).click( function() {

            var test = test_account()

            if (test == true) {

                var first = $('#first_edit').val()
                var last = $('#last_edit').val()
                var email = $('#email_edit').val()
                var update = 'set'
                
                $.post('update_manager.php',{update:update,first:first,last:last,email:email}, function(result){
                    
                    if (result=='taken') {
                        alert('This E-mail is already taken')
                    } else {
                        // Stop displaying employee_edit
                        $(document.getElementById('manager_edit')).css('display','none');
                        $('#header-line').text(first + " " + last + " - " + email)
                    }
                })
            }
        })

        // What happens if the add_employee_small_button button is clicked
        $( "#add_project" ).click( function() {
            // stop displaying the assign_employee_Modal modal
            $("#assign_project_Modal").css("display","none");
            // Make an array for ids
            ids =[]
            // Go through the employees to add
            for (i=0;i<add_list_projects.length;i++) {
                // Add each employee
                assigned_project.push(add_list_projects[i])    
                // Ad to ids
                ids.push(add_list_projects[i].id)          
            }
            if (assigned_project.length > 25 && assigned_project.length > vnum_e) {
            // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
            // Redisplay all the assigned employees
            display_all_assigned_projects()
            // Display employees not assigned
            display_all_projects()
            // Check to make sure there are ids to assign, no need to call php if not
            if (ids.length > 0) {
                // Add the assigned projects to the database
                $.post('assign_project_employee.php', {ids:ids} )
            }
            // Reset the list
            add_list_projects = []

        });

        // What happens if the exit_small_modal button is clicked
        $( "#exit_small_modal_employee" ).click( function() {
            // stop displaying the assign_employee_Modal modal
            $("#assign_employee_Modal").css("display","none");  
            // Change all divs back to original color
            $(".employee_remove").each(function() {
                // Change to the original color
                $(this).css("background-color","rgb(144, 223, 255)")
                // Change class back to original
                $(this).toggleClass('employee_remove employee_add');
            })
            // Reset list of selected employees
            add_list_employees = []
        });
        // What happens if the add_manager_small_button button is clicked
        $( "#add_project_small_button" ).click( function() {
            // Display the assign_project_Modal modal
            $("#assign_project_Modal").css("display","block");
        });
        // What happens if the exit_small_modal_manager button is clicked
        $( "#exit_small_modal_project" ).click( function() {
            // stop displaying the assign_project_Modal modal
            $("#assign_project_Modal").css("display","none"); 
            // Go through each of this class
            $(".project_remove").each(function() {
                // Change class back to original
                $(this).toggleClass('project_remove project_add');
                // Change to the original color
                $(this).css("background-color","rgb(144, 223, 255)")
            })
            // Reset list of selected employees
            add_list_projects = []    
        });


        // What happens if the exit_small_modal_manager button is clicked
        $( "#search_projects" ).keyup( function() {


            $(".project_remove").each(function() {
                // Change class back to original
                $(this).toggleClass('project_remove project_add');
                // Change to the original color
                $(this).css("background-color","rgb(144, 223, 255)")
            })
            // Reset list of selected employees
            add_list_projects = []

            input = $("#search_projects").val()
            ul = document.getElementById("search_results_projects");
            li = ul.getElementsByTagName('li');
            for (i=0;i < li.length;i++) {
                project_name_li = $(li[i]).data('project_name')
                //Check if the search is in the name
                if (project_name_li.toLowerCase().includes(input.toLowerCase()) ) {
                    li[i].style.display = "block";
                } else {
                    li[i].style.display = "none";
                }
            }
        });








    });




    $("#search_results_projects").on("click", '.project_add', function () {
        // Get the selected project name
        project_name = $(this).data("project_name")
        // Get the selected project id
        id = $(this).val()
        // Create an object with the selected project data
        pro = {project_name:project_name,id:id}
        // Add it to list of projects that could be added
        add_list_projects.push(pro)
        // Change color to yellow of selection box
        $(this).css( "background-color", "yellow" ); 
        // Change the class. This is used to change the buttons functionality
        $(this).toggleClass('project_add project_remove');
    });

    $("#search_results_projects").on("click", '.project_remove', function () {
        // Get the id of the deselected project
        id = $(this).val()
        // Go through the list
        for (i=0;i<add_list_projects.length;i++) {
            if (id == add_list_projects[i].id) {
                // Remove them from the list
                add_list_projects.splice(i,1)
            }
        }
        // Change back to original color
        $(this).css( "background-color", "rgb(144, 223, 255)" );
        // // Change the class to the original. This is used to change the buttons functionality
        $(this).toggleClass('project_remove project_add');
    });

    $("#list_projects").on("click", '.remove_assigned_project', function () {
        // Get the id of the deselected project
        id = $(this).val()
        // Go through the list

        for (i=0;i<assigned_project.length;i++) {
            if (id == assigned_project[i].id) {

                // Remove them from the list
                assigned_project.splice(i,1)
                // Leave the i loop
                break;
            }
        }
        if (assigned_project.length <= vnum_s && assigned_project.length > 0) {
            vnum_s -= 25
            vnum_e -= 25
        }
        // Check if they are on first page
        if (vnum_s == 0) {
            // Stop displaying the backward arrow as there are no more to see
            $('#view-backward').css('display','none')
        }
        // Redisplay all the assigned employees
        display_all_assigned_projects()
        // Display employees not assigned
        display_all_projects()
        // Remove the project from this manager
        $.post('deassign_project_employee.php', {id:id} )

    });


    function display_all_projects() {
            // Clear all projects
            $('#search_results_projects').html('')
            // Go through each project
            for (i=0; i < project.length; i++) {
                // Set pass
                pass = false;
                // Go through assigned employees
                for (j=0; j < assigned_project.length;j++) {
                    // Check to see if the ids match
                    if (project[i].id == assigned_project[j].id) {
                        
                        // pass set to true
                        pass = true;
                        // Leave j loop
                        break;
                    }
                }
                // Check if this project was already assigned
                if (pass != true) {  
                    // Create the text needed to create an entry
                    text_1 = "<li id='entry_box' class='entry_line project_add' data-project_name='" + project[i].project_name + "' value='" + project[i].id + "' style='height:30px; line-height:30px;'><div style='float:left;margin-left:12px;font-size:16px;'>"
                    // Creates more html
                    text_2 = "</div></li>";
                    // Get the line data
                    line_data =  "Project Name: " + project[i].project_name 
                    // Get the length of the string in pixels
                    var len = ctx.measureText(line_data).width;
                    // Check if it is greater than 380
                    if (len > 190) {
                        // Keep removing letters until it is less than 375 pixels long
                        while (len > 185) {
                            // Remove the last letter
                            line_data = line_data.substring(0, line_data.length - 1);
                            // Get the new length of string in pixels
                            len = ctx.measureText(line_data).width;
                        }
                        // Add dots at end
                        line_data += "..."
                    }
                    text = text_1 + line_data + text_2
                    // Return the text
                    var entry = $('#search_results_projects').append(text) 
                }           
            }
        }


        // Function to display all of the entries
        function display_all_assigned_projects() {
            // Clear all projects
            $('#list_projects').html('')
            // Check to see how far to make lines

            if (assigned_project.length > vnum_e) {
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
                max_view = assigned_project.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + assigned_project.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }
            // Go through every entry
            for (i = vnum_s; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line_projects(assigned_project[i].project_name, assigned_project[i].id, assigned_project[i].description, assigned_project[i].date, assigned_project[i].job_code)
                // Put the entry on #list
                var entry = $('#list_projects').append(text)
            }

        }




        // Create the entry lines with html
        function prepare_entry_line_projects(project_name, id, description, date, job_code) {
            // Create the text needed to create an entry
            text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line' ><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
            // Creates more html
            text_2 = "</div><button type='button' data-jobcode='" + job_code + "' data-project='" + project_name + "' data-date='" + date + "' data-description='" + description + "' value=" + id + " class='box-button entry-button-style-2 remove_assigned_project'>Remove</button></div></div>";
            // Get the line data
            line_data =  "Project Name: " + project_name 
            // Get the length of the string in pixels
            var len = ctx.measureText(line_data).width;
            // Check if it is greater than 380
            if (len > 490) {
                // Keep removing letters until it is less than 375 pixels long
                while (len > 485) {
                    // Remove the last letter
                    line_data = line_data.substring(0, line_data.length - 1);
                    // Get the new length of string in pixels
                    len = ctx.measureText(line_data).width;
                }
                // Add dots at end
                line_data += "..."
            }
            text = text_1 + line_data + text_2
            // Return the text
            return text
        }


</script>
