
$(document).ready(function readyDoc() {
    // What happens if the arrow forward button is clicked
    $("#view-forward").click(function () {
        // Display the back arrow to view previous
        $('#view-backward').css('display', 'inline')
        shift2shift_globalv1.vnum_s += 25
        shift2shift_globalv1.vnum_e += 25
        if (shift2shift_globalv1.searching == false) {
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display the search
            display_search()
        }
    })

    // What happens if the arrow backward button is clicked
    $("#view-backward").click(function () {
        // Display the foward arrow to view more
        $('#view-forward').css('display', 'inline')
        shift2shift_globalv1.vnum_s -= 25
        shift2shift_globalv1.vnum_e -= 25
        if (shift2shift_globalv1.searching == false) {
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display the search
            display_search()
        }
    })
    // What happens if the sorting menu is changed
    $('#sorting').change(function () {
        // Check the sorting type is alphabetical
        if ($('#sorting').val() == 'Last') {
            // Sort alphabetically
            shift2shift_globalv1.accounts = merge_alphabetical(shift2shift_globalv1.accounts)
            // Check if they are searching
            if (shift2shift_globalv1.searching == false) {
                // Display every project
                display_all()
            } else {
                // Display the projects with the search term in them
                display_search()
            }
            // Check if the sorting type is none
        } else if ($('#sorting').val() == 'Date Created') {
            // Set to orignal order
            shift2shift_globalv1.accounts = accounts_original
            // Check if tshift2shift_globalv1.hey are searching
            if (shift2shift_globalv1.searching == false) {
                // Display every project
                display_all()
            } else {
                // Display the projects with the search term in them
                display_search()
            }
        } else if ($('#sorting').val() == 'First') {
            // Sort alphabetically
            shift2shift_globalv1.accounts = merge_alphabetical_first(shift2shift_globalv1.accounts)
            // Check if they are searching
            if (shift2shift_globalv1.searching == false) {
                // Display every project
                display_all()
            } else {
                // Display the projects with the search term in them
                display_search()
            }
        } else if ($('#sorting').val() == 'E-mail') {
            // Sort alphabetically
            shift2shift_globalv1.accounts = merge_alphabetical_email(shift2shift_globalv1.accounts)
            // Check if they are searching
            if (shift2shift_globalv1.searching == false) {
                // Display every project
                display_all()
            } else {
                // Display the projects with the search term in them
                display_search()
            }
        }
    })
    // What happens if you click the search button
    $("#account-search").click(function () {
        // Set the current projects viewed
        shift2shift_globalv1.vnum_s = 0;
        // Set the last project to view
        shift2shift_globalv1.vnum_e = 25;
        // Get the search typed in
        shift2shift_globalv1.input = $('#search-input').val()
        // Clear all projects
        $('#list').html('')
        // Display the all button
        $(document.getElementById('all_button')).css('display', 'block');
        // Display projects that have names like the search word
        display_search()
        // Set searching to true
        shift2shift_globalv1.searching = true;
    })

    // When happens if a key on while on the search bar is pressed
    $("#search-input").keyup(function (event) {
        // Check if it was enter
        if (event.keyCode === 13) {
            // Set the current projects viewed
            shift2shift_globalv1.vnum_s = 0;
            // Set the last project to view
            shift2shift_globalv1.vnum_e = 25;
            // Get the search typed in
            shift2shift_globalv1.input = $('#search-input').val()
            // Clear all projects
            $('#list').html('')
            // Display the all button
            $(document.getElementById('all_button')).css('display', 'block');
            // Display projects that have names like the search word
            display_search()
            // Set searching to true
            shift2shift_globalv1.searching = true;
        }
    })

    // What happens if the all button is clicked
    $("#all_button").click(function () {
        // Reset searching objects
        shift2shift_globalv1.search_objects = []
        // Set the current projects viewed
        shift2shift_globalv1.vnum_s = 0;
        // Set the last project to view
        shift2shift_globalv1.vnum_e = 25;
        // Display all of these projects at the start of page
        display_all()
        // Stop displaying the all button
        $(document.getElementById('all_button')).css('display', 'none');
        // Set searching to false
        shift2shift_globalv1.searching = false;
        // Check if there are more than 25 managers to show
        if (shift2shift_globalv1.accounts.length > 25) {
            // Display the foward arrow to view more
            $('#view-forward').css('display', 'inline')
        }
    })

    // What happens if the cancel button on the editing project modal (employee edit) is clicked
    $("#cancel_edit_main").click(function () {
        // Stop displaying employee_edit
        $(document.getElementById('edit_main_modal')).css('display', 'none');
    })
});


// What happens when an edit button on one of the projects in clicked
$('#list').on('mouseenter', '.long_text', function () {

    var email = $(this).data('email')
    var first = $(this).data('first')
    var last = $(this).data('last')


    $('#info_description_long').text("First Name: " + first + " | Last: " + last + " | E-mail: " + email)
    // Get the height
    var height = $('.show_long_text').height()

    var offset = $(this).offset();
    /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
    var topOffset = $(this).offset().top;
    /*set the position of the info element*/
    $(".show_long_text").css({
        position: "absolute",
        top: (topOffset - height) + "px",
        left: (offset.left) + "px",
    });
    $('.show_long_text').css('display', 'block')

})
// What happens when an edit button on one of the projects in clicked
$('#list').on('mouseleave', '.long_text', function () {
    $('.show_long_text').css('display', 'none')
})


// Function to display all of the entries
function display_all() {
    // Clear all managers
    $('#list').html('')
    // Stop displaying info box that show decription
    $('.info_project').css('display', 'none')
    // Check to see how far to make lines
    if (shift2shift_globalv1.accounts.length > shift2shift_globalv1.vnum_e) {
        // Set max view to num_e
        var max_view = shift2shift_globalv1.vnum_e
        // Set the pagination indicator
        $('#pagination').text((shift2shift_globalv1.vnum_s + 1) + " - " + (shift2shift_globalv1.vnum_e))
        // Check if they are viewing the first projects
        if (shift2shift_globalv1.vnum_s == 0) {
            // Stop displaying the backward arrow as there are no more to see
            $('#view-backward').css('display', 'none')
        }
    } else {
        // Set max view to length of project
        var max_view = shift2shift_globalv1.accounts.length
        // Check if there is 0 accounts
        if (max_view == 0) {
            // Put 0 account to view in the page
            $('#pagination').text("0")
        } else {
            // Set the pagination indicator
            $('#pagination').text((shift2shift_globalv1.vnum_s + 1) + " - " + shift2shift_globalv1.accounts.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display', 'none')
        }
    }
    // Go through every entry
    for (i = shift2shift_globalv1.vnum_s; i < max_view; i++) {
        // Get the html for the entry
        var text = prepare_entry_line(shift2shift_globalv1.accounts[i].first, shift2shift_globalv1.accounts[i].last, shift2shift_globalv1.accounts[i].id, shift2shift_globalv1.accounts[i].email)
        // // Put the entry on #list
        $('#list').append(text)
    }
}


function display_search() {
    // Clear all managers
    $('#list').html('')
    // Stop displaying info box that show decription
    $('.info_project').css('display', 'none')
    // Go through every entry
    for (i = 0; i < shift2shift_globalv1.accounts.length; i++) {
        // Check if the search is in the name
        if (shift2shift_globalv1.accounts[i].email.toLowerCase().includes(shift2shift_globalv1.input.toLowerCase())) {
            // Add to the search objects
            shift2shift_globalv1.search_objects.push(shift2shift_globalv1.accounts[i])
        }
    }
    // Check to see how far to make lines
    if (shift2shift_globalv1.search_objects.length > shift2shift_globalv1.vnum_e) {
        // Set max view to num_e
        var max_view = shift2shift_globalv1.vnum_e
        // Set the pagination indicator
        $('#pagination').text((shift2shift_globalv1.vnum_s + 1) + " - " + (shift2shift_globalv1.vnum_e))
        // Check if they are viewing the first projects
        if (vnum_s == 0) {
            // Stop displaying the backward arrow as there are no more to see
            $('#view-backward').css('display', 'none')
        }
    } else {
        // Set max view to length of project
        var max_view = shift2shift_globalv1.search_objects.length
        // Check if there is 0 accounts
        if (max_view == 0) {
            // Put 0 account to view in the page
            $('#pagination').text("0")
        } else {
            // Set the pagination indicator
            $('#pagination').text((shift2shift_globalv1.vnum_s + 1) + " - " + shift2shift_globalv1.search_objects.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display', 'none')
        }
    }

    // Go through every entry
    for (i = shift2shift_globalv1.vnum_s; i < max_view; i++) {
        // Get the html for the entry
        var text = prepare_entry_line(shift2shift_globalv1.search_objects[i].first, shift2shift_globalv1.search_objects[i].last, shift2shift_globalv1.search_objects[i].id, shift2shift_globalv1.search_objects[i].email)
        // // Put the entry on #list
        $('#list').append(text)
    }
    // Reset the search objects 
    shift2shift_globalv1.search_objects = []
}

