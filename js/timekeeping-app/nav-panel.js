$(document).ready(function () {

    // Change the selected nav buttons color.
    $(".nav-panel-07122020-nav-button").click(function () {
        $(".nav-panel-07122020-nav-button").removeClass("nav-panel-07122020-nav-button-selected");
        $(this).addClass("nav-panel-07122020-nav-button-selected");
    });

    $(".hamburger-button").click(function () {
        $(".nav-panel-07122020-nav-button").removeClass("nav-panel-07122020-nav-button-selected");
        let id_data = $(this).data("id");
        $(id_data).click();
    });

    $("#nav-panel-07122020-nav-home").click(function () {
        $("#create-account-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#view-employees-div").css("display", "none");
        $("#view-clocked-time-div").css("display", "none");
        $("#user-stats-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-create-account").click(function () {
        $("#user-stats-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#view-employees-div").css("display", "none");
        $("#view-clocked-time-div").css("display", "none");
        $("#create-account-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-view-employees").click(function () {
        $("#user-stats-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#create-account-div").css("display", "none");
        $("#view-clocked-time-div").css("display", "none");
        $("#view-employees-div").css("display", "block");
    });

    // Disabled for now.
    // $("#nav-panel-07122020-nav-view-projects").click(function () {
    //     $("#user-stats-div").css("display", "none");
    //     $("#create-account-div").css("display", "none");
    //     $("#user-timekeeping-clock-div").css("display", "none");
    //     $("#view-clocked-time-div").css("display", "none");
    //     $("#view-projects-div").css("display", "block");
    // });

    $("#nav-panel-07122020-nav-user-timekeeping-clock").click(function () {
        $("#user-stats-div").css("display", "none");
        $("#create-account-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#view-employees-div").css("display", "none");
        $("#view-clocked-time-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "block");
    });
    // --------- End load div scripts ------------------




});