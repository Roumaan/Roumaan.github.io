var animNameRadio = document.getElementById("nameForm");
var f = true;
for (var i = 1; i <= animCount; i++) {
	var p = document.createElement('P');
	p.id = i;
	animNameRadio.appendChild(p);

	if (!f) {
		p.innerHTML = "<input name=\"animName\" type=\"radio\" value=" + i + "> anim" + i;
	} else {
		p.innerHTML = "<input name=\"animName\" type=\"radio\" value=" + i + " checked> anim" + i;
		f = false;
	}
}
