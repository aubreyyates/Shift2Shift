<style>
    <?php include dirname(__DIR__).'/create-account/create-account.css'; ?>
</style>
   
    <div style='height:1000px;'>

        <div class='space70'></div> 

        <div class='form_area'>

            <h3>Create Employee Account</h3>

            <div class='divider'></div>
            <!-- Form to put in the new employee's info -->
            <form id='account_form' name='account_form' class="signup-form" action="timekeeping-app/backend/create-new-account.php" method="POST">
                <!-- Box to enter the employee's first name -->
                <input class='form_input' id='first' type="text" name="first" placeholder="First Name">
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='first_alert' class='form_alert'></p></div>
                <!-- Box to enter the employee's last name -->
                <input  class='form_input' id='last' type="text" name="last" placeholder="Last Name">
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
                
                <select class='form_input' name="authority_level" id="authority_level">
                    <option value="" disabled selected hidden><p style='color:grey;'>Account Type</p></option>
                    <option value=0 >Basic Employee</option>
                    <option value=1 >Manager</option>
                    <option value=2 >Admin</option>
                </select>        
                
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='authority_alert' class='form_alert'></p></div>      
                

            </form>

            <!-- Button to submit the form and create a new employee account -->
            <button class='signup-form-button' id='submit_form' type="submit" name="submit">Create</button>
            
            <div class='space20'></div> 

            

            
        </div>

        <div id='employee-account-uses' class='form_area note-area'>
            <div class='font-1 note-icon-container'>
               
                <div class='note-icon-image-area'><img src='images/note-icon.png' class='note-icon-image'></div>
                <div class='note-icon-text'><h4>Note</h4></div>
            </div>
            <div class='note-header'><h3>Basic Employee Account</h3></div>
            <div class='divider'></div>
            <p> 
                Basic employees can clock time. They can clock time to an assigned project, given job code, or no project if you don't like projects. 
            </p>
        </div>

        <div id='manager-account-uses' class='form_area note-area'>
            <div class='font-1 note-icon-container'>
               
               <div class='note-icon-image-area'><img src='images/note-icon.png' class='note-icon-image'></div>
               <div class='note-icon-text'><h4>Note</h4></div>
           </div>
           <div class='note-header'><h3>Manager Account</h3></div>
            <div class='divider'></div>
            <p> 
                TBD
                <!-- Employees can clock time. They can clock time to an assigned project, given job code, or no project if you don't like projects. 
                They can view a calendar to see when they work. The calender can have events on it that you can create. The employees mainly just clock time, but they are also cool. -->
            </p>
        </div>

        <div id='admin-account-uses' class='form_area note-area'>
            <div class='font-1 note-icon-container'>
               
               <div class='note-icon-image-area'><img src='images/note-icon.png' class='note-icon-image'></div>
               <div class='note-icon-text'><h4>Note</h4></div>
           </div>
           <div class='note-header'><h3>Admin Account</h3></div>
            <div class='divider'></div>
            <p> 
                Admins can create projects, entries, employee accounts, manager accounts, and even other admin accounts. They can also change the settings of their company. They can also travel through space faster than light. There isn't much they can't do. 
            </p>
        </div>

    </div>

    <?php include dirname(__DIR__).'/popup-info/popup-info.php'; ?>

<script>
    // When page is ready, do this

    $(document).ready(function() {

        $("#authority_level").change(function() {
            $("#authority_level").css("color","#111");
            $(".note-area").css("display","none");
            if ($(this).val() == 0) {
                $("#employee-account-uses").css("display","block");
            } else if ($(this).val() == 1) {
                $("#manager-account-uses").css("display","block");
            } else if ($(this).val() == 2) {
                $("#admin-account-uses").css("display","block");
            }
        });


        
        $( "#submit_form" ).click(function() {
            // Get entered first
            var first = document.forms["account_form"]["first"].value;
            // Get entered last
            var last = document.forms["account_form"]["last"].value;
            // Get entered email
            var email = document.forms["account_form"]["email"].value;
            // Get entered password
            var pwd = document.forms["account_form"]["pwd"].value;
            // Get authority level value
            var authority_level = document.forms["account_form"]["authority_level"].value;
            // Allow characters
            var letters = /^[A-Za-z]+$/;
            // Allow characters
            var letters_pass = /^[-~]+$/;
            // Set the valid form to true
            var valid_form = true

            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            // Reset the account created message.
            $('#popup-info').css("display","none");
            $('#popup-info').stop();
            $('#popup-info').css("opacity","1");


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
            } else if (pwd.length < 10)  {
                pass_test()
                // Set the alert text
                $('#pass_alert').text('Your password must be at least 10 characters long.')            
                // Form is invalid
                valid_form = false
            } 

            if (authority_level == '') {
                authority_test()
                // Set the alert text
                $('#authority_alert').text('You must select an account type.')
                // Form is invalid
                valid_form = false
            }

            // Check if email is taken. True if taken. False if not taken.
            if (valid_form == true) {
                $.ajax({
                    type: 'POST',
                    url: 'backend/check-for-email-existing.php',
                    data: { 
                        email: email
                    },
                    success: function(data){
                        if (data == "True") {
                            email_test();
                            // Set the alert text
                            $('#email_alert').text('This email has already been taken.')
                            // Form is invalid
                            valid_form = false;
                        }

                        submit_form();
                    }
                });
            }
            
            function submit_form() {
                if (valid_form == true) {
                    $.ajax({
                        url:'timekeeping-app/backend/create-new-account.php',
                        type:'post',
                        data:$('#account_form').serialize(),
                        success: function(data) {
                            if (data == 'success') {
                                $('#popup-info').css("display","block");
                                $('#popup-info').fadeOut(5000);
                                clear_form();
                            } else {
                                alert("There was an error.");
                            }
                        },
                    });
                    
                }
            }

        });

        // Clear the form. This means clear out the inputs.
        function clear_form(){
            $('#first').val('');
            $('#last').val('');
            $('#email').val('');
            $('#password').val('');
        }


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
        function authority_test() {
            // Turn input box red
            $('#authority_level').css('border', '2px solid rgb(255, 98, 98)')
            // Change height
            $('#authority_level').height(38)          
            // Set an alert
            $('#authority_alert').css('display','block')
        }

    });

</script>