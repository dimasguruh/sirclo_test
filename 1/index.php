<!DOCTYPE html>
<html>
<head>
	<title>Make a Pattern</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.css">
<center>
	<h3>Please Input The Number</h3>
	<input type="text" id="angka"><br><br>
	<button id="sub" size="10">GO</button><br><br><br>

	<div id="place"></div>
</center>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
	$("#sub").click(function(){
		var b = $('#angka').val();
		$.ajax({
			method : 'POST',
			url : "proses.php",
			data : {angka : b},
			success : function(data){
				$('#place').html(data)
			}
		});
	});
</script>
</body>
</html>