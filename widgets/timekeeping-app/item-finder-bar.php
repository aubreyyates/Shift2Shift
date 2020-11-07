<div class='timekeeping-app-item-finder-bar'>

    <?php if ($search_box_shown == true) {
        echo "
        <div class='timekeeping-app-item-finder-bar-search-container'>
            <input placeholder='Search' class='timekeeping-app-item-finder-bar-search' id='".$page."-search'>
            <div class='timekeeping-app-item-finder-bar-search-icon'><img class='timekeeping-app-item-finder-bar-search-icon-image' src='images/search-icon.png'></div>
            <div class='timekeeping-app-item-finder-bar-x-icon'  id='".$page."-x-button><img class='timekeeping-app-item-finder-bar-x-icon-image' src='images/x-icon.png'></div>
        </div>
        ";
    }

    ?>

    <div class='timekeeping-app-item-finder-bar-sorting-functions'>
        <div class='timekeeping-app-item-finder-bar-sort-direction-container'>
            <button id='<?php echo $page."-ascending-order"; ?>' class='timekeeping-app-item-finder-bar-sort-direction' value='ascending'>
                <img id='<?php echo $page."-ascending-order-image"; ?>' class='timekeeping-app-item-finder-bar-sort-direction-image' src='images/ascending-icon.png'>
            </button>
        </div>

        <!-- FIXME!!! Change to take in options provided in variables so it can be reused. -->
        <div class='timekeeping-app-item-finder-bar-sort-container'>
            <select class='timekeeping-app-item-finder-bar-sort' id='<?php echo $page."-sort"; ?>'>

            </select>
            <div class='timekeeping-app-item-finder-bar-sort-label-container'>
                <p class='timekeeping-app-item-finder-bar-sort-label'>Sort By:</p>
            </div>
        </div>
    </div>

    <div class='timekeeping-app-item-finder-bar-add-button-container'>
        <button class='timekeeping-app-item-finder-bar-add-button' id='<?php echo $page."-add"; ?>'>+ Add <?php echo $item_type;?></button>
    </div>
</div>