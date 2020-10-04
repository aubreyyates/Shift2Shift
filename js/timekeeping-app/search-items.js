// This function will search items for items that have a property with a given value.
// search_query - The search string that was entered by the user
// items - The objects that will be searched

function search_items(items, search_query) {

    let search_results = [];

    // Go through every entry
    for (i = 0; i < items.length; i++) {
        // Check if the search matches
        if (
            items[i].email
                .toLowerCase()
                .includes(search_query.toLowerCase())
        ) {
            // Add to the search objects
            search_results.push(
                items[i]
            );
        }
    }

    return search_results;
}