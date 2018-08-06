<!-- Adds a font from google. Name: Lato -->
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
<!-- Adds a font into the page. Name: font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Adds the stylesheet style_now.css to the page -->
<link rel="stylesheet" type="text/css" href="style_nav.css">

<div id='div_session_write' style='display:none;'></div>







<!-- Puts the navigation on the left 25% of the page. The nav section -->
<div style='width:25%; float:left; margin-left:20px;'>    

    <div class='shadow'>
    <!-- Creates the top of the form where the employee's name is displayed -->
    <div class='nav_header'>
        <div id='top-bar' style='margin-left:20px;'>
            <h4>Navigation</h4>
        </div>
    </div>

    <!-- Create link to the home page -->
    <a class='nav-link' href='index.php'><span>Home</span></a>

    <!-- Button to open links to all projects -->
    <button id='project-dropdown' class='nav-add-button' ><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Create link to view projects page -->
    <a class='nav-link' href='view_projects.php'><span>Projects</span></a>

    <!-- Start php code -->
    <?php 

        // Create database connection
        include 'includes/dbh.inc.php';
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get all projects that are active from that company
        $sql = "SELECT * FROM projects WHERE status = 'active' AND org_id = '$org_id'";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Create a dropdown like menu to select the projects
        echo "<div style='display:none;' id='project-list'>";
        // Go throught the results
        while ($row = $result->fetch_assoc()) {
            // Get the project name
            $project_name =  $row['project_name'];
            // Get the project id
            $project_id = $row['project_id'];
            // Check if the project name is more than 28 characters
            if (strlen($project_name) > 28) {
                // Cut down the length of the string
                $project_name = substr($project_name, 0, 26)." ...";
            }
            // Put the project as an option to click
            echo "<form method='GET' action='viewHours.php' class='form-nav'>
                <input type='hidden' name='project_id' value='".$row['project_id']."'>
                <button type='submit' class='dropdown-open-button'><span class='left-float'><p class='project_name'>$project_name</p></span></button></form>";

            }
        // Ends the dropdown like menu
        echo "</div>";

    ?>
    <!-- End php code -->

    <!-- Create link the the main calender -->
    <a class='nav-link' href='main_calendar.php'><span>Calendar</span></a>

    <!-- Create link to view clocked in page to see who's clocked in -->
    <a class='nav-link' href='view_clocked_in.php'><span>View Employees Clocked In</span></a>

    <!-- Button to open links to all managers -->
    <button id='manager-dropdown' class='nav-add-button' ><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Link to view manager page -->
    <a class='nav-link' href='view_managers.php'><span>View Managers</span></a>

    <!-- Start php code -->
    <?php

        // Get all of the managers from the company
        $sql = "SELECT * FROM managers WHERE manager_org_id = '$org_id' AND status='active';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Start a dropdown like menu with all the managers
        echo "<div style='display:none;' id='manager-list'>";
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the manager's E-mail
            $manager_email =  $row['manager_email'];
            // Creates link to view that manager
            echo "<form method='GET' action='select_manager.php' class='form-nav'>
            <input type='hidden' name='manager_id' value='".$row['manager_id']."'>
            <button class='dropdown-open-button' type ='submit'><span class='left-float'>
            <p class='manager_email'>$manager_email</p></span></button></form>";

        }
        // End drop down like menu
        echo "</div>";

    ?>
    <!-- End php code -->

    <!-- Button to open dropdown to see links to all employees -->
    <button id='employee-dropdown' class='nav-add-button'><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Link to view employees page -->
    <a class='nav-link' href='view_employees.php'><span>View Employees</span></a>

    <!-- Start php code -->
    <?php 

        // Get all employees from the company
        $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status='active';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Start a dropdown like menu where you can select from all employees
        echo "<div style='display:none;' id='employee-list'>";
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the employee's E-mail
            $emp_email = $row['emp_email'];
            // Create link to view the employee
            echo "<form method='GET' action='employee_entries.php' class='form-nav'>
            <input type='hidden' name='emp_id' value='".$row['emp_id']."'>
            <button type ='submit' class='dropdown-open-button'><span class='left-float'>
            <p class='emp_email'>$emp_email</p></span></button></form>";

        }
        // End dropdown like menu
        echo "</div>";

    ?>
    <!-- End php code -->
    </div>
    <!-- <div>
        <button id='colorccc' class='color-picker'></button>
        <button id='color2' class='color-picker'></button>
        <button id='color3' class='color-picker'></button>
        <button id='color4' class='color-picker'></button>
        <button id='color5' class='color-picker'></button>
        <button id='color6' class='color-picker'></button>
    </div> -->


</div>
<!-- End nav section -->









<script>

    // When the page is ready do this
    $(document).ready(function readyDoc() {

        // Initialize variables      
        var clicked_project_id, input;
        var searching = false;
        var project_dropdown = 'closed';
        var employee_dropdown = 'closed';
        var manager_dropdown = 'closed';
        var projectdropdown = $('#project-dropdown-status').val()
        // Create a canvas to measure string length in pixels
        var canvas = document.createElement('canvas');
        // Create a canvas
        var ctx = canvas.getContext("2d");
        // Set the font of canvas
        ctx.font = "12px Arial";        

        $( ".emp_email" ).each(function() {
            line_data = $(this).text()
            // Get the length of the line in pixels
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
                // Put the shorter text back into the line
                $(this).text(line_data)
            }
        });
        $( ".manager_email" ).each(function() {
            line_data = $(this).text()
            // Get the length of the line in pixels
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
                // Put the shorter text back into the line
                $(this).text(line_data)
            }
        });
        $( ".project_name" ).each(function() {
            line_data = $(this).text()
            // Get the length of the line in pixels
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
                // Put the shorter text back into the line
                $(this).text(line_data)
            }
        });


        if (projectdropdown == 'open'){
            project_dropdown = 'open';
        }
       
        // When happens if the project dropdown button is clicked
        $( "#project-dropdown" ).click(function() {
            // Check if it is closed
            if (project_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('project-list')).css('display','block');
                // Set the status to open
                project_dropdown = 'open';
                // Change the arrow direction of the project dropdown button to down
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
                //
                $('#div_session_write').load('session_write.php?project-dropdown=open');
            // Check if it is open
            } else if (project_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('project-list')).css('display','none');  
                // Set the status to closed
                project_dropdown = 'closed';
                // Change the arrow direction of the project dropdown button to the right
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
                //
                $('#div_session_write').load('session_write.php?project-dropdown=closed');
            }
        })

        // What happens if the employee dropdown button is clicked
        $( "#employee-dropdown" ).click(function() {
            // Check if it is closed
            if (employee_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('employee-list')).css('display','block');
                // Set the status to open
                employee_dropdown = 'open';
                //
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            // Check if it is open
            } else if (employee_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('employee-list')).css('display','none');  
                // Set the status to closed
                employee_dropdown = 'closed';
                //
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })
        // Check if it is closed
        $( "#manager-dropdown" ).click(function() {
            if (manager_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('manager-list')).css('display','block');
                // Set the status to open
                manager_dropdown = 'open';
                //
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            // Check if it is open
            } else if (manager_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('manager-list')).css('display','none');  
                // Set the status to closed
                manager_dropdown = 'closed';
                //
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })

        $( "#colorccc" ).click(function() {

            $('body').css('background-color','#ccc')
            
        })
        $( "#color2" ).click(function() {
            $('body').css('background-color','rgb(100, 199, 153)')
        })
        $( "#color3" ).click(function() {
            $('body').css('background-color','rgb(166, 77, 189)')
        })
        $( "#color4" ).click(function() {
            $('body').css('background-color','rgb(224, 215, 82)')
        })
        $( "#color5" ).click(function() {
            $('body').css('background-color','rgb(43, 184, 202)')
        })
        $( "#color6" ).click(function() {
            $('body').css('background-color','rgb(219, 52, 52)')
        })
    });
    // ----- End on document.ready -----




</script>
