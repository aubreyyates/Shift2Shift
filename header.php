<?php
    // Start a session
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Put the title of the page -->
        <title>Shift 2 Shift</title>
        <!-- Put the stylesheet style.css on the page. This will go on every page that has a header on it -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <meta name="viewport" content="maximum-scale=1.0,width=device-width,initial-scale=1.0,user-scalable=0">
        <!-- <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet"> -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Londrina Sketch' rel='stylesheet'> -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'> -->
        <link href='https://fonts.googleapis.com/css?family=Chivo' rel='stylesheet'>

    </head>

<?php 

if (isset($_SESSION['u_id'])) {
        // Creates the database connect
        include 'includes/dbh.inc.php';
        // Gets the company id
        $org_id = $_SESSION['u_org_id'];
        // Gets the company settings
        $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
        // Gets the result from the database              
        $result = mysqli_query($conn, $sql); 
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the company color
            $org_color = $row['org_color'];
        }
        // Set the body to company color
        echo "<body style='background-color:$org_color'>";
    // Check if an employee is logged in
    } elseif (isset($_SESSION['e_id'])) {
        // Creates the database connect
        include 'includes/dbh.inc.php';
        // Gets the company id
        $org_id = $_SESSION['e_org_id'];
        // Gets the company settings
        $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
        // Gets the result from the database              
        $result = mysqli_query($conn, $sql); 
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the company color
            $org_color = $row['org_color'];
        }
        // Set the body to company color
        echo "<body style='background-color:$org_color'>";
    // Check if a manager is logged in
    } elseif (isset($_SESSION['m_id'])) {
        // Creates the database connect
        include 'includes/dbh.inc.php';
        // Gets the company id
        $org_id = $_SESSION['m_org_id'];
        // Gets the company settings
        $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
        // Gets the result from the database              
        $result = mysqli_query($conn, $sql); 
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the company color
            $org_color = $row['org_color'];
        }
        // Set the body to company color
        echo "<body style='background-color:$org_color'>";
    // Else no one is logged in
} else {
    // Set body to default
    echo '<body>';
}

?>

    <!-- Start the header -->
    <header>
        <nav>
            <!-- orginally 1000px -->
            <div  style='width:90%; margin:0 auto;'>

                <ul>
                    <!-- The home button to go back to the home page which is index.php -->
                    <li><a href="index.php">Home</a></li>
                    <?php
                        // if (!isset($_SESSION['u_id']) && !isset($_SESSION['e_id']) && !isset($_SESSION['m_id'])) {
                        //     echo "<li><a class='header_link' href='index.php'>Accounts</a></li>";
                        // }
                    ?>
                </ul>
                
                <!-- The login part that is determined by what account type is logged in or if no one is logged in -->
                <div class="nav-login">
                    <!-- Start php code -->
                    <?php
                        // Check if an admin is logged in
                        if (isset($_SESSION['u_id'])) {
                            // Create loggout button for admins
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                        // Check if an employee is logged in
                        } elseif (isset($_SESSION['e_id'])) {
                            // Create loggout button for employees
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';

                        // Check if a manager is logged in
                        } elseif (isset($_SESSION['m_id'])) {
                            // Create loggout button for managers
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                            // Else no one is logged in
                        } else {
                            // Create loggin area for someone
                            echo '



                            <div style="float:right;">
                            <form id="account_admin" action = "includes/login.inc.php" method="POST">
                            <input id="input1" type="text" name="uid" placeholder="Username/email">
                            <input id="pwd1" type="password" name="pwd" placeholder="Password">
                            </form>
                            <button id="submit_form_admin" name="submit">Login</button>
                            <a href="signup.php">Signup</a>
                            </div>

                            <div style="float:right; width:300px; height:60px; margin-right:20px;">
                                <div id="admin_alert">
                                        <div style="float:right;">
                                        <div class="info_alert_tip"></div>
                                    </div>
                                    <div class="info_alert"><span>
                                    
                                    <p id="info_description_alert">Invalid user or password</p>
                                    </span></div>

                                </div>
                            </div>

                            
                            '; 
                            
                            //
                        }

                    ?>
                    <!-- End php code -->
                </div>

                <?php 
                    // Check if an employee is logged in
                    if (isset($_SESSION['e_id'])) {
                        // Create the clock at the top
                        echo "<div class='clock_location'><div id='world_clock' class='clockStyle'></div>
                        </div>";
                    }
                ?>

            </div>
        </nav>
    </header>
    <!-- End of header -->

    <!-- Get Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {

        $( "#submit_form_admin" ).click(function() {
            // Get entered first
            var email = $('#input1').val()
            // Get entered last
            var pwd = $('#pwd1').val();
            // Start with valid form
            var valid_form = true

            var string_alert = ''
            // Remove old border
            $("#admin_alert").css('display','none')
            $('#pwd1').css('border', '1px solid black')
            $('#pwd1').css('width', '140px')  
            $('#input1').css('border', '1px solid black')
            $('#input1').css('width', '140px')
            // Check to make sure email is not empty
            if (email.length == 0) {
                // Turn input box red
                $('#input1').css('border', '2px solid red')
                // Remove 2 pixels of the width
                $('#input1').css('width', '138px')
                // Alert they need email
                string_alert = 'Please enter an E-mail'
                // // Set an alert
                valid_form = false
            }
            // Check to make sure email is not empty
            if (pwd.length == 0) {
                // Add that they need password too
                if (string_alert == '' ){
                    string_alert = 'Please enter a password'
                } else {
                    string_alert += ' and password'
                }
                // Turn input box red
                $('#pwd1').css('border', '2px solid red')
                // Remove 2 pixels of the width
                $('#pwd1').css('width', '138px')
                // // Set an alert
                valid_form = false
            }
            // Check if form should sumbit
            if (valid_form == true) {
                // Check if user exists
                $.post("check_for_admin.php", {email:email,pwd:pwd}, function(result) {
                    
                    if (result == "True") {
                        // Submit login form
                        $( "#account_admin" ).submit();
                    } else { 
                        $("#info_description_alert").text("Invalid user or password")
                        $("#admin_alert").css('display','block')
                    }
                }) 
            } else {
                // Set admin alert set
                $("#info_description_alert").text(string_alert)
                $("#admin_alert").css('display','block')

            }
        })
    });
</script>