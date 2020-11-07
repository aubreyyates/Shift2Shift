function edit_button(item) {

    let validation = [];
    let headings = ["First Name", "Last Name", "E-mail"];
    let inputType = ['text', 'text', 'text'];

    validation.push('required data-pristine-required-message="Please choose a first name" maxlength=29 data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The first name must only have letters"');
    validation.push('required data-pristine-required-message="Please choose a last name" maxlength=29 data-pristine-pattern="/[a-zA-z]+$/i" data-pristine-pattern-message="The last name must only have letters"');
    validation.push(`required data-pristine-required-message="Please choose an E-mail"  maxlength=59 type="email" data-original-email="${item.email}"`);

    let input = ['first', 'last', 'email'];

    let html = generate_create_form(`${item.email}`, 'user', 'update', inputType, input, ['', '', ''], headings, validation, item.id, [item.first_name, item.last_name, item.email]);

    display_main_modal(html);


};

function clock_button(item) {

    if (item.timestamps == null) {
        $.post("backend/timekeeping-app/timestamp-read.php", { id: item.id },
            function (result) {
                item.timestamps_json = JSON.parse(result)

                item.timestamps = [];
                item.timestamps_json.forEach((entry) => {
                    timestamp = new Timestamp(entry.id, entry.timestamp_start, entry.timestamp_end, entry.timestamp_length);
                    item.timestamps.push(timestamp);
                });



                //Turn unix times into readable times
                for (let i = 0; i < item.timestamps.length; i++) {
                    item.timestamps[i].timestamp_start_readable = moment(item.timestamps[i].timestamp_start, "x").format("MM/DD/YYYY - hh:mm:ss A");
                    item.timestamps[i].timestamp_end_readable = moment(item.timestamps[i].timestamp_end, "x").format("MM/DD/YYYY - hh:mm:ss A");
                    item.timestamps[i].timestamp_length_readable = moment.duration(item.timestamps[i].timestamp_length, "milliseconds").format("HH:mm:ss.SSS");
                }

                shift2shift_globalv1.timestamp_table.items = item.timestamps;
                if (item.timestamps.length > 0) {
                    run_sort_timestamp_table(shift2shift_globalv1.timestamp_table);
                } else {
                    shift2shift_globalv1.timestamp_table.draw();
                }



                // // Display all items loaded
                // //display_items("#timekeeping-app-view-clocked-time-load", shift2shift_globalv1.timestamps, shift2shift_globalv1.view_clocked_time_box_lengths, shift2shift_globalv1.view_clocked_time_buttons);

            });
    } else {
        shift2shift_globalv1.timestamp_table.items = item.timestamps;

        if (item.timestamps.length > 0) {
            run_sort_timestamp_table(shift2shift_globalv1.timestamp_table);
        } else {
            shift2shift_globalv1.timestamp_table.draw();
        }
    }



    shift2shift_globalv1.user_being_viewed = item;
    $("#view-employees-div").css("display", "none");
    $("#view-clocked-time-div").css("display", "block");
    $("#timekeeping-app-view-clocked-time-heading").text(`${item.first_name} ${item.last_name} Clocked Time`);
    $(".nav-panel-07122020-nav-button").removeClass("nav-panel-07122020-nav-button-selected");

};

function delete_button(item) {
    item.delete(item);
};

