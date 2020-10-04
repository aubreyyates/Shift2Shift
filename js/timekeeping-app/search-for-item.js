function search_for_item(item_query, items, property) {

    // Go through every entry
    for (i = 0; i < items.length; i++) {
        // Check if the search matches
        if (item_query == items[i][property]) {
            return items[i];
        }
    }

    return false;
}