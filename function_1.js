// When the page is ready do this
$(document).ready(function() {

    // What happens if the sorting menu is changed
    $('#sorting_accounts').change(function() {
        
        if ($('#sorting_accounts').val() == 'Last'){

            // Order by alphabetical last name
            lines = merge_alphabetical_last(lines)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }


        } else if ($('#sorting_accounts').val() == 'First'){
            
            // Order by alphabetical first name
            lines = merge_alphabetical_first(lines)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            } 
        } else if ($('#sorting_accounts').val() == 'E-mail'){
            
            // Order by alphabetical email
            lines = merge_alphabetical_email(lines)

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }
        } else if ($('#sorting_accounts').val() == 'Date Created'){
            
            // Set back to original order
            lines = original

            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }
        }
    });

    // What happens if the arrow forward button is clicked
    $( "#view-forward" ).click(function() {
        // Display the back arrow to view previous
        $('#view-backward').css('display','inline')
        vnum_s += 25
        vnum_e += 25
        // Check if date filter is on
        if ( filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })
    // What happens if the arrow backward button is clicked
    $( "#view-backward" ).click(function() {
        // Display the foward arrow to view more
        $('#view-forward').css('display','inline')
        vnum_s -= 25
        vnum_e -= 25
        // Check if date filter is on
        if (filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })

    // What happens if the filter button is clicked
    $( "#filter-button" ).click(function() {
        
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        // Set filter date to true. This lets us know we are using a filter
        filter_date = true;
        // Gets what filter type the user selected
        type = $('#filter-type').val()
        // If the type was all the page is refreshed
        if (type == 'all'){
            location.reload();

        // What happens if the type was year
        } else if (type == 'year') {
            $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
            date_compare()
        
        
        // What happens if the type was month
        } else if (type == 'month') {
            $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
            date_compare()
            

        } else if (type == 'week') {
            
            $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
            date_compare()
            
        
        // What happens if the type was day
        } else {
            $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            date = moment().startOf('day');
            date_end = moment().endOf('day');
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        $(document.getElementById('filter-date-slide')).css('display','block')
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
        //add_click_handlers();
    })

    // What happens if the arrow forward on the time filter is clicked
    $( "#time-forward" ).click(function() {  
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        if (type=='year') {
            date.add(1, 'years').calendar();
            date_end.add(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.add(1, 'months').calendar();
            date_end.add(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.add(7, 'days').calendar();
            date_end.add(7, 'days').calendar()
            week()
            date_compare()
        } else if (type=='day') {
            date.add(1, 'days').calendar();
            date_end.add(1, 'days').calendar();
            day()
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type});
        //add_click_handlers();
    })

    // What happens if the arrow backward on the time filter is clicked
    $( "#time-back" ).click(function() {
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')
        if (type=='year') {
            date.subtract(1, 'years').calendar();
            date_end.subtract(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.subtract(1, 'months').calendar();
            date_end.subtract(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.subtract(7, 'days').calendar();
            date_end.subtract(7, 'days').calendar();
            week()
            date_compare()
        } else if (type=='day') {
            date.subtract(1, 'days').calendar();
            date_end.subtract(1, 'days').calendar();
            day()
            date_compare()
        }
        // Load what is found for that date into the #search-results div
        //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
        //add_click_handlers();
    })

    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseenter', '.long_text' , function() {
        
        email = $(this).data('email')
        first = $(this).data('first')
        last = $(this).data('last')
        
        $('#info_description_long').text("First Name: " + first + " | Last: " + last + " | E-mail: " + email)    
        // Get the height
        height = $('.show_long_text').height()

        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".show_long_text").css({
            position: "absolute",
            top: (topOffset - height)+ "px",
            left: (offset.left) + "px",
        });
        $('.show_long_text').css('display','block')
        
    })

    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseleave', '.long_text' , function() {
        $('.show_long_text').css('display','none')
    })
    
});


function prepare_entry_line(first, last, email, id) {
    // Create the text needed to create an entry
    text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
    line_data = " First Name: " + first + " | Last Name: " + last + " | E-mail: " + email 
    text_2 = "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + id + "'><button value='" + id + "' data-email='" + email + "' style='float:right; margin-top:11px;' class='entry-button-style-2 recover' type ='submit'>Recover</button></div></div>";
    // Get the length of the string in pixels
    var len = ctx.measureText(line_data).width;
    
    // Check if it is greater than 380
    if (len > 600) {
        
        
        // Keep removing letters until it is less than 375 pixels long
        while (len > 595) {
            // Remove the last letter
            line_data = line_data.substring(0, line_data.length - 1);
            // Get the new length of string in pixels
            len = ctx.measureText(line_data).width;
        }
        // Add dots at end
        line_data += "..."
        // Add a class to allow a float box 
        text_1 = "<div class='entry_template'> <div id='entry_box' data-email='" + email + "'class='entry_line'><div class='long_text' id='entry_text' data-email='" + email + "' data-first='" + last + "' data-last='" + first + "' style='float:left;margin-left:12px;font-size:16px;'>"
    }
    // Combine all three parts to one string
    text = text_1 + line_data + text_2        
    
    // Return the text
    return text
}

function display_all() {
    
    // Clear all projects
    $('#list').html('')

    if (lines.length == 0) {
        $('.alert_none').css('display','block')
        $('#white_top').css('display','none')
    } else {
        $('#white_top').css('display','block')
        $('.alert_none').css('display','none')
    }
    // Check to see how far to make lines
    if (lines.length > vnum_e) {
        // Set max view to num_e
        max_view = vnum_e
        // Set the pagination indicator
        $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
        // Check if they are viewing the first projects
        if (vnum_s == 0) {
            // Stop displaying the backward arrow as there are no more to see
            $('#view-backward').css('display','none')
        }
            
    } else {
        // Set max view to length of project
        max_view = lines.length
        // Set the pagination indicator
        $('#pagination').text((vnum_s + 1) + " - " + lines.length)
        // Stop displaying the foward arrow as there are no more to see
        $('#view-forward').css('display','none')
        
    }          
    // Go through every entry
    for (i = vnum_s; i < max_view; i++) {
        // Get the html for the entry
        text = prepare_entry_line(lines[i].first, lines[i].last, lines[i].email, lines[i].id)
        // Put the entry on #list
        var entry = $('#list').append(text)
    }
}

// Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
function date_compare() {
    // Clear out the entries
    $('#list').html('')
    // Stop displaying info box that show decription
    $('.info_project').css('display','none')
    // Go through every entry
    for (i = 0; i < lines.length; i++) {  
        // Check if the search is in the name
        if ( moment(lines[i].date).unix() >= date.unix() && moment(lines[i].date).unix() < date_end.unix() ) {
            // Add to the search objects
            search_objects.push(lines[i])
        }
    }    

    // Check to see how far to make lines
    if (search_objects.length > vnum_e) {
        // Set max view to num_e
        max_view = vnum_e
        // Set the pagination indicator
        $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
        // Check if they are viewing the first projects
        if (vnum_s == 0) {
            // Stop displaying the backward arrow as there are no more to see
            $('#view-backward').css('display','none')
        }
        // Display the foward arrow
        $('#view-forward').css('display','inline')
    } else {
        // Set max view to length of project
        max_view = search_objects.length
        // Set the pagination indicator
        $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
        // Stop displaying the foward arrow as there are no more to see
        $('#view-forward').css('display','none')
    }               
    
    for (i = vnum_s; i < max_view; i++) {
        
        // Get the html for the entry
        text = prepare_entry_line(search_objects[i].first, search_objects[i].last, search_objects[i].email, search_objects[i].id)
        // Put the entry on #list
        var entry = $('#list').append(text) 
        
    }
    // Reset the search objects 
    search_objects = []   
}

function year(){

    $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
    date_format = date.format('YYYY');
}
function month(){

    $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM');
}
function week() {

    $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM-DD');
}
function day(){

    $(document.getElementById('start-display')).val(date.startOf('day').format('YYYY-MM-DD'))
    $(document.getElementById('end-display')).val(date_end.endOf('end').format('YYYY-MM-DD'))
    date_format = date.format('YYYY-MM-DD');        

}