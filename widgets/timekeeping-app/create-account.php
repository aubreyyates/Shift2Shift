<link rel="stylesheet" href="css/timekeeping-app/create-account.css">

    <div style='height:1000px;'>

        <div class='space70'></div> 

        <div class='form_area'>

            <h3>Create Employee Account</h3>

            <div class='divider'></div>
            <!-- Form to put in the new employee's info -->
            <form id='create-account-form' name='account_form' class="signup-form" action="backend/timekeeping-app/create-new-account.php" method="POST">
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
                    <!-- <option value=1 >Manager</option> -->
                    <option value=2 >Admin</option>
                </select>        
                
                <!-- Creates an alert to let them know they entered something wrong -->
                <div class='alert_area'><p id='authority_alert' class='form_alert'></p></div>      
                

            </form>

            <!-- Button to submit the form and create a new employee account -->
            <button class='signup-form-button submit-account-form' data-form='create-account-form' type="submit" name="submit">Create</button>
            
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
                Basic employees can clock time.
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
                Admins can create and edit accounts. They can also clock time.
            </p>
        </div>

    </div>

    <?php include_once 'widgets/timekeeping-app/popup-info.php'; ?>

<script src='js/timekeeping-app/create-account.js'></script>