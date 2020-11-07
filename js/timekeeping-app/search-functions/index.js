class searchFunctions {

    // Empty Constructor
    constructor() {
    }

    searchObject(items, searchQuery, property) {

        // Loop through all items
        for (let i = 0; i < items.length; i++) {
            // Check if the search matches
            if (searchQuery == items[i][property]) {
                return items[i];
            }
        }

        return false;
    }

    searchObjects(items, searchQuery, property) {

        let searchResults = [];

        // Go through every item
        for (let i = 0; i < items.length; i++) {
            // Check if the search matches
            if (
                items[i][property].toString()
                    .toLowerCase()
                    .includes(searchQuery.toString().toLowerCase())
            ) {
                // Add to the search objects
                searchResults.push(
                    items[i]
                );
            }
        }

        return searchResults;
    }

}
