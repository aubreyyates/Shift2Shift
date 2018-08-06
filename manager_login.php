
<!DOCTYPE html>
<html>
    <head>
        <!-- Put the title of the page -->
        <title>Shift 2 Shift</title>
        <!-- Put the stylesheet style.css on the page. This will go on every page that has a header on it -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
        <link href="style-index.css" rel="stylesheet">

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <meta name="viewport" content="maximum-scale=1.0,width=device-width,initial-scale=1.0,user-scalable=0">
        <!-- <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet"> -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Londrina Sketch' rel='stylesheet'> -->
        <!-- <link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'> -->
        <link href='https://fonts.googleapis.com/css?family=Chivo' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

    </head>

    <body>





        <link href='https://fonts.googleapis.com/css?family=Raleway Dots' rel='stylesheet'>

        <header>
            <nav>
                <!-- orginally 1000px -->
                <div  style='width:90%; margin:0 auto;'>

                    <ul>
                        <!-- The home button to go back to the home page which is index.php -->
                        <li><a href="index.php">Home</a></li>
                    </ul>

                    <div class="nav-login">
                        <div style="float:right;">
                            <form id='account_manager' action = "includes/mlogin.inc.php" method="POST">
                                <input id ='input3' type="text" name="uid" placeholder="Username/email">
                                <input id='pwd3' type="password" name="pwd" placeholder="Password">
                            </form>

                            <button id='submit_form_manager' name="submit">Login</button>
                            <!-- <img src='images/manager.png' height='42' width='42'> -->
                            <a href="signup.php">Signup</a>
                        </div>

                        <div style="float:right; width:300px; height:60px; margin-right:20px;">
                            <div id="manager_alert">
                                <div style="float:right;">
                                    <div class="info_alert_tip"></div>
                                </div>

                                <div class="info_alert"><span>
                                
                                
                                <p id="info_description_alert_3">Invalid user or password</p>
                                </span></div>

                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


        <div style='width:100%; margin:0 auto; '>


        <?php
            $page_type = 'Manager';
            include "login_area2.php";
        ?>

        <div>

        <!-- Get Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Get Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    

        <script>
        // When page is ready, do this

        $(document).ready(function() {

            $( "#submit_form_manager" ).click(function() {
                // Get entered first
                var email = $('#input3').val()
                // Get entered last
                var pwd = $('#pwd3').val();
                // Start with valid form
                var valid_form = true

                var string_alert = ''
                // Remove old border
                $("#manager_alert").css('display','none')
                $('#pwd3').css('border', '1px solid black')
                $('#pwd3').css('width', '140px')  
                $('#input3').css('border', '1px solid black')
                $('#input3').css('width', '140px')
                // Check to make sure email is not empty
                if (email.length == 0) {
                    // Turn input box red
                    $('#input3').css('border', '2px solid red')
                    // Remove 2 pixels of the width
                    $('#input3').css('width', '138px')  
                    // Alert they need email
                    string_alert = 'Please enter an E-mail'         
                    // Form is invalid
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
                    $('#pwd3').css('border', '2px solid red')
                    // Remove 4 pixels of the width
                    $('#pwd3').css('width', '138px')           
                    // Form is invalid
                    valid_form = false
                }

                // Check if form should sumbit
                if (valid_form == true) {
                    // Check if user exists
                    $.post("check_for_manager.php", {email:email,pwd:pwd}, function(result) {
                        if (result == "True") {
                            // Submit login form
                            $( "#account_manager" ).submit();
                        } else { 
                            $("#info_description_alert_3").text("Invalid user or password")
                            $("#manager_alert").css('display','block')
                            
                        }
                    }) 
                } else {
                    // Set manager alert set
                    
                    $("#info_description_alert_3").text(string_alert)
                    $("#manager_alert").css('display','block')

                }
            }) 
        });

        </script>


    </body>
</html>