$(document).ready(()=>{

	function loadOldPrice(){
		$.ajax({
			url: "assets/php/fetchOldSettings.php",
			method: "GET",
			dataType: "json",
			success: function (data) {
				if (data.res == 1) {
					$("#updateSettings").show();
					$("#addSettings").hide();
					$("#price").val(data.LPV);
					$("#chat-id").val(data.chatID);
					$("#token").val(data.token);
				}
				else {
					$("#updateSettings").hide();
					$("#addSettings").show();
				}
			},	
			error: function (){
				console.log("error with fetchOldSettings req");
			}
		});
	}
	loadOldPrice();

	// Update price 
	$("#updateSettings").click((e)=>{
		e.preventDefault();

		let price = $("#price").val();
		let chatID = $("#chat-id").val();
		let token = $("#token").val();

		let data = { newPrice:price, chatID:chatID, token:token };
		let dataJSON = JSON.stringify(data);
		$.ajax({
			url: "assets/php/updateSettings.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data){
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>");
				loadOldPrice();
			},
			error: function (){
				console.log('error with update req');
			}
		});
	});	

	// Add settings
	$("#addSettings").click((e)=>{
		e.preventDefault();

		let price = $("#price").val();
		let chatID = $("#chat-id").val();
		let token = $("#token").val();

		let data = { price:price, chatID:chatID, token:token };
		let dataJSON = JSON.stringify(data);
		$.ajax({
			url: "assets/php/addSettings.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data){
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>");
				loadOldPrice();
			},
			error: function (){
				console.log('error with add req');
			}
		});
	});	

}); //Main