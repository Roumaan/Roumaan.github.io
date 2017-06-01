function getRadioVal(name,initVal) {
	var radioVal = initVal;

	for (var i = 0; i < document.getElementsByName(name).length; i++) {
		if (document.getElementsByName(name)[i].value != "" &&
			document.getElementsByName(name)[i].checked) {
			radioVal = document.getElementsByName(name)[i].value;
		}
	}
	return radioVal;
}

function change() {
	var anim = document.getElementById("anim"); 

	var time = document.getElementById("time").value; 
	var animId = getRadioVal("animName", 1); 
	var animTFunc = getRadioVal("animTimeFunc", "linear");

	anim.style.animationName = "anim" + animId;
	anim.style.animationDuration = time + "s"; 
	anim.style.animationTimingFunction = animTFunc; 
	anim.style.animationIterationCount = "infinite";
}
