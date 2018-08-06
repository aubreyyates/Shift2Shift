<!-- Notifications modal to see messages -->
<div id='notificationsModal' class='modal'>

    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->

    <div class='centering-modal-2'>
        <div class='moveable_modal_2' id='movable_notificationsModal'>

            
            <div id='movable_notificationsModalheader' class='modal_header'>
                <p class='modal_header_text'>Notifications</p>
            </div>

            <div style='height:20px;'>
            </div>

            <div id='messages-list'>

            </div>

            <div class='space20'>
            </div>


            <?php ?>
            <div style='height:50px; margin-left:20px;margin-top:0px;'>
                <button id='all_notifications' style='width: 150px;

                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>All Notifications</button>

                <button id='cancel' style='width: 150px;
                    margin-left:20px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
            </div>
        </div>
    </div>
</div>




       
<div id='notificationsModal_all' class='modal'>

    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->

    <div class='centering-modal-2'>
        <div class='moveable_modal_2' id='movable_notificationsallModal'>
        
            <div id='movable_notificationsallModalheader' class='modal_header'>
                <p class='modal_header_text'>All Notifications</p>
            </div>

            <div style='height:20px;'>
            </div>

            <div id='messages-list-all'>
            </div>
            

            <div class='space20'>
            </div>

            <div style='height:50px; margin-left:20px;'>
                <button id='new_notifications' style='width: 150px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>New Notifications</button>

                <button id='exit_all_notifications' style='width: 100px;
                    margin-left:20px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
            </div>
        </div>
    </div>
</div>



<div id='account_modal' class='modal' style='background-color:transparent;'>

    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->

    <div class='centering-modal'>
        <div style="width:700px;" class='moveable_modal' id='account_move'>

            <div id='account_moveheader' class='modal_header'>
                <p class='modal_header_text'>Account</p>
            </div>

            <div class='space20'>
            </div>

            <div style='height:20px;padding-left:20px;'>
                <p style='float:left;padding:0;'>Promo Code</p>
                <input class='input_index' value=''  type=text>
            </div>

            <div class='space20'>
            </div>

            <div style='height:20px;padding-left:20px;'>
                <p style='float:left;padding:0;'>Cancel Payment</p>
                <input class='input_index' value=''  type=text>
            </div>

            <div class='space20'>
            </div>

            <div style='height:20px;padding-left:20px;'>
                <p style='float:left;padding:0;'>Credit Card</p>
                <input class='input_index' value=''  type=text>
            </div>

            <div class='space20'>
            </div>

            <div style='height:54px;'>
                <button id='exit_account_modal' style='width: 150px;
                    
                    margin-left:20px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
                <button id='save_account_modal' style='width: 150px;
                    
                    margin-left:20px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Save
                </button>
            </div>
        </div>
    </div>
</div>




<div id='settingsModal' class='modal'>

    <div style='display:block;' class='outside_of_modal'></div>

    <!-- Modal content -->
    <div class='centering-modal'>

        <div class='moveable_modal' id='settings_move'>
    
            <div id='settings_moveheader' class='modal_header'>
                <p class='modal_header_text'>Settings</p>
            </div>

            <div style='float:left;'>
                <div  id='company_info_button'style='height:34px;'>
                    <button class='setting_button' style='width: 180px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Company Info
                    </button>
                </div>

                <div  id='company_notifications_button' style='height:34px;'>
                    <button class='setting_button' id='' style='width: 180px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Notifications
                    </button>
                </div>

                <div  id='company_permisions_button' style='height:34px;'>
                    <button class='setting_button' id='' style='width: 180px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Permisions
                    </button>
                </div>
            </div>
        
        <div style='float:right;'>
            <div id='company_info' style='width:516px; height:154px; background-color:#fff; border: 2px solid black;'>
                <div style='height:35px;'>
                    <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Company Name</p>
                        <?php 
                            echo "<input id='company_name' value='$org_name' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type=text>";
                        ?>
                </div>


                <div style='height:35px; margin-left:20px;'>
                    <p style='float:left;padding:0; margin-top:5px;'>Company Website</p>
                        <?php
                            if ($org_website == null) {
                                echo "<input id='company_website' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type=text>";
                            } else {
                                echo "<input id='company_website' value='$org_website' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type=text>";
                            }
                            
                        ?>
                </div>

                <div style='height:35px; margin-left:20px;'>
                    <p style='float:left;padding:0; margin-top:5px;'>Company Color</p>
                        <?php
                            echo "<input id='company_color' value='$org_color' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type='color'>";
                        ?>
                </div>
            </div>
            
            <div id='company_notifications' style='display:none;width:516px; height:134px; background-color:#fff; border: 2px solid black;'>
                <div style='height:35px;'>
                    
                    <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Notify Employees when to work over phone: </p>
                    

                    <input name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>
                    <p style='float:left;padding:0; margin-left:20px;margin-top:5px;'>(Coming Soon) </p>
                </div>
            </div>

            <div id='company_permisions' style='display:none;width:516px; height:134px; background-color:#fff; border: 2px solid black;'>
                <div style='height:35px;'>
                    <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Let Employees edit time: </p>
                        <?php
                            if ($allow_employee_edit == 'yes') {
                                echo "<input value='true' id='employee_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit' checked>";
                            } else {
                                echo "<input value='true' id='employee_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>";
                            }
                        ?>
                </div>
                <div style='height:35px;'>
                    <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Let Managers edit time: </p>
                        <?php
                            if ($allow_manager_edit == 'yes') {
                                echo "<input value='true' id='manager_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit' checked>";
                            } else {
                                echo "<input value='true' id='manager_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>";
                            }
                        ?>
                    
                </div>
            </div>
        </div>

        




            <div style='height:74px;float:right;'>
                <div class='space20'></div>
                <button id='save_settings' class='button-style-4-2 right'>Save
                </button>
                <button id='cancel_settings' class='button-style-4-2 right'>Exit
                </button>
            </div>
        </div>
    </div>
</div>