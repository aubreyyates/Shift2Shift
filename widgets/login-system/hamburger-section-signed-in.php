<div id='hamburger-modal-container'>
    <div id='hamburger-modal'>
        <div id='hamburger-divider1'></div>
            
        <div class='space20'></div>

        <div style='margin: 0 auto; width: 200px;'>
            <a id='hamburger-home' href="index.php">Home</a>
        </div>

        
        <!-- <div style='height:1px; width:100%;background-color:rgb(214,214,214);'></div> -->

        <div class='space20'></div>

        <?php 

        if ($_SESSION['authority_level'] >= 2) {
            echo 
            "
            <div style='margin: 0 auto; width: 200px;'>
                <button class='hamburger-button' data-id='#nav-panel-07122020-nav-view-employees'>Employees</button>
            </div>

            <div class='space20'></div>
            ";
            }

        ?>

        <div style='margin: 0 auto; width: 200px;'>
            <button class='hamburger-button' data-id='#nav-panel-07122020-nav-user-timekeeping-clock' >Clock</button>
        </div>

        <div class='space20'></div>

        <div style='margin: 0 auto; width: 200px;'>
            <form action = "backend/login-system/logout-user.php" method="POST">
                <button id='hamburger-logout' type="submit" name="submit">Logout</button>
            </form>
        </div>


        <div class='space20'></div>
        

    </div>
</div>