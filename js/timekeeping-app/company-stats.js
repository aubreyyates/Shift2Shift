// Initialize variables
var shift2shift_globalv1 = {};

$(document).ready(function readyDoc() {



    $.post("backend/timekeeping-app/load-company-stats.php", function (result) {

        shift2shift_globalv1.company_stats = JSON.parse(result);
        shift2shift_globalv1.company_stats.total_timestamp_length_readable = moment.duration(shift2shift_globalv1.company_stats.total_timestamp_length, "milliseconds").format("HH:mm:ss");
        shift2shift_globalv1.company_stats.total_break_length_readable = moment.duration(shift2shift_globalv1.company_stats.total_break_length, "milliseconds").format("HH:mm:ss");

        $("#timekeeping-app-company-stats-number-of-timestamps").text(shift2shift_globalv1.company_stats.number_of_timestamps);
        $("#timekeeping-app-company-stats-number-of-breaks").text(shift2shift_globalv1.company_stats.number_of_breaks);
        $("#timekeeping-app-company-stats-total-timestamp-length").text(shift2shift_globalv1.company_stats.total_timestamp_length_readable);
        $("#timekeeping-app-company-stats-total-break-length").text(shift2shift_globalv1.company_stats.total_break_length_readable);

        if (shift2shift_globalv1.company_stats.total_timestamp_length != 0) {
            $("#timekeeping-app-company-stats-timestamps-to-breaks-timestamp-section").css("display", "block");
            $("#timekeeping-app-company-stats-timestamps-to-breaks-break-section").css("display", "block");

            let timestamp_and_break_time = shift2shift_globalv1.company_stats.total_timestamp_length + shift2shift_globalv1.company_stats.total_break_length;
            let timestamp_percentage = shift2shift_globalv1.company_stats.total_timestamp_length / timestamp_and_break_time * 100
            let break_percentage = 100 - timestamp_percentage;
            $("#timekeeping-app-company-stats-timestamps-to-breaks-timestamp-section").css("width", timestamp_percentage + "%");
            $("#timekeeping-app-company-stats-timestamps-to-breaks-break-section").css("width", break_percentage + "%");

            $("#timekeeping-app-company-stats-timestamps-to-breaks-timestamp-section-text").text(timestamp_percentage.toFixed(0) + "%");
            $("#timekeeping-app-company-stats-timestamps-to-breaks-break-section-text").text(break_percentage.toFixed(0) + "%");
        }

    });







});