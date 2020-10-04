function prepare_empty_line(text) {

    html =
        `
    <div class='entry-template'>
        <div class='entry-line'>
            <div class='entry-empty-line'>
                <p class='entry-empty-line-text'>${text}</p>
            </div>
        </div>
    </div>
    `;

    return html;
}