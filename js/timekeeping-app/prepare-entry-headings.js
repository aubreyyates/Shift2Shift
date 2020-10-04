function prepare_entry_headings(headings) {

    let html = "";

    for (i = 0; i < headings.length; i++) {
        html += `
        <div class='timekeeping-app-entry-data-heading-container-heading' style = 'width: ${headings[i].width}%;' >
            <div class='timekeeping-app-entry-data-heading-container-text-container'>
                <p class='timekeeping-app-entry-data-heading-container-text'>${headings[i].text}</p>
            </div>
            <div class='timekeeping-app-entry-data-heading-container-heading-draggable'></div>
        </div> `
    }

    // FIXME!!! Give the job to another function at some point!
    return html;

};