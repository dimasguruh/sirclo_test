<?php
$con = mysqli_connect("localhost","root","","project_tes");
?>

<?php
	$pro = $_POST['dp'];
	$ha = substr($pro, 0,1);
	if($ha == 'a') {
		$kode = substr($pro,11,1);
		$qty = substr($pro,13,-1);
		$query = mysqli_query($con,"SELECT * FROM cart WHERE idpro = '$kode'");
		if(mysqli_num_rows($query)>0) {
			while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) 
			{
				$aqty = $row['qty'];
			}
			$nowqty = $qty + $aqty;
			$quei = mysqli_query($con,"UPDATE cart SET qty = '$nowqty' WHERE idpro='$kode'");
		}
		else{
			$quei = mysqli_query($con, "INSERT INTO cart(idpro,qty) VALUES('$kode','$qty')");
		}
		$arr[] = array('status' => "berhasila");
		echo json_encode($arr);
	}else if ($ha == 'r'){
		$kode = substr($pro,14,1);
			$quei = mysqli_query($con,"DELETE FROM cart WHERE idpro='$kode'");
		$arr[] = array('status' => "berhasilr");
		echo json_encode($arr);
	}else if ($ha == 's'){
		$query = mysqli_query($con,"SELECT * FROM cart as a INNER JOIN produk as b ON a.idpro = b.id");
		if(mysqli_num_rows($query)>0) {
			while ($row = mysqli_fetch_array($query,MYSQLI_BOTH)) {
			$arr[] = array('produk'=>$row['produk'],
						   'qty'=> $row['qty'],
						   'status'=>"berhasils"); 
			}
		}else{
			$arr[] = array('status'=>'tidakb');
		}
		
		echo json_encode($arr);
	}
?>