class searchBox {

    constructor(searchBoxId, searchProperty, handleResults, items) {
        this.searcher = new searchFunctions();
        this.searchBoxId = searchBoxId;
        this.searchBoxElement = document.getElementById(this.searchBoxId);
        this.searchBoxElement.addEventListener("input", () => {
            this.inputChange();
        }, false);
        this.createCancelButton();
        this.searchProperty = searchProperty;
        this.items = items;
        this.handleResults = handleResults;
    }

    inputChange() {

        // Check that input is not empty
        if (this.searchBoxElement.value == '') {
            this.cancelButton.style.display = 'none';
            this.handleResults(null);
            return;
        }


        this.cancelButton.style.display = 'block';

        let searchQuery = this.searchBoxElement.value
        this.handleResults(this.searcher.searchObjects(this.items, searchQuery, this.searchProperty));


    }

    createCancelButton() {

        this.cancelButton = document.createElement('div');
        this.cancelButton.innerHTML =
            `
        <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg>
            <g id="Group_2" data-name="Group 2" transform="translate(2.5 2.5)">
            <path class='search-box-cancel-button-svg' id="Path_1" data-name="Path 1" d="M2.845,3.93l20,20" transform="translate(-2.845 -3.93)" fill="none" stroke-linecap="round" stroke-width="3"/>
            <path class='search-box-cancel-button-svg' id="Path_2" data-name="Path 2" d="M22.845,3.93l-20,20" transform="translate(-2.845 -3.93)" fill="none" stroke-linecap="round" stroke-width="3"/>
            </g>
        </svg>
        `;

        this.cancelButton.className = 'search-box-cancel-button';

        this.searchBoxElement.parentNode.insertBefore(this.cancelButton, this.searchBoxElement.nextSibling);
        this.cancelButton.addEventListener('click', () => {
            this.cancelSearch();
        }, false);
    }

    cancelSearch() {
        this.searchBoxElement.value = '';
        this.cancelButton.style.display = 'none';
        this.handleResults(null);
    }

    setPropertyToSearch(searchProperty) {
        this.searchProperty = searchProperty;
    }

    setItems(items) {
        this.items = items;
    }

    rerunSearch() {
        this.inputChange();
    }

};