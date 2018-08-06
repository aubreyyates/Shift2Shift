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