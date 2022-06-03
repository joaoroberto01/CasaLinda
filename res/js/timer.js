const START_TIME = 5;
var time;
var startTime;

var timer = document.getElementById("timer");
var container = document.getElementsByClassName('timer-container');

var activityEvents = ['mousedown', 'mousemove', 'keydown', 'scroll', 'touchstart'];

activityEvents.forEach(function(eventName) {
	document.addEventListener(eventName, resetTimer, true);
});

resetTimer();

setInterval(function(){
	if(startTime <= 0){
		var m = Math.floor(time / 60);
		var s = time % 60;


		if (m < 10) m = "0" + m;
		if (s < 10) s = "0" + s;

		timer.innerHTML = `${m}:${s}`;
		setTimerVisible(true);

		time--;
		if(time == -1){
			goTo("logout");
		}
	}else{
		startTime--;
		setTimerVisible(false);
	}
}, 1000);

function goTo(link){
	window.location = ROOT_PATH + link;
}

function setTimerVisible(visible){
	if (container.length > 0)
		container[0].style.opacity = visible ? "1" : "0";
	else
		timer.style.opacity = visible ? "1" : "0";
}

function resetTimer(){
	if (startTime == START_TIME)
		return;

	time = INACTIVITY_TIME;
	startTime = START_TIME;

	setTimerVisible(false);
}