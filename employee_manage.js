$(document).ready(function() {   
    

    // What happens if the arrow forward button is clicked
    $( "#view-forward" ).click(function() {
        // Display the back arrow to view previous
        $('#view-backward').css('display','inline')
        vnum_s += 25
        vnum_e += 25
        // Check if date filter is on
        if ( filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })
    // What happens if the arrow backward button is clicked
    $( "#view-backward" ).click(function() {
        // Display the foward arrow to view more
        $('#view-forward').css('display','inline')
        vnum_s -= 25
        vnum_e -= 25
        // Check if date filter is on
        if ( filter_date == false){
            // Display all of these projects at the start of page
            display_all()
        } else {
            // Display only filtered dates
            date_compare()
        }
    })

    // What happens if the sorting menu is changed
    $('#sorting').change(function() {
        
        if ($('#sorting').val() == 'Alphabetical') {
            

            entries = merge_alphabetical_project_name(entries)

            if ( filter_date == false){
                
                display_all()
            } else {
                date_compare()
            }


        } else if ($('#sorting').val() == 'Date'){

        
            entries = merge_date(entries)
            if ( filter_date == false){
                
                display_all()
            } else {
                date_compare()
            }
            

                        
        } else if ($('#sorting').val() == 'Length'){

            entries = merge_length(entries)
            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }



        } else if ($('#sorting').val() == 'Date Created') {
            entries = entries_original
            if ( filter_date == false){
                display_all()
            } else {
                date_compare()
            }


        }
    })

    // What happens if the filter button is clicked
    $( "#filter-button" ).click(function() {
        
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')

        filter_date = true;

        // Gets what filter type the user selected
        //all, day, month, or year
        type = $('#filter-type').val()

        

        // If the type was 'all' the page is refreshed
        switch (type) { //should use switch statement
            
        case 'all': 
            // Refreshes page
            location.reload();
            break;
        
        // What happens if the type was year
        case 'year':
            $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
            date_compare()
            break;
        
        // What happens if the type was month
        case 'month':
            $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
            date_compare()
            break;

        // What happens if the type was month
        case 'week':
            $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
            date_compare()
            break;
        
        // What happens if the type was day
        default:
            $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            date_end = date.clone()
            $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            date = moment().startOf('day');
            date_end = moment().endOf('day');
            date_compare()
            break;
        }
        // Load what is found for that date into the #search-results div
        $(document.getElementById('filter-date-slide')).css('display','block')
    })

    // What happens if the arrow forward on the time filter is clicked
    $( "#time-forward" ).click(function() {  
        
        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')

        if (type=='year') {
            date.add(1, 'years').calendar();
            date_end.add(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.add(1, 'months').calendar();
            date_end.add(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.add(7, 'days').calendar();
            date_end.add(7, 'days').calendar()
            week()
            date_compare()
        } else if (type=='day') {
            date.add(1, 'days').calendar();
            date_end.add(1, 'days').calendar();
            day()
            date_compare()
        }
    })

    // What happens if the arrow backward on the time filter is clicked
    $( "#time-back" ).click(function() {

        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')

        if (type=='year') {
            date.subtract(1, 'years').calendar();
            date_end.subtract(1, 'years').calendar();
            year()
            date_compare()
        } else if (type=='month') {
            date.subtract(1, 'months').calendar();
            date_end.subtract(1, 'months').calendar();
            month()
            date_compare()
        } else if (type=='week') {
            date.subtract(7, 'days').calendar();
            date_end.subtract(7, 'days').calendar();
            week()
            date_compare()
        } else if (type=='day') {
            date.subtract(1, 'days').calendar();
            date_end.subtract(1, 'days').calendar();
            day()
            date_compare()
        }
    })

    // What happens if the date is changed on the custom start calendar
    $('#start-display').change(function() {

        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')

        if ( moment($('#start-display').val()).unix() < date_end.unix()) {
            date = moment($('#start-display').val())
            $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            date_compare()
        } else {
            alert("Your start date is later than your end date.")
            $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
        }
        
    })
    // What happens if the date is changed on the custom end calendar
    $('#end-display').change(function() {

        // Set the current projects viewed
        vnum_s = 0;
        // Set the last project to view
        vnum_e = 25;
        // Stop displaying the backward arrow
        $('#view-backward').css('display','none')

        if ( date.unix() < moment($('#end-display').val()).unix()) {
            date_end = moment($('#end-display').val())
            $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            date_compare()
        } else {
            alert("Your start date is later than your end date.")
            $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
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
            csvFirstLine = 'Id, Date, Start Time, AM/PM, End Time, AM/PM, Length, Project Name, Description\r\n'


            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                return checkbox.value;
            })

            if (arr.length == 0) {
                if (filter_date == true ) {
                    csvContent = ConvertToCSV_filter(entries)
                } else {
                    csvContent = ConvertToCSV(entries)
                }
            } else {
                csvContent = ConvertToCSV_selected(entries, arr)
            }
            
            csvContent = csvFirstLine + csvContent

            var blob = new Blob([csvContent]);
            if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
                window.navigator.msSaveBlob(blob, "employee_data.csv");
            else
            {
                var a = window.document.createElement("a");
                a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
                a.download = "employee_data.csv";
                document.body.appendChild(a);
                a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
                document.body.removeChild(a);
            }
        

        } else if (export_type == 'excel') {


            var excel = $JExcel.new("Calibri light 10 #333333");            
            excel.set( {sheet:0,value:"Employee Data" } );
            var evenRow=excel.addStyle( { border: "none,none,none,thin #333333"});        
            var oddRow=excel.addStyle ( { fill: "#ECECEC" ,border: "none,none,none,thin #333333"}); 
            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                return checkbox.value;
            })
            if (arr.length == 0) {
                if (filter_date == false) {
                    for (var i=1;i<entries.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });     
                } else {
                    for (var i=1;i<total_view;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });     
                }         
            } else {
                for (var i=1;i<arr.length;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });   
            }          
            var headers=["Id", "Date", "Start Time", "AM/PM", "End Time","AM/PM","Length","Project Name","Description"];                            
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
            var c = 0



            
            if (arr.length == 0 ) {
                if (filter_date == false) {
                    for (var i=0;i<entries.length;i++){                                    
                        excel.set(0,0,i + 1,entries[i].id);                                  
                        excel.set(0,1,i + 1,entries[i].date);                  
                        excel.set(0,2,i + 1,entries[i].start);          
                        excel.set(0,3,i + 1,entries[i].startdiem);   
                        excel.set(0,4,i + 1,entries[i].end);     
                        excel.set(0,5,i + 1,entries[i].enddiem);                  
                        excel.set(0,6,i + 1,entries[i].time);          
                        excel.set(0,7,i + 1,entries[i].project_name);   
                        excel.set(0,8,i + 1,entries[i].description);                 
                    }
                } else {
                    for (var i=0;i<entries.length;i++) {   
                                    
                        if ( moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix() ) {   
                                        
                            excel.set(0,0,c + 1,entries[i].id);                                  
                            excel.set(0,1,c + 1,entries[i].date);                  
                            excel.set(0,2,c + 1,entries[i].start);          
                            excel.set(0,3,c + 1,entries[i].startdiem);   
                            excel.set(0,4,c + 1,entries[i].end);     
                            excel.set(0,5,c + 1,entries[i].enddiem);                  
                            excel.set(0,6,c + 1,entries[i].time);          
                            excel.set(0,7,c + 1,entries[i].project_name);   
                            excel.set(0,8,c + 1,entries[i].description);    
                            c += 1  
                        }             
                    }
                }
                
            } else {

                for (var i=0;i<entries.length;i++) {   
                    if (entries[i].id == arr[c]) { 
                                        
                        excel.set(0,0,c + 1,entries[i].id);                                  
                        excel.set(0,1,c + 1,entries[i].date);                  
                        excel.set(0,2,c + 1,entries[i].start);          
                        excel.set(0,3,c + 1,entries[i].startdiem);   
                        excel.set(0,4,c + 1,entries[i].end);     
                        excel.set(0,5,c + 1,entries[i].enddiem);                  
                        excel.set(0,6,c + 1,entries[i].time);          
                        excel.set(0,7,c + 1,entries[i].project_name);   
                        excel.set(0,8,c + 1,entries[i].description);    
                        c += 1  
                    }             
                }
            }
            
            
            
            excel.set(0,3,undefined,10);                                
            excel.set(0,5,undefined,10);            
            excel.set(0,8,undefined,50);                   

            excel.generate("employee_data.xlsx");
        } else if (export_type == 'pdf') {

            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                return checkbox.value;
            })
            var doc = new jsPDF()
            doc.setFontSize(8);
            doc.text('ID', 10, 10)
            doc.text('Date', 25, 10)
            doc.text('Start', 50, 10)
            doc.text('End', 70, 10)
            doc.text('Length', 90, 10)
            doc.text('Project Name', 110, 10)
            var c = 0
            if (arr.length == 0){
                if (filter_date == false ) {
                    for (var i=0;i<entries.length;i++) {                               
                        doc.text(entries[i].id, 10,i*5+20)                                  
                        doc.text(entries[i].date, 25,i*5+20)
                        doc.text(entries[i].start.substring(0,10), 50,i*5+20)  
                        doc.text(entries[i].startdiem, 58,i*5+20)  
                        doc.text(entries[i].end, 70,i*5+20)     
                        doc.text(entries[i].enddiem.substring(0,10), 78,i*5+20)  
                        doc.text(entries[i].time, 90,i*5+20)

                        doc.text(entries[i].project_name.substring(0,33), 110,i*5+20)        
                    }
                } else {
                    for (var i=0;i<entries.length;i++) {       
                        if ( moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix() ) {                           
                            doc.text(entries[i].id, 10,c*5+20)                                  
                            doc.text(entries[i].date, 25,c*5+20)
                            doc.text(entries[i].start.substring(0,10), 50,c*5+20)  
                            doc.text(entries[i].startdiem, 58,c*5+20)  
                            doc.text(entries[i].end, 70,c*5+20)     
                            doc.text(entries[i].enddiem.substring(0,10), 78,c*5+20)  
                            doc.text(entries[i].time, 90,c*5+20)  
                            doc.text(entries[i].project_name.substring(0,33), 110,c*5+20)               
                            c += 1
                        }
                    }
                }
            } else {
                for (var i=0;i<entries.length;i++) {       
                    if (entries[i].id == arr[c]) {                         
                        doc.text(entries[i].id, 10,c*5+20)                                  
                        doc.text(entries[i].date, 25,c*5+20)
                        doc.text(entries[i].start.substring(0,10), 50,c*5+20)  
                        doc.text(entries[i].startdiem, 58,c*5+20)  
                        doc.text(entries[i].end, 70,c*5+20)     
                        doc.text(entries[i].enddiem.substring(0,10), 78,c*5+20)  
                        doc.text(entries[i].time, 90,c*5+20)  
                        doc.text(entries[i].project_name.substring(0,33), 110,c*5+20)               
                        c += 1
                    }
                }                    
            }
            doc.save('employee_data.pdf')


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
    function ConvertToCSV_filter(objArray) {
        var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
        var str = '';

        for (var i = 0; i < array.length; i++) {
            if ( moment(array[i].date).unix() >= date.unix() && moment(array[i].date).unix() < date_end.unix() ) {
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
    // JSON to CSV Converter
    function ConvertToCSV_selected(objArray, selected) {
        var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
        var str = '';
        j = 0
        for (var i = 0; i < array.length; i++) {
            if (objArray[i].id == selected[j]) {

                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','

                    line += array[i][index];
                }

                str += line + '\r\n';
                j+=1
            }
        }

        return str;
    }

})

    // Function to display all of the entries
    function display_all(){
        // Clear all entries
        $('#list').html('')
        //
        $('.info_project').css('display','none');
        // Create moment duration to add up total time
        total_time = moment.duration()
        // Check to see how far to make lines
        if (entries.length > vnum_e) {
            // Set max view to num_e
            max_view = vnum_e
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1)+ " - " + (vnum_e))
            // Check if they are viewing the first entries
            if (vnum_s == 0) {
                // Stop displaying the backward arrow as there are no more to see
                $('#view-backward').css('display','none')
            }
            
        } else {
            // Set max view to length of entries
            max_view = entries.length
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1) + " - " + entries.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display','none')
        }
        // Go through every entry
        for (i = vnum_s; i < max_view; i++) {
            // Get the html for the entry
            text = prepare_entry_line(entries[i].project_name,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
        for (i = 0; i< entries.length; i++){
            // Create time entry object
            entry_time = moment.duration(entries[i].time)  
            // Add to the total time
            total_time.add(entry_time) 
        }
        // Put the total time at the bottum
        $('#total_time').html(total_time.format('HH:mm:ss'))
    }

    // Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
    function date_compare() {
        // Clear out the entries
        $('#list').html('')
        //
        $('.info_project').css('display','none');
        // Create moment duration to add up total time
        total_time = moment.duration()
        // Go through every entry
        for (i = 0; i < entries.length; i++) {  
            // Check if the search is in the name
            if ( moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix() ) {
                // Add to the search objects
                search_objects.push(entries[i])
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
            // Display the foward arrow
            $('#view-forward').css('display','inline')
        } else {
            // Set max view to length of project
            max_view = search_objects.length
            // Set the pagination indicator
            $('#pagination').text((vnum_s + 1) + " - " + search_objects.length)
            // Stop displaying the foward arrow as there are no more to see
            $('#view-forward').css('display','none')
        }
        // Go through every entry
    
        for (i = vnum_s; i < max_view; i++) {
            // Get the html for the entry
            text = prepare_entry_line(search_objects[i].project_name,search_objects[i].date ,search_objects[i].time, search_objects[i].id, search_objects[i].start,search_objects[i].startdiem,search_objects[i].end,search_objects[i].enddiem ,search_objects[i].description)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
        for (i = 0; i< search_objects.length; i++){
            // Create time entry object
            entry_time = moment.duration(search_objects[i].time)  
            // Add to the total time
            total_time.add(entry_time) 
        }
        // Put the total time at the bottum
        $('#total_time').html(total_time.format('HH:mm:ss'))
        // Get search object length
        total_view = search_objects.length
        // Reset the search objects 
        search_objects = []   
    }

    // Create the entry lines with html
    function prepare_entry_line(project_name,date,time,id,start,startdiem,end,enddiem,description) {
        // Create the text for the entry
        text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'>"
        line_data =  "Project Name: " + project_name + " | Date: " + date + " | Time: " + time 
        text_2 = "</div><label style = 'margin-top:10px; float:right; margin-right:15px;' class='checkbox-container'><input class='entry_check' type='checkbox' name='num[]' value='" + id + "'><span class='checkmark'></span></label><button type='submit' value='" + id + "' class='info_button_managetime entry-button-style-2 wide60' name='time_id'>Info</button><button type='button' data-start='" + start +"' data-startdiem ='" + startdiem + "' data-end='" + end +"' data-enddiem='" + enddiem + "' data-date='" + date + "' data-description='" + description + "' value='" + id + "' class='edit entry-button-style-2 wide60 time_id' name='time_id'>Edit</button></div></div>";
        // Get the length of the string in pixels
        var len = ctx.measureText(line_data).width;
        // Check if it is greater than 380
        if (len > 430) {
            // Keep removing letters until it is less than 375 pixels long
            while (len > 430) {
                // Remove the last letter
                line_data = line_data.substring(0, line_data.length - 1);
                // Get the new length of string in pixels
                len = ctx.measureText(line_data).width;
            }
            // Add dots at end
            line_data += "..."
            // Add a class to the text div so you can hover and see the rest
            text_1 = "<div class='entry_template'> <div id='entry_box' class='entry_line'><div id='entry_text' class='long_text' data-project_name='" + project_name + "' data-date='" + date + "' data-time='" + time + "' style='float:left;margin-left:12px;font-size:16px;'>"
        }
        text = text_1 + line_data + text_2
        // Return the text
        return text
    }
    function year(){

        $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
        $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
        date_format = date.format('YYYY');
    }
    function month(){

        $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
        $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
        date_format = date.format('YYYY-MM');
    }
    function week() {

        $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
        $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
        date_format = date.format('YYYY-MM-DD');
    }
    function day(){

        $(document.getElementById('start-display')).val(date.startOf('day').format('YYYY-MM-DD'))
        $(document.getElementById('end-display')).val(date_end.endOf('end').format('YYYY-MM-DD'))
        date_format = date.format('YYYY-MM-DD');        

    }

    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseenter', '.long_text' , function() {
        
        project_name = $(this).data('project_name')
        date = $(this).data('date')
        time = $(this).data('time')
        
        $('#info_description_long').text("Project Name: " + project_name + " | Date: " + date + " | Time: " + time)    
        // Get the height
        height = $('.show_long_text').height()

        var offset = $(this).offset();	
        /*get the top Position of the info element. $(window).scrollTop() is used to calculate the right top coordinate of the button element after the window is scrolled*/
        var topOffset = $(this).offset().top;
        /*set the position of the info element*/
        $(".show_long_text").css({
            position: "absolute",
            top: (topOffset - height)+ "px",
            left: (offset.left) + "px",
        });
        $('.show_long_text').css('display','block')
        
    })
    // What happens when an edit button on one of the projects in clicked
    $('#list').on('mouseleave', '.long_text' , function() {
        $('.show_long_text').css('display','none')
    })