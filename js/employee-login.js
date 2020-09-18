$(document).ready(function () {

    $(document).keypress(function (e) {
        if (e.which == 13) {
            if ($("#input2").is(":focus") || $("#pwd2").is(":focus")) {
                submit_form()
            }
        }
    });

    $("#submit_form_employee").click(function () {
        submit_form()
    });

    function submit_form() {
        // Get entered first
        var email = $('#input2').val()
        // Get entered last
        var pwd = $('#pwd2').val();
        // Start with valid form
        var valid_form = true

        var string_alert = ''
        // Remove old border
        $("#employee_alert").css('display', 'none')
        $('#pwd2').css('border', '1px solid black')
        $('#pwd2').css('width', '140px')
        $('#input2').css('border', '1px solid black')
        $('#input2').css('width', '140px')

        // Check to make sure email is not empty
        if (email.length == 0) {
            // Turn input box red
            $('#input2').css('border', '2px solid red')
            // Remove 4 pixels of the width
            $('#input2').css('width', '138px')
            // Alert they need email
            string_alert = 'Please enter an E-mail'
            // Form is invalid
            valid_form = false
        }
        // Check to make sure email is not empty
        if (pwd.length == 0) {
            // Add that they need password too
            if (string_alert == '') {
                string_alert = 'Please enter a password'
            } else {
                string_alert += ' and password'
            }
            // Turn input box red
            $('#pwd2').css('border', '2px solid red')
            // Remove 4 pixels of the width
            $('#pwd2').css('width', '138px')
            // Form is invalid
            valid_form = false
        }
        // Check if form should sumbit
        if (valid_form == true) {
            // Check if user exists
            $.post("check_for_employee.php", { email: email, pwd: pwd }, function (result) {
                if (result == "True") {
                    // Submit login form
                    $("#account_employee").submit();
                } else {
                    $("#info_description_alert_2").text("Invalid user or password")
                    $("#employee_alert").css('display', 'block')
                    $("#admin-alert-words").text("Invalid user or password")
                    $("#admin-alert-tablet-area").css('display', 'block')
                }
            })
        } else {
            // Set manager alert set
            $("#info_description_alert_2").text(string_alert)
            $("#employee_alert").css('display', 'block')
            $("#admin-alert-words").text(string_alert)
            $("#admin-alert-tablet-area").css('display', 'block')

        }
    }

});