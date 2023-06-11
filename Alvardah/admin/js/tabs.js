function hideByDefault() {
				$("#home").hide();
				$("#products").hide();
				$("#orders").hide();
				$("#feedback").hide();
				$("#account").hide();
				$("#about").hide();
}



function hideAll(){
		    	$("#dashboard").css("display", "none");
		    	$("#home").css("display", "none");
		    	$("#products").css("display", "none");
		    	$("#orders").css("display", "none");
		    	$("#feedback").css("display", "none");
		    	$("#account").css("display", "none");
		    	$("#about").css("display", "none");
		    }

function fadeOutRest(name) {
	
	switch(name) {
		
		case dashboard:
		    hideAll();
		    $("#dashboard").fadeIn();
		break;

		case home:
			hideAll();
		    $("#home").fadeIn();
		break;

		case products:
			hideAll();
		    $("#products").fadeIn();
		break;

		case orders:
			hideAll();
		    $("#orders").fadeIn();
		break;

		case feedback:
			hideAll();
		    $("#feedback").fadeIn();
		break;

		case account:
			hideAll();
		    $("#account").fadeIn();
		break;

		case about:
			hideAll();
		    $("#about").fadeIn();
		break;

		default:
		    
		}

}



