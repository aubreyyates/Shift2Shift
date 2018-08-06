<?php
    // Put header in the page
    include_once 'header.php';
    // Check if no one is signed in
    // if (!isset($_SESSION['u_id']) && !isset($_SESSION['e_id']) && !isset($_SESSION['m_id'])) {
    //     include 'emplogin.html';
    // }
?>

<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
<link href="style-index.css" rel="stylesheet">

<!-- Main part of page -->
<section class="main-container-index">
    <?php
    
        if (!isset($_SESSION['u_id']) && !isset($_SESSION['e_id']) && !isset($_SESSION['m_id'])) {
            include "login_bar.html";
            echo "<div style='width:100%; margin:0 auto; '>";
        } else {
            echo "<div style='width:1000px; margin:0 auto; '>";
        }
    
    ?>
        
        
        <?php
            
            // -------------------------------- Checks if an Admin is logged in --------------------------------
            if (isset($_SESSION['u_id'])) {

                // Creates the database connect
                include 'includes/dbh.inc.php';

                // Gets the users id
                $user_id = $_SESSION['u_id'];
                // Gets the company id
                $org_id = $_SESSION['u_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $org_name = $row['org_name'];
                    // Gets the company website address
                    $org_website = $row['org_website'];
                    // Gets if the company allows employees to edit entries
                    $allow_employee_edit = $row['allow_employee_time_edit'];
                    // Gets if the company allows managers to edit entries
                    $allow_manager_edit = $row['allow_manager_time_edit'];
                    // Get the company color
                    $org_color = $row['org_color'];
                }

                
                // Diplays the name of the company
                // echo "<div class='index_company_name_box'>
                //                     <div id='home'>Home</div>



                //         </div>";

                
                echo "<div class='index_company_name_box2'><h2 id='company_name_header'>".htmlspecialchars($org_name, ENT_QUOTES, 'UTF-8')."</h2></div><br><br>";
                
                // More space
                echo "<br>";


                // include 'project.php';

                // include "admin_home.html";
                
                // --- Creates three columns for the home page buttons to be displayed on ---
                echo "<div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>";
                

                // --- 1st row : images ---
                echo "<div><img src='images/employee.png' height='42' width='42'></div>";
                echo "<div><img src='images/manager.png' height='42' width='42'></div>";
                echo "<div><img src='images/admin.png' height='42' width='42'></div>";
                // --- End 1st row --- 


                // --- 2nd row : buttons ---
                // Button to create a new employee account
                echo "<a href='eaccount.php'>Create Employee Account</a>";
                
                // Button to create a new manager account
                echo "<a href='manager_account.php'>Create Manager Account</a>";

                // Button to create a new admin account
                echo "<a class='home_page_button' href='adminaccount.php'>Create Admin Account</a>";
                // --- End 2nd row ---


                // --- 3rd row: buttons ---
                // Button to view employees in your company
                echo "<a href='view_employees.php'>View Employees</a>";

                // Button to view managers in your company
                echo "<a href='view_managers.php'>View Managers</a>";

                echo "<a href='view_admins.php'>View Admins</a>";
                // --- End 3rd row ---

                
                // --- 4th row : buttons ---
                // Button to view who is currently clocked in
                echo "<a href='view_clocked_in.php'>View Employees Clocked In</a>";
                echo "<div></div><br><br>";
                
                // --- End 4th row ---
                
                
                // --- 5th row: images ---
                echo "<div><img src='images/projects.png' height='42' width='42'></div>";
                echo "<div><img src='images/calendar.png' height='42' width='42'></div>";
                echo "<div><img src='images/database.png' height='42' width='42'></div>";
                // --- End 5th row ---


                // --- 6th row: buttons ---
                // Button to view projects 
                echo "<a href='view_projects.php'>Projects</a>";

                // Button to view the main calender 
                echo "<a href='main_calendar.php'>Calendar</a>";

                // Button to view database information 
                echo "<a href='database_options.php'>Database Options</a>";
                // --- End 6th row --- 


                // --- 7th and 8th row: empty ---
                echo "<div></div><div></div><br><br>";
                // --- End 7th and 8th row --- 


                // --- 9th row : images ---
                echo "<div><img src='images/notifications.png' height='42' width='42'>";
                echo "</div><div><img src='images/settings.png' height='42' width='42'></div>";
                echo "<div></div>";
                // --- End 9th row ---


                // Gets all of the messages for the company that are unread
                $sql = "SELECT * FROM message WHERE org_id = '$org_id' AND read_status='No';";   
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql);     
                // Get the number of results from the database. This is the number of unread messages
                $resultCheck = mysqli_num_rows($result);  

                $pixels = 165+($resultCheck*54);
                // --- 10th row : buttons ---

                // If there is 1 or more unread messages, display a redbox with the number of unread messages in the notifications button
                if ($resultCheck > 0) {
                    echo "<div><button id='notifications'>Notifications</button><div id='total_messages' style='background-color:red; color:#fff; margin-left:40px; z-index:5; margin-top:-44px;font-size:16px;height: 30px; width: 34px; line-height:30px;'>$resultCheck</div></div>";
                } else {
                    echo "<button id='notifications'>Notifications</button>";
                }
                // Button to view notifications 

                // Button to view settings
                echo "<button id='settings'>Settings</button>";
                // --- End 10th row ---

                // --- 11th row: 1 button ---
                echo "<div></div><div></div><button id='account'>Account</button>";
                // --- End 11th row --- 


                echo "</div>";
                // --- End columns ---


                // More space
                echo "<br><br><br>";
            
            // -------------------------------- End of Admin Code --------------------------------

                   

                

        
            
            // -------------------------------- Checks if an Employee is logged in --------------------------------
            } elseif (isset($_SESSION['e_id'])){
                
                // Connects to databse
                include 'includes/dbh.inc.php';
                
                // Gets the company id
                $org_id = $_SESSION['e_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $org_name = $row['org_name'];
                } 
                // Diplays the name of the company
                echo "<div class='index_company_name_box2'><h2 id='company_name_header'>".htmlspecialchars($org_name, ENT_QUOTES, 'UTF-8')."</h2></div>";

                echo "</div>";
                echo "<div style='height:30px;'></div>";
                include "employee_index.php";
                
                echo "<div style='height:800px;'</div>";
                
                

            // -------------------------------- End of Employee Code --------------------------------







            // -------------------------------- Checks if a Manager is logged in --------------------------------
            } elseif (isset($_SESSION['m_id'])){

                // Connects to databse
                include 'includes/dbh.inc.php';
            

                // Gets the company id
                $org_id = $_SESSION['m_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $org_name = $row['org_name'];
                } 
                echo "
                <div class='index_company_name_box'>
                    <div id='home'>Home</div>
                </div>";


                echo "<div class='index_company_name_box2'><h2 id='company_name_header'>".htmlspecialchars($org_name, ENT_QUOTES, 'UTF-8')."</h2></div><br><br>";
                
                
                
                // --- Creates three columns for the home page buttons to be displayed on ---
                echo "<div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>";

                echo "<div><img src='images/employee.png' height='42' width='42'></div>";
                echo "<div><img src='images/projects.png' height='42' width='42'></div>";
                echo "<div></div>";

                // Button to view employees you are assigned
                echo "<a href='view_assigned_employees.php'>View Employees</a>";
                
                // Button to view projects you are assigned
                echo "<a href='view_assigned_projects.php'>View Projects</a>";

                echo "</div>";
                // --- End Colomns --- 

            // -------------------------------- End of Manager Code --------------------------------






            

            // If no one is logged in, display the employee loggin box
            } else {


                include "login_area.html";


               
            }
        ?>

    </div>
</section>
<!-- End main part of page -->


<div class='show_long_text_2' style='display:none;'>
  
    <div class='info_content-2'><span id='height-measure'>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <p id='info_description_long'></p>
    </span></div>
    <div class='info_long_tip'></div>
</div>



<?php 
    // Check if admin is signed in
    if (isset($_SESSION['u_id'])){
        // Put modals on the page
        include "index_modals.php";
        // Used for santizing string 
        echo "<script type='text/javascript' src='dist/purify.min.js'></script>";
        echo "<script src='index_functions.js'></script>";
    }
?>

<script>
    
</script>














