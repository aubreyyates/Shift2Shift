<body>
    <!-- Start the header -->
    <header>
        <nav>
            <div id='desktop' style='width:90%; margin:0 auto;'>

                <ul>
                    <!-- The home button to go back to the home page which is index.php -->
                    <li><a href="index.php">Home</a></li>
                </ul>      

                <div class="nav-login">
                    <div style="float:right;">
                        <form id='account-login' action ="includes/elogin.inc.php" method="POST">     
                            <input id ='input2' type="text" name="uid" placeholder="Username/email">
                            <input id='pwd2' type="password" name="pwd" placeholder="Password">
                        </form>
                        <button id='submit-form-login' name="submit">Login</button>
                        <a href="signup.php">Signup</a>
                    </div>

                    <div id="header-spacing">
                        <div id="login-alert">
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

            <div id='tablet-mobile'>
                <button id='hamburger'><p class='fa fa-bars'></p></button>
            </div>
        </nav>
    </header>