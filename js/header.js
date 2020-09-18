$(document).ready(function () {

    var modal = false;

    $("#hamburger").click(function () {
        if (modal == false) {
            $("#hamburger-modal").css("display", "block");
            modal = true;
        } else {
            $("#hamburger-modal").css("display", "none");
            modal = false;
        }
    })

    // Check if enter is pressed. Submit forms if they are.
    $(document).keypress(function (e) {
        if (e.which == 13) {
            if ($("#input1").is(":focus") || $("#pwd1").is(":focus")) {
                submit_form()
            }
        }

        if (e.which == 13) {
            if ($("#input2").is(":focus") || $("#pwd2").is(":focus")) {
                submit_form2()
            }
        }
    });


    $("#submit-form-login").click(function () {
        submit_form()
    })

    $("#submit-form-login2").click(function () {
        submit_form2()
    })

    function submit_form() {
        // Get entered first
        var email = $('#input1').val()
        // Get entered last
        var pwd = $('#pwd1').val();
        // Start with valid form
        var valid_form = true

        var string_alert = ''
        // Remove old border
        $("#login-alert").css('display', 'none')
        $("#admin-alert-tablet-area").css('display', 'none')
        $('#pwd1').css('border', '1px solid black')
        $('#pwd1').css('width', '140px')
        $('#input1').css('border', '1px solid black')
        $('#input1').css('width', '140px')
        // Check to make sure email is not empty
        if (email.length == 0) {
            // Turn input box red
            $('#input1').css('border', '2px solid red')
            // Remove 2 pixels of the width
            $('#input1').css('width', '138px')
            // Alert they need email
            string_alert = 'Please enter an E-mail'
            // // Set an alert
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
            $('#pwd1').css('border', '2px solid red')
            // Remove 2 pixels of the width
            $('#pwd1').css('width', '138px')
            // // Set an alert
            valid_form = false
        }
        // Check if form should sumbit
        if (valid_form == true) {
            // Check if user exists
            $.post("./backend/check-for-user-account-existing.php", { email: email, pwd: pwd }, function (result) {

                if (result == "True") {
                    // Submit login form
                    $("#account_admin").submit();
                } else {
                    $("#info_description_alert").text("Invalid user or password")
                    $("#login-alert").css('display', 'block')
                    $("#admin-alert-words").text("Invalid user or password")
                    $("#admin-alert-tablet-area").css('display', 'block')
                }
            })
        } else {
            // Set admin alert set
            $("#info_description_alert").text(string_alert)
            $("#login-alert").css('display', 'block')
            $("#admin-alert-words").text(string_alert)
            $("#admin-alert-tablet-area").css('display', 'block')

        }
    }

    function submit_form2() {
        // Get entered first
        var email = $('#input2').val()
        // Get entered last
        var pwd = $('#pwd2').val();
        // Start with valid form
        var valid_form = true

        var string_alert = ''
        // Remove old border
        $("#admin_alert_modal").css('display', 'none')
        $('#pwd2').css('border', '1px solid black')
        $('#pwd2').css('width', '178px')
        $('#input2').css('border', '1px solid black')
        $('#input2').css('width', '178px')
        $('#modal-spacing').css('height', '20px')
        $('#modal-spacing2').css('height', '20px')
        // Check to make sure email is not empty
        if (email.length == 0) {
            // Turn input box red
            $('#input2').css('border', '2px solid red')
            // Remove 2 pixels of the width
            $('#input2').css('width', '176px')
            // Remove some spacing
            $('#modal-spacing').css('height', '18px')
            // Alert they need email
            string_alert = 'Please enter an E-mail'
            // // Set an alert
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
            // Remove 2 pixels of the width
            $('#pwd2').css('width', '176px')
            // Remove some spacing
            $('#modal-spacing2').css('height', '18px')
            // // Set an alert
            valid_form = false
        }
        // Check if form should sumbit
        if (valid_form == true) {
            // Check if user exists
            $.post("./backend/check-for-user-account-existing.php", { email: email, pwd: pwd }, function (result) {

                if (result == "True") {
                    // Submit login form
                    $("#account_admin2").submit();
                } else {
                    $("#admin-alert-words-modal").text("Invalid user or password")
                    $("#admin_alert_modal").css('display', 'block')
                }
            })
        } else {
            // Set admin alert set
            $("#admin-alert-words-modal").text(string_alert)
            $("#admin_alert_modal").css('display', 'block')

        }
    }
});