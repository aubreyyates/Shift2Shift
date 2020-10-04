// When the page is ready.
$(document).ready(function () {


    let headings = [{ text: "Start Time", width: 40 }, { text: "End Time", width: 40 }, { text: "Total Time", width: 20 }]
    let html = prepare_entry_headings(headings);
    $("#timekeeping-app-entry-data-heading-container-clocked-time").append(html);


});