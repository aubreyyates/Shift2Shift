$(document).ready(function () {


    $(document).keypress(function (e) {
        if (e.which == 13) {
            if ($("#input3").is(":focus") || $("#pwd3").is(":focus")) {
                submit_form()
            }
        }
    });


    $("#submit_form_manager").click(function () {
        submit_form()
    });

    function submit_form() {

        // Get entered first
        var email = $('#input3').val()
        // Get entered last
        var pwd = $('#pwd3').val();
        // Start with valid form
        var valid_form = true

        var string_alert = ''
        // Remove old border
        $("#manager_alert").css('display', 'none')
        $('#pwd3').css('border', '1px solid black')
        $('#pwd3').css('width', '140px')
        $('#input3').css('border', '1px solid black')
        $('#input3').css('width', '140px')
        // Check to make sure email is not empty
        if (email.length == 0) {
            // Turn input box red
            $('#input3').css('border', '2px solid red')
            // Remove 2 pixels of the width
            $('#input3').css('width', '138px')
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
            $('#pwd3').css('border', '2px solid red')
            // Remove 4 pixels of the width
            $('#pwd3').css('width', '138px')
            // Form is invalid
            valid_form = false
        }

        // Check if form should sumbit
        if (valid_form == true) {
            // Check if user exists
            $.post("check_for_manager.php", { email: email, pwd: pwd }, function (result) {
                if (result == "True") {
                    // Submit login form
                    $("#account_manager").submit();
                } else {
                    $("#info_description_alert_2").text("Invalid user or password")
                    $("#manager_alert").css('display', 'block')
                    $("#admin-alert-words").text("Invalid user or password")
                    $("#admin-alert-tablet-area").css('display', 'block')

                }
            })
        } else {
            // Set manager alert set

            $("#info_description_alert_2").text(string_alert)
            $("#manager_alert").css('display', 'block')
            $("#admin-alert-words").text(string_alert)
            $("#admin-alert-tablet-area").css('display', 'block')

        }
    }

});