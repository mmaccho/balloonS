//Thanks to: http://www.instructables.com/member/TheFreeElectron/
var button_0 = document.getElementById("button_0");
var button_1 = document.getElementById("button_1");

var Buttons = [button_0, button_1];

function change_pin (pic) {
var data = 0;

	var request = new XMLHttpRequest();
	request.open("GET", "gpio.php?pic=" + pic, true);
	request.send(null);

	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			
			if ( !(data.localeCompare("0")) ){
				Buttons[pic].src = "data/img/idle/idle_"+pic+".png";
			}
			else if ( !(data.localeCompare("1")) ) {
				Buttons[pic].src = "data/img/active/active_"+pic+".png";
			}
			else if ( !(data.localeCompare("fail"))) {
				alert ("Something went wrong!" );
				return ("fail");			
			}
			else {
				alert ("Something went wrong!" );
				return ("fail"); 
			}
		}
		else if (request.readyState == 4 && request.status == 500) {
			alert ("server error");
			return ("fail");
		}
		else if (request.readyState == 4 && request.status != 200 && request.status != 500 ) { 
			alert ("Something went wrong!");
			return ("fail"); }
	}	
	
return 0;
}