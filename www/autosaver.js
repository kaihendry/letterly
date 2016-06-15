// Based on work by Alejandro Ugarte
//
// get the state of the form
function getFormState() {
    var fields = document.getElementsByTagName('form')[0].elements;
    if (fields.length == 0){return};
    for (var i = 0; i <= fields.length-1; i++) {
        var name = fields[i].getAttribute('name');
        if (name in localStorage && localStorage[name] !== null) {
            fields[i].value = localStorage[name];
        }
    }
}

function saveFormState() {
    var fields = document.getElementsByTagName('form')[0].elements;
    if (fields.length == 0){return};
    var populated = false;
    for (var i = 0; i <= fields.length-1; i++) {
        var name = fields[i].getAttribute('name');
        if (fields[i].value != '' && fields[i].getAttribute('type') != 'submit') {
           localStorage[name] = fields[i].value;
           populated = true;
        }
    }
    // display the time form data was saved (optional)
    if (populated) {
        var date = new Date();
        var hours = date.getHours();
        var mins = date.getMinutes();
        var secs = date.getSeconds();
        hours = (hours < 10) ? '0' + hours : hours;
        mins = (mins < 10) ? '0' + mins : mins;
        secs = (secs < 10) ? '0' + secs : secs;
        var msg = 'Form data was saved at ' + hours + ':' + mins + ':' + secs;
        var timecont = document.getElementById('time_container');
        if (timecont !== null) {
            timecont.innerHTML = msg;
        }
        else {
            timecont = document.createElement('span');
            timecont.setAttribute('id', 'time_container');
            timecont.appendChild(document.createTextNode(msg));
            document.getElementsByTagName('form')[0].appendChild(timecont);
        }
    }
}

// run the above functions when the web page is loaded
window.onload = function () {
    // check if HTML5 localStorage is supported by the browser
    if ('localStorage' in window && window['localStorage'] !== null) {
        // get the form state
        getFormState();
        // save the state of the form each 15 seconds (customizable)
        setInterval('saveFormState()', 15 * 1000);
    }
}
