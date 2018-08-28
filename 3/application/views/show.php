 <?php
 	foreach ($dt->result() as $row) {
 		$date = $row->ddate;
 		$max = $row->maxi;
 		$min = $row->mini;
 		$var = $row->varianc;
 	}
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('../js/bootstrap/css/bootstrap.css"')?>">
  	<center>
  	<h2>Show</h2>
	  	<div class="panel-body">
		    <table class="table table-bordered nowrap" style="width:40%">
		      <thead>
		        <tr>
		          <th width="40%">Date</th>
		          <th><?php echo $date; ?></th>
		        </tr>
		        <tr>
		          <th>Max</th>
		          <th><?php echo $max; ?></th>
		        </tr>
		        <tr>
		          <th>Min</th>
		          <th><?php echo $min; ?></th>
		        </tr>
		        <tr>
		          <th>Variance</th>
		          <th><?php echo $var;?></th>
		        </tr>
		      </thead>
		      <tbody id="viewdt">
		      </tbody>
		    </table>
		</div>
	<a href="<?php echo base_url('Weight')?>">Back</a>
	</center>
