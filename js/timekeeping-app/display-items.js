// This function will load items into a given div that will be displayed on the page in entry lines. 
// load_div - The div that the entry lines should be loaded into.
// items_to_display - The objects that will be turned into entry lines.

function display_items(load_div, items_to_display, box_lengths, buttons) {

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
        // if (items_to_display.length > 0) {
        //     // Set the pagination indicator
        //     $('#pagination').text((vnum_s + 1) + " - " + items_to_display.length)
        //     // Stop displaying the foward arrow as there are no more to see
        //     $('#view-forward').css('display', 'none')
        // } else {
        //     // Set the pagination indicator
        //     $('#pagination').text(0)
        //     // Stop displaying the foward arrow as there are no more to see
        //     $('#view-forward').css('display', 'none')
        // }

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