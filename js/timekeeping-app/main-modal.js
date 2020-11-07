$(document).ready(function () {

    shift2shift_globalv1.main_modal_visible = false;

    $(".timekeeping-app-main-modal-exit-button").click(function () {
        $("#timekeeping-app-main-modal").css("display", "none")
        shift2shift_globalv1.main_modal_visible = false;
    });



});

function display_main_modal(html) {
    if (shift2shift_globalv1.main_modal_visible == false) {
        $("#timekeeping-app-main-modal").css("display", "block")
        $("#timekeeping-app-main-modal-load").html(html);
        shift2shift_globalv1.main_modal_visible = true;
    }
}

function hide_main_modal() {

    $("#timekeeping-app-main-modal").css("display", "none")
    shift2shift_globalv1.main_modal_visible = false;

}