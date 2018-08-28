<!DOCTYPE html>
<html>
<head>
	<title>Make a Library	</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.css">
<?php include('db.php') ?>
<center><h2>Library Of Shopping Cart</h2></center><br><br>
	List Of Library You Can Use :
		<ul>
			<li>addProduct(productCode,Qty) -> For Add</li>
			<li>removeProduct(productCode) -> For Remove</li>
			<li>showCart() -> For Show List Of Cart</li>
		</ul>
	<br>
	List Of Product :
	<table class="table table-bordered nowrap" style="width:40%">
		<tr>
			<th style="width:20%">Kode Produk</th>
			<th>Nama Produk</th>
		</tr>
	<?php
		while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) 
		{
	?>
		<tr>
			<td><?php echo $row['id']?></td>
			<td><?php echo $row['produk']?></td>
		</tr>
	<?php
		}
	?>
	</table>
<br><br><br>
<center>
	<div id="placeresult"></div>

	Please Insert a Procedure:<br>
	<textarea id="proplace"></textarea><br>

	<button id="go">Go</button>

<br><br>
<div id="show"></div>
</center> 
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">


	$(document).ready(function(){
		$("#go").click(function(){
			var dataproduk = $("#proplace").val();
			if (!dataproduk.trim()) {
				alert("Please Fill a Procedure");
				return false;
			}
			var dt;
			$.ajax({
				method : 'POST',
				url : 'proses.php',
				data : {dp : dataproduk},
				success : function(data){
					$.each(data, function(i,obj){
						if(obj.status=="berhasila") {
							alert('Add Data Success');		
							location.reload();	
						} 
						else if(obj.status=="berhasilr") {
							alert('Remove Data Success');
							location.reload();

						}
						else if(obj.status=="berhasils"){
							dt = "My Shopping Cart <br> <table class = table table-bordered nowrap><tr><th>Number</th><th>Product</th><th>Quantity </th></tr>"
							var numb = 1;
							$.each(data, function(i,obj){
								dt = dt+"<tr><td>"+numb+"</td><td>"+obj.produk+"</td><td>"+obj.qty+"</td></tr>";
								numb ++;
							});
							dt = dt+"</table>";
							$("#show").html(dt);
						}
						else if(obj.status=="tidakb"){
							dt= dt+"<h2>Shopping Cart Empty</h2>";
							$("#show").html(dt);
						}
						else{
							alert("Failed Input Procedure");
							return false;
						}
					});
				},
				dataType : 'JSON'
			});
		});
	});
</script>
</body>
</html>