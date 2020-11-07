

// When the page is ready.
$(document).ready(function () {

    function delete_timestamp(item) {
        if (confirm(`Are you sure that you want to delete this timestamp with length ${item.timestamp_length_readable}?`)) {
            $.post("backend/timekeeping-app/timestamp-delete.php", { id: item.id }, function (result) {
                if (result == 'success') {
                    console.log(shift2shift_globalv1.user_being_viewed);
                    shift2shift_globalv1.user_being_viewed.timestamps.splice(shift2shift_globalv1.user_being_viewed.timestamps.indexOf(item), 1);
                    shift2shift_globalv1.timestamp_table.items = shift2shift_globalv1.user_being_viewed.timestamps;
                    shift2shift_globalv1.timestamp_table.draw();
                    popupInfo('popup-info-modal-update', 'Timestamp Deleted');
                }
            });
        };
    };

    let buttonFunctions = [delete_timestamp];

    let property_texts = ["Start Time", "End Time", "Total Time"];
    let property_values = ['timestamp_start', 'timestamp_end', 'timestamp_length'];

    property_values.forEach((property, i) => {
        $("#timekeeping-app-item-finder-bar-timestamp-sort").append(new Option(property_texts[i], property));
    })


    itemCreator('Timestamp', ['id', 'timestamp_start', 'timestamp_end', 'timestamp_length'], ['delete'], buttonFunctions);

    function search_results(results) {
        if (results === null) {
            shift2shift_globalv1.timestamp_table.updateItems(shift2shift_globalv1.user_items);
            return;
        }
        shift2shift_globalv1.timestamp_table.updateItems(results);
    }




    let button_functions = [delete_button, edit_button];
    shift2shift_globalv1.timestamp_table = new Table([], 'timekeeping-app-view-clocked-time-load', ['timestamp_start_readable', 'timestamp_end_readable', 'timestamp_length_readable'], [200, 200, 200], ["Start Time", "End Time", "Total Time"], { height: 50 }, ["delete-button", "edit-button"], button_functions, edit_button);
    // timekeeping - app - view - clocked - time - load
    // let headings = [{ text: "Start Time", width: 40 }, { text: "End Time", width: 40 }, { text: "Total Time", width: 20 }]
    // let html = prepare_entry_headings(headings);
    // $("#timekeeping-app-entry-data-heading-container-clocked-time").append(html);

    $("#timekeeping-app-item-finder-bar-timestamp-add").click(function () {


        let validation = [];
        let headings = ["Start Time"];
        let inputType = ['text'];



        validation.push('required data-pristine-required-message="Please choose a start time" data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The first name must only have letters"');
        validation.push('required data-pristine-required-message="Please choose an end time" data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The last name must only have letters"');

        let input = ['start_time'];


        let html = generate_create_form('Create Timestamp', 'timestamp', 'create', inputType, input, ['Start time'], headings, validation, -1, ['']);

        display_main_modal(html);

        $('#start_time').daterangepicker({
            opens: 'left',
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    });


    $('#timekeeping-app-item-finder-bar-timestamp-sort').on('change', function () {
        run_sort_timestamp_table(shift2shift_globalv1.timestamp_table);
    });

    $('#timekeeping-app-item-finder-bar-timestamp-ascending-order').click(function () {

        let order = $(this).attr("value");
        let property = $('#timekeeping-app-item-finder-bar-timestamp-sort').val();

        if (order == "ascending") {
            $("#timekeeping-app-item-finder-bar-timestamp-ascending-order-image").attr("src", "images/descending-icon.png");
            this.value = "descending";
        } else {
            $("#timekeeping-app-item-finder-bar-timestamp-ascending-order-image").attr("src", "images/ascending-icon.png");
            this.value = "ascending";
        }

        sort_dropdown(this.value, property, shift2shift_globalv1.timestamp_table, 'number');

    });


});


function run_sort_timestamp_table(table) {
    let order = $("#timekeeping-app-item-finder-bar-timestamp-ascending-order").attr("value");
    let property = $('#timekeeping-app-item-finder-bar-timestamp-sort').val();
    sort_dropdown(order, property, table, 'number');
}

