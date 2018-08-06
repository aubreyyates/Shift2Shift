<div id="edit_main_modal" class="modal">
    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->
    <div class='centering-modal'>
        <div id='moveable_edit_main' class='moveable_modal'>
        
            <div id='moveable_edit_mainheader' class='modal_header'>
                <p class='modal_header_text'><?php echo $header; ?></p>
            </div>

            <div class='space20'>
            </div>
            <!-- Top Bar -->
            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>First Name</p>
            </div>
            
            <div style='height:30px;'>
                <input id="first_edit" value='<?php echo $first; ?>' style='padding: 0 0 0 4px; float:left; margin-left:20px;height:30px; width: 60%;' type=text id='start_submit'>
            </div>

            <div class='space20'>
            </div>
            <!-- Top Bar -->
            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>Last Name</p>
            </div>
            
            <div style='height:30px;'>
                <input id="last_edit" value='<?php echo $last; ?>' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 60%;' type=text id='start_submit'>
            </div>

            <div class='space20'>
            </div>
            <!-- Top Bar -->
            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>E-mail</p>
            </div>
            
            <div style='height:30px;'>
                <input id="email_edit" value='<?php echo $email; ?>' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 60%;' type=text id='start_submit'>
            </div>
    
            <div class='space20'>
            </div>

            <div style='height:54px;'>
                <button id='save_main' class='button-style-4-2 left'>Save
                </button>
            
                <button id='cancel_edit_main' class='button-style-4-2 left'>Cancel
                </button>
            </div>
        </div>
    </div>
</div>