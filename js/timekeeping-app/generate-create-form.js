function generate_create_form(heading, table, action, inputType, input, options, hints, validation, id, value) {

    let html =
        `
    <div>
        <div class='edit-form-heading'>    
            <h3>${heading}</h3>
        </div>
        <div class='divider'></div>
        <div class='space20'></div>

        <div class='edit-form'>
        <form id='create-${table}-form'>
            <input id='id' type='hidden' name='id' value='${id}'>
    `;

    inputType.forEach((type, i) => {
        if (type == 'text') {
            html +=
                `
            <div class='form-group'>
                <input ${validation[i]} placeholder='${hints[i]}' name="${input[i]}" id='${input[i]}' class='form-control form_input edit-form-input' value='${value[i]}'>
            </div>
            `;
        } else if (type == 'select') {
            html +=
                `
            <div class='form-group'>
                <select ${validation[i]} placeholder='${hints[i]}' name="${input[i]}" id='${input[i]}' class='form-control form_input edit-form-input'>${options[i]} value='${value[i]}'</select>
            </div>
            `;
        }
    });




    html +=
        `
        </form>

        <button data-form='create-${table}-form' data-table='${table}' data-action='${action}' class='signup-form-button edit-form-save submit-item-form' >Save</button>
    </div>
    `;


    return html;

}