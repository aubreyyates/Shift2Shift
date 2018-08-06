<?php
    // Put the header in the page 
    include_once 'header.php';
    // Connect to database
    include 'includes/dbh.inc.php';
?>



<!-- Main part of page -->
<section class="main-container">

    <?php
        include 'nav_for_managers.php';
    ?>

    <div class="main-wrapper">


        <div class='shadow'>   
            <!-- Displays the page name -->
            <div class='box-create-2'>
                <div id='top-bar' style='margin-left:20px;'>
                    <h4>Manage Employees</h4>
                </div>
            </div>


            <div class='box-create' style='width:100%; height:62px; background-color:rgb(247, 247, 247)'>
                <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                    
                <!-- <form id='search-form' method='GET'> -->
                <button id='employee-search' type='submit'class='button-style-4 right'>
                    Search</button>
                <input  class='searchbar-style-2' id='search-input' placeholder='Search employees'type='text' name='search'>
                <!-- </form> -->

                        <button id='all_button' class='button-style-5 right'>
                            All
                        </button>
                    </div>
                </div>

                <div class='box-create' style='width:100%; height:60px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
                    <div id='top-bar' style='margin-left:20px;'>
          
                        <!-- Button to make an export of the employees -->
                        <button id='export' class='button-style-4 right'>
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




            <?php
                
                // Start the list div
                echo "<div id='list'>";
                echo "</div>";
                // ---- End list div ----




















            // include 'includes/dbh.inc.php';
            
            // $manager_id = $_SESSION['m_id'];
            // $sql = "SELECT * FROM assignment_managers";
            // $result = mysqli_query($conn, $sql);
            
            // while ($row = $result->fetch_assoc()) {
            //     if ($row['manager_id']===$manager_id) {
            //         if ($row['emp_id'] != null) {

            //             $emp_id = $row['emp_id'];
                       
            //             $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id'";
            //             $result2 = mysqli_query($conn, $sql2);
            
            //             while ($row2 = $result2->fetch_assoc()) {
                            
            //                 echo "<div id='projectBox' style='width: 950px; height:35px;
            //                     padding: 5px;
            //                     margin-bottom:4px;
            //                     background-color: #fff;
            //                     border-radius: 4px;font-size:14px;'>
            //                     <p>";

            //                 echo "First Name: ";
            //                 echo $row2['emp_first'];
            //                 echo " | Last Name: ";
            //                 echo $row2['emp_last'];
            //                 echo " | Email: ";
            //                 echo $row2['emp_email'];               
                        
            //                 echo "</p></div>";
                            
            //                 echo "<form style='position:absolute; margin-top:-65px; margin-left: 60%;' method='POST' action='employee_entries_for_managers.php'>
            //                     <input type='hidden' name='emp_id' value='".$row2['emp_id']."'>
            //                     <input type='hidden' name='emp_first' value='".$row2['emp_first']."'>
            //                     <input type='hidden' name='emp_last' value='".$row2['emp_last']."'>
            //                     <button type ='submit' name='viewemployee' style=' width: 180px;
            //                     height: 30px;
            //                     margin-right: 10px;
            //                     border: none;
            //                     background-color: #f3f3f3;
            //                     font-family: arial;
            //                     font-size: 16px;
            //                     color: #111;
            //                     cursor: pointer;'>
            //                     Select Employee</button></form>";
                            
                             
            //             }
            //         }
            //     }
            // }


        ?>
    </div>
    <!-- End shadow -->
         <div>
            <div style='float:left; margin-left:41%;'>
                <button id='view-backward' class='arrow-button' style='display:none;'><p class='fa fa-chevron-left'></p>
                </button>
            </div>

            <div style='float:right; margin-right:41%;'>
                <button id='view-forward' class='arrow-button' style='display:none;'><p class='fa fa-chevron-right'></p>
                </button>
            </div>

            <div><p id='pagination' style='margin: 0 auto;width:50px;'></p></div>
        </div>



    </div>
</section>



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

<script>

    $(document).ready(function readyDoc() {
        
        // Initialize variables 
        var clicked_project_id, input;
        // Default searching to false 
        var searching = false;
        // Create a canvas to measure string length in pixels
        var canvas = document.createElement('canvas');
        // Create a canvas
        var ctx = canvas.getContext("2d");
        // Set the font of canvas
        ctx.font = "12px Arial";
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;  
        // Variable that can contain new objects for searching
        var search_objects = []  


        // Get all of the entries from the project
        $.post('load_assigned_employees_to_objects.php', function(result) {
            
            // Turn the result into JSON objects
            employees = JSON.parse(result)
            // Go through each employee
            for (i=0; i<employees.length;i++) {
                // Sanitize the code, prevent XSS              
                employees[i].first = DOMPurify.sanitize(employees[i].first);
                employees[i].last = DOMPurify.sanitize(employees[i].last);
                employees[i].email = DOMPurify.sanitize(employees[i].email);
            }  
            // Save the original object order
            employees_original = employees
            // Display all of these projects at the start of page
            display_all()
            // Check to see if you need to put arrows to view more projects
            if (employees.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })
        
        // Function to display all of the entries
        function display_all() {
            
            // Clear all managers
            $('#list').html('')
            // Stop displaying info box that show decription
            $('.info_project').css('display','none')
            // Check to see how far to make lines
            if (employees.length > vnum_e) {
                // Set max view to num_e
                max_view = vnum_e
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
                // Check if they are viewing the first projects
                if (vnum_s == 0) {
                    // Stop displaying the backward arrow as there are no more to see
                    $('#view-backward').css('display','none')
                }
            } else {
                // Set max view to length of project
                max_view = employees.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + employees.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }
            // Go through every entry
            for (i = vnum_s ; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
        }


        function display_search() {
            // Clear all managers
            $('#list').html('')
            // Stop displaying info box that show decription
            $('.info_project').css('display','none')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {  
                // Check if the search is in the name
                if ( employees[i].email.toLowerCase().includes(input.toLowerCase()) ) {
                    // Add to the search objects
                    search_objects.push(employees[i])
                }
            }    
            
            // Check to see how far to make lines
            if (search_objects.length > vnum_e) {
                // Set max view to num_e
                max_view = vnum_e
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
                // Check if they are viewing the first projects
                if (vnum_s == 0) {
                    // Stop displaying the backward arrow as there are no more to see
                    $('#view-backward').css('display','none')
                }
            } else {
                // Set max view to length of project
                max_view = search_objects.length
                // Set the pagination indicator
                $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
                // Stop displaying the foward arrow as there are no more to see
                $('#view-forward').css('display','none')
            }            
            // Go through every entry
            for (i = vnum_s ; i < max_view; i++) {
                // Get the html for the entry
                text = prepare_entry_line(search_objects[i].first, search_objects[i].last, search_objects[i].id, search_objects[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
            // Reset the search objects 
            search_objects = []   
        }

        // What happens if the arrow forward button is clicked
        $( "#view-forward" ).click(function() {
            // Display the back arrow to view previous
            $('#view-backward').css('display','inline')
            vnum_s += 25
            vnum_e += 25
            if (searching == false) {
                // Display all of these projects at the start of page
                display_all()
            } else {
                // Display the search
                display_search()
            }
        })

        // What happens if the arrow backward button is clicked
        $( "#view-backward" ).click(function() {
            // Display the foward arrow to view more
            $('#view-forward').css('display','inline')
            vnum_s -= 25
            vnum_e -= 25
            if (searching == false) {
                // Display all of these projects at the start of page
                display_all()
            } else {
                // Display the search
                display_search()
            }
        })

        $("#export").click(function() {
            // Get the chosen export type
            export_type = $('#export-type').val()
            // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
            //filter = $('#filter-type').val()
            // Check the export type
            if (export_type == 'csv') {

                // Convert JSON to CSV 
                csvFirstLine = 'Id, First Name, Last Name, E-mail\r\n'
                
                if (searching == false) {
                    csvContent = ConvertToCSV(employees)
                } else {
                    csvContent = ConvertToCSV_search(employees)
                }

                csvContent = csvFirstLine + csvContent

                var blob = new Blob([csvContent]);
                if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
                    window.navigator.msSaveBlob(blob, "employees_data.csv");
                else
                {
                    var a = window.document.createElement("a");
                    a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
                    a.download = "employees_data.csv";
                    document.body.appendChild(a);
                    a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
                    document.body.removeChild(a);
                }
            

            } else if (export_type == 'excel') {

                
                var excel = $JExcel.new("Calibri light 10 #333333");            
                excel.set( {sheet:0,value:"Employees Data" } );
                var evenRow=excel.addStyle( { border: "none,none,none,thin #333333"});        
                var oddRow=excel.addStyle ( { fill: "#ECECEC" ,border: "none,none,none,thin #333333"}); 
                for (var i=1;i<employees.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });  
                                   
                 
                var headers=["ID","First Name","Last Name","E-mail"];                            
                var formatHeader=excel.addStyle ( {
                    border: "none,none,none,thin #333333",font: "Calibri 12 #0000AA B"}
                );                                                         
                
                for (var i=0;i<headers.length;i++){              // Loop headers
                    excel.set(0,i,0,headers[i],formatHeader);    // Set CELL header text & header format
                    excel.set(0,i,undefined,"auto");             // Set COLUMN width to auto 
                }

                var dStyle = excel.addStyle ( {                       
                    align: "R",                                                                                                                                             
                    font: "#00AA00"}
                );                                                                         
                if (searching == false) {
                    for (var i=0;i<employees.length;i++){                                    
                        excel.set(0,0,i + 1,employees[i].id);                                  
                        excel.set(0,1,i + 1,employees[i].first);                  
                        excel.set(0,2,i + 1,employees[i].last);          
                        excel.set(0,3,i + 1,employees[i].email);                
                    }
                } else {
                    for (var i=0;i<employees.length;i++){   
                        if (employees[i].email.toLowerCase().includes(input.toLowerCase())) {                               
                            excel.set(0,0,i + 1,employees[i].id);                                  
                            excel.set(0,1,i + 1,employees[i].first);                  
                            excel.set(0,2,i + 1,employees[i].last);          
                            excel.set(0,3,i + 1,employees[i].email);      
                        }                 
                    }
                }
                
                excel.set(0,1,undefined,30);                                // Set COLUMN B to 30 chars width
                excel.set(0,2,undefined,36);                                
                excel.set(0,3,undefined,40);                               // Set COLUMN D to 70 chars width

                excel.generate("employees_data.xlsx");

            } else if (export_type == 'pdf') {


                var doc = new jsPDF()
                doc.setFontSize(8);
                doc.text('ID', 10, 10)
                doc.text('First Name', 25, 10)
                doc.text('Last Name', 60, 10)
                doc.text('E-mail', 90, 10)
                if (searching == false) {
                    for (var i=0;i<employees.length;i++){                               
                        doc.text(employees[i].id, 10,i*5+20)                                  
                        doc.text(employees[i].first, 25,i*5+20)
                        doc.text(employees[i].last.substring(0,10), 60,i*5+20)  
                        doc.text(employees[i].email, 90,i*5+20)            
                    }
                } else {
                    j = 0
                    for (var i=0;i<employees.length;i++){ 
                        if (employees[i].email.toLowerCase().includes(input.toLowerCase())) { 
                            doc.text(employees[i].id, 10,i*5+20-j*5)                                  
                            doc.text(employees[i].first, 25,i*5+20-j*5)
                            doc.text(employees[i].last.substring(0,10), 60,i*5+20-j*5)  
                            doc.text(employees[i].email, 90,i*5+20-j*5)  
                        } else {
                            j += 1;
                        }        
                    }
                }


                doc.save('employees_data.pdf')




                
            }
        })

        // JSON to CSV Converter
        function ConvertToCSV(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','

                    line += array[i][index];
                }

                str += line + '\r\n';
            }

            return str;
        }
        // JSON to CSV Converter
        function ConvertToCSV_search(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                if ( array[i].email.toLowerCase().includes(input.toLowerCase()) ) {
                    var line = '';
                    for (var index in array[i]) {
                        if (line != '') line += ','

                        line += array[i][index];
                    }

                    str += line + '\r\n';
                }
            }

            return str;
        }

        // Create the entry lines with html
        function prepare_entry_line(first, last, id, email) {
            // Sanitize all of the entries. This helps prevent injections and XSS
            first = first.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            last = last.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            id = id.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            email = email.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            
            // Create the text needed to create an entry
            text_1 = "<div class='entry_template'> <div id='entry_box' data-email='" + email + "'class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
            // Get the line data
            line_data =  "First Name: " + first + " | Last Name: " + last + " | Email: " + email
            // Get the length of the string in pixels
            var len = ctx.measureText(line_data).width;
            // Check if it is greater than 425
            if (len > 425) {
                // Keep removing letters until it is less than 420 pixels long
                while (len > 420) {
                    // Remove the last letter
                    line_data = line_data.substring(0, line_data.length - 1);
                    // Get the new length of string in pixels
                    len = ctx.measureText(line_data).width;
                }
                // Add dots at end
                line_data += "..."
            }
            
            text_2 ="</div><form style='position:relative; float:right; margin-right:26px;' method='GET' action='employee_entries_for_managers.php'><input type='hidden' name='emp_id' value='" + id + "'><button type='submit' class='entry-button-style-2 wide200'>Select Employee</button></form></div></div>";
            
            text = text_1 + line_data + text_2
            // Return the text
            return text
        }

        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            // Check the sorting type is alphabetical
            if ($('#sorting').val() == 'Last') {
                // Sort alphabetically
                employees = merge_alphabetical(employees)
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            // Check if the sorting type is none
            } else if ($('#sorting').val() == 'Date Created') {
                // Set to original order
                employees = employees_original
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            } else if ($('#sorting').val() == 'First') {
                // Sort alphabetically
                employees = merge_alphabetical_first(employees)               
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            } else if ($('#sorting').val() == 'E-mail') {
                // Sort alphabetically
                employees = merge_alphabetical_email(employees)                
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            }
        })


        // What happens if you click the search button
        $( "#employee-search" ).click(function() {
            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Get the search typed in
            input = $('#search-input').val()
            // Clear all projects
            $('#list').html('')
            // Display the all button
            $(document.getElementById('all_button')).css('display','block');
            // Display projects that have names like the search word
            display_search()
            // Set searching to true
            searching = true;
            // Check to see if you need to put arrows to view more projects
        })

        // When happens if a key on while on the search bar is pressed
        $("#search-input").keyup(function(event) {
            // Check if it was enter
            if (event.keyCode === 13) {
                // Set the current projects viewed
                vnum_s = 0;
                // Set the last project to view
                vnum_e = 25;
                // Get the search typed in
                input = $('#search-input').val()
                // Clear all projects
                $('#list').html('')
                // Display the all button
                $(document.getElementById('all_button')).css('display','block');
                // Display projects that have names like the search word
                display_search()
                // Set searching to true
                searching = true;
            }
        })

        // What happens if the all button is clicked
        $( "#all_button" ).click(function() {
            // Reset searching objects
            search_objects = []
            // Set the current projects viewed
            vnum_s = 0;
            // Set the last project to view
            vnum_e = 25;
            // Display all of these projects at the start of page
            display_all()
            // Stop displaying the all button
            $(document.getElementById('all_button')).css('display','none');
            // Set searching to false
            searching = false;
            // Check if there are more than 25 employees to show
            if (employees.length > 25) {
                // Display the foward arrow to view more
                $('#view-forward').css('display','inline')
            }
        })

        // What happens if the all button is clicked
        $( "#all_button" ).click(function() {
            // Display all of these projects at the start of page
            display_all()
            // Stop displaying the all button
            $(document.getElementById('all_button')).css('display','none');
            
            searching = false;
        })




    });

    $("#list").on("mouseenter", '.entry-button-style-2', function () {
        $(this).parent().parent().css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry-button-style-2', function () {
        $(this).parent().parent().css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("mouseleave", '.entry_line', function () {
        $(this).css( "background-color", "rgb(144, 223, 255)" ); 
    });
    $("#list").on("mouseenter", '.entry_line', function () {
        $(this).css( "background-color", "rgb(197, 239, 255)" ); 
    });
    $("#list").on("click", '.entry-button-style-2', function () {
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


    <div class='info_project'>
        <div class='info_project_tip'></div>
        <div class='info_content'><span>
        <!-- <p>Date:</p><p id='info_date'></p> -->
        <h6>E-mail:</h6>
        <p id='info_description'></p>
        </span></div>
    </div>


<?php
    include_once 'footer.php';
?>



