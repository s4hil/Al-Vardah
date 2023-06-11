<!DOCTYPE html>
<html lang="en">
<head>
    <title>Override</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="assets/imgs/favicon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/common.css">
    <style>
        body{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            width: 30%;
        }
        img[alt="www.000webhost.com"] {
        	display: none !important;
        }
    </style>
</head>
<body>

    <form>
        <h2 class="alert alert-primary">Override Baby</h2>
        <input type="text" id="counter" hidden value="1">
        <input type="text" id="date" class="form-control" placeholder="date"><br>
        <input type="text" id="quantity" class="form-control" placeholder="quantity" required><br>
        <input type="submit" id="submit" class="form-control btn btn-success">
    </form>

    <script src="./assets/js/jquery.min.js"></script>
    <script>
        $("#submit").click((e)=>{
            e.preventDefault();

            let counter = $("#counter").val();

            let date = $("#date").val();
            let quantity = $("#quantity").val();

            let data = {date: date, quantity:quantity};
            let dataJSON = JSON.stringify(data);
            $.ajax({
                url: "assets/php/overideScript.php",
                method: "POST",
                data: dataJSON,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    count = Number(counter) + 1;
                    $("#counter").val(count);

                    let newDate = count+"/5/2021";
                    $("#date").val(newDate);
                    $("#quantity").val("");
                    $("#quantity")[0].focus();

                },
                error: function (){
                    console.log("err with req");
                }
            });
        });
    </script>
</body>
</html>
