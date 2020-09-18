<style>
    <?php include dirname(__DIR__).'/user-timekeeping-clock/user-timekeeping-clock.css'; ?>
</style>

    <div class='space70'></div>

    <div class='form_area'>

    <h3>Clock</h3>

       <div class='divider'></div>


        <div>
            <select id='project-select' class='dropdown-style-4' style='margin-top:50px;margin-right:0px;'>
                <option data-projectname='No Project' value='0'>No Project</option>
                    <?php
                        
                        // // Get the employee's id
                        // $emp_id = $_SESSION['e_id'];
                        // // Get all the employee's assignments
                        // $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                        // // Put the result into $result2
                        // $result2 = mysqli_query($conn, $sql); 
                        // // Go through the result
                        // while ($row = $result2->fetch_assoc()) {
                        //     // Get the project id they were assigned to
                        //     $project_id = $row['project_id'];
                        //     // Get the project with this id
                        //     $sql = "SELECT * FROM projects WHERE project_id = '$project_id';";
                        //     // Put the result into $result3
                        //     $result3 = mysqli_query($conn, $sql);
                        //     // Go through the result
                        //     while ($row2 = $result3->fetch_assoc()) {
                        //         // Get the project name 
                        //         $project_name = $row2['project_name'];
                        //     }
                        //     // Put the project into an option to select
                        //     echo "<option data-projectname='$project_name' value='$project_id'>$project_name</option>"; 
                        // }
                    
                        
                    ?>
            </select>
        </div>

        <div> 
            <input id='job_code' placeholder='Project Code' style='width: 118px; height:30px; margin-top:0px; font-size:12px; padding: 0px 15px' type="text">
        </div>

        <div id='clock_in_buttons_area'>
            <button id='clockin' class='clockin-button'>Clock In</button>
            <button id='clockout' class='clockin-button' disabled>Clock Out</button>
            <div id='user-clock-container'>
                <span id='user-clock'>00:00:00</span>
            </div>
        </div>

        <!-- Display the clock for time clocked -->
        <!-- <div class="clockStyle clockStyle2"> -->

        <!-- </div> -->

        <div>
            <button id = 'breakbtn' type ='submit' name='submitpausetime' style='' disabled>Take A Break
            </button>
        </div>

        <div style='height:12px;'></div>

    </div>

    <div id='notification-area'>

    </div>

<script src='timekeeping-app/widgets/user-timekeeping-clock/user-timekeeping-clock.js'></script>