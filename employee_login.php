
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

    </head>

    <body>





        <link href='https://fonts.googleapis.com/css?family=Raleway Dots' rel='stylesheet'>

        <!-- Start the header -->
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
                            <form id='account_employee' action = "includes/elogin.inc.php" method="POST">     
                                <input id ='input2' type="text" name="uid" placeholder="Username/email">
                                <input id='pwd2' type="password" name="pwd" placeholder="Password">
                            </form>
                            <button id='submit_form_employee' name="submit">Login</button>
                            <a href="signup.php">Signup</a>
                            <!-- <img src='images/employee.png' height='42' width='42'> -->
                        </div>

                        <div style="float:right; width:300px; height:60px; margin-right:20px;">
                            <div id="employee_alert">
                                <div style="float:right;">
                                    <div class="info_alert_tip"></div>
                                </div>
                                <div class="info_alert"><span>
                                
                                <p id="info_description_alert_2">Invalid user or password</p>
                                </span></div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


        <div style='width:100%; margin:0 auto; '>


        <?php
            $page_type = 'Employee';
            include "login_area2.php";
        ?>

        <!-- Get Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Get Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    

        <script>
        // When page is ready, do this

        $(document).ready(function() {

            $( "#submit_form_employee" ).click(function() {
                // Get entered first
                var email = $('#input2').val()
                // Get entered last
                var pwd = $('#pwd2').val();
                // Start with valid form
                var valid_form = true
    
                var string_alert = ''
                // Remove old border
                $("#employee_alert").css('display','none')
                $('#pwd2').css('border', '1px solid black')
                $('#pwd2').css('width', '140px')  
                $('#input2').css('border', '1px solid black')
                $('#input2').css('width', '140px')
                
                // Check to make sure email is not empty
                if (email.length == 0) {
                    // Turn input box red
                    $('#input2').css('border', '2px solid red')
                    // Remove 4 pixels of the width
                    $('#input2').css('width', '138px')     
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
                    $('#pwd2').css('border', '2px solid red')
                    // Remove 4 pixels of the width
                    $('#pwd2').css('width', '138px')  
                    // Form is invalid
                    valid_form = false
                }
                // Check if form should sumbit
                if (valid_form == true) {
                    // Check if user exists
                    $.post("check_for_employee.php", {email:email,pwd:pwd}, function(result) {
                        if (result == "True") {
                            // Submit login form
                            $( "#account_employee" ).submit();
                        } else { 
                            $("#info_description_alert_2").text("Invalid user or password")
                            $("#employee_alert").css('display','block')
                        }
                    }) 
                } else {
                    // Set manager alert set
                    $("#info_description_alert_2").text(string_alert)
                    $("#employee_alert").css('display','block')
    
                }
            })
        });

        </script>


    </body>
</html>