var formValidationMessage = function (data) {
    var form = document.getElementById(data.form),
        eEles = document.getElementsByClassName('i-' + data.form);

    while (eEles.length > 0) {
        eEles[0].parentNode.removeChild(eEles[0]);
    }

    data.errors.forEach(function (error) {
        var eEle = document.getElementById(error.id),
            msgEle = document.createElement('i'),
            msg = document.createTextNode(error.msg);

        msgEle.id = 'i-' + error.id;
        msgEle.class = 'i-' + data.form;
        msgEle.appendChild(msg);
        eEle.parentNode.insertBefore(msgEle, eEle.nextSibling);
    });
};
