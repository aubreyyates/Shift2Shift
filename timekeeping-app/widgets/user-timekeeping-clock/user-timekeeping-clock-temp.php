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
            <button type='button' onclick='timestamp()'id='clockin' class='clockin-button'>Clock In</button>
            <button name='submitsendtime' onclick='changebtnTwo()' disabled id='clockout' class='clockin-button'>Clock Out</button>
            <div id='user-clock-container'>
                <span id='user-clock'>00:00:00</span>
            </div>
        </div>

        <!-- Display the clock for time clocked -->
        <!-- <div class="clockStyle clockStyle2"> -->

        <!-- </div> -->

        <div>
            <button id = 'breakbtn' type ='submit' name='submitpausetime' style=' position: relative; width: 180px; top: 0px;
                height: 30px;
                border: none;
                background: #423d3d;
                font-family: arial;
                font-size: 16px;
                color: white;
                cursor:pointer;' disabled>Take A Break
            </button>
        </div>

        <div style='height:12px;'></div>

    </div>

    <div id='infoclock'>
                            <?php 
                                include dirname(__DIR__).'/notify-widget/notify-widget.php';
                            ?>
    </div>

   

<!-- Div to store the time clocked in -->
<div id='d1' style='font-size:0px;'>
    <?php 
        // // Gets the logged in employee's id
        // $emp_id = $_SESSION['e_id'];
        // // Get a row from timeGeneral if the employee hasn't sumbitted it by clocking out
        // $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$emp_id';";
        // $result = mysqli_query($conn, $sql);
        // // Checks if there were any results
        // $resultCheck = mysqli_num_rows($result);
        // // Code to run if there were any results
        // if ($resultCheck > 0) { 
        //     while ($row = $result->fetch_assoc()) {
        //         $time = $row["time_stamp"];
        //         $time_id = $row["time_id"];
        //         // put the time the unsubmitted time started into the div
        //         echo $time;
        //     }
        // }
    ?>
</div>

<script>

    $(document).ready(function readyDoc() {
        
        // Initialising variables
        let break_check = false;
        // Clocked in set to false
        let clocked_in = false;
        // Sets the start time to 0
        let start_time = 0;
        // Sets current_time to 0
        let current_time = 0;
        // Defaults the current project to no project
        let current_project = "No Project";
        // Defaults project name to No Project
        let project_name = "No Project";
        // Defaults job code use to false
        let job_code_used = false;
        // Defaults job code to none code
        let job_code = 'none';
        // Starts total_clocked_time to 0 
        let total_clocked_time = 0;
        // switching set to false
        let switching = false;
        // Defaults just_clocked_in to false
        let just_clocked_in = false;
        // Defaults just_took_break to false
        let just_took_break = false;
        // Defaults just_ended_break to false
        let just_ended_break = false;
        // Defaults coming back from break to false
        let coming_back_from_break = false;

        // // ajax call to see if there is any unsubmitted timestamp in the database
        // $.post( "not_submitted_test.php", function(result) { 
        //     // Parse the result
        //     result = jQuery.parseJSON(result);
            
        //     // Checks to see if the employee had not clocked out since last time
        //     if (result.time_start != 'no start') {

        //         // Sets the current project to what you had selected before you left
        //         current_project = result.previous_project;
        //         // Sets the project name to the one you can had before
        //         project_name = result.project_name;

                
                
        //         if ( result.previous_project == 0 ) {
        //             // Sets the option to the project you selected before you left
        //             $("#project-select").val(0);
        //             // Set the project name to No Project
        //             project_name = 'No Project';                    

        //         } else {            
        //             // Sets the option to the project you selected before you left
        //             $("#project-select").val(result.previous_project);
        //         }


        //         // Checks to see if the employee was on a break when they loaded the page
        //         if (result.on_break == 'no') {
        //             // Disables the clockin button
        //             $("#clockin").attr("disabled","disabled");
        //             // Enables the clockout button
        //             $("#clockout").removeAttr("disabled");
        //             // Enables the break button
        //             $("#breakbtn").removeAttr("disabled");
        //             // Changes color of the clockin button
        //             $("#clockin").css("background","#423d3d");
        //             // Changes color of the clockout button
        //             $("#clockout").css("background","linear-gradient(#db5555, #aa3636)");
        //             // Changes color of the break button
        //             $("#breakbtn").css("background","linear-gradient(#f3a736, #da8d23)");
        //             // Changes the text of the clockin button to clock in
        //             $("#clockin").val("Clock In");
        //             start_time = moment(result.time_start, "X");

    //                 start_time2 = moment(result.time_start, "X").format("hh:mm:ss A")
    //                 return_message = "<p>You clocked into " + project_name + " at " + start_time2 + "</p>"
    //                 $(return_message).appendTo($('#clocked_alert_area'));
    //             } else {
    //                 // Sets break_check to true
    //                 break_check = true;
    //                 coming_back_from_break = true;
    //                 time1 = moment(result.time_start, "X");
    //                 time2 = moment();
    //                 str_total_clocked_time = time2 - time1;
    //                 str_total_clocked_time = str_total_clocked_time.toString();
    //                 str_total_clocked_time = str_total_clocked_time.slice(0, -3);
    //                 total_clocked_time = parseInt(str_total_clocked_time);
    //                 start_time = moment();
    //                 start_time2 = moment(result.time_start, "X").format("hh:mm:ss A")
    //                 return_message = "<p>You started a break from " + project_name + " at " + start_time2 + "</p>"
    //                 $(return_message).appendTo($('#clocked_alert_area'));
    //             }
    //             // If they were clocked in, this gets the time that the had clocked in and makes a moment
                
    //             // Sets clocked_in to true since they never clocked out
    //             clocked_in = true;
    //             // Display the time they had previously 
    //             Clocked_timer();
    //         }
    //     }); 

        // What happens if you click the clock in button
        $( "#clockin" ).click(function() {

            // Check if a job code was entered
            if ($("#job_code").val() == '') {
                // // Check if they used a job code
                // if (job_code_used != true || switching == true) {
                //     // Get the current selection of project and sets it as the current_project
                //     current_project = $("#project-select").val();
                //     // Get the project name
                //     project_name = $("#project-select").find(':selected').data('projectname')
                // }
                // Start the clock 
                start_clock();
            } 
            // else {
            //     // Get the entered job code
            //     job_code = $("#job_code").val();
            //     // Put the job code box to none
            //     $("#job_code").val('');
            //     // Check to make sure the job code is a real code
            //     $.post("check_for_job_code.php", {job_code:job_code}, function(result){
            //         // Parse the JSON
            //         check = JSON.parse(result)
            //         // Check for results
            //         if (check[0].number != 1) {
            //             // Tell them the job code doesn't exist
            //             alert("This job code does not exist");
            //         } else {
            //             // Set job code use to true
            //             job_code_used = true
            //             // Get the project name
            //             project_name = check[0].project_name
            //             // Start the clock
            //             start_clock();
            //         }
            //     })
            // }
            
            function start_clock() {
                // Disables the clockin button
                $("#clockin").attr("disabled","disabled");
                // Enables the clockout button
                $("#clockout").removeAttr("disabled");
                // sets a 1 second delay to enable to break button
                setTimeout(function(){ $("#breakbtn").removeAttr("disabled");},1000);
                // Changes color of the clockin button
                $("#clockin").css("background","#423d3d");
                // Changes color of the clockout button
                $("#clockout").css("background","linear-gradient(#db5555, #aa3636)");
                // Changes color of the break button
                $("#breakbtn").css("background","linear-gradient(#f3a736, #da8d23)");
                // Changes the text of the clockin button to clock in
                $("#clockin").val("Clock In");
                
                if (break_check == false) {
                    
                    time = moment().format('hh:mm:ss A');
                    // // Stop any animation
                    // $('#infoclock').stop()
                    // // Set opacity back to 1
                    // $('#infoclock').css('opacity', '1')
                    // // Set opacity back to 1
                    // $('#infoclock').css('display', 'block')
                    // if (switching == false) {
                    //     $("#infoclock").text("You clocked in to " + project_name + " at " + time);
                    // } else {
                    //     $("#infoclock").text("You switched to " + project_name + " at " + time);
                    // }
                    // $('#infoclock').clone().appendTo($('#clocked_alert_area'));
                    // // Fade out the words in 3 seconds
                    // $('#infoclock').fadeOut(3000)
                    // Get the history box div
                    var history = document.getElementById("clocked_alerts");
                    // // Scroll to bottom of div
                    // history.scrollTop = history.scrollHeight;
                    just_clocked_in = true;
                
                } 
                //else {
                    //time = moment().format('hh:mm:ss A');
                    // // Stop any animation
                    // $('#infoclock').stop()
                    // // Set opacity back to 1
                    // $('#infoclock').css('opacity', '1')
                    // // Set opacity back to 1
                    // $('#infoclock').css('display', 'block')
                    // // Check if they are switching projects
                    // if (switching == false) {
                    //     $("#infoclock").text("You ended a break from " + project_name + " at " + time);
                    // } else {
                    //     $("#infoclock").text("You switched to " + project_name + " at " + time);
                    // }
                    // $('#infoclock').clone().appendTo($('#clocked_alert_area'));
                    // // Fade out the words in 3 seconds
                    // $('#infoclock').fadeOut(3000)


            //         // Get the history box div
            //         var history = document.getElementById("clocked_alerts");
            //         // Scroll to bottom of div
            //         history.scrollTop = history.scrollHeight;

            //         just_ended_break = true;
            //     }
                // if (coming_back_from_break != true) { 
                    // if (switching == false) {
                        
                        start_time = moment();
                    // } else {
                    //     time = $("#clockedDisplay").text();
                        
                    //     timestamp = moment().format("X");
                    //     timestamp = parseInt(timestamp);
                        
                    //     $.post( "timestamp_end.php", {timestamp:timestamp, time:time});
                    //     total_clocked_time = 0;
                    //     start_time = moment();
                    //     // if (break_check == true) {
                    //     //     start_time = moment();
                    //     // }
                    // }
            //     } else {
            //         start_time = moment();
            //         if (switching == true) {
            //             time = $("#clockedDisplay").text();
                        
            //             timestamp = moment().format("X");
            //             timestamp = parseInt(timestamp);
                        
            //             $.post( "timestamp_end.php", {timestamp:timestamp, time:time});
            //             total_clocked_time = 0;
            //             start_time = moment();
            //             // Set job code used to false
            //             job_code_used = false;
            //         }
            //     }
            //     coming_back_from_break = false;
                // Set clocked_in to true
                clocked_in = true;
            //     // Set break_check to false as they are not on a break
            //     break_check = false;
            //     // They cannot be switching anymore so set to false
            //     switching = false;
            }
        })



        // What happens if you click the clock in button
        $( "#clockout" ).click(function() {

            // time = moment().format('hh:mm:ss A');
            // // Stop any animation
            // $('#infoclock').stop()
            // // Set opacity back to 1
            // $('#infoclock').css('opacity', '1')
            // // Set opacity back to 1
            // $('#infoclock').css('display', 'block')
            // // Let them know when they clocked out
            // $("#infoclock").text("You clocked out of " + project_name + " at " + time);
            // // Add this to the history
            // $('#infoclock').clone().appendTo($('#clocked_alert_area'));
            // // Fade out the words in 3 seconds
            // $('#infoclock').fadeOut(3000)
            // // Get the history box div
            // var history = document.getElementById("clocked_alerts");
            // // Scroll to bottom of div
            // history.scrollTop = history.scrollHeight;

            // time = $("#clockedDisplay").text();


            
            
            // Disables the clockout button
            $("#clockout").attr("disabled","disabled");
            // sets a 1 second delay to enable to clockin button
            setTimeout(function(){ $("#clockin").removeAttr("disabled");},1000);
            // Disables the break button
            $("#breakbtn").attr("disabled","disabled");
            // Changes color of the clockin button
            $("#clockout").css("background","#423d3d");
            // Changes color of the clockout button
            $("#clockin").css("background","linear-gradient(#4ae478, #239c45)");
            // Changes color of the break button
            $("#breakbtn").css("background","#423d3d");
            // Changes the text of the clockin button to clock in
            $("#clockin").val("Clock In");
            // Puts the text in the clockedDisplay to 00:00:00
            $("#clockedDisplay").text("00:00:00");
            // Set clocked_in to false since they just clocked out
            clocked_in = false;
            // They are not switching projects since they just clocked out so set it to false
            switching = false;
            // Not on a break since they clocked out, set it to false
            break_check = false;
            // reset total_clocked_time by setting it to 0
            total_clocked_time = 0;
            // Set job code use to false
            job_code_used = false

            
    //         timestamp = moment().format("X");
    //         timestamp = parseInt(timestamp);
    //         $.post( "timestamp_end.php", {timestamp:timestamp, time:time});
        })

    //     // What happens if you click the take a break button
    //     $( "#breakbtn" ).click(function() {

    //         // Disables the clockout button
    //         $("#clockout").attr("disabled","disabled");
    //         // sets a 1 second delay to enable to clockin button
    //         setTimeout(function(){ $("#clockin").removeAttr("disabled");},1000);
    //         // sets a 1 second delay to enable to break button
    //         setTimeout(function(){ $("#breakbtn").removeAttr("disabled");},1000);
    //         // Changes color of the clockin button
    //         $("#clockout").css("background","#423d3d");
    //         // Changes color of the clockout button
    //         $("#clockin").css("background","linear-gradient(#4ae478, #239c45)");
    //         // Changes color of the break button
    //         $("#breakbtn").css("background","#423d3d");
    //         // Changes the text of the clockin button to clock in
    //         $("#clockin").val("Clock In");
            
    //         time = moment().format('hh:mm:ss A');
    //         // Stop any animation
    //         $('#infoclock').stop()
    //         // Set opacity back to 1
    //         $('#infoclock').css('opacity', '1')
    //         // Set opacity back to 1
    //         $('#infoclock').css('display', 'block')
    //         $("#infoclock").text("You started a break from " + project_name + " at " + time);
    //         $('#infoclock').clone().appendTo($('#clocked_alert_area'));
    //         // Fade out the words in 3 seconds
    //         $('#infoclock').fadeOut(3000)
    //         // Get the history box div
    //         var history = document.getElementById("clocked_alerts");
    //         // Scroll to bottom of div
    //         history.scrollTop = history.scrollHeight;

    //         diff = current_time.diff(start_time, "seconds");
    //         // An attempt to get rid of the milliseconds that diff put in by default
    //         // str_total_clocked_time str_total_clocked_time.toString();
    //         // str_total_clocked_time = str_total_clocked_time.slice(0, -3);
    //         // total_clocked_time = parseInt(str_total_clocked_time);
    //         total_clocked_time += diff;

    //         just_took_break = true;
    //         //clock = moment.duration($("#clockedDisplay").text()).format("HH:mm:ss");
    //         // timestamp = moment().format("X");
    //         // timestamp = parseInt(timestamp);
    //         // $.post( "timestamp_break.php", {timestamp:timestamp});
            
    //         break_check = true;
    //     })

    //     $( "#project-select" ).change(function() {
    //         if (current_project != $("#project-select").val()) {
    //             if (clocked_in == true) {
    //                 // Enables the clockin button
    //                 $("#clockin").removeAttr("disabled");
    //                 // Changes the text of the clockin button
    //                 $("#clockin").val("Switch");
    //                 // Changes color of the clockin button
    //                 $("#clockin").css("background","linear-gradient(#fcf974, #c4bf43)");
    //                 // set switching to true
    //                 switching = true;
    //             } 
    //         } else {
    //             // set switching to false
    //             switching = false;
    //             if (clocked_in == true) {
    //                 if ( break_check == false) {
    //                     // Enables the clockin button
    //                     $("#clockin").attr("disabled","disabled");
    //                     // Changes the text of the clockin button
    //                     $("#clockin").val("Clock In");
    //                     // Changes color of the clockin button
    //                     $("#clockin").css("background","#423d3d");
    //                 } else {
    //                     // Enables the clockin button
    //                     $("#clockin").removeAttr("disabled");
    //                     // Changes the text of the clockin button
    //                     $("#clockin").val("Clock In");
    //                     // Changes color of the clockin button
    //                     $("#clockin").css("background","linear-gradient(#4ae478, #239c45)");
    //                 }
    //             }
    //         } 
    //     })
    });


    // // // Start the continuous clock at the top of the page
    // //continuous_clock();
    // setInterval(function(){ continuous_clock() }, 200);
    // var clockDisplay = document.getElementById('world_clock');
    // clockDisplay.innerHTML = moment().format('hh:mm:ss A');

    // // Function to run clock at the top of the page that displays the time
    // function continuous_clock() {
        
    //     var clockDisplay = document.getElementById('world_clock');
    //     clockDisplay.innerHTML = moment().format('hh:mm:ss A');
        
        
    //     // if (just_clocked_in == true) {
            
    //     //     // Creates a timestamp of this moment in time
    //     //     timestamp = moment().format("X");
    //     //     // turns timestamp into an int
    //     //     timestamp = parseInt(timestamp);
    //     //     // timestamp this as the start
    //     //     $.post( "timestamp_start.php", {timestamp:timestamp, current_project:current_project, job_code:job_code});
    //     //     // Reset job code
    //     //     job_code = 'none';
    //     //     // Sets just_clocked_in to false so it doesn't stamp the time more than once
    //     //     just_clocked_in = false;
    //     // }
    //     // if (just_took_break == true) {
    //     //     // Creates a timestamp of this moment in time
    //     //     timestamp = moment().format("X");
    //     //     // turns timestamp into an int
    //     //     timestamp = parseInt(timestamp);
    //     //     // 
    //     //     timestamp -= 1;
    //     //     // timestamp this as the start
    //     //     $.post( "timestamp_break.php", {timestamp:timestamp});
    //     //     // Sets just_took_break to false so it doesn't stamp the time more than once
    //     //     just_took_break = false;
    //     // }
    //     // if (just_ended_break == true){
    //     //     // Creates a timestamp of this moment in time
    //     //     timestamp = moment().format("X");
    //     //     // turns timestamp into an int
    //     //     timestamp = parseInt(timestamp);
            
           
    //     //     // This is a break end so time stamp when it ended
    //     //     $.post( "timestamp_breakend.php", {timestamp:timestamp});
    //     //     // Sets just_ended_break to false so it doesn't stamp the time more than once
    //     //     just_ended_break = false;
    //     // }


    //     // if (clocked_in == true) {
    //     //     if (break_check != true) {
    //     //         Clocked_timer();
    //     //     }
    //     // }
    // }

    function Clocked_timer(){
        current_time = moment();
        var clockedDisplay = document.getElementById('clockedDisplay');
        //clockedDisplay.innerHTML  = moment.duration(current_time.diff(start_time)+moment.duration(total_clocked_time, "seconds")).format("HH:mm:ss");
        clockedDisplay.innerHTML  = moment.duration(current_time.diff(start_time).format("HH:mm:ss");
    }

</script>