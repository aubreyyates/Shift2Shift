$(document).ready(function () {

    $("#authority_level").change(function () {
        $("#authority_level").css("color", "#111");
        $(".note-area").css("display", "none");
        if ($(this).val() == 0) {
            $("#employee-account-uses").css("display", "block");
        } else if ($(this).val() == 1) {
            $("#manager-account-uses").css("display", "block");
        } else if ($(this).val() == 2) {
            $("#admin-account-uses").css("display", "block");
        }
    });

    $(document).on('click', '.submit-account-form', function () {

        //FIXME!!!!!!!!!! ------ Break this into funtions at some point! It is not good.

        let form_id = $(this).data("form");
        // Get entered first
        var first = document.forms[form_id]["first"].value;
        // Get entered last
        var last = document.forms[form_id]["last"].value;
        // Get entered email
        var email = document.forms[form_id]["email"].value;

        if (form_id == "create-account-form") {
            // Get entered password
            var pwd = document.forms[form_id]["pwd"].value;
            // Get authority level value
            var authority_level = document.forms[form_id]["authority_level"].value;
        }

        // Allow characters
        var letters = /^[A-Za-z]+$/;
        // Allow characters
        var letters_pass = /^[-~]+$/;
        // Set the valid form to true
        var valid_form = true

        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        // Reset the account created message.
        $('#timekeeping-app-popup-info').css("display", "none");
        $('#timekeeping-app-popup-info').stop();
        $('#timekeeping-app-popup-info').css("opacity", "1");

        var form = "#" + form_id + " ";

        if (form_id == "create-account-form") {
            // Remove previous alerts
            $(form + '.form_alert').css('display', 'none')
            // Remove previous alerts
            $(form + '.form_input').css('border', '1px solid rgb(214, 214, 214)')
            // Remove previous alerts
            $(form + '.form_input').height(40)
        } else {
            // Remove previous alerts
            $(form + '.form_alert').css('display', 'none')
            // Remove previous alerts
            $('.edit-form-input').css('border', '1px solid rgb(214, 214, 214)')
        }

        // Check to make sure first is not empty
        if (first.length == 0) {
            first_test(form)
            // Set the alert text
            $(form + '#first_alert').text('You must enter a first name.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters for first name
        } else if (!first.match(letters)) {
            first_test(form)
            // Set the alert text
            $(form + '#first_alert').text('You must only have letters.')
            // Form is invalid
            valid_form = false
        } else if (first.length > 29) {
            first_test(form)
            // Set the alert text
            $(form + '#first_alert').text('Your first name must be less than 30 charaters. We are sorry if your name is over 29. :(')
            // Form is invalid
            valid_form = false
        }

        // Check to make sure last is not empty
        if (last.length == 0) {
            last_test(form)
            // Set the alert text
            $(form + '#last_alert').text('You must enter a last name.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters last name
        } else if (!last.match(letters)) {
            last_test(form)
            // Set the alert text
            $(form + '#last_alert').text('You must only have letters.')
            // Form is invalid
            valid_form = false
        } else if (last.length > 29) {
            last_test(form)
            // Set the alert text
            $(form + '#last_alert').text('Your last name must be less than 30 charaters. We are sorry if your name is over 29. :(')
            // Form is invalid
            valid_form = false
        }

        // Check to make sure email is not empty
        if (email.length == 0) {
            email_test(form)
            // Set the alert text
            $(form + '#email_alert').text('You must enter an email.')
            // Form is invalid
            valid_form = false
            // Test to make sure they only use letters last name         

        } else if (!re.test(String(email).toLowerCase())) {
            email_test(form)
            // Set the alert text
            $(form + '#email_alert').text('Your email is not a valid email.')
            // Form is invalid
            valid_form = false
        }

        if (form_id == "create-account-form") {
            // Check to make sure email is not empty
            if (pwd.length == 0) {
                pass_test(form)
                // Set the alert text
                $(form + '#pass_alert').text('You must enter a password.')
                // Form is invalid
                valid_form = false
            } else if (pwd.match(letters_pass)) {
                pass_test(form)
                // Set the alert text
                $(form + '#pass_alert').text('You have invalid characters.')
                // Form is invalid
                valid_form = false
            } else if (pwd.length < 10) {
                pass_test(form)
                // Set the alert text
                $(form + '#pass_alert').text('Your password must be at least 10 characters long.')
                // Form is invalid
                valid_form = false
            }

            if (authority_level == '') {
                authority_test(form)
                // Set the alert text
                $(form + '#authority_alert').text('You must select an account type.')
                // Form is invalid
                valid_form = false
            }
        }

        if (form_id == "edit-account-form") {
            if (email == $("#edit-form-email").text()) {
                submit_edit_account_form(valid_form, form);
            } else {
                // Check if email is taken. True if taken. False if not taken.
                if (valid_form == true) {
                    $.ajax({
                        type: 'POST',
                        url: 'backend/timekeeping-app/check-for-email-existing.php',
                        data: {
                            email: email
                        },
                        success: function (data) {
                            if (data == "True") {
                                email_test(form);
                                // Set the alert text
                                $(form + '#email_alert').text('This email has already been taken.')
                                // Form is invalid
                                valid_form = false;
                            }

                            submit_edit_account_form(valid_form);
                        }
                    });
                }
            }
        } else {

            // Check if email is taken. True if taken. False if not taken.
            if (valid_form == true) {
                $.ajax({
                    type: 'POST',
                    url: 'backend/timekeeping-app/check-for-email-existing.php',
                    data: {
                        email: email
                    },
                    success: function (data) {
                        if (data == "True") {
                            email_test(form);
                            // Set the alert text
                            $(form + '#email_alert').text('This email has already been taken.')
                            // Form is invalid
                            valid_form = false;
                        }
                        submit_create_account_form(valid_form, form);
                    }
                });
            }
        }


    });

    function submit_create_account_form(valid_form, form) {
        if (valid_form == true) {
            $.ajax({
                url: 'backend/timekeeping-app/create-new-account.php',
                type: 'post',
                data: $('#create-account-form').serialize(),
                success: function (data) {
                    if (data == 'success') {
                        $('#timekeeping-app-popup-info').css("display", "block");
                        $('#timekeeping-app-popup-info').fadeOut(5000);
                        clear_form(form);
                    } else {
                        alert("There was an error.");
                    }
                },
            });
        }
    }

    function submit_edit_account_form(valid_form, form) {
        if (valid_form == true) {
            $.ajax({
                url: 'backend/timekeeping-app/edit-account.php',
                type: 'post',
                data: $('#edit-account-form').serialize(),
                success: function (data) {
                    if (data == 'success') {
                        let form = 'edit-form-account';
                        let id = $("#edit-account-id").val();
                        let item = search_for_item(id, shift2shift_globalv1.entry_items, "id");
                        item.first_name = $(".edit-form-input-first").val();
                        item.last_name = $(".edit-form-input-last").val();
                        item.email = $(".edit-form-input-email").val();
                        $("#edit-form-email").text(item.email);

                        if ($('#timekeeping-app-item-finder-bar-employees-search').val() != "") {
                            let search_quary = $('#timekeeping-app-item-finder-bar-employees-search').val();
                            display_items("#timekeeping-app-view-employees-load", search_items(shift2shift_globalv1.entry_items, search_quary), shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
                        } else {
                            display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
                        };
                    } else {
                        alert("There was an error.");
                    }
                },
            }).fail(function () {
                alert("error");

            });
        }
    }

    // Clear the form. This means clear out the inputs.
    function clear_form(form) {
        $(form + '#first').val('');
        $(form + '#last').val('');
        $(form + '#email').val('');
        $(form + '#password').val('');
    }
    function first_test(form) {
        // Turn input box red
        $(form + '#first').css('border', '2px solid rgb(255, 98, 98)')
        // Change height
        $(form + '#first').height(38)
        // Set an alert
        $(form + '#first_alert').css('display', 'block')
    }
    function last_test(form) {
        // Turn input box red
        $(form + '#last').css('border', '2px solid rgb(255, 98, 98)')
        // Change height
        $(form + '#last').height(38)
        // Set an alert
        $(form + '#last_alert').css('display', 'block')
    }
    function email_test(form) {
        // Turn input box red
        $(form + '#email').css('border', '2px solid rgb(255, 98, 98)')
        // Change height
        $(form + '#email').height(38)
        // Set an alert
        $(form + '#email_alert').css('display', 'block')
    }
    function pass_test(form) {
        // Turn input box red
        $(form + '#password').css('border', '2px solid rgb(255, 98, 98)')
        // Change height
        $(form + '#password').height(38)
        // Set an alert
        $(form + '#pass_alert').css('display', 'block')
    }
    function authority_test(form) {
        // Turn input box red
        $(form + '#authority_level').css('border', '2px solid rgb(255, 98, 98)')
        // Change height
        $(form + '#authority_level').height(38)
        // Set an alert
        $(form + '#authority_alert').css('display', 'block')
    }
});