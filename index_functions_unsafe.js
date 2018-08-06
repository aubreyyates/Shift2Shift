    var messages = []
    // Create a canvas to measure string length in pixels
    var canvas = document.createElement('canvas');
    // Create a canvas
    var ctx = canvas.getContext("2d");
    // Set the font of canvas
    ctx.font = "12px Arial";
    // Set total messages to 0
    var total_messages = 0
    


    $(document).ready(function readyDoc() {    
        
        
        // Default settings to info
        var settings = 'info';
        // Set message load to set
        var message_load = 'set';

        
        // Get all of the entries from the project
        $.post('load_messages_objects.php', {message_load:message_load}, function(result) {
            // Turn the result into JSON objects
            messages = JSON.parse(result)
             // Go through each project          
            // Add all of the messages to the notifications
            display_all()
            // Display the unread messages
            display_unread()
        })



        // Function to display all of the entries
        function display_all(){
            // Clear all entries
            $('#messages-list-all').html('')
            // Go through every entry
            for (i =  0; i < messages.length; i++) {
                // Get the html for the message
                text = prepare_message_line_all(messages[i].email, messages[i].message, messages[i].new_date ,messages[i].start ,messages[i].end,messages[i].id)
                // Put the message on #messages-all
                var message = $('#messages-list-all').append(text)
            }
        }


        // Create the entry lines with html
        function prepare_message_line_all(email,message,new_date,start,end,id) {
            // Create the text for the entry
            text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;margin-top:18px;'>"
            // Create the line data
            line_data = " E-mail: " + email + " | Message: " + message + " | Event Start: " + start + " | Event End: " + end + " | New Date Request: " + new_date
            // Create more html
            text_2 = "</div></div></div>";
            // Get the length of the string in pixels
            var len = ctx.measureText(line_data).width;
            // Check if it is greater than 380
            if (len > 670) {
                // Keep removing letters until it is less than 375 pixels long
                while (len > 665) {
                    // Remove the last letter
                    line_data = line_data.substring(0, line_data.length - 1);
                    // Get the new length of string in pixels
                    len = ctx.measureText(line_data).width;
                }
                // Add dots at end
                line_data += "..."
                // Add class
                text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' style='float:left;margin-left:12px;font-size:16px;margin-top:18px;' data-email='" + email + "' data-message='" + message + "' data-start='" + start + "' data-end='" + end + "' data-new_date='" + new_date + "'>"
            }
            text = text_1 + line_data + text_2

            
            // Return the text
            return text
        
        }


        // What happens when notifications is clicked       
        $( "#notifications" ).click(function() {  
            // Display the notifications modal
            $(document.getElementById('notificationsModal')).css('display','block');
        })
        // What happens if you click the cancel button 
        $( "#cancel" ).click(function() {  
            // Display the notifications modal
            $(document.getElementById('notificationsModal')).css('display','none');
            
        })
        $( "#exit_all_notifications" ).click(function() {  
            
            $(document.getElementById('notificationsModal_all')).css('display','none');
            
        })

        // What happens if the setting button is clicked
        $( "#settings" ).click(function() {  
            
            $(document.getElementById('settingsModal')).css('display','block');
            
        })

        // What happens if the setting button is clicked
        $( "#account" ).click(function() {  
            
            $('#account_modal').css('display','block');
            
        })
       // What happens if the setting button is clicked
       $( "#exit_account_modal" ).click(function() {  
            
            $('#account_modal').css('display','none');
            
        })
        $( "#cancel_settings" ).click(function() {  
            $(document.getElementById('settingsModal')).css('display','none');
            
        })

        $( "#company_notifications_button" ).click(function() {  
            
            // Set settings to notifications
            settings = 'notifications'
            $(document.getElementById('company_info')).css('display','none');
            $(document.getElementById('company_notifications')).css('display','block');
            $(document.getElementById('company_permisions')).css('display','none');
        
        })

        $( "#company_info_button" ).click(function() {  
    
            // Set settings to info
            settings = 'info'
            $(document.getElementById('company_info')).css('display','block');
            $(document.getElementById('company_notifications')).css('display','none');
            $(document.getElementById('company_permisions')).css('display','none');
        
        })


        $( "#all_notifications" ).click(function() {  
            
            $(document.getElementById('notificationsModal')).css('display','none');
            $(document.getElementById('notificationsModal_all')).css('display','block');
        
        })
        $( "#new_notifications" ).click(function() {  
            

            $(document.getElementById('notificationsModal')).css('display','block');
            $(document.getElementById('notificationsModal_all')).css('display','none');
        
        })
        $( "#company_permisions_button" ).click(function() {  
            
            // Set the settings to permissions
            settings = 'permissions'
            $(document.getElementById('company_info')).css('display','none');
            $(document.getElementById('company_notifications')).css('display','none');
            $(document.getElementById('company_permisions')).css('display','block');
        
        })




        $( "#save_settings" ).click(function() {  

            
            // Check what settings panel is being saved
            if (settings == 'info') {
                // Get the new company name
                company_name = $("#company_name").val()

                var letters_company = /^[A-Za-z0-9| |&|\-]+$/;

                // Update the company name on the page
                $("#company_name_header").text(company_name)
                // Get the new company website
                company_website = $("#company_website").val()
                // Get the new company color
                company_color = $("#company_color").val()
                // Update the settings in the database
                $.post('update_company_settings_info_unsafe.php', {company_name:company_name,company_website:company_website,company_color:company_color});
                
                location.reload();
                
            } else if (settings == 'permissions') {
                if ($('#employee_allow_edit').prop('checked')) {
                    employee_allow_edit = 'yes'
                }  else {
                    employee_allow_edit = 'no';
                }
                if ($('#manager_allow_edit').prop('checked')) {
                    manager_allow_edit = 'yes'
                }  else {
                    manager_allow_edit = 'no';
                }
                $.post('update_company_settings.php', {employee_allow_edit:employee_allow_edit,manager_allow_edit:manager_allow_edit});
            }
            $(document.getElementById('settingsModal')).css('display','none');

        })
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('myModal')).css('display','none');
            $(document.getElementById('settingsModal')).css('display','none');
            $(document.getElementById('notificationsModal')).css('display','none');
            $(document.getElementById('account_modal')).css('display','none');
        })



        
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("movable_notificationsModal")));
        dragElement(document.getElementById(("movable_notificationsallModal")));
        dragElement(document.getElementById(("account_move")));
        dragElement(document.getElementById(("settings_move")));
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


    // Function to display all of the entries
    function display_unread() {
        // Clear all entries
        $('#messages-list').html('')
        // Go through every entry
        for (i = 0; i < messages.length; i++) {
            // Check if it has been read
            if (messages[i].read == 'No') {
                // Get the html for the message
                text = prepare_message_line(messages[i].email, messages[i].message, messages[i].new_date ,messages[i].start ,messages[i].end,messages[i].id)
                // Put the message on #messages-all
                var message = $('#messages-list').append(text)
                // Get total messages
                total_messages += 1;
            }
        }
    }
    // Create the entry lines with html
    function prepare_message_line(email,message, new_date,start,end,id) {
        
        // Create the text for the entry
        text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;margin-top:18px;'>"
        // Create the line data
        line_data = " E-mail: " + email + " | Message: " + message + " | Event Start: " + start + " | Event End: " + end + " | New Date Request: " + new_date
        // Create more html
        text_2 = "</div><button type='submit' value='" + id + "' class='entry-button-style-2 wide60 read_button'>Read</button></div></div>";
        // Get the length of the string in pixels
        var len = ctx.measureText(line_data).width;
        // Check if it is greater than 380
        if (len > 640) {
            // Keep removing letters until it is less than 375 pixels long
            while (len > 635) {
                // Remove the last letter
                line_data = line_data.substring(0, line_data.length - 1);
                // Get the new length of string in pixels
                len = ctx.measureText(line_data).width;
            }
            // Add dots at end
            line_data += "..."
            // Add class
            text_1 = "<div class='entry_template'><div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' style='float:left;margin-left:12px;font-size:16px;margin-top:18px;' data-email='" + email + "' data-message='" + message + "' data-start='" + start + "' data-end='" + end + "' data-new_date='" + new_date + "' >"
        }
        text = text_1 + line_data + text_2

        // Return the text
        return text
    
    }

    $('#messages-list').on('click', '.read_button' , function(){
        // Get the id  
        id = $(this).val()
        // Go through each message
        for (i =  0; i < messages.length; i++) {
            // Find the message with id 
            if (messages[i].id == id) {
                // Set the message to read
                messages[i].read = 'Yes'
                // break from i loop
                break
            }
        }
        total_messages -= 1;

        if (total_messages == 0){
            $("#total_messages").css("display","none")
        } else {
            $("#total_messages").text(total_messages)
        }
        // Get all of the entries from the project
        $.post('save_message_read.php', {id:id})
        // Redisplay unread
        display_unread()
    })
    // What happens when an edit button on one of the projects in clicked
    $('#messages-list').on('mouseenter', '.long_text' , function() {
        email = $(this).data('email')
        message = $(this).data('message')
        start = $(this).data('start')
        end = $(this).data('end')
        new_date = $(this).data('new_date')

        
        $('#info_description_long').text("Email : " + email + " | Message: " + message + " | Start: " + start + " | End: " + end + " | New Date Request: " + new_date)    
        // Get the height
        height = $('.show_long_text_2').height()
 
        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".show_long_text_2").css({
            position: "absolute",
            top: (topOffset - height - 19)+ "px",
            left: (offset.left) + "px",
        });
        $('.show_long_text_2').css('display','block')
        
    })
    // What happens when an edit button on one of the projects in clicked
    $('#messages-list').on('mouseleave', '.long_text' , function() {
        $('.show_long_text_2').css('display','none')
    })
    $(document).on( "keydown",  function() {
        $('.show_long_text_2').css('display','none')
    })
    // What happens when an edit button on one of the projects in clicked
    $('#messages-list-all').on('mouseenter', '.long_text' , function() {
        email = $(this).data('email')
        message = $(this).data('message')
        start = $(this).data('start')
        end = $(this).data('end')
        new_date = $(this).data('new_date')

        
        $('#info_description_long').text("Email : " + email + " | Message: " + message + " | Start: " + start + " | End: " + end + " | New Date Request: " + new_date)    
        // Get the height
        height = $('.show_long_text_2').height()
 
        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".show_long_text_2").css({
            position: "absolute",
            top: (topOffset - height - 19)+ "px",
            left: (offset.left) + "px",
        });
        $('.show_long_text_2').css('display','block')
        
    })
    // What happens when an edit button on one of the projects in clicked
    $('#messages-list-all').on('mouseleave', '.long_text' , function() {
        $('.show_long_text_2').css('display','none')
    })