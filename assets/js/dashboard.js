$(document).ready(()=>{

	// Set date in date field
	function setDate() {
		let now = new Date();
		let days = now.getDate();
		let month = now.getMonth()+1;
		let year = now.getFullYear();
		let date = days +"/"+ month +"/"+ year;
		$("#date").val(date);
		$("#date-label").text(date);
	}
	setDate();

	// Load Table
	function loadTable() {
		let date = $("#date").val();
		let data = { date:date };
		let dataJSON = JSON.stringify(data);
		let output = "";
		$.ajax({
			url: "assets/php/fetchRecords.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data) {
				x = data;
				for(let i = 0; i < x.length; i++){
					output += "<tr><td>" + x[i].date + "</td><td>" + x[i].quantity + "</td><td><button class='ml-2 btn btn-danger del' rec-id='"+ x[i].id +"'><i class='fas fa-trash-alt'></i> Delete</button></td></tr>";
				}
				$("#table-body").html(output);
			},
			error: function() {
				console.log("Error with load table req.");
			}
		});
	}
	loadTable();

	// Save New Entry
	$(".addRecord").click((e)=>{
		e.preventDefault();

		let date = $("#date").val();
		let quantity = $("#quantity").val();

		let data = { date:date, quantity:quantity };
		let dataJSON = JSON.stringify(data);

		$.ajax({
			url: "assets/php/addRecord.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function(data) {
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>");
				$("#quantity").val("");
				$("#quantity").focus();
				loadTable();
			},
			error: function () {
				console.log("Error with adding rec req.");
			}
		});
	});

	// Show confirmation modal on each click
	$("#table-body").on('click', '.del', function () {
		let id = $(this).attr('rec-id');
		$("#delRecID").val(id);
		$("#delete-modal").modal('show');
	});

	// Delete record after confirmation
	$("#delRecord").click(()=>{
		let id = $("#delRecID").val();
		let data = { delID:id };
		let dataJSON = JSON.stringify(data);

		$.ajax({
			url: "assets/php/deleteRecord.php",
			method: "POST",
			data: dataJSON,
			dataType: "json",
			success: function (data) {
				$(".msg").html("<div class='alert alert-warning'><i class='fas fa-info-circle'></i> "+ data +"</div>");
				$("#delete-modal").modal('hide');
				loadTable();
			},
			error: function () {
				console.log("error with del req.");
			}
		});
	});

	//Close Modal
	$("#close-modal").click(()=>{
		$("#delete-modal").modal('hide');
	});	


	// Adding Edit functionality
	$("#table-body").on('click', '.edit', function () {
		
	});

}); // main