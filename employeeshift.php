<?php
    // Put the header in the page
    include_once 'header.php';

?>

<!-- Main part of page -->
<section style='padding-top:40px;'>
             
    <div style='font-family: arial;'>
        <?php
            // Include the navigation in the page
            include_once 'nav.php';
        ?>
    </div>
    

    <!-- Get jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <!-- Get jqury -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Get moment -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <!-- Get the fullcalendar  -->
    <script src='fullcalendar/fullcalendar.js'></script>
    <!-- Get styling for the calendar -->
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    

<script>

    // Put the employee's id into a variable called emp_id
    var emp_id = <?php echo $_SESSION['current_emp_id'];?>
    // When page is ready this is run
    $(document).ready(function() {

        var calendar = $('#calendar').fullCalendar({
        
            // Settings for the calendar
            editable:true,
            // The calander can be clicked to do something
            selectable:true,
            // Turns on the helper
            selectHelper:true,
            // Only show so many events on one date
            eventLimit: true,
            

            // Settings for the calender's header
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay, add_button'
            },
            
            // Where to get the events from and what color they are by default
            eventSources:[
            {
                url: 'load.php',     
                textColor: 'white'  
            }],

            // Create custom buttons
            // customButtons: {  
            //     add_button: {
            //         text: '+',
                    
            //         // What happens when the + button is clicked
            //         click: function() {
                        
            //             // Displays the add button modal
            //             $(document.getElementById('add_button_modal')).css('display','block');
                        
            //             //What happens if you click the cancel button
            //             $( "#cancel_add_modal" ).click(function() {
            //                 $(document.getElementById('add_button_modal')).css('display','none');
            //                 unbinding();
            //                 return;
            //             })
                        
            //             // What happens if the close button is clicked
            //             $( "#close_add_modal" ).click(function() {
            //                 $(document.getElementById('add_button_modal')).css('display','none');
            //                 unbinding();
            //                 return;
            //             })

            //             // What happens when the submit button is clicked
            //             $( "#submit_add_modal" ).click(function() {
                            
            //                 var title = $('#title_add_modal').val()
            //                 var description = $('#description_add_modal').val()
            //                 var project = $('#project_add_modal').val()
            //                 var location = $('#location_add_modal').val()

            //                 var date1 = $('#date1').val()
            //                 var date2 = $('#date2').val()
            //                 var date3 = $('#date3').val()
            //                 var date4 = $('#date4').val()
                            
            //                 $.ajax({
            //                     url:"insert_with_add.php",
            //                     type:"POST",
            //                     data:{title:title, location:location, project:project, description:description, emp_id:emp_id, date1:date1},
            //                     success:function()
            //                     {
            //                         calendar.fullCalendar('refetchEvents');
            //                     }
            //                 });

            //                 $(document.getElementById('add_button_modal')).css('display','none');
            //                 unbinding();
            //                 return;
            //             })
            //         }
            //     }
            // },



            
            // Displays location, description, and project on event element if the view is in week or day
            eventRender: function( event, element, view ) {
                var view = $('#calendar').fullCalendar('getView');
                var view_string = view.title;
                if (view_string.indexOf(',') > -1) {
                    element.find('.fc-title').append("<p style='font-size:10px;'>" + "<br>Location: " + event.location + "<br>Project: " + event.project + "<br>Description: " + event.description + "</p>");
                }
            },
            

            // // When an event is resized
            eventResize:function(event) {
                
                // Gets the start time of event that it was changed to
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                // Get the end time of event that it was changed to
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                // Gets the events title
                var title = event.title;
                // Gets the events id
                var id = event.id;
                // Get event type
                var event_type = event.type
                // Updates the time of event in database
                $.ajax({
                    url:"update.php",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id, event_type:event_type},
                    // Reloads events on the page
                    success:function() {
                        calendar.fullCalendar('refetchEvents');
                    }   
                })
            },


            // When an event is dragged 
            eventDrop:function(event) {
                
                // Gets start of the new time of event
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                // Gets end of the new time of event
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                // Get the title of event
                var title = event.title;
                // Get the id of the event
                var id = event.id;
                // Get event type
                var event_type = event.type
                
                // Updates the time of event in database
                $.ajax({
                    url:"update.php",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id,event_type:event_type},
                    success:function() {
                        calendar.fullCalendar('refetchEvents');
                    }
                });
            },







            // ------------- FIRST SUBMITTING EVENT -------------
            // What happens if an area on the calender is clicked
            select: function(start, end, allDay) {
                
                $('#delete').css('display','none')
                $("#myModal_text").text("Add New Event");
                // Resets the values in the input boxs and drop-down menus
                // $('#description').val('None');
                // $('#location').val('None');
                // $('#title').val('None');

                // Get the start date of the event and put it in the start date
                $('#date_of_start').val(start.format("YYYY-MM-DD"));
                // Get the end date of the event and put it in the end date
                $('#date_of_end').val(end.format("YYYY-MM-DD"));
                // Set the start time in the modal to the selected start time
                $('#start_submit').val(start.format("hh:mm"));
                // Set the end time in the modal to the selected end time
                $('#end_submit').val(end.format("hh:mm"));

                $('#start_diem').val(start.format("A"));
                $('#end_diem').val(end.format("A"));

                // Displays the modal
                $(document.getElementById('myModal')).css('display','block');
                
                // Get the time that the user set the event to
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            
                // What happens if the cancel button is clicked
                $( "#cancel" ).click(function() {
                    $(document.getElementById('myModal')).css('display','none');
                    unbinding();
                    return;
                })
            
                // What happens if the close button is clicked
                $( "#close" ).click(function() {
                    $(document.getElementById('myModal')).css('display','none');
                    unbinding();
                    return;
                })

                // What happens if the save button is clicked
                $( "#submit" ).click(function() {
                    
                // Get the new start time that was entered
                var start_submit = $('#start_submit').val()
                // Get the AM/PM of the new start time
                var start_diem = $('#start_diem').val()
                // Get the start date
                var date_of_start = $('#date_of_start').val()
                // Check to make sure the start time is a valid time
                if (moment(date_of_start + " " + start_submit+" "+start_diem).isValid()) {
                    if (start_submit.charAt(start_submit.length-3) != ':'){
                        alert("Your start time is not a valid time.")
                        return
                    }
                    // Get the new end time that was entered              
                    var end_submit = $('#end_submit').val()
                    // Get the AM/PM of the new end time
                    var end_diem = $('#end_diem').val()
                    // Get the end date
                    var date_of_end = $('#date_of_end').val()
                    // Check to make sure the end time is a valid time
                    if (moment(date_of_end + " " + end_submit+" "+end_diem).isValid()) { 
                        if (end_submit.charAt(end_submit.length-3) != ':'){
                            alert("Your end time is not a valid time.")
                            return
                        }
                        if (moment(date_of_end + " " + end_submit+" "+end_diem).unix() > moment(date_of_start + " " + start_submit+" "+start_diem).unix()) {
                            
                            var string_start = date_of_start;
                            string_start += " "+start_submit+":00 "+start_diem
                            var string_end = date_of_end;
                            string_end += " "+end_submit+":00 "+end_diem
                            var end_check = end_submit+":00 "+end_diem

                            var title = $('#title').val()
                            var description = $('#description').val()
                            var project_id = $('#project_id').val()
                            var location = $('#location').val()
                            var recurring = $('#recurring').val()
                            var submit = $('#submit_employee').val()

                            start_moment = moment(string_start)
                            end_moment = moment(string_end)  
 
                            var start = start_moment.format("YYYY-MM-DD HH:mm:ss");
                            var end = end_moment.format("YYYY-MM-DD HH:mm:ss");
                            
                            var dow = '';
                            //var id = event.id;

                            $.ajax({
                                url:"insert.php",
                                type:"POST",
                                data:{title:title, location:location, project_id:project_id, description:description, recurring:recurring, start:start, end:end, submit:submit, dow:dow},
                                success:function()
                                {
                                    calendar.fullCalendar('refetchEvents');
                                }
                            });
                            $(document.getElementById('myModal')).css('display','none');
                            unbinding();
                            return;
                        } else {
                            alert("Your start time is later than your end time.")
                        }
                    } else {
                        alert('Your end time is not a valid time.')
                    }
                } else {
                    alert('Your start time is not a valid time.')
                }
            })
            
                // What happens if the delete button is clicked 
                $( "#delete" ).click(function() {
                    
                    // Closes the modal
                    $(document.getElementById('myModal')).css('display','none');
                    
                    // Removes the event from the database
                    // var id = event.id;
                    // var event_type = event.type
                    // $.ajax({
                    // url:"delete.php",
                    // type:"POST",
                    // data:{id:id},
                    // success:function() {
                    //     calendar.fullCalendar('refetchEvents');
                    // }
                    // })
                    unbinding();
                    return;
                })

                // What happens if the info button is clicked
                $( "#info" ).click(function() {      
                    $(document.getElementById('myModal')).css('display','none');
                    unbinding();
                })
            },
            // ----------- END FIRST SUBMITTING EVENT -----------








            


            // ------------ EDITING AN EVENT ------------
            // When an event is clicked
            eventClick:function(event) {  
                $('#delete').css('display','block')                
                $("#myModal_text").text("Edit Event");
                // Displays the modal
                $(document.getElementById('myModal')).css('display','block');
                // Sets the inputs to what the user set the as when event was created
                $('#description').val(event.description);
                // Get the chosen project id
                $('#project_id').val(event.project_id);
                // Get the location of the event
                $('#location').val(event.location);
                // Get the title of the event
                $('#title').val(event.title);
                // Set the start time in the modal to the selected start time
                $('#start_submit').val(event.start.format("hh:mm"));
                // Set the end time in the modal to the selected end time
                $('#end_submit').val(event.end.format("hh:mm"));

                $('#start_diem').val(event.start.format("A"));

                $('#end_diem').val(event.end.format("A"));
                // Get the start date of the event and put it in the start date
                $('#date_of_start').val(event.start.format("YYYY-MM-DD"));
                // Get the end date of the event and put it in the end date
                $('#date_of_end').val(event.end.format("YYYY-MM-DD"));
                // What happens when the cancel button is clicked
                $( "#cancel" ).click(function() {
                    $(document.getElementById('myModal')).css('display','none');
                    unbinding();
                    return;
                })

                // What happens when the cancel button is clicked
                $( "#close" ).click(function() {
                    $(document.getElementById('myModal')).css('display','none');
                    unbinding();
                    return;
                })
                
                // What happens when the submit button is clicked
                $( "#submit" ).click(function() {
                    // Get the new start time that was entered
                    var start_submit = $('#start_submit').val()
                    // Get the AM/PM of the new start time
                    var start_diem = $('#start_diem').val()
                    // Get the start date
                    var date_of_start = $('#date_of_start').val()
                    // Check to make sure the start time is a valid time         
                    if (moment(date_of_start + " " + start_submit+ " " + start_diem).isValid()) {
                        if (start_submit.charAt(start_submit.length-3) != ':'){
                            alert("Your start time is not a valid time.")
                            return
                        }
                        // Get the new end time that was entered              
                        var end_submit = $('#end_submit').val()
                        // Get the AM/PM of the new end time
                        var end_diem = $('#end_diem').val()
                        // Get the end date
                        var date_of_end = $('#date_of_end').val()
                        // Check to make sure the end time is a valid time
                        if (moment(date_of_end + " " + end_submit+" "+end_diem).isValid()) {
                            if (end_submit.charAt(end_submit.length-3) != ':'){
                                alert("Your end time is not a valid time.")
                                return
                            } 
                            if (moment(date_of_end + " " + end_submit+" "+end_diem).unix() > moment(date_of_start + " " + start_submit+" "+start_diem).unix()) {
                                
                                var string_start = date_of_start;
                                string_start += " "+start_submit+":00 "+start_diem
                                var string_end = date_of_end;
                                string_end += " "+end_submit+":00 "+end_diem
                                var end_check = end_submit+":00 "+end_diem

                                var title = $('#title').val()
                                var description = $('#description').val()
                                var project_id = $('#project_id').val()
                                var location = $('#location').val()
                                var recurring = $('#recurring').val()

                                start_moment = moment(string_start)
                                end_moment = moment(string_end)  
 
                                var start = start_moment.format("YYYY-MM-DD HH:mm:ss");
                                var end = end_moment.format("YYYY-MM-DD HH:mm:ss");
                                
                                var id = event.id;
                                var event_type = event.type

                                $.ajax({
                                    url:"update_submit_employeeshift.php",
                                    type:"POST",
                                    data:{title:title, location:location, project_id:project_id, description:description, id:id, recurring:recurring, start:start, end:end,event_type:event_type},
                                    success:function()
                                    {
                                        calendar.fullCalendar('refetchEvents');
                                    }
                                });
                                $(document.getElementById('myModal')).css('display','none');
                                unbinding();
                                return;
                            } else {
                                alert("Your start time is later than your end time.")
                            }
                        } else {
                            alert('Your end time is not a valid time.')
                        }
                    } else {
                        alert('Your start time is not a valid time.')
                    }

                })
                
                // What happens when the delete button is clicked
                $( "#delete" ).click(function() {
                    $(document.getElementById('myModal')).css('display','none');
                    var id = event.id;
                    var event_type = event.type
                    $.ajax({
                    url:"delete.php",
                    type:"POST",
                    data:{id:id,event_type:event_type},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                    //alert("Event Removed");
                    }
                    
                })

                unbinding();
                return;
                })
                
                var event_project, event_location, event_description;

                // What happens when the info button is clicked
                $( "#info" ).click(function() {  
                    $(document.getElementById('myModal')).css('display','none');
                    event_project = event.project;
                    event_location = event.location;
                    event_description = event.description;
                    document.getElementById('des').innerHTML = event_description;
                    document.getElementById('pro').innerHTML = event_project;
                    document.getElementById('loc').innerHTML = event_location;
                    $(document.getElementById('myInfo')).css('display','block');
                    $( "#close_info" ).click(function() {
                        
                        $(document.getElementById('myInfo')).css('display','none');
                        $( "#close_info" ).unbind('click');
                    })
                    unbinding()
                })
            
                function info(){
                    $( "#close_info" ).click(function() {
                        $(document.getElementById('myInfo')).css('display','none');
                        document.getElementById('des').innerHTML = event.description;
                        document.getElementById('pro').innerHTML = event.project_id;
                        document.getElementById('loc').innerHTML = event.location;
                        $( "#close_info" ).unbind('click');
                    })
                }
            },
            // ---------- END EDITING AN EVENT ----------




        });
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('myModal')).css('display','none');
            
        })
        //Make the DIV element draggagle, makes data_modal draggable :
dragElement(document.getElementById(("moveable_myModal")));

dragElement(document.getElementById(("moveable_add_button_modal")));

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
    




    // Removes the listening for a click on button from the modal
    function unbinding() {
        $( "#submit").unbind('click');
        $( "#cancel" ).unbind('click');
        $( "#delete" ).unbind('click');
        $( "#close" ).unbind('click');
        $( "#info" ).unbind('click');
        //$( document ).unbind('click');
    }


</script>









        <div class="main-wrapper" style='font-family:arial;'> 
            <!-- Creates the top of the form where the employee's name is displayed -->
            <div class='shadow'>
                <div class='box-create-2'>
                    <div id='top-bar' style='margin-left:20px;'>
                        <h4><?php echo $_SESSION['current_emp_first']." ".$_SESSION['current_emp_last']."'s Calendar";?></h4>
                    </div>
                </div>
                <!-- Top row or 1st row 60px: 2 buttons 1 hidden button 1 dropdown menu -->
                <div class='box-create' style='width:100%; height:50px; background-color:rgb(247, 247, 247)'>
                    <div id='top-bar' style='margin-left:20px;'>
                    </div>
                </div>
                <div class='box-create' style='width:100%; height:700px; background-color:rgb(247, 247, 247)'>
                    <div id='top-bar' style='margin-left:20px;margin-right:20px;'>
                        <div class="container">   
                            <div id="calendar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</section>




<!-- Hidden modals -->


<!-- The Modal -->
<div id="myModal" class="modal">
    
    <div style='display:block;' class='outside_of_modal'></div>

    <div class='centering-modal'>
    <!-- Modal content -->
    <div style='height:430px;' class='moveable_modal' id='moveable_myModal'>
        
        <div id='moveable_myModalheader' style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
            <p id='myModal_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Add New Event</p>
        </div>
        <!-- <span class="close" id='close'>&times;</span> -->
        <div style='margin-left:20px; margin-right:20px;'>
            
            <div style='height:20px;'>
            </div>
            <!-- <p style='width:100px;margin:0 auto;'>Enter Event</p> -->
            <div style='height:15px;line-height:15px;'>
                <p style='float: left;'>Title</p>

                <p style='float: left; margin-left:140px;'>Location</p>

                <p style='float: left; margin-left:118px;'>Project</p>
            </div>

            <div style='height:55px;'> 
                <input type=text id='title' style='height: 30px;width: 140px; float:left;'>
                <input type=text id='location' style='height: 30px;width: 140px; float: left; margin-left:20px; '>
                <!-- php to get the options for projects -->
                <?php
                    // Creates database connnect
                    include 'includes/dbh.inc.php'; 
                    // Get the company id
                    $org_id = $_SESSION['u_org_id'];
                    // Get all projects from the company
                    $sql = "SELECT * FROM projects WHERE status = 'active' AND org_id ='$org_id'";
                    // Put the result into result
                    $result = mysqli_query($conn, $sql);
                    // Echo out a dropdown menu
                    echo "<select id ='project_id' name='project' style='float:left;padding: 0 0 0 4px; height:34px; width: 170px; margin-left:20px; margin-top:1px;'>";
                    // Go through the results
                    while ($row = $result->fetch_assoc()) {
                        // Get the project name
                        $project = $row['project_name'];
                        // Get the project id
                        $project_id = $row['project_id'];
                        // Put the project as an option to select in the dropdown menu
                        echo "<option value='$project_id'>$project</option>";   
                    }
                    // End drop down menu
                    echo "</select>";
                ?>
            </div>
            <div style='height:15px;line-height:15px;'>
                <p style='float:left;'>Start</p>
                <p style='float:left;margin-left:308px;'>End</p>
            </div>

            <div style='height:55px;'>
                <input name='start' value='10:00'id='start_submit' form='new_entry' style='padding: 0 0 0 4px; float:left; height:30px; width: 60px;' type=text>
                <select id='start_diem' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <input type=date id='date_of_start'  style='height: 30px;width: 140px; float:left; margin-left: 20px;'>
                <input name='end' value='2:00' id='end_submit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:56px; height:30px; width: 60px;' type=text>
                <select id='end_diem' name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <input type=date id='date_of_end' style='height: 30px;width: 140px; float:left; margin-left: 20px;'>
                <!-- <input type=text id='start_submit' style='height: 30px;width: 140px; float: left;'> 
                <input type=text id='end_submit' style='height: 30px;width: 140px; float: left; margin-left:20px;'> -->
            </div>

            <div style='height:30px;'>
                <p>Description</p>
            </div>
            <div style='height:70px;'>
                <textarea id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
            </div>
            <div style='height:15px;'>
                <p>Reaccuring</p>
            </div>
            <div style='height: 60px;'>
                <select id='recurring' style='float:left;padding: 0 0 0 4px; height:34px; width: 170px; margin-top:1px;'>
                    <option value="none">None</option>
                    <option value="weekdays">Weekdays</option>
                    <option value="weekends">Weekends</option>
                </select>
            </div>

  

            <div style='height:50px;'>
                <button id='submit' style='float:right;margin-left:20px;width: 100px;
                    height: 34px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Save</button>
                <button id='cancel'style='float:right;margin-left:20px;width: 100px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;' >Cancel</button>
                <!-- <button id='info' style='float:right;margin-left:20px;width: 100px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Info</button> -->
                <button id='delete' style='width: 100px; margin-left:20px; float:right;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Delete</button> 
            </div>

        </div>
    </div>
</div>
</div>



<div id="myInfo" class="info" style='
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 5; /* Sit on top */
    left:0px;
    top: 0%;
    width: 100%;
    height:100%;
    background-color: rgba(0,0,0,0.5);

    overflow: auto; /* Enable scroll if needed */'>

    <div class="modal-content" style='width:30%; margin: 0 auto; top:5%;'>
        <span class="close" id='close_info'>&times;</span>
        <p>Info</p>
        <br>
        <p>Location</p>
        <p id='loc'></p>
        <br>
        <p>Project</p>
        <p id='pro'></p>
        <br>
        <p>Description</p>
        <p id='des'></p>
    </div>
</div>



