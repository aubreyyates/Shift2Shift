// When page is ready, do this

$(document).ready(function () {

    $("#submit_form").click(function () {
        // Get entered first
        var first = document.forms["account_form"]["first"].value;
        // Get entered last
        var last = document.forms["account_form"]["last"].value;
        // Get entered email
        var email = document.forms["account_form"]["email"].value;
        // Get entered email
        var company = document.forms["account_form"]["org"].value;
        // Get entered password
        var pwd = document.forms["account_form"]["pwd"].value;
        // Allow characters
        var letters = /^[A-Za-z]+$/;
        // Allow characters
        var letters_pass = /^[-~]+$/;
        // Set the valid form to true
        var valid_form = true
        // Allow characters
        var letters_company = /^[A-Za-z0-9| |&|\-]+$/;

        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        // Remove previous alerts
        $('.form_alert').css('display', 'none')
        // Remove previous alerts
        $('.form_input').css('border', '1px solid rgb(214, 214, 214)')



        // Check to make sure first is not empty
        if (first.length == 0) {
            // Turn input box red
            $('#first').css('border', '2px solid red')
            // Set an alert
            $('#first_alert').css('display', 'block')
            // Set the alert text
            $('#first_alert').text('You must enter a first name.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters for first name
        } else if (!first.match(letters)) {
            // Turn input box red
            $('#first').css('border', '2px solid red')
            // Set an alert
            $('#first_alert').css('display', 'block')
            // Set the alert text
            $('#first_alert').text('You must only have letters.')
            // Form is invalid
            valid_form = false
        } else if (first.length > 29) {
            // Turn input box red
            $('#first').css('border', '2px solid red')
            // Set an alert
            $('#first_alert').css('display', 'block')
            // Set the alert text
            $('#first_alert').text('Your first name must be less than 30 characters. We are sorry if your name is over 29. :(')
            // Form is invalid
            valid_form = false
        }

        // Check to make sure last is not empty
        if (last.length == 0) {
            // Turn input box red
            $('#last').css('border', '2px solid red')
            // Set an alert
            $('#last_alert').css('display', 'block')
            // Set the alert text
            $('#last_alert').text('You must enter a last name.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters last name
        } else if (!last.match(letters)) {
            // Turn input box red
            $('#last').css('border', '2px solid red')
            // Set an alert
            $('#last_alert').css('display', 'block')
            // Set the alert text
            $('#last_alert').text('You must only have letters.')
            // Form is invalid
            valid_form = false
        } else if (last.length > 29) {
            // Turn input box red
            $('#last').css('border', '2px solid red')
            // Set an alert
            $('#last_alert').css('display', 'block')
            // Set the alert text
            $('#last_alert').text('Your last name must be less than 30 characters. We are sorry if your name is over 29. :(')
            // Form is invalid
            valid_form = false
        }

        // Check to make sure email is not empty
        if (email.length == 0) {
            // Turn input box red
            $('#email').css('border', '2px solid red')
            // Set an alert
            $('#email_alert').css('display', 'block')
            // Set the alert text
            $('#email_alert').text('You must enter an email.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters last name         

        } else if (!re.test(String(email).toLowerCase())) {
            // Turn input box red
            $('#email').css('border', '2px solid red')
            // Set an alert
            $('#email_alert').css('display', 'block')
            // Set the alert text
            $('#email_alert').text('Your email is not a valid email.')
            // Form is invalid
            valid_form = false
        } else if (email.length > 60) {
            // Turn input box red
            $('#email').css('border', '2px solid red')
            // Set an alert
            $('#email_alert').css('display', 'block')
            // Set the alert text
            $('#email_alert').text('Your E-mail must be less than 60 characters.')
            // Form is invalid
            valid_form = false
        }
        // Check to make sure company is not empty
        if (company.length == 0) {
            // Turn input box red
            $('#company').css('border', '2px solid red')
            // Set an alert
            $('#company_alert').css('display', 'block')
            // Set the alert text
            $('#company_alert').text('You must enter a company name.')
            // Form is invalid
            valid_form = false
        } else if (company.length > 100) {
            // Turn input box red
            $('#company').css('border', '2px solid red')
            // Set an alert
            $('#company_alert').css('display', 'block')
            // Set the alert text
            $('#company_alert').text('Your company name must be less than 100 characters.')
            // Form is invalid
            valid_form = false
        } else if (!company.match(letters_company)) {
            // Turn input box red
            $('#company').css('border', '2px solid red')
            // Set an alert
            $('#company_alert').css('display', 'block')
            // Set the alert text
            $('#company_alert').text("Your company can only have letters, numbers, spaces, hyphens, and ampersands in it's name.")
            // Form is invalid
            valid_form = false
        }

        // Check to make sure email is not empty
        if (pwd.length == 0) {
            // Turn input box red
            $('#password').css('border', '2px solid red')
            // Set an alert
            $('#pass_alert').css('display', 'block')
            // Set the alert text
            $('#pass_alert').text('You must enter a password.')
            // Form is invalid
            valid_form = false
        } else if (pwd.match(letters_pass)) {
            // Turn input box red
            $('#password').css('border', '2px solid red')
            // Set an alert
            $('#pass_alert').css('display', 'block')
            // Set the alert text
            $('#pass_alert').text('You have invalid characters.')
            // Form is invalid
            valid_form = false
        } else if (pwd.length < 10) {
            // Turn input box red
            $('#password').css('border', '2px solid red')
            // Set an alert
            $('#pass_alert').css('display', 'block')
            // Set the alert text
            $('#pass_alert').text('Your password must be at least 10 characters long.')
            // Form is invalid
            valid_form = false
        } else if (pwd.length > 99) {
            // Turn input box red
            $('#password').css('border', '2px solid red')
            // Set an alert
            $('#pass_alert').css('display', 'block')
            // Set the alert text
            $('#pass_alert').text('Your password must be less than 100 characters long.')
            // Form is invalid
            valid_form = false
        }

        // Check if email is taken. True if taken. False if not taken.
        if (valid_form == true) {
            $.ajax({
                type: 'POST',
                url: 'backend/login-system/check-for-email-existing.php',
                data: {
                    email: email
                },
                success: function (data) {
                    if (data == "True") {
                        // Turn input box red
                        $('#email').css('border', '2px solid rgb(255, 98, 98)')
                        // Set the alert text
                        $('#email_alert').text('This email has already been taken.')
                        // Set an alert
                        $('#email_alert').css('display', 'block')
                        // Form is invalid
                        valid_form = false;
                    }

                    submit_form();
                }
            });
        }

        function submit_form() {
            if (valid_form == true) {

                $("#account_form").submit();

            }
        }
    });

});