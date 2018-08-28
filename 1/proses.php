<?php
$b = $_POST['angka'];;
if(!$b) {
	echo "Number Empty";
}else{
	for ($b=$b; $b>=0 ; $b--) { 
		$bil_awal = $b.$b;
		echo $bil_awal;
		$bil_akhir = $b+2;
		$jum = $b+1;
		for ($i=1; $i<=$jum; $i++) { 
			echo $bil_akhir;
		}
		echo '<br>';
	}
}
?>