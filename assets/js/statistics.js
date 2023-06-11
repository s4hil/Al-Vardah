$(document).ready(()=>{
	// Months Array
	let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	// Set Date
	let now = new Date();
	let monthIndex = now.getMonth();
	let year = now.getFullYear();
	let monthYear = months[monthIndex-1]+"/"+year;

	// Get data from server
	let data = { month:monthIndex };
	let dataJSON = JSON.stringify(data);
	$.ajax({
		url: "assets/php/get6vals.php",
		method: "POST",
		data: dataJSON,
		dataType: "json",
		success: function (data) {
			x = data;

			var ctx = document.getElementById('myChart').getContext('2d');

			var chart = new Chart(ctx, {
				 type: 'line',
		    data: {
		        labels: ['5', '10', '15', '20', '25', '30'],
		        datasets: [{
		            label: 'Stats for the month: '+ monthYear,
		            data: [x[0],x[1],x[2],x[3],x[4],x[5]],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		    	responsive: false,
		        scales: {
		            y: {
		                beginAtZero: true
		            }
		        }
		    }
		});

		},
		error: function (){
			console.log("error with geting vals req.");
		}
	});

 	$("#download-img").click(()=>{

        var node = document.getElementById('chart-box');

        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                downloadURI(dataUrl, "a.jpg")
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });

    function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }
 	});
	

}); //main