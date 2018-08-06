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
    // Check to see if a manager was just deleted
    if (isset($_SESSION['just_deleted_manager'])) {
        // Get the value 
        $result = $_SESSION['just_deleted_manager'];
        // Check to see if it is set to true
        if ($result == 'true') {

            
            echo "
                <div class='disappear_modal' style='position:absolute;margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;top:80px;width:400px; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <p style=' margin-left:130px; line-height:50px;'>MANAGER DELETED</p>
                </div>
            ";
        }
        // Unset the session variable so it doesn't pop up another message
        unset($_SESSION['just_deleted_manager']);
    }
?>

<!-- Start main part of page -->
<section class="main-container">
    
    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>


    <div class="main-wrapper">

    <div class='shadow'>
        <!-- Create top bar that says Manage Managers -->
        <div class='box-create-2'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Managers</h4>
            </div>
        </div>

        <!-- Create 1st row 120px: 2 buttons 1 input box 1 hidden button -->
        <div class='box-create' style='width:100%; height:62px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                
                <!-- Create a search form to search E-mails of managers -->
                <!-- <form id='search-form' method='GET'> -->
                    <!-- Create the button to run search -->
                    <button id='account-search' type='submit' class='button-style-4 right'>Search</button>
                    <!-- Create input box to entry search term -->
                    <input id='search-input' class='searchbar-style-2'placeholder='Search managers'type='text' name='search'>
                <!-- </form> -->

                <button id='all_button' class='button-style-5 right'>
                    All
                </button>

                <!-- Create button to go to create another manager page -->
                <a class='button-style-4' style='height:38px;'  href='manager_account.php'>Add Manager </a>
        
            </div>
        </div>

        <div class='box-create' style='width:100%; height:66px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Button to get data for the employees -->
                <!-- <button id='data_button' type='submit' name='commentSubmit' 
                    style=' width: 100px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    Data
                </button> -->

                <!-- Button to make an export of the employees -->
                <button id='export' class='button-style-4 right' type='submit' name='delete3' id='export'>
                    Export
                </button>






                

                <!-- Drop down menu to choose export type -->
                <select style='float:right;' class='dropdown-style-3' id='export-type'>
                    <option value='csv'>csv</option>
                    <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option>
                </select>
            </div>
        </div>

        <!-- 3rd row: 1 button -->
        <div class='box-create' style='width:100%; height:90px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>
                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' class='dropdown-style-3 wide200'>
                    <option>Date Created</option>
                    <option>Last</option>
                    <option>First</option>
                    <option>E-mail</option>
                </select>
            </div>
            <div>
                <h5 style='float:right; margin-right:20px; line-height:74px;'> sort by: </h5>
            </div>
        </div>
        <!-- 3rd row end -->

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
        $.post('load_managers_to_objects.php', function(result) {
            // Turn the result into JSON objects
            shift2shift_globalv1.accounts = JSON.parse(result)
            // Save the original object order
            accounts_original = shift2shift_globalv1.accounts
            // Go through each employee
            for (i=0; i<shift2shift_globalv1.accounts.length;i++) {
                // Sanitize the code, prevent XSS              
                shift2shift_globalv1.accounts[i].first = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].first);
                shift2shift_globalv1.accounts[i].last = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].last);
                shift2shift_globalv1.accounts[i].email = DOMPurify.sanitize(shift2shift_globalv1.accounts[i].email);
            }  
            // Display all of these projects at the start of page
            display_all()
            // Check to see if you need to put arrows to view more managers
            if (shift2shift_globalv1.accounts.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })


        $( ".info_project" ).click(function() {
            // stop displaying the info box
            $('.info_project').css('display','none');
        })
        // What happens if the data button is clicked
        $( "#data_button" ).click(function() {
            // Display the data modal
            $(document.getElementById('data_modal')).css('display','block');
        })

        // What happens if the exit button is clicked
        $( "#exit_data" ).click(function() {
              
            $(document.getElementById('data_modal')).css('display','none');
            
        })
        // What happens if you click outside the edit project modal
        $( "#outside_modal_data" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('data_modal')).css('display','none');
            
        })

        // $("#export").click(function() {
        //     // Get the chosen export type
        //     export_type = $('#export-type').val()
        //     // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
        //     //filter = $('#filter-type').val()
        //     // Check the export type
        //     if (export_type == 'csv') {

        //         // Convert JSON to CSV 
        //         csvFirstLine = 'Id, First Name, Last Name, E-mail\r\n'
                
        //         if (searching == false) {
        //             csvContent = ConvertToCSV(managers)
        //         } else {
        //             csvContent = ConvertToCSV_search(managers)
        //         }

        //         csvContent = csvFirstLine + csvContent

        //         var blob = new Blob([csvContent]);
        //         if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
        //             window.navigator.msSaveBlob(blob, "managers_data.csv");
        //         else
        //         {
        //             var a = window.document.createElement("a");
        //             a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
        //             a.download = "managers_data.csv";
        //             document.body.appendChild(a);
        //             a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
        //             document.body.removeChild(a);
        //         }
            

        //     } else if (export_type == 'excel') {

                
        //         var excel = $JExcel.new("Calibri light 10 #333333");            
        //         excel.set( {sheet:0,value:"managers Data" } );
        //         var evenRow=excel.addStyle( { border: "none,none,none,thin #333333"});        
        //         var oddRow=excel.addStyle ( { fill: "#ECECEC" ,border: "none,none,none,thin #333333"}); 
        //         for (var i=1;i<managers.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });  
                                   
                 
        //         var headers=["ID","First Name","Last Name","E-mail"];                            
        //         var formatHeader=excel.addStyle ( {
        //             border: "none,none,none,thin #333333",font: "Calibri 12 #0000AA B"}
        //         );                                                         
                
        //         for (var i=0;i<headers.length;i++){              // Loop headers
        //             excel.set(0,i,0,headers[i],formatHeader);    // Set CELL header text & header format
        //             excel.set(0,i,undefined,"auto");             // Set COLUMN width to auto 
        //         }

        //         var dStyle = excel.addStyle ( {                       
        //             align: "R",                                                                                                                                             
        //             font: "#00AA00"}
        //         );                                                                         
        //         if (searching == false) {
        //             for (var i=0;i<managers.length;i++){                                    
        //                 excel.set(0,0,i + 1,managers[i].id);                                  
        //                 excel.set(0,1,i + 1,managers[i].first);                  
        //                 excel.set(0,2,i + 1,managers[i].last);          
        //                 excel.set(0,3,i + 1,managers[i].email);                
        //             }
        //         } else {
        //             for (var i=0;i<managers.length;i++){   
        //                 if (managers[i].email.toLowerCase().includes(input.toLowerCase())) {                               
        //                     excel.set(0,0,i + 1,managers[i].id);                                  
        //                     excel.set(0,1,i + 1,managers[i].first);                  
        //                     excel.set(0,2,i + 1,managers[i].last);          
        //                     excel.set(0,3,i + 1,managers[i].email);      
        //                 }                 
        //             }
        //         }
                
        //         excel.set(0,1,undefined,30);                                // Set COLUMN B to 30 chars width
        //         excel.set(0,2,undefined,36);                                
        //         excel.set(0,3,undefined,40);                               // Set COLUMN D to 70 chars width

        //         excel.generate("managers_data.xlsx");

        //     } else if (export_type == 'pdf') {


        //         var doc = new jsPDF()
        //         doc.setFontSize(8);
        //         doc.text('ID', 10, 10)
        //         doc.text('First Name', 25, 10)
        //         doc.text('Last Name', 60, 10)
        //         doc.text('E-mail', 90, 10)
        //         if (searching == false) {
        //             for (var i=0;i<managers.length;i++){                               
        //                 doc.text(managers[i].id, 10,i*5+20)                                  
        //                 doc.text(managers[i].first, 25,i*5+20)
        //                 doc.text(managers[i].last.substring(0,10), 60,i*5+20)  
        //                 doc.text(managers[i].email, 90,i*5+20)            
        //             }
        //         } else {
        //             j = 0
        //             for (var i=0;i<managers.length;i++){ 
        //                 if (managers[i].email.toLowerCase().includes(input.toLowerCase())) { 
        //                     doc.text(managers[i].id, 10,i*5+20-j*5)                                  
        //                     doc.text(managers[i].first, 25,i*5+20-j*5)
        //                     doc.text(managers[i].last.substring(0,10), 60,i*5+20-j*5)  
        //                     doc.text(managers[i].email, 90,i*5+20-j*5)  
        //                 } else {
        //                     j += 1;
        //                 }        
        //             }
        //         }


        //         doc.save('managers_data.pdf')




                
        //     }
        // })

        

        // // JSON to CSV Converter
        // function ConvertToCSV(objArray) {
        //     var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
        //     var str = '';

        //     for (var i = 0; i < array.length; i++) {
        //         var line = '';
        //         for (var index in array[i]) {
        //             if (line != '') line += ','

        //             line += array[i][index];
        //         }

        //         str += line + '\r\n';
        //     }

        //     return str;
        // }
        // // JSON to CSV Converter
        // function ConvertToCSV_search(objArray) {
        //     var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
        //     var str = '';

        //     for (var i = 0; i < array.length; i++) {
        //         if ( array[i].email.toLowerCase().includes(input.toLowerCase()) ) {
        //             var line = '';
        //             for (var index in array[i]) {
        //                 if (line != '') line += ','

        //                 line += array[i][index];
        //             }

        //             str += line + '\r\n';
        //         }
        //     }

        //     return str;
        // }


                //Make the DIV element draggagle, makes data_modal draggable :
                dragElement(document.getElementById(("movable_data")));

            function dragElement(elmnt) {
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            if (document.getElementById(elmnt.id + "header")) {
                /* if present, the header is where you move the DIV from:*/
                document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
            } else {
                /* otherwise, move the DIV from anywhere inside the DIV:*/
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                /* stop moving when mouse button is released:*/
                document.onmouseup = null;
                document.onmousemove = null;
            }
            }

    });

    // Create the entry lines with html
    function prepare_entry_line(first, last, id, email) {
        
        // Create the text needed to create an entry
        var text_1 = "<div class='entry_template' > <div id='entry_box' class='entry_line' data-email='" + email + "' ><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>";
        
        var line_data = "First Name: " + first + " | Last Name: " + last + " | Email: " + email


        // Get the length of the string in pixels
        var len = shift2shift_globalv1.ctx.measureText(line_data).width;
        // Check if it is greater than 425
        if (len > 505) {
            // Keep removing letters until it is less than 420 pixels long
            while (len > 500) {
                // Remove the last letter
                line_data = line_data.substring(0, line_data.length - 1);
                // Get the new length of string in pixels
                len = shift2shift_globalv1.ctx.measureText(line_data).width;
            }
            // Add dots at end
            line_data += "..."
            text_1 = "<div class='entry_template'> <div id='entry_box' data-email='" + email + "'class='entry_line'><div class='long_text' id='entry_text' data-email='" + email + "' data-first='" + last + "' data-last='" + first + "' style='float:left;margin-left:12px;font-size:16px;'>"
        }

        var text_2 = "</div><form style='position:relative;' method='GET' action='select_manager.php'><input type='hidden' name='manager_id' value='" + id + "'><button class='select-button-1' type='submit' ></button></form><button class='select-button-3' ></button><button class='select-button-2' ></button></div></div>"
        text= text_1 + line_data + text_2
        // Return the text
        return text
    }

    $("#list").on("mouseenter", '.select-button-1', function () {
        $(this).parent().parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.select-button-1', function () {
        $(this).parent().parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseenter", '.select-button-2', function () {
        $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.select-button-2', function () {
        $(this).parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseenter", '.select-button-3', function () {
        $(this).parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.select-button-3', function () {
        $(this).parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry_line', function () {
        $(this).css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseenter", '.entry_line', function () {
        $(this).css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("click", '.select-button-1', function () {
        // Prevent entry line from activating 
        stopPropagation() 
    });
    $("#list").on("click", '.select-button-2', function () {
        // Prevent entry line from activating 
        stopPropagation() 
    });
    $("#list").on("click", '.select-button-3', function () {
        // Prevent entry line from activating 
        stopPropagation() 
    });

    // What happens when an edit button on one of the projects in clicked
    $('#list').on('click', '.entry_line' , function() {
        email = $(this).data('email')
        // date = $(this).children( ".box-button" ).data('date')
        // $('#info_date').text(date)
        $('#info_description').text(email)
        //$('.info_project').css('opacity','0')
        $('.info_project').css('display','none')

        // $('.info_project').stop()
        // $('.info_project').css('display','none')
        // $('.info_project').css('opacity','0')        
        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".info_project").css({
            position: "absolute",
            top: (topOffset)+ "px",
            left: (offset.left-323) + "px",
        });
        $('.info_project').css('display','block')
    })


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
                        <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Data For Managers</p>
                </div>

                <div style='margin-top:15px;height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Managers</p>
                    <p style='float:left'><?php 
                        // Get all managers from the company
                        $sql = "SELECT * FROM managers WHERE status = 'active' AND manager_org_id = '$org_id'";
                        // Put the results into $result
                        $result = mysqli_query($conn, $sql);
                        // Get the number of managers found
                        $total_managers = mysqli_num_rows($result);
                
                        echo ": "; echo $total_managers; ?></p>
                </div>
                <div style='height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Time Entered To All Projects</p>
                    <p style='float:left;'>
                    <?php
                        echo ": ";
                        //Initalize total seconds to 0
                        $total_seconds = 0;
                        //Initalize total seconds to 0
                        $total_entries = 0;
                        // Get all projects from the company
                        $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active';";
                        // Put the results into $result
                        $result = mysqli_query($conn, $sql);
                        // Go throught the results
                        while ($row = $result->fetch_assoc()) {
                            // Get the project id
                            $project_id = $row['project_id'];
                            // Get entries from that project
                            $sql = "SELECT * FROM timeGeneral WHERE project_id = '$project_id' AND status = 'active';";
                            // Put the results into $result2
                            $result2 = mysqli_query($conn, $sql);
                            // Go through the results
                            while ($row2 = $result2->fetch_assoc()) {
                                // Get the time
                                $time = $row2['time'];
                                // converts and adds the time into seconds
                                $array = explode(':', trim($time, ':'));
                                $total_seconds += intval($array[0]) * 3600;
                                $total_seconds += intval($array[1]) * 60;
                                $total_seconds += intval($array[2]);

                                $total_entries += 1;
                                
                            }
                        }
                        $hours = floor($total_seconds/3600);
                        $total_seconds = ($total_seconds - $hours * 3600);
                        $minutes = floor($total_seconds/60);
                        $seconds = ($total_seconds - $minutes * 60);
                        if ( $hours < 10) {
                            echo "0".$hours.":";
                        } else {
                            echo $hours.":";
                        }
                        if ( $minutes < 10) {
                            echo "0".$minutes.":";
                        } else {
                            echo $minutes.":";
                        }
                        if ( $seconds < 10) {
                            echo "0".$seconds;
                        } else {
                            echo $seconds;
                        }

                    ?>
                    </p>
                </div>
                <div style='height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Entries In All Projects</p>
                    <p style='float:left;'><?php echo ": "; echo $total_entries; ?></p>
                </div>
                <!-- <div style='height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Entries In All Projects</p>
                    <p style='float:left;'><?php echo ": "; echo $total_entries; ?></p>
                </div> -->

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