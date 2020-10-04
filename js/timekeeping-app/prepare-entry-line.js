function prepare_entry_line(item, box_lengths, buttons) {

    var entry_boxs = '';
    var entry_buttons = '';
    var i = 0;

    for (var key in item) {

        var property = item[key];

        entry_boxs += `
        <div class='entry-text-box' data-id=${item.id} style='width:${box_lengths[i]}%;'>
            <p class='font-1'>${property}</p>
        </div>            
        
        `
        i++;

        if (i > box_lengths.length - 1) {
            break;
        }
    }

    for (i = 0; i < buttons.length; i++) {
        entry_buttons += `                    
        <button data-id=${item.id} class='entry-line-button ${buttons[i].class}'>
            <img class='entry-line-button-image-${buttons[i].image}' src='images/${buttons[i].image}.png'>
        </button>`;
    }

    let pixels = buttons.length * 40;
    let width = style = `width:calc(100% - ${pixels}px);`;

    // Create the html needed to create an entry
    let html = `
        <div class='entry-template'>
            <div class='entry-line'>
                <div class='entry-line-user-data' style="${width}">
                    ${entry_boxs}
                </div>
        <div class='entry-line-buttons'>
            ${entry_buttons}
        </div>
            </div>
        </div>
        `;

    // Return the html
    return html;
}