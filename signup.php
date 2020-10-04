<?php
    
    // Check if someone is signed in. Send them home if they are signed in.
    include_once 'backend/login-system/check-for-user-logged-in.php';
    // Put the header in the page
    include_once 'widgets/login-system/header.php';

?>

<link href="css/login-system/signup.css" rel="stylesheet">

<!-- Start main part of page -->
<section class="main-container" style='padding:0px;min-width:300px;'>

    <?php
        include "widgets/login-system/signup-error-alerts.php";
    ?>

    <div class="centered-wrapper">
        <div class='form_area'>
            <h3 id='signup-header'>Signup Your Company</h2>
            <div class='divider'></div>
            <form id='account_form' class="signup-form" action="backend/login-system/signup-new-company.php" method="POST">
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

<!-- Start PHP -->
<?php
    
    // // Checks to see if they just attempted to create an account
    // if (isset($_SESSION['new_admin_created'])) {
    //     // Get the result value
    //     $result = $_SESSION['new_admin_created'];
    //     // Checks to see if they just successfully create an account
    //     if ($result == 'true') {
    //         echo "
             
    //             <div class='disappear_modal' style='width:500px; margin: 0 auto; height:50px; margin-top:-435px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
    //                 <div style='margin-left:50%; margin-left: 64px; margin-top: 15px;> 
    //                     <p style=';padding:0;color:black; font-size:20px; line-height:40px;'>NEW ACCOUNT AND COMPANY CREATED SUCCESSFULLY</p>
    //                 </div
    //             </div>

    //         ";
    //     }
    //     // Unset as they have seen the message
    //     unset($_SESSION['new_admin_created']);
    // }
        
?>
<!-- End PHP -->

<script src='js/login-system/signup.js'></script>

<?php
    // Put the footer in the page
    include_once 'footer.php';
?>