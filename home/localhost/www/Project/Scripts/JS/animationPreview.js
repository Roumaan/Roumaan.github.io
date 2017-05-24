// \/ Функция полученя значения радио кнопок 
function getRadioVal(name /*Имя радиокнопок*/ ,
	initVal /*Значение если радиокнопок нет*/ ) {
	var radioVal = initVal;

	//Перебор радиокнопок по имени
	for (var i = 0; i < document.getElementsByName(name).length; i++) {
		//Если значение радиокнопки есть и она выбрана,
		if (document.getElementsByName(name)[i].value != "" &&
			document.getElementsByName(name)[i].checked) {
			//то переписать её значение в возвращемую переменную
			radioVal = document.getElementsByName(name)[i].value;
		}
	}
	return radioVal; //Вернуть результат
}

// \/ Получить весь ввод и обновить анимацию
function change() {
	var anim = document.getElementById("anim"); //Получаем анимируемый объект

	var time = document.getElementById("time").value; //Получаем время воспроизведения анимации
	var animId = getRadioVal("animName", 1); //Получаем номер анимации
	var animTFunc = getRadioVal("animTimeFunc", "linear"); //Получаем правило воспроизведения анимации

	anim.style.animationName = "anim" + animId; //Устанавиливаем анимацию на анимируемый объект
	anim.style.animationDuration = time + "s"; //Устанавливаем время воспроизведения анимации
	anim.style.animationTimingFunction = animTFunc; //Устанавливаем правило воспроизведения анимации
	anim.style.animationIterationCount = "infinite" //Устанавливаем колл-во воспроизведений на бесконечное		
}
