// When the page is ready.
$(document).ready(function () {


    let headings = [{ text: "First Name", width: 25 }, { text: "Last Name", width: 25 }, { text: "E-mail", width: 50 }]
    let html = prepare_entry_headings(headings);
    $("#timekeeping-app-item-finder-bar-employees-heading").append(html);

    $.post('backend/timekeeping-app/load-employees-to-objects.php', function (result) {
        // Turn the result into JSON objects
        shift2shift_globalv1.entry_items = JSON.parse(result)
        // Save the original object order
        shift2shift_globalv1.entry_items_original_order = shift2shift_globalv1.entry_items;

        shift2shift_globalv1.entry_items = sort_items(shift2shift_globalv1.entry_items, "first_name");

        shift2shift_globalv1.view_employees_box_lengths = [25, 25, 50];

        shift2shift_globalv1.view_employees_buttons = [{ class: "entry-line-button-clock", image: "clock" }, { class: "entry-line-button-pencil entry-line-button-edit-employee", image: "pencil-icon" }];
        // Display all items loaded
        display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);

    })

    // Search input
    $('#timekeeping-app-item-finder-bar-employees-search').on('input', function () {
        // Make sure the input isn't empty
        if ($('#timekeeping-app-item-finder-bar-employees-search').val() == "") {
            $("#timekeeping-app-item-finder-bar-employees-x-button").css("display", "none");
            display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
            return;
        };

        $("#timekeeping-app-item-finder-bar-employees-x-button").css("display", "block");

        let search_quary = $('#timekeeping-app-item-finder-bar-employees-search').val();
        display_items("#timekeeping-app-view-employees-load", search_items(shift2shift_globalv1.entry_items, search_quary), shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);

    });

    $('#timekeeping-app-item-finder-bar-employees-sort').on('change', function () {
        sort_employees();
    });

    $('#timekeeping-app-item-finder-bar-employees-x-button').click(function () {
        $("#timekeeping-app-item-finder-bar-employees-x-button").css("display", "none");
        $('#timekeeping-app-item-finder-bar-employees-search').val("");
        display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
    });

    $('#timekeeping-app-item-finder-bar-employees-ascending-order').click(function () {
        let order = $(this).attr("value");

        if (order == "ascending") {
            $("#timekeeping-app-item-finder-bar-employees-ascending-order-image").attr("src", "images/descending-icon.png");
            this.value = "descending";
        } else {
            $("#timekeeping-app-item-finder-bar-employees-ascending-order-image").attr("src", "images/ascending-icon.png");
            this.value = "ascending";
        }

        sort_employees();

    });

    $(document).on('click', '.entry-line-button-clock', function () {
        $("#view-employees-div").css("display", "none");
        $("#view-clocked-time-div").css("display", "block")
        $(".nav-panel-07122020-nav-button").removeClass("nav-panel-07122020-nav-button-selected");
        let item_id = $(this).data("id");
        prepare_view_clocked_time(item_id)
    });

    $(document).on('click', '.entry-line-button-edit-employee', function () {
        let item_id = $(this).data("id");
        let item = search_for_item(item_id, shift2shift_globalv1.entry_items, "id");
        let html = create_employee_edit_form(item);
        display_main_modal(html);
    });

    function sort_employees() {

        let order = $("#timekeeping-app-item-finder-bar-employees-ascending-order").attr("value");
        let property = $('#timekeeping-app-item-finder-bar-employees-sort').val();

        if ($('#timekeeping-app-item-finder-bar-employees-search').val() != "") {
            shift2shift_globalv1.entry_items = sort_items(shift2shift_globalv1.entry_items, property)
            if (order == "descending") {
                shift2shift_globalv1.entry_items = shift2shift_globalv1.entry_items.reverse();
            }
            let search_quary = $('#timekeeping-app-item-finder-bar-employees-search').val();
            display_items("#timekeeping-app-view-employees-load", search_items(shift2shift_globalv1.entry_items, search_quary), shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
        } else {
            shift2shift_globalv1.entry_items = sort_items(shift2shift_globalv1.entry_items, property)
            if (order == "descending") {
                shift2shift_globalv1.entry_items = shift2shift_globalv1.entry_items.reverse();
            }
            display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
        };

    }

    // function display_items_with_current_settings() {
    //     if ($('#timekeeping-app-item-finder-bar-employees-search').val() != "") {
    //         let search_quary = $('#timekeeping-app-item-finder-bar-employees-search').val();
    //         display_items("#timekeeping-app-view-employees-load", search_items(shift2shift_globalv1.entry_items, search_quary), shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
    //     } else {
    //         display_items("#timekeeping-app-view-employees-load", shift2shift_globalv1.entry_items, shift2shift_globalv1.view_employees_box_lengths, shift2shift_globalv1.view_employees_buttons);
    //     };
    // }

    function prepare_view_clocked_time(item_id) {
        let item = search_for_item(item_id, shift2shift_globalv1.entry_items, "id");
        if (item != false) {
            let heading_text = item.first_name + " " + item.last_name + " Clocked Time";
            $('#timekeeping-app-view-clocked-time-heading').text(heading_text);
        }



        $.post("backend/timekeeping-app/load-timestamps-to-objects.php", { id: item.id },
            function (result) {
                shift2shift_globalv1.timestamps = JSON.parse(result)
                shift2shift_globalv1.view_clocked_time_box_lengths = [40, 40, 20];

                // Turn unix times into readable times
                for (i = 0; i < shift2shift_globalv1.timestamps.length; i++) {
                    shift2shift_globalv1.timestamps[i].timestamp_start = moment(shift2shift_globalv1.timestamps[i].timestamp_start, "x").format("MM/DD/YYYY - hh:mm:ss A");
                    shift2shift_globalv1.timestamps[i].timestamp_end = moment(shift2shift_globalv1.timestamps[i].timestamp_end, "x").format("MM/DD/YYYY - hh:mm:ss A");
                    shift2shift_globalv1.timestamps[i].timestamp_length = moment.duration(shift2shift_globalv1.timestamps[i].timestamp_length, "milliseconds").format("HH:mm:ss.SSS");
                }

                // shift2shift_globalv1.view_clocked_time_buttons = [{ class: "entry-line-button-pencil", image: "pencil-icon" }];
                shift2shift_globalv1.view_clocked_time_buttons = [];
                // Display all items loaded
                display_items("#timekeeping-app-view-clocked-time-load", shift2shift_globalv1.timestamps, shift2shift_globalv1.view_clocked_time_box_lengths, shift2shift_globalv1.view_clocked_time_buttons);

            });


    }

})






