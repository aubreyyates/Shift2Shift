<?php
    // Check to see if a project was just deleted
    if (isset($_SESSION['just_deleted_employee'])) {
        // Get the value 
        $result = $_SESSION['just_deleted_employee'];
        // Check to see if it is set to true
        if ($result == 'true') {

            echo "
                <div class='disappear_modal' style='position:absolute;margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;top:80px;width:400px; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <p style=' margin-left:130px; line-height:50px;'>EMPLOYEE DELETED</p>
                </div>
            ";
        }
        // Unset the session variable so it doesn't pop up another message
        unset($_SESSION['just_deleted_employee']);   
    }
?>
    
    <div class="main-wrapper">
        

    <div class='shadow'>

        <!-- Displays the page name -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Employees</h4>
            </div>
        </div>


        <?php 
            $search_place='Search Employees';
            $link_new = 'eaccount.php';
            $button_name = 'Add Employee';
            //include "search_area.php"
        ?>


<div class='space20' style=' background-color:rgb(247, 247, 247);'></div>

<!-- Create 1st row 120px: 2 buttons 1 input box 1 hidden button -->
<div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247);'>
    <div style='margin-left:20px;'>
        
        <!-- Create a search form to search E-mails of managers -->
        <!-- <form id='search-form' method='GET'> -->
            <!-- Create the button to run search -->
            <button id='account-search' type='submit' class='button-style-4 right'>Search</button>
            <!-- Create input box to entry search term -->
            <input id='search-input' class='searchbar-style-2'placeholder='<?php echo $search_place; ?>'type='text' >
        <!-- </form> -->

        <button id='all_button' class='button-style-5 right'>
            All
        </button>

        <!-- Create button to go to create another manager page -->
        <a class='button-style-4' style='height:38px;'  href='<?php echo $link_new; ?>'><?php echo $button_name; ?></a>

    </div>
</div>


<div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  
    <div id='top-bar' style='margin-left:20px;'>

        <!-- Button to make an export of the employees -->
        <button id='export' class='button-style-4' type='submit' name='delete3' id='export' style='float:left;'>
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
            <option>Last</option>
            <option>First</option>
            <option>E-mail</option>
        </select>

        <div>
            <h5 style='float:right; margin-right:20px; line-height:14px; padding:12px;'> sort by: </h5>
        </div>
    </div>
</div>

<!-- <div class='divider'></div>

<div class='space20' style=' background-color:rgb(247, 247, 247);'></div> -->

        <!-- Start the php code -->
        <?php

            // Get the org id
            $org_id =  $_SESSION['u_org_id'];
        ?>
        <!-- End php code -->



        <!-- Start the list div -->
        <div id='list'>
            
            
        </div>
         <!-- End list div -->
         

        </div>

    <?php
        //include "arrows_pagination.html";
    ?>

    <div id='tutorial_note_area' style="position:absolute; right:430px; top: 100px;width:300px; padding:20px; line-height:16px;text-align:left;">
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
                    <p id='tut_words'>This box lets your search for employees. It will search by E-mail.</p>
                </span>
            </div>

            <div id='extra_space22' style='height:22px;'></div>

            <div class="tutorial_note3">
                <button id='next_tut' class='tutorial_button'>Next</button>
            </div>
            <div id='right_arrow' style='float:right;margin-top:-92px;'>
                <div class="tutorial_note_tip_right"></div>
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
    </div>

    </div>

<!-- End main part of page -->


<!-- Add a moment format -->
<script src="duration_format.js"></script>
<!-- javascript library to make pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<!-- javascript library to zip files -->
<script type="text/javascript" src="jszip.js"></script>
<!-- javascript library to save files -->
<script type="text/javascript" src="FileSaver.js"></script>
<!-- javascript library to make excel files -->
<script type="text/javascript" src="myexcel.js"></script>
<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>
<!-- Put in functions important for pages with accounts -->
<script type="text/javascript" src="account_page_functions.js"></script>

<script>


    // // Initialize variables
    // var shift2shift_globalv1 = {};
    // // Put input property
    // shift2shift_globalv1.input = '';
    // // Default searching to false 
    // shift2shift_globalv1.searching = false;
    // // Create a canvas to measure string length in pixels
    // shift2shift_globalv1.canvas = document.createElement('canvas');
    // // Create a canvas
    // shift2shift_globalv1.ctx = shift2shift_globalv1.canvas.getContext("2d");
    // // Set the font of canvas
    // shift2shift_globalv1.ctx.font = "12px Arial";
    // // Set the current projects viewed
    // shift2shift_globalv1.vnum_s = 0;
    // // Set the last project to view
    // shift2shift_globalv1.vnum_e = 25;  
    // // Variable that can contain new objects for searching
    // shift2shift_globalv1.search_objects = []  
    // // Create accounts
    // shift2shift_globalv1.accounts = []
    // // Set the type of page for file exporting
    // shift2shift_globalv1.page = "employees_data";
            
    // // When the page is ready, do this
    // $(document).ready(function() {
    

    //     // Get all of the entries from the project
    //     $.post('load_employees_to_objects.php', function(result) {
    //         // Turn the result into JSON objects
    //         shift2shift_globalv1.accounts = JSON.parse(result)
    //         // Go through each employee
    //         for (i=0; i<shift2shift_globalv1.accounts.length;i++) {
                
    //             if (shift2shift_globalv1.accounts[i].total_time != "00:00:00") {
    //                 var seconds_moment = moment.duration(shift2shift_globalv1.accounts[i].total_time);
    //                 var seconds = seconds_moment.asSeconds()/shift2shift_globalv1.accounts[i].days_worked*1000
    //                 var entry_avg = seconds_moment.asSeconds()/shift2shift_globalv1.accounts[i].total_entries*1000
    //                 shift2shift_globalv1.accounts[i].average = moment.duration(seconds).format("HH:mm:ss");
    //                 shift2shift_globalv1.accounts[i].eaverage = moment.duration(entry_avg).format("HH:mm:ss");
    //             } else {
    //                 shift2shift_globalv1.accounts[i].average = "none";
    //                 shift2shift_globalv1.accounts[i].eaverage = "none";
    //             }

    //             // Sanitize the code, prevent XSS              
    //             shift2shift_globalv1.accounts[i].first = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].first);
    //             shift2shift_globalv1.accounts[i].last = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].last);
    //             shift2shift_globalv1.accounts[i].email = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].email);
    //         }  
    //         // Save the original object order
    //         accounts_original = shift2shift_globalv1.accounts        
    //         // Display all of these projects at the start of page
    //         display_all()
            
    //         // Check to see if you need to put arrows to view more projects
    //         if (shift2shift_globalv1.accounts.length > 25) {
    //             // Display the foward arrow to view more
    //             $('#view-forward').css('display','inline')
    //         }
    //     })





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
    //     // What happens if you click outside the edit project modal
    //     $( "#outside_modal_data" ).click(function() {
    //         // Stop displaying data_modal
    //         $(document.getElementById('data_modal')).css('display','none');
            
    //     })
    //     $("#exit_tutorial").click(function() {
    //         $("#tutorial_modal").css("display", "none");
    //         sessionStorage.tutorialCount = "none";
    //     });
    //     $( "#exit_tutorial2" ).click(function() {
    //         //
    //         $('#tutorial_note_area').css('display','none');
    //         //
    //         sessionStorage.tutorialCount = 'none';
    //     })
    //     if (sessionStorage.tutorialCount == 16){
    //         $('#tutorial_modal').css("display","block");
    //     }
       
    //     if (sessionStorage.tutorialCount) {
            
    //         if (sessionStorage.tutorialCount != "none") {
            
    //             if (
    //                 sessionStorage.tutorialCount > 16 &&
    //                 sessionStorage.tutorialCount < 21
    //             ) {
                    
    //                 $("#tutorial_note").css("display", "block");
    //                 getTutorial()
    //                 var emp1 = {first:"Jake",last:"Example",email:"jake@example.com"}
    //                 var emp2 = {first:"Ashley",last:"Example",email:"ashley@example.com"}
    //                 shift2shift_globalv1.accounts = [];
    //                 shift2shift_globalv1.accounts.push(emp1)
    //                 shift2shift_globalv1.accounts.push(emp2)
    //                 display_all()
    //             }
    //         }
    //     }
    //     $("#next_tut").click(function() {
    //         var tut = parseInt(sessionStorage.tutorialCount);
    //         tut += 1;
    //         sessionStorage.tutorialCount = tut;
    //         getTutorial();
    //     })

    //     function getTutorial() {

    //         if (sessionStorage.tutorialCount == 18) {
                
    //             //
    //             $("#tutorial_note_area").css("top","54px")
    //             $("#tutorial_note_area").css("right","20px")
    //             $("#down_arrow").css("display","block");
    //             $("#down_arrow").css("margin-left","200px");
    //             $("#right_arrow").css("display","none");
    //             $("#extra_space22").css("display","none");
    //             $("#tut_words").text(
    //                 "This is where you can sort your employees by first name, last name or E-mail."
    //             );
            
            
            
            
    //         } else if (sessionStorage.tutorialCount == 19) {
    //             $("#tutorial_note_area").css("top","38px")
    //             $("#tutorial_note_area").css("right","");
    //             $("#down_arrow").css("margin-left","28px");

    //             $("#tut_words").text(
                    
    //                 "This is where you can export your employees to csv, excel, or pdf. It will export searches and in what ever order they are sorted."
    //             );
                
    //             // $("#tutorial_note_area").css("margin-left","300px")
    //         } else if (sessionStorage.tutorialCount == 20) {
    //             $("#tutorial_note_area").css("display","none")
    //             $("#tutorial_cont").css("display","block")
                
    //         }
    //     }


    //     $("#continue_tutorial").click(function() {
    //         var emp1 = {first:"Jake",last:"Example",email:"jake@example.com"}
    //         var emp2 = {first:"Ashley",last:"Example",email:"ashley@example.com"}
    //         shift2shift_globalv1.accounts = [];
    //         shift2shift_globalv1.accounts.push(emp1)
    //         shift2shift_globalv1.accounts.push(emp2)
    //         display_all()
    //         sessionStorage.tutorialCount = 17
    //         $("#tutorial_modal").css("display", "none");
    //         $("#tutorial_note").css("display", "block");
          
    //     });


    //             //Make the DIV element draggagle, makes data_modal draggable :
    //             dragElement(document.getElementById(("movable_data")));

    //         function dragElement(elmnt) {
    //         var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    //         if (document.getElementById(elmnt.id + "header")) {
    //             /* if present, the header is where you move the DIV from:*/
    //             document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
    //         } else {
    //             /* otherwise, move the DIV from anywhere inside the DIV:*/
    //             elmnt.onmousedown = dragMouseDown;
    //         }

    //         function dragMouseDown(e) {
    //             e = e || window.event;
    //             // get the mouse cursor position at startup:
    //             pos3 = e.clientX;
    //             pos4 = e.clientY;
    //             document.onmouseup = closeDragElement;
    //             // call a function whenever the cursor moves:
    //             document.onmousemove = elementDrag;
    //         }

    //         function elementDrag(e) {
    //             e = e || window.event;
    //             // calculate the new cursor position:
    //             pos1 = pos3 - e.clientX;
    //             pos2 = pos4 - e.clientY;
    //             pos3 = e.clientX;
    //             pos4 = e.clientY;
    //             // set the element's new position:
    //             elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    //             elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
    //         }

    //         function closeDragElement() {
    //             /* stop moving when mouse button is released:*/
    //             document.onmouseup = null;
    //             document.onmousemove = null;
    //         }
    //         }

    // });
    // // End document.ready

    // // Create the entry lines with html
    // function prepare_entry_line(first, last, id, email) {    
    //     // Create the text needed to create an entry
    //     var text_1 = "<div class='entry_template'> <div id='entry_box' data-email='" + email + "'class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
    //     // Get the line data
    //     var line_data =  "First Name: " + first + " | Last Name: " + last + " | Email: " + email
    //     // Get the length of the string in pixels
    //     var len = shift2shift_globalv1.ctx.measureText(line_data).width;
    //     // Check if it is greater than 425
    //     if (len > 425) {
    //         // Keep removing letters until it is less than 420 pixels long
    //         while (len > 420) {
    //             // Remove the last letter
    //             line_data = line_data.substring(0, line_data.length - 1);
    //             // Get the new length of string in pixels
    //             len = shift2shift_globalv1.ctx.measureText(line_data).width;
    //         }
    //         // Add dots at end
    //         line_data += "..."
    //         //
    //         text_1 = "<div class='entry_template'> <div id='entry_box' data-email='" + email + "'class='entry_line'><div class='long_text' id='entry_text' data-email='" + email + "' data-first='" + first + "' data-last='" + last + "' style='float:left;margin-left:12px;font-size:16px;'>"
    //     }
        
    //     var text_2 ="</div><form style='position:relative;' method='GET' action='employee_entries.php'><input type='hidden' name='emp_id' value='" + id + "'><button type='submit' class='entry-button-style-2 wide200'>Select Employee</button></form></div></div>";
        
    //     text = text_1 + line_data + text_2
    //     // Return the text
    //     return text
    // }


    // $("#list").on("mouseenter", '.entry-button-style-2', function () {
    //     $(this).parent().parent().css( "background-color", "rgb(144, 223, 255)" ); 
    // });
    // $("#list").on("mouseleave", '.entry-button-style-2', function () {
    //     $(this).parent().parent().css( "background-color", "rgb(197, 239, 255)" ); 
    // });
    
    // $("#list").on("mouseleave", '.entry_line', function () {
    //     $(this).css( "background-color", "rgb(144, 223, 255)" ); 
    // });
    // $("#list").on("mouseenter", '.entry_line', function () {
    //     $(this).css( "background-color", "rgb(197, 239, 255)" ); 
    // });
    // $("#list").on("click", '.entry-button-style-2', function () {
    //     // Prevent entry line from activating 
    //     stopPropagation() 
    // });
    // // What happens when an edit button on one of the projects in clicked
    // $('#list').on('click', '.entry_line' , function() {
    //     email = $(this).data('email')
    //     // date = $(this).children( ".box-button" ).data('date')
    //     // $('#info_date').text(date)
    //     $('#info_description').text(email)
    //     //$('.info_project').css('opacity','0')
    //     $('.info_project').css('display','none')

    //     // $('.info_project').stop()
    //     // $('.info_project').css('display','none')
    //     // $('.info_project').css('opacity','0')        
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

</script>

<!-- Hidden Modals -->
<div class='main-container'>


    <div class='info_project'>
        <div class='info_project_tip'></div>
        <div class='info_content'><span>
        <!-- <p>Date:</p><p id='info_date'></p> -->
        <h6>E-mail:</h6>
        <p id='info_description'></p>
        </span></div>
    </div>

<div class='show_long_text' style='display:none;'>
  
    <div class='info_content-2'><span id='height-measure'>
    <!-- <p>Date:</p><p id='info_date'></p> -->
    <p id='info_description_long'></p>
    </span></div>
    <div class='info_long_tip'></div>
</div>

    <div id="data_modal" class="modal" style='background-color:transparent;display:none;'>
        <div id='outside_modal_data' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
        <!-- Modal content -->
        <div style='left:50%; margin-top:2%; position: absolute; margin-left:-350px;'>
            <div style='width:700px; height:230px; position:absolute; background-color:#fff;z-index:6;border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='movable_data'>
                
                <div id='movable_dataheader' style='cursor: move;height:40px;background-color: rgb(200, 200, 200);'>
                        <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Data For Employees</p>
                </div>

                <div style='margin-top:15px;height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Employees</p>
                    <p style='float:left'><?php 
                        // Get all projects from the company
                        $sql = "SELECT * FROM employees WHERE status = 'active' AND emp_org = '$org_id'";
                        // Put the results into $result
                        $result = mysqli_query($conn, $sql);
                        // Get the number of projects found
                        $total_employees = mysqli_num_rows($result);
                
                        echo ": "; echo $total_employees; ?></p>
                </div>


                <div style='height:44px;'>
                    <!-- <p style='float:left;margin-left:20px;padding:0;'>Employees Assigned To A Project</p>
                    <p style='float:left;margin-left:120px;padding:0;'>Employees Not Assigned To A Project</p> -->
                </div>

                <div style='height:20px;'>
                    <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        
                        cursor: pointer;'>Export</button>
                
                    <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Exit</button>
                </div>    
                    
                    
            </div>
        </div>
    </div>

</div>