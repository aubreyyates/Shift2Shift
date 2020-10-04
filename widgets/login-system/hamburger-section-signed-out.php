<div id='hamburger-modal-container'>
    <div id='hamburger-modal'>
        <div id='hamburger-divider1'></div>
            
        <div style='height:20px;'></div>

        <div style='margin: 0 auto; width: 200px;'>
            <form id="account_admin2" action = "backend/login-system/login-user.php" method="POST">
                <input id="input2" class='hamburger-input' type="text" name="email" placeholder="Username/email">
                <div id='modal-spacing' style='height:20px;'></div>
                <input id="pwd2"  class='hamburger-input' type="password" name="pwd" placeholder="Password">
            </form>

            <div id='modal-spacing2' style='height:20px;'></div>

            <button id="submit-form-login2" name="submit">Login</button>

            <div style='height:20px;'></div>

            <div id='admin_alert_modal'><img src='images/alert-sign.png' height='30px' width='30px' style='float:left;margin-right:5px;'><p id='admin-alert-words-modal'>Enter a password</p></div>
        </div>
        
        <div style='height:1px; width:100%;background-color:rgb(214,214,214);'></div>

        

        <div style='margin: 0 auto; width: 200px;'>
            <div style='height:20px;'></div>
            <a class='signup-button' href="signup.php">Signup</a>
        </div>

    </div>
</div>