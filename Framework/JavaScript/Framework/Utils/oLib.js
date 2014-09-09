/* NOT IMPLEMENTED! DON'T USE ANYTHING FROM HERE */

function ajax(type, url, data, func) {
	var xhr = new XMLHttpRequest();
	xhr.open(type, url);
	xhr.onreadystatechange = function(data) {}

	if(type === 'GET') {
		xhr.send();
	} else {
		xhr.send({data: data});
	}
}

function eventListener(id, func) {
	[].forEach.call(document.querySelectorAll(id), function(el) {
		el.addEventListener('event', func, false);
	});
}