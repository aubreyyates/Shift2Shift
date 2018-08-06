<?php
    // Put the header in the page
    include_once 'header.php';
        // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
    // Create a database connection
    include 'includes/dbh.inc.php';
    // // Check to see if a manager was just deleted
    // if (isset($_SESSION['just_deleted_manager'])) {
    //     // Get the value 
    //     $result = $_SESSION['just_deleted_manager'];
    //     // Check to see if it is set to true
    //     if ($result == 'true') {

            
    //         echo "
    //             <div class='disappear_modal' style='position:absolute;margin-left: auto;
    //             margin-right: auto;
    //             left: 0;
    //             right: 0;top:80px;width:400px; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
    //                 <p style=' margin-left:130px; line-height:50px;'>MANAGER DELETED</p>
    //             </div>
    //         ";
    //     }
    //     // Unset the session variable so it doesn't pop up another message
    //     unset($_SESSION['just_deleted_manager']);
    // }
?>


<!-- Start main part of page -->
<section class="main-container">
    
    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>


    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>

        <div class='shadow'>
        <!-- Create top bar that says Manage Managers -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Admins</h4>
            </div>
        </div>

        <?php 
            $search_place='Search Admins';
            $link_new = 'adminaccount.php';
            $button_name = 'Add Admin';
            include "search_area.php"
        ?>

        <!-- Begin list div -->
        <div id='list'>
        </div>
        <!-- End list div -->
    </div>


    <?php
        include "arrows_pagination.html";
    ?>


    </div>
</section>
<!-- End main part of page -->


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
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Used for santizing string -->
<script type="text/javascript" src="dist/purify.min.js"></script>
<!-- Put in functions important for pages with accounts -->
<script type="text/javascript" src="account_page_functions.js"></script>

<script>


    // Initialize variables
    var shift2shift_globalv1 = {};
    // Put input property
    shift2shift_globalv1.input = '';
    // Default searching to false 
    shift2shift_globalv1.searching = false;
    // Create a canvas to measure string length in pixels
    shift2shift_globalv1.canvas = document.createElement('canvas');
    // Create a canvas
    shift2shift_globalv1.ctx = shift2shift_globalv1.canvas.getContext("2d");
    // Set the font of canvas
    shift2shift_globalv1.ctx.font = "12px Arial";
    // Set the current projects viewed
    shift2shift_globalv1.vnum_s = 0;
    // Set the last project to view
    shift2shift_globalv1.vnum_e = 25;  
    // Variable that can contain new objects for searching
    shift2shift_globalv1.search_objects = []  
    // Create accounts
    shift2shift_globalv1.accounts = []
    
    $(document).ready(function readyDoc() {
        

        // Get all of the entries from the project
        $.post('load_admins_to_objects.php', function(result) {
            // Turn the result into JSON objects
            shift2shift_globalv1.accounts = JSON.parse(result)
            // Go through each employee
            for (i=0; i<shift2shift_globalv1.accounts.length;i++) {
                // Sanitize the code, prevent XSS              
                shift2shift_globalv1.accounts[i].first = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].first);
                shift2shift_globalv1.accounts[i].last = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].last);
                shift2shift_globalv1.accounts[i].email = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].email);
            }  
            // Save the original object order
            accounts_original = shift2shift_globalv1.accounts
            // Display all of these projects at the start of page
            display_all()
        })


    });

    // Create the entry lines with html
    function prepare_entry_line(first, last, id, email) {
        // Create the text needed to create an entry
        var text_1 = "<div class='entry_template' > <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>";
        
        var line_data = "First Name: " + first + " | Last Name: " + last + " | Email: " + email


        // Get the length of the string in pixels
        var len = shift2shift_globalv1.ctx.measureText(line_data).width;
        // Check if it is greater than 425
        if (len > 395) {
            // Keep removing letters until it is less than 420 pixels long
            while (len > 390) {
                // Remove the last letter
                line_data = line_data.substring(0, line_data.length - 1);
                // Get the new length of string in pixels
                len = shift2shift_globalv1.ctx.measureText(line_data).width;
            }
            // Add dots at end
            line_data += "..."
            // Give div a long_text class 
            text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' data-email='" + email + "' data-first='" + last + "' data-last='" + first + "' style='float:left;margin-left:12px;font-size:16px;'>";
        }

        var text_2 = "</div><input type='hidden' name='manager_id' value='" + id + "'><input type='hidden' name='manager_first' value='" + first + "'><input type='hidden' name='manager_last' value='" + last + "'><button class='entry-button-style-2 remove' value='" + id + "'type='submit' name='view_manager' >Remove</button><button class='entry-button-style-2 edit' value='" + id + "'type='submit' name='view_manager' >Edit</button></div></div>"
        text= text_1 + line_data + text_2
        // Return the text
        return text
    }






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

    //     $("#export").click(function() {
    //         // Get the chosen export type
    //         export_type = $('#export-type').val()
    //         // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
    //         //filter = $('#filter-type').val()
    //         // Check the export type
    //         if (export_type == 'csv') {

    //             // Convert JSON to CSV 
    //             csvFirstLine = 'Id, First Name, Last Name, E-mail\r\n'
                
    //             if (shift2shift_globalv1.searching == false) {
    //                 csvContent = ConvertToCSV(managers)
    //             } else {
    //                 csvContent = ConvertToCSV_search(managers)
    //             }

    //             csvContent = csvFirstLine + csvContent

    //             var blob = new Blob([csvContent]);
    //             if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
    //                 window.navigator.msSaveBlob(blob, "managers_data.csv");
    //             else
    //             {
    //                 var a = window.document.createElement("a");
    //                 a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
    //                 a.download = "managers_data.csv";
    //                 document.body.appendChild(a);
    //                 a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
    //                 document.body.removeChild(a);
    //             }
            

    //         } else if (export_type == 'excel') {

                
    //             var excel = $JExcel.new("Calibri light 10 #333333");            
    //             excel.set( {sheet:0,value:"managers Data" } );
    //             var evenRow=excel.addStyle( { border: "none,none,none,thin #333333"});        
    //             var oddRow=excel.addStyle ( { fill: "#ECECEC" ,border: "none,none,none,thin #333333"}); 
    //             for (var i=1;i<managers.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });  
                                   
                 
    //             var headers=["ID","First Name","Last Name","E-mail"];                            
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
    //             if (shift2shift_globalv1.searching == false) {
    //                 for (var i=0;i<managers.length;i++){                                    
    //                     excel.set(0,0,i + 1,managers[i].id);                                  
    //                     excel.set(0,1,i + 1,managers[i].first);                  
    //                     excel.set(0,2,i + 1,managers[i].last);          
    //                     excel.set(0,3,i + 1,managers[i].email);                
    //                 }
    //             } else {
    //                 for (var i=0;i<managers.length;i++){   
    //                     if (managers[i].email.toLowerCase().includes(shift2shift_globalv1.input.toLowerCase())) {                               
    //                         excel.set(0,0,i + 1,managers[i].id);                                  
    //                         excel.set(0,1,i + 1,managers[i].first);                  
    //                         excel.set(0,2,i + 1,managers[i].last);          
    //                         excel.set(0,3,i + 1,managers[i].email);      
    //                     }                 
    //                 }
    //             }
                
    //             excel.set(0,1,undefined,30);                                // Set COLUMN B to 30 chars width
    //             excel.set(0,2,undefined,36);                                
    //             excel.set(0,3,undefined,40);                               // Set COLUMN D to 70 chars width

    //             excel.generate("managers_data.xlsx");

    //         } else if (export_type == 'pdf') {


    //             var doc = new jsPDF()
    //             doc.setFontSize(8);
    //             doc.text('ID', 10, 10)
    //             doc.text('First Name', 25, 10)
    //             doc.text('Last Name', 60, 10)
    //             doc.text('E-mail', 90, 10)
    //             if (shift2shift_globalv1.searching == false) {
    //                 for (var i=0;i<managers.length;i++){                               
    //                     doc.text(managers[i].id, 10,i*5+20)                                  
    //                     doc.text(managers[i].first, 25,i*5+20)
    //                     doc.text(managers[i].last.substring(0,10), 60,i*5+20)  
    //                     doc.text(managers[i].email, 90,i*5+20)            
    //                 }
    //             } else {
    //                 j = 0
    //                 for (var i=0;i<managers.length;i++){ 
    //                     if (managers[i].email.toLowerCase().includes(shift2shift_globalv1.input.toLowerCase())) { 
    //                         doc.text(managers[i].id, 10,i*5+20-j*5)                                  
    //                         doc.text(managers[i].first, 25,i*5+20-j*5)
    //                         doc.text(managers[i].last.substring(0,10), 60,i*5+20-j*5)  
    //                         doc.text(managers[i].email, 90,i*5+20-j*5)  
    //                     } else {
    //                         j += 1;
    //                     }        
    //                 }
    //             }


    //             doc.save('managers_data.pdf')




                
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
    //             if ( array[i].email.toLowerCase().includes(shift2shift_globalv1.input.toLowerCase()) ) {
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

    //     //Make the DIV element draggagle, makes data_modal draggable :
    //     dragElement(document.getElementById(("moveable_edit_main")));
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

    $("#list").on("click", '.remove', function () {

        if (shift2shift_globalv1.accounts.length > 1) {
            // Check to make sure they really want to delete the admin?
            var check = confirm("Are you sure you want to DELETE this admin? (Can be recovered)")
            // Get the admin id
            var admin_id = $(this).val()
            // Check if they said yes
            if (check == true) {
                // Change the admin status to deleted
                $.post('delete_admin.php',{admin_id:admin_id})
                // Go through all admins
               
                for (i=0; i<shift2shift_globalv1.accounts.length;i++) {
                    // Find the match id
                    if (admin_id == shift2shift_globalv1.accounts[i].id) {
                        // Remove the admin
                        shift2shift_globalv1.accounts.splice(i, 1);
                        // Leave the i loop
                        break
                    }
                }

                // Check if they are searching
                if (shift2shift_globalv1.searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            }            
        } else {
            alert("You can't delete the only admin that you have.")
        }
    });

    $("#list").on("click", '.edit', function () {
        // Display the edit admin info modal
        $(document.getElementById('edit_main_modal')).css('display','block');
    });







</script>


<!-- Hidden Modals -->
<div class='main-container'>


    <div class='show_long_text' style='display:none;'>
    
        <div class='info_content-2'><span id='height-measure'>
        <!-- <p>Date:</p><p id='info_date'></p> -->
        <p id='info_description_long'></p>
        </span></div>
        <div class='info_long_tip'></div>
    </div>

</div>

<?php
    $header = "Edit Admin";
    include "edit_main_modal.php";
?>