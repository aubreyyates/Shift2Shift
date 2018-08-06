<?php
    // Put the header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['e_id'])) {
        // if not, exit the code
        exit;
    }
    // Get the employee's id 
    $_SESSION['current_emp_id'] = $_SESSION['e_id'];
?>

<!-- Get the jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get the jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Get the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Get the calendar -->
<script src='fullcalendar/fullcalendar.js'></script>
<!-- Get the styling for the calendar -->
<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<!-- Get the stylesheet style.css -->
<link rel="stylesheet" type="text/css" href="style.css">

<!-- Main part of page -->
<section style='padding-top:40px;'>
    <div class="centered-wrapper">          

        <script>
            // When page is ready, do this
            $(document).ready(function() {
                
                var event_id = 'none'
                // Start the calendar section
                var calendar = $('#calendar').fullCalendar({
                    
                    // Set the header options
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month, agendaWeek, agendaDay'
                    },
                    
                    // Load the entries into the page
                    events: 'load.php',

                    // What happens if an event is clicked
                    eventClick:function(event) {
                        // Get the event's project  
                        event_project = event.project;
                        // Get the event's location
                        event_location = event.location;
                        // Get the event's description
                        event_description = event.description;
                        // Get the event id
                        event_id = event.id;
                        // Put the description into the des id
                        document.getElementById('des').innerHTML = event_description;
                        // Put the project into the pro id
                        document.getElementById('pro').innerHTML = event_project;
                        // Put the location into the loc id
                        document.getElementById('loc').innerHTML = event_location;
                        // Display the info modal called myInfo
                        $(document.getElementById('myInfo')).css('display','block');
                    },


                    // Displays location, description, and project on event element if the view is in week or day
                    eventRender: function( event, element, view ) {
                        var view = $('#calendar').fullCalendar('getView');
                        var view_string = view.title;
                        if (view_string.indexOf(',') > -1) { 
                            element.find('.fc-title').append("<p style='font-size:10px;'>" + "<br>Location: " + event.location + "<br>Project: " + event.project + "<br>Description: " + event.description + "</p>");
                        }
                    }
                });
                // ----- End calendar -----





                // What happens if the X is clicked on the myInfo modal
                $( "#close_info" ).click(function() {
                    // Stop display the myInfo modal
                    $(document.getElementById('myInfo')).css('display','none');
                })

                // What happens if the request schedule change button is clicked
                $( "#request_change" ).click(function() {
                    // Stop display the myInfo modal
                    $(document.getElementById('myInfo')).css('display','none');
                    // Display the request_change_modal
                    $(document.getElementById('request_change_modal')).css('display','block');
                })

                // What happens if the cancel button is clicked on the request_change_modal
                $( "#cancel_request" ).click(function() {
                    // Stop displaying the request_change_modal        
                    $(document.getElementById('request_change_modal')).css('display','none');
                          
                })

                // What happens when you click the submit button of the request_change_modal
                $( "#submit_request" ).click(function() {

                    // Get the chosen date
                    date = $('#date_request').val()
                    // Get the time of day chosen
                    time = $('#time_request').val()
                    // Get the diem AM/PM
                    diem = $('#time_request_2').val()
                    // Get the message they are sending
                    message = $('#message').val()

                    if (time=='') {
                        alert('you need a time.')
                        return
                    }
                    if (date=='') {
                        alert('You need a new date you would like.')
                        return
                    }
                    // Get the message they are sending
                    $('#message').val('')
                    // Stop displaying the request_change_modal  
                    $(document.getElementById('request_change_modal')).css('display','none');
                    // AJAX request to put the message into the database
                    $.post( "employee_request.php", {date:date,time:time,diem:diem,message:message,event_id:event_id});
                            
                })

        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('myInfo')).css('display','none');

            $(document.getElementById('request_change_modal')).css('display','none');
            
        })
        //Make the DIV element draggagle, makes data_modal draggable :
dragElement(document.getElementById(("moveable_myModal")));

dragElement(document.getElementById(("moveable_add_entry_modal")));

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
            // ----- End (document).ready -----


            // Start the continuous clock at the top of the page. It ticks once per a second
            setInterval(function(){ continuous_clock() }, 1000);
            // Put the clock into a variable
            var clockDisplay = document.getElementById('world_clock');
            // Set the clock to the current time
            clockDisplay.innerHTML = moment().format('hh:mm:ss A');
            // Function to run clock at the top of the page that displays the time
            function continuous_clock() {
                // Put the clock into a variable
                var clockDisplay = document.getElementById('world_clock');
                // Set the clock to the current time
                clockDisplay.innerHTML = moment().format('hh:mm:ss A');
            }

        </script>




        <div class='shadow' style='font-family:arial;'>
            <!-- Create the top header that says Calendar -->
            <div class='box-create-2'>
                <div id='top-bar' style='margin-left:20px;'>
                    <h1 style='float:left; font-size:20px; line-height:40px; font-family: arial;'>Calander</h1>
                </div>
            </div>

            <!-- Create a 50px tall white area -->
            <div class='box-create' style='width:100%; height:50px; background-color:rgb(247, 247, 247)'>
                <div id='top-bar' style=''>
                </div>
            </div>

            <!-- Create the calendar section with a white background -->
            <div class='box-create' style='width:100%; height:780px; background-color:rgb(247, 247, 247)'>
                <div id='top-bar' style='margin-left:20px; margin-right:20px;'>
                    <div class="container">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End main part of page -->


















<!-- Hidden modals -->

<!-- myInfo is an info modal to display infomation on an event that is clicked, it also contains a button
     to request a schedule change -->
<div id="myInfo" class="modal">
    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->
    <div class='centering-modal'>

        <div class="moveable_modal" >
            <div style='margin-left:20px; margin-right:20px;'>
                <div style='height:20px;'>
                    <span style='margin-top:20px;float:right;' id='close_info'>&times;</span>
                </div>
                <div>
                    <p style='width:50px; margin: 0 auto;'>Info</p>
                </div>
                <br>
                <div style='height:30px;'>
                    <p style='float:left;'>Location: &nbsp</p>
                    <p style='float:left;' id='loc'></p>
                </div>
                <br>
                <div style='height:30px;'>
                    <p style='float:left;'>Project: &nbsp</p>
                    <p style='float:left;' id='pro'></p>
                </div>
                <br>
                <div style='height:30px;'>
                    <p style='float:left;' >Description: &nbsp</p>
                    <p style='float:left;' id='des'></p>
                </div>
                <button id='request_change'style='width: 60%;
                    height: 30px;
                    margin-bottom: 20px;
                    margin-left: 20%;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>Request Schedule Change
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End myInfo modal -->





<!-- The request_change_modal is a modal to send a message to managers and admins to change a time schedule  -->
<div id="request_change_modal" class="modal">
    <div style='display:block;' class='outside_of_modal'></div>
        <!-- Modal content -->
    <div class='centering-modal'>
    <!-- Modal content -->
        <div id='moveable_myModal' class='moveable_modal'>

        
            <div id='moveable_myModalheader' class='modal_header'>
                <p id='myModal_text'class='modal_header_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Enter Date Change</p>
            </div>

            <div style='height:20px;'></div>

            <div style='height:40px;'>
                <input id='date_request' name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:20px; height:34px; width: 30%;' type=date id='start_submit'>
                <input id='time_request' value='1:00' style='float:left; width: 50px; height:34px; margin-left:20px;' type='text'>
                <select id='time_request_2' style='float:left; height:34px; margin-left:20px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
            </div>

            <div style='height:50px; margin-left:20px; '>
                <p style='float:left;padding:0;'>Description</p>

            </div>
            
            <div style='height:66px; margin-left:20px;'>

            <textarea  name='desciption' id='message' class='textarea-style-1'></textarea>

            </div>

            <div class='space20'>
            </div>

            <div style='height:54px;'>
                <button id='submit_request' class='button-style-4-2 left'>Submit
                </button>
            
                <button id='cancel_request' class='button-style-4-2 left'>Cancel
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End request_change_modal modal -->