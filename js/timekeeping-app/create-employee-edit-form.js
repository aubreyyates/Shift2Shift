function create_employee_edit_form(item) {
    let html =

        `
        <div>
            <div class='edit-form-heading'>
                <h3 id='edit-form-email'>${item.email}</h3>
            </div>
            <div class='divider'></div>
            <div class='space20'></div>
            <div class='edit-form'>
                <form id='edit-account-form'>
                    <input placeholder='First Name' name="first" id='first' class='form_input edit-form-input edit-form-input-first' value='${item.first_name}'>
                    <div class='alert_area'><p id='first_alert' class='form_alert'></p></div>
                    <input placeholder='Last Name' name="last" id='last' class='form_input edit-form-input edit-form-input-last' value='${item.last_name}'>
                    <div class='alert_area'><p id='last_alert' class='form_alert'></p></div>
                    <input placeholder='E-mail' name="email" id='email' class='form_input edit-form-input edit-form-input-email' value='${item.email}'>
                    <div class='alert_area'><p id='email_alert' class='form_alert'></p></div>    
                    <input name="id" class='edit-form-hidden-form-input' id='edit-account-id' value='${item.id}'>
                </form>

                <button data-form='edit-account-form' class='signup-form-button edit-form-save submit-account-form' >Save</button>
            </div>
            
        </div>

    `;

    return html;
}