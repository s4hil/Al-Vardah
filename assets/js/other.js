$(document).ready(()=>{

	// Add item record
	$(".addItem").click((e)=>{
		e.preventDefault();

		let date = $("#date").val();
		let item = $("#item").val();
		let quantity = $("#item-quantity").val();

		let data = { date:date, item:item, quantity:quantity };
		let dataJSON = JSON.stringify(data);

		$.ajax({
			url: "assets/php/addOtherItem.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data) {
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>")
				$(".form")[0].reset();
			},
			error: function () {
				console.log("error with add rec req");
			}
		});	

	});

	// Load Table	
	$("#loadTable").click((e)=>{
		e.preventDefault();
		
		let month = $("#month").val();
		let data = { month:month };
		let dataJSON = JSON.stringify(data);		
		let output = "";

		$.ajax({
			url: "assets/php/fetchPurchasedItems.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data) {
				x = data;
				for(let i = 0; i < x.length; i++){
					output += "<tr><td>"+ x[i].date +"</td><td>"+ x[i].item +"</td><td>"+ x[i].quantity +"</td><td><button class='btn btn-danger del-item' item-id='"+ x[i].id +"'>Delete</button></td></tr>";
				}
				$("#table-body").html(output);
			},
			error: function () {
				console.log("error with load table req");
			}
		});	
	});

	// Delete Item
	$("#table-body").on('click', '.del-item', function () {
		let myThis = this;
		let id = $(this).attr('item-id');
		let data = { id:id };
		let dataJSON = JSON.stringify(data);

		$.ajax({
			url: "assets/php/delPurchasedItem.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data) {
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>")
				$(myThis).closest('tr').fadeOut();
			},
			error: function () {
				console.log("error with del item req");
			}
		});
	});
}); // main