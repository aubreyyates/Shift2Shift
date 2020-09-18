$(document).ready(function () {

    // Change the selected nav buttons color.
    $(".nav-panel-07122020-nav-button").click(function () {
        $(".nav-panel-07122020-nav-button").removeClass("nav-panel-07122020-nav-button-selected");
        $(this).addClass("nav-panel-07122020-nav-button-selected");
    });

    // The following load components/widgets into the load div (#main-window-container) -----
    $("#nav-panel-07122020-nav-home").click(function () {
        //$("#main-window-container").load("./timekeeping-app/widgets/user-stats/user-stats.php");
        $("#create-account-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#user-stats-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-create-account").click(function () {
        //$("#main-window-container").load("./timekeeping-app/widgets/create-account/create-account.php");
        $("#user-stats-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#create-account-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-view-employees").click(function () {
        //$("#main-window-container").load("./timekeeping-app/widgets/view-employees/view-employees.php");
        // $("user-stats-div").css("display", "none");
        // $("view-projects-div").css("display", "none");
        // $("user-timekeeping-clock").css("display", "none");
        // $("create-account-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-view-projects").click(function () {
        //$("#main-window-container").load("./timekeeping-app/widgets/view-projects/view-projects.php");
        $("#user-stats-div").css("display", "none");
        $("#create-account-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "none");
        $("#view-projects-div").css("display", "block");
    });

    $("#nav-panel-07122020-nav-user-timekeeping-clock").click(function () {
        //$("#main-window-container").load("./timekeeping-app/widgets/user-timekeeping-clock/user-timekeeping-clock.php")
        $("#user-stats-div").css("display", "none");
        $("#create-account-div").css("display", "none");
        $("#view-projects-div").css("display", "none");
        $("#user-timekeeping-clock-div").css("display", "block");
    });
    // --------- End load div scripts ------------------




});