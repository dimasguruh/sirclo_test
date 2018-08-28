<!DOCTYPE html>
<html>
<head>
	<title>Membuat Inputan Hanya Angka Dengan Javascript | www.malasngoding.com</title>
</head>
<body>
	<h1>Membuat Inputan Hanya Angka Dengan Javascript</h1>
	<h2>www.malasngoding.com</h2>
 
	<input type="text" onkeypress="return hanyaAngka(event)"/>
 
	<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
</body>
</html>