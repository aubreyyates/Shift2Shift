<!-- Modal When edit button on a project is clicked -->
<div id="myModal2" class="modal" style='background-color:transparent;'>
    <div id='outside_modal_edit' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
    <!-- Modal content -->
    <div class='centering-modal'>
        <div style='line-height:20px;' id='moveable_edit' class='moveable_modal'>
        
            <div id='moveable_editheader' class='modal_header'>
                <p class='modal_header_text'>Edit Project</p>
            </div>

            <div class='space20'>
            </div>

            <!-- Top Bar -->
            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>Enter Project Name</p>
            </div>

            
            <div class='space34'>
                <input form ='edit_form' id="project_name_edit" value='<?php echo $project_name; ?>' name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:30px; width: 60%;' type=text id='start_submit'>
            </div>

            <div class='space20'>
            </div>

            <div class='space20'>
                <p style='float:left;padding:0;margin-left:20px;'>Date Start</p>
            </div>

            <div style='height:34px; margin-left:20px;'>  
                <input type='date' value='<?php echo $date; ?>'  id='date_edit_project' name='date' style='float:left;width: 300px;height: 30px;'>
                <input type='hidden' value='' name='pid' id='project_id'>
                <button id='save_edit_project' name='project_edit' class='button-style-4-2 left'>Save</button>
                <button id='cancel_edit_project' class='button-style-4-2 left button-color-gray'
                    >Cancel</button>
            </div>

            <div class='space20'>
            </div>

            <div style='height:20px; margin-left:20px;'>
                <p style='float:left;padding:0'>Description</p>
            </div>
            
            <div style='height:66px; margin-left:20px;'>
                <textarea id='description_edit_project' name='description_edit' style='resize: none;width:656px; float:left; height:60px; '><?php echo $description;?></textarea>
            </div>

            <div class='space20'>
            </div>

            <div style='height:20px; margin-left:20px;'>
                <p style='float:left;padding:0;'>Job Code</p>
            </div>
            
            <div style='height:54px; margin-left:20px;'>
                <input id='job_code_edit' type='text' value='<?php echo $job_code; ?>' name='job_code_edit' style='float:left;width: 300px;height: 30px;'>
            </div>
        </div>
    </div>
</div>