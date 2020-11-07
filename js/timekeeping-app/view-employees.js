


// When the page is ready.
$(document).ready(function () {

    function delete_user(item) {
        if (confirm(`Are you sure that you want to delete ${item.email}?`)) {
            $.post("backend/timekeeping-app/user-delete.php", { id: item.id }, function (result) {
                if (result == 'success') {
                    shift2shift_globalv1.user_items.splice(shift2shift_globalv1.user_items.indexOf(item), 1);
                    run_search_employee_table();
                    popupInfo('popup-info-modal-update', 'User Deleted');
                }
            });
        };
    };


    let property_texts = ["First Name", "Last Name", "E-mail"];
    let property_values = ['first_name', 'last_name', 'email'];

    property_values.forEach((property, i) => {
        $("#timekeeping-app-item-finder-bar-employees-sort").append(new Option(property_texts[i], property));
    })


    let buttonFunctions = [delete_user];
    itemCreator('User', ['id', 'first_name', 'last_name', 'email'], ['delete'], buttonFunctions);

    $.post('backend/timekeeping-app/user-read.php', function (result) {

        // Turn the result into JSON objects
        shift2shift_globalv1.user_items_json = JSON.parse(result)

        shift2shift_globalv1.user_items = [];

        shift2shift_globalv1.user_items_json.forEach(entry => {
            user = new User(entry.id, entry.first_name, entry.last_name, entry.email);
            shift2shift_globalv1.user_items.push(user);
        });

        shift2shift_globalv1.user_items_original_order = shift2shift_globalv1.user_items;

        shift2shift_globalv1.user_items = sort_items(shift2shift_globalv1.user_items, "first_name");

        shift2shift_globalv1.view_employees_box_lengths = [25, 25, 50];

        shift2shift_globalv1.view_employees_buttons = [{ class: "entry-line-button-clock", image: "clock" }, { class: "entry-line-button-pencil entry-line-button-edit-employee", image: "pencil-icon" }];

        let button_functions = [delete_button, edit_button, clock_button];




        shift2shift_globalv1.employee_table = new Table(shift2shift_globalv1.user_items, 'timekeeping-app-view-employees-load', ['first_name', 'last_name', 'email'], [200, 200, 200], ["First Name", "Last Name", "E-mail"], { height: 50 }, ["delete-button", "edit-button", "clock-button"], button_functions, edit_button);
        shift2shift_globalv1.employee_table.draw();

        shift2shift_globalv1.search_box_employees = new searchBox('timekeeping-app-item-finder-bar-employees-search', 'email', search_results, shift2shift_globalv1.user_items);


        function search_results(results) {
            if (results === null) {
                shift2shift_globalv1.employee_table.items = shift2shift_globalv1.user_items;
                run_sort_employee_table(shift2shift_globalv1.employee_table);
                return;
            }
            shift2shift_globalv1.employee_table.updateItems(results);
        }

    })

    $('#timekeeping-app-item-finder-bar-employees-sort').on('change', function () {
        run_sort_employee_table(shift2shift_globalv1.employee_table);
    });

    $('#timekeeping-app-item-finder-bar-employees-ascending-order').click(function () {

        let order = $(this).attr("value");
        let property = $('#timekeeping-app-item-finder-bar-employees-sort').val();

        if (order == "ascending") {
            $("#timekeeping-app-item-finder-bar-employees-ascending-order-image").attr("src", "images/descending-icon.png");
            this.value = "descending";
        } else {
            $("#timekeeping-app-item-finder-bar-employees-ascending-order-image").attr("src", "images/ascending-icon.png");
            this.value = "ascending";
        }

        sort_dropdown(this.value, property, shift2shift_globalv1.employee_table);

    });

    $("#timekeeping-app-item-finder-bar-employees-add").click(function () {


        let validation = [];
        let headings = ["First Name", "Last Name", "E-mail", "Password", "Account Type"];
        let inputType = ['text', 'text', 'text', 'text', 'select'];

        validation.push('required data-pristine-required-message="Please choose a first name" maxlength=29 data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The first name must only have letters"');
        validation.push('required data-pristine-required-message="Please choose a last name" maxlength=29 data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The last name must only have letters"');
        validation.push('required data-pristine-required-message="Please choose an E-mail"  maxlength=59 type="email"');
        validation.push('required data-pristine-required-message="Please choose a password" type="password" minlength="10" maxlength=99');
        validation.push('required data-pristine-required-message="Please choose an account type"');


        let options = `<option value="" disabled selected hidden><p style='color:grey;'>Account Type</p></option>
        <option value=0 >Basic Employee</option>
        <option value=2 >Admin</option>`

        let input = ['first', 'last', 'email', 'pwd', 'authority_level'];

        let html = generate_create_form('Create Employee', 'user', 'create', inputType, input, ['', '', '', '', options], headings, validation, -1, ['', '', '', '', '']);

        display_main_modal(html);
    });
});

function run_sort_employee_table(table) {
    let order = $("#timekeeping-app-item-finder-bar-employees-ascending-order").attr("value");
    let property = $('#timekeeping-app-item-finder-bar-employees-sort').val();
    sort_dropdown(order, property, table);
}
function run_search_employee_table() {
    shift2shift_globalv1.search_box_employees.rerunSearch();
}



