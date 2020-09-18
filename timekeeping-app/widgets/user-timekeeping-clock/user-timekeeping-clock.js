shift2shiftobject = {};
// Total Clocked time set to 0
shift2shiftobject.start_time = 0;
// Clocked in set to false
shift2shiftobject.clocked_in = false;
// Clocked in set to false
shift2shiftobject.on_break = false;

$(document).ready(function readyDoc() {

    // Initialising variables

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

    // ajax call to see if there is any unsubmitted timestamp in the database
    $.post("timekeeping-app/backend/check-if-still-clocked-in.php", function (result) {
        // Parse the result
        result = jQuery.parseJSON(result);
        // Checks to see if the employee had not clocked out since last time
        if (result.time_start != 'no start') {

            disable_clock_in_button();

            enable_break_button();
            enable_clock_out_button();


            shift2shiftobject.start_time = result.time_start * 1000;
            shift2shiftobject.clocked_in = true;

            time = moment(result.time_start, "X").format("hh:mm:ss A");

            add_notification_to_page("You clocked in at " + time, "clock-in-icon.png");

            // // Display the time they had previously 
            // Clocked_timer();
        }
    });

    // What happens if you click the take a break button
    $("#breakbtn").click(function () {

        $.ajax({
            type: "POST",
            url: 'timekeeping-app/backend/break-start.php',
            dataType: "text",
            success: function (data) {
                if (data == "success") {

                    disable_clock_out_button();

                    disable_break_button();

                    enable_clock_in_button();

                    shift2shiftobject.clocked_in = false;

                    shift2shiftobject.on_break = true;

                    time = moment().format('hh:mm:ss A');
                    add_notification_to_page("You started a break at " + time, "clock-break-icon.png");

                } else {
                    alert(data);
                }
            },
            error: function () {
                alert('Error occured.');
            }
        });


    })


    // What happens if you click the clock in button
    $("#clockin").click(function () {


        if (shift2shiftobject.on_break == false) {

            // Send data to create a timestamp.
            $.ajax({
                type: "POST",
                url: 'timekeeping-app/backend/timestamp-start.php',
                data: ({ project_id: -1 }),
                dataType: "text",
                success: function (data) {
                    if (data != "Error. A timestamp has still not been submitted before.") {
                        let timestamp = parseInt(data);
                        shift2shiftobject.start_time = timestamp * 1000;
                        shift2shiftobject.clocked_in = true;

                        disable_clock_in_button();

                        enable_break_button();
                        enable_clock_out_button();

                        // Changes the text of the clockin button to clock in
                        $("#clockin").val("Clock In");

                        time = moment().format('hh:mm:ss A');
                        add_notification_to_page("You clocked in at " + time, "clock-in-icon.png");
                    } else {
                        alert(data);
                    }
                },
                error: function () {
                    alert('Error occured. Try to clock in again.');
                }
            });

        } else {

            $.ajax({
                type: "POST",
                url: 'timekeeping-app/backend/break-end.php',
                success: function () {

                    shift2shiftobject.clocked_in = true;
                    shift2shiftobject.on_break = false;

                    disable_clock_in_button();

                    enable_break_button();
                    enable_clock_out_button();


                    time = moment().format('hh:mm:ss A');
                    add_notification_to_page("You ended a break at " + time, "clock-in-icon.png");
                },
                error: function () {
                    alert('Error occured. Try to clock in again.');
                }
            });
        }
    })



    // What happens if you click the clock in button
    $("#clockout").click(function () {

        $.ajax({
            type: "POST",
            url: 'timekeeping-app/backend/timestamp-end.php',
            dataType: "text",
            success: function () {

                disable_clock_out_button();

                disable_break_button();

                enable_clock_in_button();


                // Set clocked_in to false since they just clocked out
                shift2shiftobject.clocked_in = false;
                // They are not switching projects since they just clocked out so set it to false
                switching = false;
                // Not on a break since they clocked out, set it to false
                break_check = false;
                // reset total_clocked_time by setting it to 0
                total_clocked_time = 0;
                // Set job code use to false
                job_code_used = false;
                // Puts the text in the clockedDisplay to 00:00:00
                $("#user-clock").text("00:00:00");
                // Set clocked_in to false since they just clocked out
                shift2shiftobject.clocked_in = false;

                time = moment().format('hh:mm:ss A');
                add_notification_to_page("You clocked out at " + time, "clock-out-icon.png");
            },
            error: function () {
                alert('Error occured. Try to clock out again.');
            }
        });
    })

});

function disable_clock_in_button() {
    // Disables the clockin button
    $("#clockin").attr("disabled", "disabled");
    // Changes color of the clockin button
    $("#clockin").css("background", "#423d3d");
    // Changes the text of the clockin button to clock in
    $("#clockin").val("Clock In");
}

function disable_clock_out_button() {
    // Disables the clockout button
    $("#clockout").attr("disabled", "disabled");
    // Changes color of the clockout button
    $("#clockout").css("background", "#423d3d");
}

function disable_break_button() {
    // Disables the break button
    $("#breakbtn").attr("disabled", "disabled");
    // Changes color of the break button
    $("#breakbtn").css("background", "#423d3d");
}

function enable_clock_in_button() {
    // sets a 1 second delay to enable to clockin button
    setTimeout(function () { $("#clockin").removeAttr("disabled"); }, 1000);
    // Changes color of the clockin button
    $("#clockin").css("background", "linear-gradient(#4ae478, #239c45)");
    // Changes the text of the clockin button to clock in
    $("#clockin").val("Clock In");
}

function enable_clock_out_button() {
    // sets a 1 second delay to enable to clockout button
    setTimeout(function () { $("#clockout").removeAttr("disabled"); }, 1000);
    // Changes color of the clockout button
    $("#clockout").css("background", "linear-gradient(#db5555, #aa3636)");
}

function enable_break_button() {
    // sets a 1 second delay to enable to break button
    setTimeout(function () { $("#breakbtn").removeAttr("disabled"); }, 1000);
    // Changes color of the break button
    $("#breakbtn").css("background", "linear-gradient(#f3a736, #da8d23)");
}

function add_notification_to_page(notification, icon) {

    if ($("#notification-area .form_area").length > 3) {

        $("#notification-area .form_area:last").remove();

    }

    html =
        `
    <div class='form_area fade-in clock-notify'>
        <div class='font-1 note-icon-container'>
            <div class='note-icon-image-area'><img src='images/notification-icon.png' class='note-icon-image'></div>
            <div class='note-icon-text'><h4></h4></div>
        </div>
        <div class='note-header-2'><p class='font-1'>${notification}</p></div>
        <div class='clock-icon-container'>
            <img src='images/${icon}' class='clock-icon'>
        </div>
    </div>
    `;

    $("#notification-area").prepend(html);

}

//Start the continuous clock at the top of the page
setInterval(function () { continuous_clock(); }, 1000);

// Function to run clock at the top of the page that displays the time.
function continuous_clock() {

    // Update the time displayed in the clock.
    let clockDisplay = document.getElementById('world_clock');
    clockDisplay.innerHTML = moment().format('hh:mm:ss A');

    // Check if the user is clocked.
    if (shift2shiftobject.clocked_in == true) {
        //if (shift2shiftobject.on_break == false) {
        clocked_timer();
        //}
    }

}

// Update the clock in on the user-timekeeping-clock page.
function clocked_timer() {
    let current_time = moment();

    let clockedDisplay = document.getElementById('user-clock');

    clockedDisplay.innerHTML = moment.duration(current_time.diff(shift2shiftobject.start_time)).format("HH:mm:ss");
}