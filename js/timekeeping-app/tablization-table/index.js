function displayTable(load_div, items_to_display, box_lengths, buttons) {

    let table_div = document.getElementById(load_div);
    // Clear all items
    $(load_div).html('')

    // Check if there are no items to display
    if (items_to_display.length == 0) {
        $(load_div).append(prepare_empty_line("No Results"));
        return;
    }

    // Temp lines! ------
    vnum_e = 2000;
    vnum_s = 0;

    // Check to see how far to make items_to_display
    if (items_to_display.length > vnum_e) {
        // Set max view to num_e
        var max_view = vnum_e
        // Set the pagination indicator
        $('#pagination').text((vnum_s + 1) + " - " + (vnum_e))

    } else {
        // Set max view to length of project
        max_view = items_to_display.length
    }

    // FIXME!!! Change back to max_view at some point!!! --------
    // Go through every entry
    for (i = vnum_s; i < items_to_display.length; i++) {
        // Get the html for the entry
        var html = prepare_entry_line(items_to_display[i], box_lengths, buttons)
        // Put the entry into the div
        $(load_div).append(html)
    }
}