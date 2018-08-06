

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