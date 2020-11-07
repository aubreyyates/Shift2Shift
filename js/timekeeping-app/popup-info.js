function popupInfo(divId, message) {

    let node = document.createElement('div');
    node.innerHTML =
        `
    <div id='timekeeping-app-popup-info' >
        <div id='timekeeping-app-popup-info-container'> 

            <div id='timekeeping-app-popup-info-left'>
                <p class='font-1' id='timekeeping-app-popup-info-words'>${message}</p>
            </div>
            <div id='timekeeping-app-popup-info-right'>
                <img src='images/checkmark.png' id='timekeeping-app-popup-info-checkmark'>
            </div>
        </div>
    </div>
    `;

    document.getElementById(divId).innerHTML = '';
    document.getElementById(divId).append(node);
    document.getElementById(divId).style.display = 'block';
    document.getElementById(divId).style.opacity = 1;
    fadeOutEffect(divId);

    function fadeOutEffect(divId) {
        var fadeTarget = document.getElementById(divId);
        var fadeEffect = setInterval(function () {
            if (!fadeTarget.style.opacity) {
                fadeTarget.style.opacity = 1;
            }
            if (fadeTarget.style.opacity > 0) {
                fadeTarget.style.opacity -= 0.05;
            } else {
                document.getElementById(divId).innerHTML = ''
                clearInterval(fadeEffect);
            }
        }, 100);
    }
}

