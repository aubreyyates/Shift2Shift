<style>
    <?php include dirname(__DIR__).'/view-projects/view-projects.css'; ?>
</style>

    
    <div class='space70'></div>
        
    <div class='form_area wide-form'>
        <!-- Create the top bar that says Manage Projects -->
        <h3>Manage Projects</h3>

        <div class='divider'></div>
        
        <!-- <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Projects</h4>
            </div>
        </div> -->

        <div class='space20'  style=''>
        </div>
    
        <div class='box-create' style=' width:100%; height:62px;'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                
            <!-- Search form to search projects -->
            <!-- <form method='GET' > -->
                <button class='button-style-4 right' id='project-search' type='submit' style='float:right;margin-right:'>Search</button>
                <input class='searchbar-style-2' id='search-input' placeholder='Search projects'type='text' name='search'>
            <!-- </form> -->
         
            <!-- Button to add new projects -->
            <button id='add_button' class='button-style-4'>
                Add Project
            </button>
            
            
            <button id='all_button' class='button-style-5 right'>
                All
            </button>
            

            </div>
        </div>


        <div class='box-create' style='width:100%; height:90px;'>  
            <div id='top-bar' style='margin-left:20px;'>
  
            
                <!-- Button to make an export of the project -->
                <button class='button-style-4' style='float:left;' name='delete3' id='export'>
                    Export
                </button>

                <!-- Drop down menu to choose export type -->
                
                <select class='dropdown-style-3 left' id='export-type'>
                    <option value='csv'>csv</option>
                    <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option>
                </select>

                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Created</option>
                    <option>Alphabetical</option>
                </select>

                <div>
                    <h5 style='float:right; margin-right:20px; line-height:14px; padding:12px;'> sort by: </h5>
                </div>

            </div>
        </div>






        <!-- Begin PHP code -->
        <?php
            // Get the company id
            $org_id = $_SESSION['u_org_id'];

            // // Start the list div that contains results
            echo "<div id='list'>";

            echo "</div>";
            // ----- End list div -----

        ?>
        <!-- End php code -->

    </div>

        
        <?php
            //include "arrows_pagination.html";
        ?>

        <!-- <div id='tutorial_note_area' style="position:absolute; right:430px; top: 84px;width:300px; padding:20px; line-height:16px;text-align:left;">
            <div id="tutorial_note">

                <div id='tutorial_header'>
                    <p>
                    Tutorial
                    </p>   
                    <button id='exit_tutorial2' >
                        Exit Tutorial
                    </button>
                </div>



                <div class="tutorial_note2">
                    <span>
                        <p id='tut_words'>This box lets you search through projects. It will search by the name of the project.</p>
                    </span>
                </div>

                <div id='extra_space22' style='height:22px;'></div>

                <div class="tutorial_note3">
                    <button id='next_tut' class='tutorial_button'>Next</button>
                </div>
                <div id='right_arrow' style='float:right;margin-top:-92px;'>
                    <div class="tutorial_note_tip_right"></div>
                </div>
                <div id='left_arrow' style='display:none;float:left;margin-top:-92px;margin-left:-12px;'>
                    <div class="tutorial_note_tip_left"></div>
                </div>
                <div id='down_arrow' style='display:none;'>
                    <div class="tutorial_note_tip"></div>
                </div>


            </div>


        </div>

        <div id='tutorial_cont' style='position:absolute; left:25%; top: 120px;width:222px; padding:20px; line-height:16px;display:none;'>
            <div id="tutorial_alert" style=''>
                <div>
                    <div class="info_alert_tip_tutorial"></div>
                </div>
                <div class="info_alert_tutorial">
                    <span>
                        <p id="info_description_alert">Go back home to continue.</p>
                    </span>
                </div>
            </div>
        </div> -->










<!-- Add a moment format -->


<script>

    // $(document).ready(function readyDoc() {
        
    //     // Initialize variables 
    //     var clicked_project_id, input;
    //     // Default searching to false 
    //     var searching = false;
    //     // Create a canvas to measure string length in pixels
    //     var canvas = document.createElement('canvas');
    //     // Create a canvas
    //     var ctx = canvas.getContext("2d");
    //     // Set the font of canvas
    //     ctx.font = "12px Arial";
    //     // Set the current projects viewed
    //     vnum_s = 0;
    //     // Set the last project to view
    //     vnum_e = 25;  
    //     // Variable that can contain new objects for searching
    //     var search_objects = []   


    //     // Get all of the entries from the project
    //     $.post('load_projects_to_objects.php', function(result) {
    //         // Turn the result into JSON objects
    //         project = JSON.parse(result)
    //         // Go through each project
    //         for (i=0; i<project.length;i++) {
    //             if (project[i].total_time != "00:00:00") {
    //                 var seconds_moment = moment.duration(project[i].total_time);
    //                 var entry_avg = seconds_moment.asSeconds()/project[i].total_entries*1000
    //                 project[i].eaverage = moment.duration(entry_avg).format("HH:mm:ss");
    //             } else {
    //                 project[i].eaverage = "none";
    //             }
    //             // Sanitize the code, prevent XSS              
    //             project[i].description = DOMPurify.sanitize(project[i].description);
    //             project[i].date = DOMPurify.sanitize(project[i].date);
    //             project[i].job_code = DOMPurify.sanitize(project[i].job_code);
    //             project[i].project_name = DOMPurify.sanitize(project[i].project_name);

    //         }
    //         // Save the original object order
    //         project_original = project
    //         // Display all of these projects at the start of page
    //         display_all()
    //         // Check to see if you need to put arrows to view more projects
    //         if (project.length > 25) {
    //             // Display the foward arrow to view more
    //             $('#view-forward').css('display','inline')
    //         }
    //     })


    //     // Function to display all of the entries
    //     function display_all() {
    //         // Clear all projects
    //         $('#list').html('')
    //         // Stop displaying info box that show decription
    //         $('.info_project').css('display','none')
    //         // Check to see how far to make lines
    //         if (project.length > vnum_e) {
    //             // Set max view to num_e
    //             max_view = vnum_e
    //             // Set the pagination indicator
    //             $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
    //             // Check if they are viewing the first projects
    //             if (vnum_s == 0) {
    //                 // Stop displaying the backward arrow as there are no more to see
    //                 $('#view-backward').css('display','none')
    //             }
    //         } else {
    //             // Set max view to length of project
    //             max_view = project.length
    //             if (max_view == 0) {
    //                 // Put 0 account to view in the page
    //                 $("#pagination").text("0");
    //             } else {
    //             // Set the pagination indicator
    //             $('#pagination').text((vnum_s + 1) + " - " + project.length)
    //             // Stop displaying the foward arrow as there are no more to see
    //             $("#view-forward").css("display", "none");
    //             }
    //         }
    //         // Go through every entry
    //         for (i = vnum_s; i < max_view; i++) {
    //             // Get the html for the entry
    //             text = prepare_entry_line(project[i].project_name, project[i].id, project[i].description, project[i].date, project[i].job_code)
    //             // Put the entry on #list
    //             var entry = $('#list').append(text)
    //         }

    //     }

    //     function display_search() {
    //         // Clear all projects
    //         $('#list').html('')
    //         // Stop displaying info box that show decription
    //         $('.info_project').css('display','none')
    //         // Go through every entry
    //         for (i = 0; i < project.length; i++) {  
    //             // Check if the search is in the name
    //             if ( project[i].project_name.toLowerCase().includes(input.toLowerCase()) ) {
    //                 // Add to the search objects
    //                 search_objects.push(project[i])
    //             }
    //         }    
            
    //         // Check to see how far to make lines
    //         if (search_objects.length > vnum_e) {
    //             // Set max view to num_e
    //             max_view = vnum_e
    //             // Set the pagination indicator
    //             $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
    //             // Check if they are viewing the first projects
    //             if (vnum_s == 0) {
    //                 // Stop displaying the backward arrow as there are no more to see
    //                 $('#view-backward').css('display','none')
    //             }
    //         } else {
    //             // Set max view to length of project
    //             max_view = search_objects.length
    //             // Set the pagination indicator
    //             $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
    //             // Stop displaying the foward arrow as there are no more to see
    //             $('#view-forward').css('display','none')
    //             // Stop displaying the backward arrow as there are no more to see
    //             $('#view-backward').css('display','none')
    //         }
    //         // Go through every entry
    //         for (i = vnum_s; i < max_view; i++) {
    //             // Get the html for the entry
    //             text = prepare_entry_line(search_objects[i].project_name, search_objects[i].id, search_objects[i].description, search_objects[i].date, search_objects[i].job_code)
    //             // Put the entry on #list
    //             var entry = $('#list').append(text)
    //         }     
    //         // Reset the search objects 
    //         search_objects = []        
    //     }

    //     // Create the entry lines with html
    //     function prepare_entry_line(project_name, id, description, date, job_code) {
        
    //         // description = DOMPurify.sanitize(description);
    //         // date = DOMPurify.sanitize(date);
    //         // job_code = DOMPurify.sanitize(job_code);
            
    //         // Create the text needed to create an entry
    //         text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line' ><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
    //         // Creates more html
    //         text_2 = "</div><form method='GET' action='viewHours.php'><input type='hidden' name='project_id' value=" + id + "><button class='entry-button-style-2 selecting' type ='submit'>Select Project</button></form><button type='button' data-jobcode='" + job_code + "' data-project='" + project_name + "' data-date='" + date + "' data-description='" + description + "' value=" + id + " class='box-button entry-button-style-2 time_id' name='time_id'>Edit</button></div></div>";
    //         // Get the line data
    //         line_data =  "Project Name: " + project_name 
    //         // Get the length of the string in pixels
    //         var len = ctx.measureText(line_data).width;
    //         // Check if it is greater than 380
    //         if (len > 400) {
    //             // Keep removing letters until it is less than 375 pixels long
    //             while (len > 395) {
    //                 // Remove the last letter
    //                 line_data = line_data.substring(0, line_data.length - 1);
    //                 // Get the new length of string in pixels
    //                 len = ctx.measureText(line_data).width;
    //             }
    //             // Add dots at end
    //             line_data += "..."
    //             // Add a class to allow a float box 
    //             text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line' ><div id='entry_text' class='long_text' data-project='" + project_name+"' style='float:left;margin-left:12px;font-size:16px;'>"
    //         }

    //         text = text_1 + line_data + text_2
    //         // Return the text
    //         return text
    //     }

    //     $("#next_tut").click(function() {
    //         var tut = parseInt(sessionStorage.tutorialCount);
    //         tut += 1;
    //         sessionStorage.tutorialCount = tut;
    //         getTutorial();
    //     })


    //     // What happens if the sorting menu is changed
    //     $('#sorting').change(function() {
            
    //         // Check the sorting type is alphabetical
    //         if ($('#sorting').val() == 'Alphabetical') {
    //             // Sort alphabetically
    //             project = merge_alphabetical_project_name(project)
    //             // Check if they are searching
    //             if (searching == false) {
    //                 // Display every project
    //                 display_all()
    //             } else {
    //                 // Display the projects with the search term in them
    //                 display_search()
    //             }
    //         // Check if the sorting type is none
    //         } else if ($('#sorting').val() == 'Date Created') {
    //             // Set to orignal order
    //             project = project_original
    //             // Check if they are searching
    //             if (searching == false) {
    //                 // Display every project
    //                 display_all()
    //             } else {
    //                 // Display the projects with the search term in them
    //                 display_search()
    //             }
    //         }
    //     })

    //     if (sessionStorage.tutorialCount == 31){
    //         $('#tutorial_modal').css("display","block");
    //     }
    //     if (sessionStorage.tutorialCount) {
    //         if (sessionStorage.tutorialCount != "none") {
            
    //             if (
    //                 sessionStorage.tutorialCount > 31 &&
    //                 sessionStorage.tutorialCount < 36
    //             ) {
    //                 $("#tutorial_note").css("display", "block");
    //                 getTutorial()
    //                 display_all()
    //             }
    //         }
    //     }

        
    //     function getTutorial() {
            
    //         if (sessionStorage.tutorialCount == 33) {
                
    //             //
    //             $("#tutorial_note_area").css("top","56px")
    //             $("#tutorial_note_area").css("right","20px")
    //             $("#down_arrow").css("display","block");
    //             $("#down_arrow").css("margin-left","200px");
    //             $("#right_arrow").css("display","none");
    //             $("#extra_space22").css("display","none");
    //             $("#tut_words").text(
    //                 "This is where you can sort projects alphabetically, or by the they were date created."
    //             );
            
            
            
    //         } else if (sessionStorage.tutorialCount == 34) {
    //             $("#down_arrow").css("display","block");
    //             $("#right_arrow").css("display","none");
    //             $("#tutorial_note_area").css("top","40px")
    //             $("#tutorial_note_area").css("right","");
    //             $("#down_arrow").css("margin-left","28px");
    //             $("#extra_space22").css("display","none");
    //             $("#tut_words").text(
                    
    //                 "This is where you can export your projects to csv, excel, or pdf. It will export searches and in what ever order they are sorted."
    //             );
                
    //         } else if (sessionStorage.tutorialCount == 35) {
    //             $("#tutorial_note_area").css("top","104px")
    //             $("#down_arrow").css("display","none");
    //             $("#left_arrow").css("display","block");
    //             $("#right_arrow").css("display","none");
    //             $("#down_arrow").css("margin-left","28px");
    //             $("#extra_space22").css("display","none");
    //             $("#tutorial_note_area").css("margin-left","132px")
    //             $("#tut_words").text(
                    
    //                 "This button lets you create a new project. You can give it a name, start date, description, and a job code."
    //             );

                
    //         } else if (sessionStorage.tutorialCount == 36) {
    //             $("#tutorial_note_area").css("display","none")
    //             $("#tutorial_cont").css("display","block")
    //         }
            
            
            
            
            
            
    //             else if (sessionStorage.tutorialCount == 37) {
    //             $("#tutorial_note_area").css("display","none")
    //             $("#tutorial_cont").css("display","block")
                
    //         }
    //     }
        

    //     $("#continue_tutorial").click(function() {

    //         display_all()
    //         sessionStorage.tutorialCount = 32
    //         $("#tutorial_modal").css("display", "none");
    //         $("#tutorial_note").css("display", "block");
          
    //     });

    //     // What happens if you click the search button
    //     $( "#project-search" ).click(function() {
    //         // Set the current projects viewed
    //         vnum_s = 0;
    //         // Set the last project to view
    //         vnum_e = 25;
    //         // Get the search typed in
    //         input = $('#search-input').val()
    //         // Clear all projects
    //         $('#list').html('')
    //         // Display the all button
    //         $(document.getElementById('all_button')).css('display','block');
    //         // Display projects that have names like the search word
    //         display_search()
    //         // Set searching to true
    //         searching = true;
    //     })

    //     // When happens if a key on while on the search bar is pressed
    //     $("#search-input").keyup(function(event) {
    //         // Check if it was enter
    //         if (event.keyCode === 13) {
    //             // Set the current projects viewed
    //             vnum_s = 0;
    //             // Set the last project to view
    //             vnum_e = 25;
    //             // Get the search typed in
    //             input = $('#search-input').val()
    //             // Clear all projects
    //             $('#list').html('')
    //             // Display the all button
    //             $(document.getElementById('all_button')).css('display','block');
    //             // Display projects that have names like the search word
    //             display_search()
    //             // Set searching to true
    //             searching = true;
    //         }
    //     })

    //     // What happens if the all button is clicked
    //     $( "#all_button" ).click(function() {
    //         // Reset searching objects
    //         search_objects = []
    //         // Set the current projects viewed
    //         vnum_s = 0;
    //         // Set the last project to view
    //         vnum_e = 25;
    //         // Display all of these projects at the start of page
    //         display_all()
    //         // Stop displaying the all button
    //         $(document.getElementById('all_button')).css('display','none');
    //         // Set searching to false
    //         searching = false;
    //         // Check if there are more than 25 projects to show
    //         if (project.length > 25) {
    //             // Display the foward arrow to view more
    //             $('#view-forward').css('display','inline')
    //         }
    //     })

    //     // What happens if the arrow forward button is clicked
    //     $( "#view-forward" ).click(function() {
    //         // Display the back arrow to view previous
    //         $('#view-backward').css('display','inline')
    //         vnum_s += 25
    //         vnum_e += 25
    //         if (searching == false) {
    //             // Display all of these projects at the start of page
    //             display_all()
    //         } else {
    //             // Display the search
    //             display_search()
    //         }
    //     })
    //     // What happens if the arrow backward button is clicked
    //     $( "#view-backward" ).click(function() {
    //         // Display the foward arrow to view more
    //         $('#view-forward').css('display','inline')
    //         vnum_s -= 25
    //         vnum_e -= 25
    //         if (searching == false) {
    //             // Display all of these projects at the start of page
    //             display_all()
    //         } else {
    //             // Display the search
    //             display_search()
    //         }
    //     })

    //     // Happens if the add project button is clicked
    //     $( "#add_button" ).click(function() {
    //         // Display the myModal modal
    //         $(document.getElementById('myModal')).css('display','block');
            
    //     })

    //     // What happens if the cancel button is clicked on the add new project (myModal) 
    //     $( "#cancel" ).click(function() {
    //         // Stop displaying myModal
    //         $(document.getElementById('myModal')).css('display','none');
            
    //     })

    //     // What happens if the cancel button on the editing project modal (myModal2) is clicked
    //     $( "#cancel_edit_project" ).click(function() {
    //         // Stop displaying myModal2
    //         $(document.getElementById('myModal2')).css('display','none');
            
    //     })

    //     // What happens if the save button on the editing project modal (myModal2) is clicked
    //     $( "#save_edit_project" ).click(function() {
    //         // Get the new project name
    //         project_name = $("#project_name_edit").val()
    //         // Check to make sure the project name is not empty
    //         if (project_name != '') {
    //             // Check to make sure the project name is not empty
    //             if (project_name.length < 101) {
    //                 // Set the valid characters
    //                 var letterNumber = /^[0-9a-zA-Z\s]+$/;
    //                 // Check to make sure they use only letters and numbers in the project name
    //                 if (project_name.match(letterNumber)) {
    //                     // Set project_edit
    //                     project_edit = 'set'
    //                     // Get the project id
    //                     project_id = $("#project_id").val()
    //                     // Get the new date
    //                     date = $("#date_edit_project").val()
    //                     // Get the new description
    //                     description = $("#description_edit_project").val()
    //                     // Check description length
    //                     if (description.length > 250) {
    //                         // Let them know the description is too long
    //                         alert("Your description can't be more than 250 characters long.")
    //                         // Leave function
    //                         return;
    //                     }
    //                     // Get the new job code
    //                     job_code = $("#job_code_edit").val()
    //                     // Check job code length
    //                     if (job_code.length > 100) {
    //                         // Let them know the description is too long
    //                         alert("Your job code can't be more than 100 characters long. How is anyone ever going to remember it?!")
    //                         // Leave function
    //                         return;
    //                     }
    //                     // Sanitize any code they enter.
    //                     date = DOMPurify.sanitize(date);
    //                     description = DOMPurify.sanitize(description);
    //                     job_code = DOMPurify.sanitize(job_code);
                        
    //                     // Put the new info into the database
    //                     $.post('edit_project_info.php', {project_edit:project_id,project_id:project_id, project_name:project_name,date:date,description:description, job_code:job_code})
    //                     // Go through all the project objects
    //                     for (var i = 0; i < project.length; i++) {
    //                         // Check if the project
    //                         if (project[i].id == project_id) {
    //                             // Update the project object name
    //                             project[i].project_name = project_name;
    //                             // Update the project object date
    //                             project[i].date = date;
    //                             // Update the project object description
    //                             project[i].description = description;
    //                             // Update the project job code
    //                             project[i].job_code = job_code;
    //                             // Leave the i for loop
    //                             break;
    //                         }
    //                     }
                        
    //                     // Check if they are searching
    //                     if (searching == false) {
                            
    //                         // Display every project
    //                         display_all()
    //                     } else {
    //                         // Display the projects with the search term in them
    //                         display_search()
    //                     }
    //                     // Stop displaying myModal2
    //                     $(document.getElementById('myModal2')).css('display','none');
    //                 } else {
    //                     // Let the user know they need valid characters
    //                     alert("You can only use letters, numbers, and spaces in the project name.")
    //                 }
    //             } else {
    //             // Let the user know that their project needs a name
    //             alert("Your project name can't be more than 100 characters long. More than 100 characters would be really hard to remember!")
    //             }
    //         } else {
    //             // Let the user know that their project needs a name
    //             alert('Your project must at least have a name.')
    //         }
    //     })

    //     // What happens click the save button on the add project modal
    //     $( "#save_project" ).click(function() {
    //         // Get the project name
    //         project_name = $("#project_name").val()
    //         // Check to make sure the project name is not empty
    //         if (project_name != '') {
    //             // Check to make sure the project name is not empty
    //             if (project_name.length < 101) {
    //                 // Set the valid characters
    //                 var letterNumber = /^[0-9a-zA-Z\s]+$/;
    //                 // Check to make sure they use only letters and numbers in the project name
    //                 if (project_name.match(letterNumber)) {
    //                     // Set project_save
    //                     project_save= 'set'
    //                     // Get the date
    //                     date = $("#date").val()
    //                     // Get the description
    //                     description = $("#description").val()
    //                     // Check description length
    //                     if (description.length > 250) {
    //                         // Let them know the description is too long
    //                         alert("Your description can't be more than 250 characters long.")
    //                         // Leave function
    //                         return;
    //                     }
    //                     // Get the job code
    //                     job_code = $("#job_code").val()
    //                     // Check job code length
    //                     if (job_code.length > 100) {
    //                         // Let them know the description is too long
    //                         alert("Your job code can't be more than 100 characters long. How is anyone ever going to remember it?!")
    //                         // Leave function
    //                         return;
    //                     }
    //                     // Sanitize any code they enter.
    //                     date = DOMPurify.sanitize(date);
    //                     description = DOMPurify.sanitize(description);
    //                     job_code = DOMPurify.sanitize(job_code);
    //                     // Put the new info into the database
    //                     $.post('save_project_info.php', {project_save:project_save,project_name:project_name,date:date,description:description, job_code:job_code}, function(result){        
    //                         // Create a new project object
    //                         project_new = {id:result,project_name:project_name,date:date,description:description, job_code:job_code}
    //                         // Put the object into the JSON
    //                         project.push(project_new)
                            
    //                         // Display all the entries
                            
    //                         if (searching == false) {
    //                             // Display every project
    //                             display_all()
    //                             // Check if the number of projects is over 25, and your not on the last pages
    //                             if (project.length > 25 && project.length > vnum_e) {
    //                                 // Display the foward arrow to view more
    //                                 $('#view-forward').css('display','inline')
    //                             }
    //                         } else {
    //                             // Display the projects with the search term in them
    //                             display_search()
    //                             // Check if the number of projects in the search is over 25, and your not on the last pages
    //                             if (search_objects.length > 25 && search_objects.length > vnum_e) {
    //                                 // Display the foward arrow to view more
    //                                 $('#view-forward').css('display','inline')
    //                             }
    //                         }
    //                     })
    //                     // Stop displaying myModal
    //                     $(document.getElementById('myModal')).css('display','none'); 
    //                 } else {
    //                     // Let the user know they need valid characters
    //                     alert("You can only use letters, numbers, and spaces in the project name.")
    //                 } 
    //             } else {
    //             // Let the user know that their project needs a name
    //             alert("Your project name can't be more than 100 characters long. More than 100 characters would be really hard to remember!")
    //             }
    //         } else {
    //             // Let the user know that their project needs a name
    //             alert('Your project must at least have a name.')
    //         }
    //     })




    //     $("#export").click(function() {
    //         // Get the chosen export type
    //         export_type = $('#export-type').val()
    //         // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
    //         //filter = $('#filter-type').val()
    //         // Check the export type
    //         if (export_type == 'csv') {

    //             // Convert JSON to CSV 
    //             csvFirstLine = 'Id, Date, Description, Project Name, Job Code, Total Entries, Total Time, Total Employees Who Worked, Average Entry Time\r\n'
                
    //             if (searching == false) {
    //                 csvContent = ConvertToCSV(project)
    //             } else {
    //                 csvContent = ConvertToCSV_search(project)
    //             }

    //             csvContent = csvFirstLine + csvContent

    //             var blob = new Blob([csvContent]);
    //             if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
    //                 window.navigator.msSaveBlob(blob, "projects_data.csv");
    //             else
    //             {
    //                 var a = window.document.createElement("a");
    //                 a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
    //                 a.download = "projects_data.csv";
    //                 document.body.appendChild(a);
    //                 a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
    //                 document.body.removeChild(a);
    //             }
            

    //         } else if (export_type == 'excel') {

                        
    //             var excel = $JExcel.new("Calibri light 10 #333333");            
    //             excel.set( {sheet:0,value:"Projects Data" } );
    //             var evenRow=excel.addStyle( { border: "none,none,none,thin #333333"});        
    //             var oddRow=excel.addStyle ( { fill: "#ECECEC" ,border: "none,none,none,thin #333333"}); 
    //             for (var i=1;i<project.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });  
                                   
                 
    //             var headers=["ID","Project Name","Date","Description","Job Code"];                            
    //             var formatHeader=excel.addStyle ( {
    //                 border: "none,none,none,thin #333333",font: "Calibri 12 #0000AA B"}
    //             );                                                         
                
    //             for (var i=0;i<headers.length;i++){              // Loop headers
    //                 excel.set(0,i,0,headers[i],formatHeader);    // Set CELL header text & header format
    //                 excel.set(0,i,undefined,"auto");             // Set COLUMN width to auto 
    //             }

    //             var dStyle = excel.addStyle ( {                       
    //                 align: "R",                                                                                                                                             
    //                 font: "#00AA00"}
    //             );                                                                         
    //             if (searching == false) {
    //                 for (var i=0;i<project.length;i++){                                    
    //                     excel.set(0,0,i + 1,project[i].id);                                  
    //                     excel.set(0,1,i + 1,project[i].project_name);                  
    //                     excel.set(0,2,i + 1,project[i].date);          
    //                     excel.set(0,3,i + 1,project[i].description);   
    //                     excel.set(0,4,i + 1,project[i].job_code);                   
    //                 }
    //             } else {
    //                 for (var i=0;i<project.length;i++){   
    //                     if (project[i].project_name.toLowerCase().includes(input.toLowerCase())) {                               
    //                         excel.set(0,0,i + 1,project[i].id);                                  
    //                         excel.set(0,1,i + 1,project[i].project_name);                  
    //                         excel.set(0,2,i + 1,project[i].date);          
    //                         excel.set(0,3,i + 1,project[i].description);   
    //                         excel.set(0,4,i + 1,project[i].job_code);  
    //                     }                 
    //                 }
    //             }
                
    //             excel.set(0,1,undefined,30);                                // Set COLUMN B to 30 chars width
    //             excel.set(0,2,undefined,36);                                
    //             excel.set(0,3,undefined,70);                               // Set COLUMN D to 70 chars width

    //             excel.generate("project_data.xlsx");
    //         } else if (export_type == 'pdf') {


    //             var doc = new jsPDF()
    //             doc.setFontSize(8);
    //             doc.text('ID', 10, 10)
    //             doc.text('Project Name', 25, 10)
    //             doc.text('Date', 70, 10)
    //             doc.text('Description', 90, 10)
    //             doc.text('Job Code', 160, 10)
    //             if (searching == false) {
    //                 for (var i=0;i<project.length;i++){                               
    //                     doc.text(project[i].id, 10,i*5+20)                                  
    //                     doc.text(project[i].project_name, 25,i*5+20)
    //                     doc.text(project[i].date.substring(0,10), 70,i*5+20)  
    //                     doc.text(project[i].description, 90,i*5+20)  
    //                     doc.text(project[i].job_code, 160,i*5+20)            
    //                 }
    //             } else {
    //                 j = 0
    //                 for (var i=0;i<project.length;i++){ 
    //                     if (project[i].project_name.toLowerCase().includes(input.toLowerCase())) { 
    //                         doc.text(project[i].id, 10,i*5+20-j*5)                                  
    //                         doc.text(project[i].project_name, 25,i*5+20-j*5)
    //                         doc.text(project[i].date.substring(0,10), 70,i*5+20-j*5)  
    //                         doc.text(project[i].description, 90,i*5+20-j*5)  
    //                         doc.text(project[i].job_code, 160,i*5+20-j*5)    
    //                     } else {
    //                         j += 1;
    //                     }        
    //                 }
    //             }


    //             doc.save('projects_data.pdf')




                
    //         }
    //     })

    //     // JSON to CSV Converter
    //     function ConvertToCSV(objArray) {
    //         var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    //         var str = '';

    //         for (var i = 0; i < array.length; i++) {
    //             var line = '';
    //             for (var index in array[i]) {
    //                 if (line != '') line += ','

    //                 line += array[i][index];
    //             }

    //             str += line + '\r\n';
    //         }

    //         return str;
    //     }
    //     // JSON to CSV Converter
    //     function ConvertToCSV_search(objArray) {
    //         var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    //         var str = '';

    //         for (var i = 0; i < array.length; i++) {
    //             if ( array[i].project_name.toLowerCase().includes(input.toLowerCase()) ) {
    //                 var line = '';
    //                 for (var index in array[i]) {
    //                     if (line != '') line += ','

    //                     line += array[i][index];
    //                 }

    //                 str += line + '\r\n';
    //             }
    //         }

    //         return str;
    //     }

    //     $( ".info_project" ).click(function() {
    //         //
    //         $('.info_project').css('display','none');
    //     })

    //     // What happens if the data button is clicked
    //     $( "#data_button" ).click(function() {
    //         // Display the data modal
    //         $(document.getElementById('data_modal')).css('display','block');
    //     })

    //     // What happens if the exit button is clicked
    //     $( "#exit_data" ).click(function() {
              
    //         $(document.getElementById('data_modal')).css('display','none');
            
    //     })
    //     // What happens if you click outside the add project modal
    //     $( "#outside_modal" ).click(function() {
    //         // Stop displaying myModal
    //         $(document.getElementById('myModal')).css('display','none');
            
    //     })
    //     // What happens if you click outside the edit project modal
    //     $( "#outside_modal_edit" ).click(function() {
    //         // Stop displaying myModal2
    //         $(document.getElementById('myModal2')).css('display','none');
            
    //     })
    //     // What happens if you click outside the edit project modal
    //     $( "#outside_modal_data" ).click(function() {
    //         // Stop displaying data_modal
    //         $(document.getElementById('data_modal')).css('display','none');
            
    //     })


    //     //Make the DIV element draggagle, makes myModal draggable :
    //     dragElement(document.getElementById(("movable_add")));
    //     //Make the DIV element draggagle, makes myModal2 draggable :
    //     dragElement(document.getElementById(("moveable_edit")));
    //     //Make the DIV element draggagle, makes data_modal draggable :
    //     dragElement(document.getElementById(("movable_data")));

    //     function dragElement(elmnt) {
    //     var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    //     if (document.getElementById(elmnt.id + "header")) {
    //         /* if present, the header is where you move the DIV from:*/
    //         document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    //     } else {
    //         /* otherwise, move the DIV from anywhere inside the DIV:*/
    //         elmnt.onmousedown = dragMouseDown;
    //     }

    //     function dragMouseDown(e) {
    //         e = e || window.event;
    //         // get the mouse cursor position at startup:
    //         pos3 = e.clientX;
    //         pos4 = e.clientY;
    //         document.onmouseup = closeDragElement;
    //         // call a function whenever the cursor moves:
    //         document.onmousemove = elementDrag;
    //     }

    //     function elementDrag(e) {
    //         e = e || window.event;
    //         // calculate the new cursor position:
    //         pos1 = pos3 - e.clientX;
    //         pos2 = pos4 - e.clientY;
    //         pos3 = e.clientX;
    //         pos4 = e.clientY;
    //         // set the element's new position:
    //         elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    //         elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    //     }

    //     function closeDragElement() {
    //         /* stop moving when mouse button is released:*/
    //         document.onmouseup = null;
    //         document.onmousemove = null;
    //     }
    //     }



    // });


    // $("#list").on("mouseenter", '.entry-button-style-2', function () {
    //     $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    // });
    // $("#list").on("mouseleave", '.entry-button-style-2', function () {
    //     $(this).parent().css( "background-color", "rgb(197, 239, 255)" ); 
    // });
    // $("#list").on("mouseenter", '.selecting', function () {
    //     $(this).parent().parent().css( "background-color", "rgb(144, 223, 255)" ); 
    // });
    // $("#list").on("mouseleave", '.selecting', function () {
    //     $(this).parent().parent().css( "background-color", "rgb(197, 239, 255)" ); 
    // });
    // $("#list").on("mouseleave", '.entry_line', function () {
    //     $(this).css( "background-color", "rgb(144, 223, 255)" ); 
    // });
    // $("#list").on("mouseenter", '.entry_line', function () {
    //     $(this).css( "background-color", "rgb(197, 239, 255)" ); 
    // });


    // // What happens when an edit button on one of the projects in clicked
    // $('#list').on('click', '.box-button' , function(){
    //     // Display the myModal2 modal
    //     $(document.getElementById('myModal2')).css('display','block');
    //     // Get the id of the edited project
    //     clicked_project_id = $(this).val();
    //     // Get the name of the edited project
    //     clicked_project_name = $(this).attr("data-project");
    //     // Get the date of the edited project
    //     clicked_project_date = $(this).attr("data-date");
    //     // Get the job code of the edited project
    //     clicked_project_jobcode = $(this).attr("data-jobcode");
    //     // Get the description of the edited project
    //     clicked_project_description = $(this).attr("data-description");
    //     // Get the first 10 characters of the clicked_project_date string
    //     format_date = clicked_project_date.slice(0, 10);
    //     // Prefill the edit project modal with the current name
    //     $("#project_name_edit").val(clicked_project_name)
    //     // Prefill the project with the current chosen date
    //     $("#date_edit_project").val(format_date)
    //     // Put the projects id into the form needed to update the project
    //     $("#project_id").val(clicked_project_id)
    //     // Prefill the project the current description
    //     $("#description_edit_project").val(clicked_project_description)  
    //     // Prefill the project the current description
    //     $("#job_code_edit").val(clicked_project_jobcode)
    //     // Stop displaying info box that show decription
    //     $('.info_project').css('display','none')
    //     // Prevent entry line from activating 
    //     stopPropagation() 
    // })
    // $("#list").on("click", '.entry-button-style-2', function () {
    //     // Prevent entry line from activating 
    //     stopPropagation() 
    // });

    // // What happens when an edit button on one of the projects in clicked
    // $('#list').on('click', '.entry_line' , function() {
    //     description = $(this).children( ".box-button" ).data('description')

    //     $('#info_description').text(description)
    //     $('.info_project').css('display','none')     
    //     var offset = $(this).offset();	
    //     /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
    //     var topOffset = $(this).offset().top;
    //     /*set the position of the info element*/
    //     $(".info_project").css({
    //         position: "absolute",
    //         top: (topOffset)+ "px",
    //         left: (offset.left-323) + "px",
    //     });
    //     $('.info_project').css('display','block')
    // })

    // // What happens when an edit button on one of the projects in clicked
    // $('#list').on('mouseenter', '.long_text' , function() {
        
    //     project_name = $(this).data('project')

    //     $('#info_description_long').text("Project Name: " + project_name)   
    //     // Get the height
    //     height = $('.show_long_text').height() 

    //     var offset = $(this).offset();	
    //     /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
    //     var topOffset = $(this).offset().top;
    //     /*set the position of the info element*/
    //     $(".show_long_text").css({
    //         position: "absolute",
    //         top: (topOffset - height)+ "px",
    //         left: (offset.left) + "px",
    //     });
    //     $('.show_long_text').css('display','block')
    // })
    // // What happens when an edit button on one of the projects in clicked
    // $('#list').on('mouseleave', '.long_text' , function() {
    //     $('.show_long_text').css('display','none')
    // })

</script>












