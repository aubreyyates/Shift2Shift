<?php
    // Put the header in the page
    include_once 'header.php';
    // Start a session
    session_start();
?>

<!-- Start main part of page -->
<section class="main-container">
    <div class="centered-wrapper">
        <div class='form_area'>
            <h3>Signup Your Company</h2>
            <div class='divider'></div>
            <form id='account_form' class="signup-form" action="includes/signup.inc.php" method="POST">
                <!-- Box to enter the employee's first name -->
                <input class='form_input' id='first' type="text" name="first" placeholder="Firstname">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='first_alert' class='form_alert'></p></div>
                <!-- Box to enter the employee's last name -->
                <input  class='form_input' id='last' type="text" name="last" placeholder="Lastname">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='last_alert' class='form_alert'></p></div>
                <!-- Box to enter the employee's E-mail -->
                <input  class='form_input' id='email' type="text" name="email" placeholder="E-mail">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='email_alert' class='form_alert'></p></div>
                <!-- Box to enter the employee's password that they will use to log in to that account -->
                <input  class='form_input' id='company' name="org" placeholder="Company Name">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='company_alert' class='form_alert'></p></div>
                <!-- Box to enter the employee's password that they will use to log in to that account -->
                <input  class='form_input' id='password' type="password" name="pwd" placeholder="Password">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='pass_alert' class='form_alert'></p></div>
            </form>

            <!-- Button to submit the form and create a new employee account -->
            <button class='signup-form-button' id='submit_form' type="submit" name="submit">Create</button>

            <div class='space20'></div>

        
        </div>
    </div>
</section>

<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>
    // When page is ready, do this

    $(document).ready(function() {
        
        $( "#submit_form" ).click(function() {
            // Get entered first
            var first = document.forms["account_form"]["first"].value;
            // Get entered last
            var last = document.forms["account_form"]["last"].value;
            // Get entered email
            var email = document.forms["account_form"]["email"].value;
            // Get entered email
            var company = document.forms["account_form"]["org"].value;
            // Get entered password
            var pwd = document.forms["account_form"]["pwd"].value;
            // Allow characters
            var letters = /^[A-Za-z]+$/;
            // Allow characters
            var letters_pass = /^[-~]+$/;
            // Set the valid form to true
            var valid_form = true
            // Allow characters
            var letters_company = /^[A-Za-z0-9| |&|\-]+$/;

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            // Remove previous alerts
            $('.form_alert').css('display','none')
            // Remove previous alerts
            $('.form_input').css('border','1px solid rgb(214, 214, 214)')
            


            // Check to make sure first is not empty
            if (first.length == 0) {
                // Turn input box red
                $('#first').css('border', '2px solid red')
                // Set an alert
                $('#first_alert').css('display','block')
                // Set the alert text
                $('#first_alert').text('You must enter a first name.')
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters for first name
            } else if (!first.match(letters)) {
                // Turn input box red
                $('#first').css('border', '2px solid red')
                // Set an alert
                $('#first_alert').css('display','block')
                // Set the alert text
                $('#first_alert').text('You must only have letters.')
                // Form is invalid
                valid_form = false
            } else if (first.length > 29) {
                // Turn input box red
                $('#first').css('border', '2px solid red')
                // Set an alert
                $('#first_alert').css('display','block')
                // Set the alert text
                $('#first_alert').text('Your first name must be less than 30 charaters. We are sorry if your name is over 29. :(')
                // Form is invalid
                valid_form = false
            }
            
            // Check to make sure last is not empty
            if (last.length == 0) {
                // Turn input box red
                $('#last').css('border', '2px solid red')
                // Set an alert
                $('#last_alert').css('display','block')
                // Set the alert text
                $('#last_alert').text('You must enter a last name.')            
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters last name
            } else if (!last.match(letters)) {
                // Turn input box red
                $('#last').css('border', '2px solid red')
                // Set an alert
                $('#last_alert').css('display','block')
                // Set the alert text
                $('#last_alert').text('You must only have letters.')            
                // Form is invalid
                valid_form = false
            } else if (last.length > 29) {
                // Turn input box red
                $('#last').css('border', '2px solid red')
                // Set an alert
                $('#last_alert').css('display','block')
                // Set the alert text
                $('#last_alert').text('Your last name must be less than 30 charaters. We are sorry if your name is over 29. :(')
                // Form is invalid
                valid_form = false
            }
            
            // Check to make sure email is not empty
            if (email.length == 0) {
                // Turn input box red
                $('#email').css('border', '2px solid red')
                // Set an alert
                $('#email_alert').css('display','block')
                // Set the alert text
                $('#email_alert').text('You must enter an email.')            
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters last name         
            
            } else if (!re.test(String(email).toLowerCase())) {
                // Turn input box red
                $('#email').css('border', '2px solid red')
                // Set an alert
                $('#email_alert').css('display','block')
                // Set the alert text
                $('#email_alert').text('Your email is not a valid email.')            
                // Form is invalid
                valid_form = false
            }
            // Check to make sure company is not empty
            if (company.length == 0) {
                // Turn input box red
                $('#company').css('border', '2px solid red')
                // Set an alert
                $('#company_alert').css('display','block')
                // Set the alert text
                $('#company_alert').text('You must a company name.')            
                // Form is invalid
                valid_form = false
            }  else if (company.length > 100) {
                // Turn input box red
                $('#company').css('border', '2px solid red')
                // Set an alert
                $('#company_alert').css('display','block')
                // Set the alert text
                $('#company_alert').text('Your company name must be less than 100 charaters.')
                // Form is invalid
                valid_form = false
            } else if (!company.match(letters_company)) {
                // Turn input box red
                $('#company').css('border', '2px solid red')
                // Set an alert
                $('#company_alert').css('display','block')
                // Set the alert text
                $('#company_alert').text("Your company can only have letters, numbers, spaces, hyphens, and ampersands in it's name.")
                // Form is invalid
                valid_form = false
            }

            // Check to make sure email is not empty
            if (pwd.length == 0) {
                // Turn input box red
                $('#password').css('border', '2px solid red')
                // Set an alert
                $('#pass_alert').css('display','block')
                // Set the alert text
                $('#pass_alert').text('You must enter a password.')            
                // Form is invalid
                valid_form = false
            } else if (pwd.match( letters_pass ) ) {
                // Turn input box red
                $('#password').css('border', '2px solid red')
                // Set an alert
                $('#pass_alert').css('display','block')
                // Set the alert text
                $('#pass_alert').text('You have invalid characters.')            
                // Form is invalid
                valid_form = false
            } else if (pwd.length < 5)  {
                // Turn input box red
                $('#password').css('border', '2px solid red')
                // Set an alert
                $('#pass_alert').css('display','block')
                // Set the alert text
                $('#pass_alert').text('Your password must be at least 5 characters long.')            
                // Form is invalid
                valid_form = false
            } 
            
            
            if (valid_form == true) {
                
                $( "#account_form" ).submit();
                
            }
        });
    });
</script>

<!-- Start PHP -->
<?php
    
    // Checks to see if they just attempted to create an account
    if (isset($_SESSION['new_admin_created'])) {
        // Get the result value
        $result = $_SESSION['new_admin_created'];
        // Checks to see if they just successfully create an account
        if ($result == 'true') {
            echo "
             
                <div class='disappear_modal' style='width:500px; margin: 0 auto; height:50px; margin-top:-435px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <div style='margin-left:50%; margin-left: 64px; margin-top: 15px;> 
                        <p style=';padding:0;color:black; font-size:20px; line-height:40px;'>NEW ACCOUNT AND COMPANY CREATED SUCCESSFULLY</p>
                    </div
                </div>

            ";
        }
        // Unset as they have seen the message
        unset($_SESSION['new_admin_created']);
    }
        
?>
<!-- End PHP -->


<?php
    // Put the footer in the page
    include_once 'footer.php';
?>