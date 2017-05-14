//var response;
/*
function getXmlHttp() {
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;

}

function getResponse() {
	var styleAdress = document.styleSheets[0].href;
	var xmlhttp = getXmlHttp();
	xmlhttp.open('GET', 'styleAdress');
	alert(1);
	xmlhttp.onload = function a(e) {
		alert(2);
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			alert(3);
			response = xmlhttp.responseText;
			alert(response);
		}
		alert(4);
	};
	alert(5);
}
*/

var style = 0;
// Создали промежуточный блок div#temp
var tempDiv = $('body').append($('<div/>').attr('id', 'temp')).find('#temp');
// Загрузили данные в этот блок
tempDiv.load("/test.txt");
// Записали ответ в переменную
myVar = tempDiv.text();
// Удалили промежуточный блок
tempDiv.remove();
var r = /@keyframes/ig;
while (style == null) {
	if (r.exec(style) != null) {
		var anims = r.exec(style);
		alert(anims);
	} else {
		alert("Error!");
	}
}
