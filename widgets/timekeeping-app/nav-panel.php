<link href="css/timekeeping-app/nav-panel.css" rel="stylesheet">

<div id='nav-panel-07122020-nav-panel'>
    <div id='nav-panel-07122020-nav-buttons-area'>

        <?php 


        if ($_SESSION['authority_level'] > 1) {
        echo 
        "
            <button class='nav-panel-07122020-nav-button nav-panel-07122020-nav-button-selected' id='nav-panel-07122020-nav-home'>
                <img src='images/home.png' class='nav-panel-07122020-image'>
                <p class='nav-panel-image-text'>Home</p>
            </button>
            <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-view-employees'>
                <img src='images/view-employee.png' class='nav-panel-07122020-image'>
                <p class='nav-panel-image-text'>Manage</p>
            </button>

        ";
        }
        ?>


            <!-- <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-view-projects'>
                <img src='images/clipboard.png' class='nav-panel-07122020-image'>
            </button> -->


        <button class='nav-panel-07122020-nav-button <?php if ($_SESSION['authority_level'] == 0) { echo "nav-panel-07122020-nav-button-selected"; } ?>' id='nav-panel-07122020-nav-user-timekeeping-clock'>
            <img src='images/clock.png' class='nav-panel-07122020-image'>
            <p class='nav-panel-image-text'>Clock</p>
        </button>
    </div>
</div>

<script src='js/timekeeping-app/nav-panel.js'></script>