<?php
    // Put the header into the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
?>


<!-- Main part of page -->
<section class="main-container" style='height:1200px;'>

    <?php
        // Puts the navigation in the page
        include_once 'nav_cost_box.php';
    ?>

    <div class='main-wrapper'>

        <div class='form_area'>
        <h3>Create Manager Account</h3>

        <div class='divider'></div>
        <!-- Form to create a new admin account -->
        <form id='account_form' name='account_form' class="signup-form" action="includes/signup_manager.inc.php" method="POST">
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
            <input  class='form_input' id='password' type="password" name="pwd" placeholder="Password">
            <!-- Creates an alert to let them know they entered something wrong -->
            <div class='alert_area'><p id='pass_alert' class='form_alert'></p></div>
            

        </form>

        <!-- Button to submit the form and create a new manager account -->
        <button class='signup-form-button' id='submit_form' type="submit" name="submit">Create</button>

        <div class='space20'></div>
        </div>

        <div class='form_area area'>
            <h3>Manager Account Uses</h3>
            <div class='divider'></div>
            <p> 
                Managers can add, delete, and alter the entries and events of the employees that they are assigned to. They can see the 
                entries of the assigned employees and projects. They can't do as many things as admins, but they are still cool.
            </p>
        </div>

        <div class='form_area area'>
            <h3>Employee Account Uses</h3>
            <div class='divider'></div>
            <p> 
                Employees can clock time. They can be clocking time to an assigned project, given job code or No Project if you don't like projects. 
                They can view a calendar to see when they work. This will have events on it that you can create. The employees mainly just clock time, but they also cool.
            </p>
        </div>

        <div class='form_area area'>
            <h3>Admin Account Uses</h3>
            <div class='divider'></div>
            <p> 
                Admins can create projects, entries, events for 
                calendars, employee accounts, manager accounts, and even other admin accounts. They have complete control over all in this list from their company.
                They can add, delete, alter, and recover them if needed later. They can also change the settings of their company. They can also travel through space faster than light. There isn't much they can't do. 
            </p>
        </div>

        <!-- <div class='info_accounts_box_uses'>
            <h5>Admin Account Uses</h5>
            <p style='line-height:20px;'> 
                Admins can create projects, entries, events for 
                calendars, employee accounts, manager accounts, and even other admin accounts. They have complete control over all in this list from their company.
                They can add, delete, alter, and recover them if needed later. They can also change the settings of their company. They can also travel through space faster than light. There isn't much they can't do. 
            </p>
            <h5>Manager Account Uses</h5>
            <p style='line-height:20px;'> 
                Managers can add, delete, and alter the entries and events of the employees that they are assigned to. They can see the 
                entries of the assigned employees and projects. They can't do as many things as admins, but they are still cool.
            </p>
            <h5>Employee Account Uses</h5>
            <p style='line-height:20px;'> 
                Employees can clock time. They can be clocking time to an assigned project, given job code or No Project if you don't like projects. 
                They can view a calendar to see when they work. This will have events on it that you can create. The employees mainly just clock time, but they also cool.
            </p>
        </div>

        <div class='info_accounts_box'>
            <h5>Admin account: Free to create</h5>
            <h5>Manager account: Free to create</h5>
            <h5>Employee account: $1.50/month</h5>
        </div> -->


    </div>


</section>
<!-- End main part of page -->


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
            // Get entered password
            var pwd = document.forms["account_form"]["pwd"].value;
            // Allow characters
            var letters = /^[A-Za-z]+$/;
            // Allow characters
            var letters_pass = /^[-~]+$/;
            // Set the valid form to true
            var valid_form = true

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            // Remove previous alerts
            $('.form_alert').css('display','none')
            // Remove previous alerts
            $('.form_input').css('border','1px solid rgb(214, 214, 214)')
            // Remove previous alerts
            $('.form_input').height(40)


            // Check to make sure first is not empty
            if (first.length == 0) {
                first_test()
                // Set the alert text
                $('#first_alert').text('You must enter a first name.')
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters for first name
            } else if (!first.match(letters)) {
                first_test()
                // Set the alert text
                $('#first_alert').text('You must only have letters.')
                // Form is invalid
                valid_form = false
            } else if (first.length > 29) {
                first_test()
                // Set the alert text
                $('#first_alert').text('Your first name must be less than 30 charaters. We are sorry if your name is over 29. :(')
                // Form is invalid
                valid_form = false
            }
            
            // Check to make sure last is not empty
            if (last.length == 0) {
                last_test()
                // Set the alert text
                $('#last_alert').text('You must enter a last name.')            
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters last name
            } else if (!last.match(letters)) {
                last_test()
                // Set the alert text
                $('#last_alert').text('You must only have letters.')            
                // Form is invalid
                valid_form = false
            } else if (last.length > 29) {
                last_test()
                // Set the alert text
                $('#last_alert').text('Your last name must be less than 30 charaters. We are sorry if your name is over 29. :(')
                // Form is invalid
                valid_form = false
            }
            
            // Check to make sure email is not empty
            if (email.length == 0) {
                email_test()
                // Set the alert text
                $('#email_alert').text('You must enter an email.')            
                // Form is invalid
                valid_form = false
            // Test to make sure they only use letters last name         
            
            } else if (!re.test(String(email).toLowerCase())) {
                email_test()
                // Set the alert text
                $('#email_alert').text('Your email is not a valid email.')            
                // Form is invalid
                valid_form = false
            }

            // Check to make sure email is not empty
            if (pwd.length == 0) {
                pass_test()
                // Set the alert text
                $('#pass_alert').text('You must enter a password.')            
                // Form is invalid
                valid_form = false
            } else if (pwd.match( letters_pass ) ) {
                pass_test()
                // Set the alert text
                $('#pass_alert').text('You have invalid characters.')            
                // Form is invalid
                valid_form = false
            } else if (pwd.length < 5)  {
                pass_test()
                // Set the alert text
                $('#pass_alert').text('Your password must be at least 5 characters long.')            
                // Form is invalid
                valid_form = false
            } 
            
            
            if (valid_form == true) {
                $( "#account_form" ).submit();

            }
        });
        function first_test() {
            // Turn input box red
            $('#first').css('border', '2px solid rgb(255, 98, 98)')
            // Change height
            $('#first').height(38)          
            // Set an alert
            $('#first_alert').css('display','block')
        }
        function last_test() {
            // Turn input box red
            $('#last').css('border', '2px solid rgb(255, 98, 98)')
            // Change height
            $('#last').height(38)       
            // Set an alert
            $('#last_alert').css('display','block')
        }
        function email_test() {
            // Turn input box red
            $('#email').css('border', '2px solid rgb(255, 98, 98)')
            // Change height
            $('#email').height(38)   
            // Set an alert
            $('#email_alert').css('display','block')
        }
        function pass_test() {
            // Turn input box red
            $('#password').css('border', '2px solid rgb(255, 98, 98)')
            // Change height
            $('#password').height(38)  
            // Set an alert
            $('#pass_alert').css('display','block')
        }
    });

</script>

<!-- Start PHP -->
<?php

    // Checks to see if they just attempted to create an account
    if (isset($_SESSION['manager_account_created'])) {
        // Get the result value
        $result = $_SESSION['manager_account_created'];
        // Checks to see if they just successfully created an account
        if ($result == 'true') {
            echo "
             
                <div class='disappear_modal' style='top:60px; left:50%; margin-left:-250px;width:500px; position:absolute; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <div style='margin-left:50%; margin-left: 64px;'> 
                        <p style='padding:0;color:black; font-size:16px; line-height:48px;'>MANAGER ACCOUNT CREATED SUCCESSFULLY</p>
                    </div>
                </div>

            ";
        }
        // Unset as they have seen the message
        unset($_SESSION['manager_account_created']);
    }
        
    if (isset($_SESSION['user_taken'])) {
        // Get the result value
        $result = $_SESSION['user_taken'];
        // Checks to see if the user is taken
        if ($result == 'true') {
            echo "
             
                <div class='disappear_modal' style='top:60px; left:50%; margin-left:-250px;width:500px; position:absolute; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <div style='margin-left:50%; margin-left: 126px;'> 
                        <p style='padding:0;color:black; font-size:16px; line-height:48px;'>THIS E-MAIL IS ALREADY IN USE</p>
                    </div>
                </div>

            ";
        }
        // Unset as they have seen the message
        unset($_SESSION['user_taken']);
    }
?>
<!-- End PHP -->

<?php
    // Put foot in the page
    include_once 'footer.php';
?>