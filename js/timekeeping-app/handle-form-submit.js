$(document).ready(function () {


    $(document).on("click", ".submit-item-form", function () {
        let form_id = $(this).data('form');
        let table = $(this).data('table');
        let action = $(this).data('action');
        let objectParams = $(this).data('params');
        handle_form_submit(form_id, table, action);
    });

    //     $("#authority_level").change(function () {
    //         $("#authority_level").css("color", "#111");
    //         $(".note-area").css("display", "none");
    //         if ($(this).val() == 0) {
    //             $("#employee-account-uses").css("display", "block");
    //         } else if ($(this).val() == 1) {
    //             $("#manager-account-uses").css("display", "block");
    //         } else if ($(this).val() == 2) {
    //             $("#admin-account-uses").css("display", "block");
    //         }
    //     });
});

function handle_form_submit(form_id, table, action) {

    let form = document.getElementById(form_id);

    let pristine = new Pristine(form);

    let result;

    if (table == 'user') {
        var elem = document.getElementById("email")
        let original = $('#email').data('original-email');
        let email = elem.value;

        result = pristine.validate();

        if (result == true && original == email) {
            run_result();
        } else {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: 'backend/timekeeping-app/check-for-email-existing.php',
                    data: {
                        email: email
                    },
                    success: function (data) {
                        console.log(data + "-Data!");
                        if (data == "False") {
                            run_result();
                        } else {
                            pristine.addError(elem, "This email is already taken");
                        }
                    }
                });
            }
        }

    } else {
        result = pristine.validate();
        run_result();
    }


    function run_result() {
        if (result) {
            let url = `backend/timekeeping-app/${table}-${action}.php`
            $.ajax({
                url: url,
                type: 'post',
                data: $("#" + form_id).serialize(),
                success: function (data) {
                    if (data != 'error') {

                        $('#timekeeping-app-popup-info').css("display", "block");
                        $('#timekeeping-app-popup-info').fadeOut(5000);

                        if (table == 'user') {
                            if (action == 'create') {
                                let user = new User(parseInt(data), $('#first').val(), $('#last').val(), $('#email').val());
                                shift2shift_globalv1.user_items.push(user);
                                shift2shift_globalv1.employee_table.items = shift2shift_globalv1.user_items;
                                run_search_employee_table();

                                popupInfo('popup-info-modal-create', 'Account Created');
                                $("#" + form_id).trigger("reset");
                                pristine.reset();
                            } else if (action == 'update') {
                                let id = $('#id').val();
                                let user = shift2shift_globalv1.user_items.find(u => u.id == id)
                                user.first_name = $('#first').val();
                                user.last_name = $('#last').val();
                                user.email = $('#email').val();
                                run_search_employee_table();

                                popupInfo('popup-info-modal-update', 'Account Updated');
                                hide_main_modal();
                            }
                        }
                    } else {
                        alert("There was an error.");
                    }
                },
            });
        }
    }
};
