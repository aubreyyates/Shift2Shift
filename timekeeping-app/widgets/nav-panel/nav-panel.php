<style>
    <?php include dirname(__DIR__).'/nav-panel/nav-panel.css'; ?>
</style>

<div id='nav-panel-07122020-nav-panel'>
    <div id='nav-panel-07122020-nav-buttons-area'>

        <button class='nav-panel-07122020-nav-button nav-panel-07122020-nav-button-selected' id='nav-panel-07122020-nav-home'>
            <img src='images/home.png' class='nav-panel-07122020-image'>
            <!-- <p style='font-family: "Chivo"'>Home</p> -->
        </button>

        <?php 


        if ($_SESSION['authority_level'] > 1) {
        echo 
        "
            <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-create-account'>
                <img src='images/add-employee.png' class='nav-panel-07122020-image'>
            </button>
            <!-- <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-view-employees'>
                
            </button> -->
            <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-view-projects'>
                <img src='images/clipboard.png' class='nav-panel-07122020-image'>
            </button>
        ";
        }
        ?>




        <button class='nav-panel-07122020-nav-button' id='nav-panel-07122020-nav-user-timekeeping-clock'>
            <img src='images/clock.png' class='nav-panel-07122020-image'>
        </button>
    </div>
</div>

<script>
    <?php include dirname(__DIR__).'/nav-panel/nav-panel.js'; ?>
</script>

