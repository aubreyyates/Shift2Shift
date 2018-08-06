


$(document).ready(function () {
    // What happends if the save button is clicked on a project
    $("#save_edit").click(function () {
        // Get the date that was entered
        date_for_edit = $('#date_edit').val()
        // Make sure they enter a date
        if (date_for_edit != '') {
            // Get the entered start time    
            start = $('#start_edit').val()
            // Get the entered end time
            end = $('#end_edit').val()
            // Get the chosen AM/PM for start
            start_diem = $('#start_diem_edit').val()
            // Get the chosen AM/PM for end
            end_diem = $('#end_diem_edit').val()
            // Make sure the start time is a valid time
            if (moment(date_for_edit + " " + start + " " + start_diem).isValid()) {
                if (start.charAt(start.length - 3) != ':') {
                    alert("Your start time is not a valid time.")
                    return
                }
                // Make sure the end time is a valid time
                if (moment(date_for_edit + " " + end + " " + end_diem).isValid()) {
                    if (end.charAt(end.length - 3) != ':') {
                        alert("Your end time is not a valid time.")
                        return
                    }
                    // Check to make sure the end time is later than the start time
                    if (moment(date_for_edit + " " + start + " " + start_diem).unix() < moment(date_for_edit + " " + end + " " + end_diem).unix()) {
                        // Get the length of the entry
                        time = moment.duration(moment(date_for_edit + " " + end + " " + end_diem).diff(moment(date_for_edit + " " + start + " " + start_diem))).format('HH:mm:ss')
                        // Get the id of the entry being edited
                        time_id = $('#tid').val() //time id
                        emp_id = $('#emp_id').val() //employee id
                        description = $('#description_edit').val() //entered description
                        // Sanitize the code, prevent XSS              

                        description = description.replace(/'/g, "`")


                        description = DOMPurify.sanitize(description);
                        date_for_edit = DOMPurify.sanitize(date_for_edit);
                        time = DOMPurify.sanitize(time);
                        start = DOMPurify.sanitize(start);
                        end = DOMPurify.sanitize(end);
                        start_diem = DOMPurify.sanitize(start_diem);
                        end_diem = DOMPurify.sanitize(end_diem);
                        // Check description length
                        if (description.length > 250) {
                            // Let them know the description is too long
                            alert("Your description can't be more than 250 characters long.")
                            // Leave function
                            return;
                        }
                        // Update the database
                        $.post('edit_entry_to_employee.php', { date: date_for_edit, start: start, end: end, start_diem: start_diem, end_diem: end_diem, emp_id: emp_id, description: description, time_id: time_id }, function () {

                            for (var i = 0; i < entries.length; i++) {

                                if (entries[i].id === time_id) {

                                    entries[i].date = date_for_edit;
                                    entries[i].time = time;
                                    entries[i].start = start;

                                    entries[i].startdiem = start_diem;
                                    entries[i].end = end;
                                    entries[i].enddiem = end_diem;

                                    entries[i].description = description;
                                    if (filter_date == false) {
                                        display_all()
                                    } else {
                                        date_compare()
                                    }

                                }
                            }
                        });
                        $(document.getElementById('myModal')).css('display', 'none');
                    } else {
                        alert("Your start time is later than your end time.")
                    }
                } else {
                    alert("Your end time is not a valid time")
                }
            } else {
                alert("Your start time is not a valid time.")
            }
        } else {
            alert("You must enter a date.");
        }


    })
});