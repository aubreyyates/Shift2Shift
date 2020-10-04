<link href="css/timekeeping-app/user-timekeeping-clock.css" rel="stylesheet">

<div class='space70'></div>

<div class='form_area'>

    <h3>Clock</h3>

    <div class='divider'></div>

    <div id='clock_in_buttons_area'>
        <button id='clockin' class='clockin-button'>Clock In</button>
        <button id='clockout' class='clockin-button' disabled>Clock Out</button>
        <div id='user-clock-container'>
            <span id='user-clock'>00:00:00</span>
        </div>
    </div>

    <div>
        <button id = 'breakbtn' type ='submit' name='submitpausetime' style='' disabled>Take A Break</button>
    </div>

    <div style='height:12px;'></div>

</div>

<div id='notification-area'></div>

<script src='js/timekeeping-app/user-timekeeping-clock.js'></script>