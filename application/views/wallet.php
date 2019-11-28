<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-chart.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/angular-chart.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.js"></script>

<br clear="all">
<div style="margin-top: 1px;width: 1200px;
  margin: auto; 
  margin-top: 10px; 
  background: #f5f5f5">
<div id="Tleft">
<?php
foreach ($userData as $x ) {
  include 'includes/side.php';
   } ?>

</div>



<div id="TCenter" style="position: absolute; left: 362px;background: #fff; width: 62%;height: 100%;" > 

	<div style="width: 100%; height: 70px;margin: auto;background: #002e6e;box-shadow: 3px 3px 3px #f5f5f5;">
		
		<div style="width: 95%;margin: auto; padding: 15px 0px;">
			<div style="width: 7%; float: left;">
				<img src="<?php echo base_url(); ?>assets/img/wallet-outline.png" style="width: 40px; height: 40px;" >
			</div>
			<div style="width: 15%; float: left;color: #fff;border-right: 1px dotted #ccc; ">
				Rs. <?php echo $wa; ?> <br>
				<small> Your wallet balance </small>
			</div>
			<div style="width: 70%; float: left;color: #fff;">
		      <form action="<?php echo base_url(); ?>Wallet/proceedP" method="post">
		       <input type="hidden" name="name" value="<?php echo $x->name; ?>">
		       <input type="hidden" name="email" value="<?php echo $x->email; ?>">
		       <input type="hidden" name="phone" value="<?php echo $x->mobile; ?>">
				<input type="text" name="amount" style="border: 1px solid #002e6e;margin-top: 8px;margin-left: 15px;height: 25px;width: 350px;color: black" placeholder=" Enter amount to be added ">
				<input type="submit" class="btn-success" value="Add money to wallet" name="">
		      </form> 
			</div>


		</div>
	</div>

	<div style="width: 95%;margin: auto;margin-top: 25px;">
		
		<h3> Credit Transacttions </h3>

		<table border="1" width="100%">
			<tr>
				<td>  S.N. </td>
				<td> Amount </td>
				<td> Date </td>
			</tr>
			<tr>
			<?php 
			$i=1;
			foreach ($transaction as $key => $value) { ?>
				<td>  <?php echo $i; ?> </td>
				<td>  <?php echo $value->incocming_balance; ?> </td>
				<td>  <?php echo $value->time; ?> </td>
				</tr>

	<?php 			$i++;	} ?>
			
				
			
		</table>
		
		<br>

		<h3> Debit Transacttions </h3>

		<table border="1" width="100%">
			<tr>
				<td>  S.N. </td>
				<td> Amount </td>
				<td> Date </td>
			</tr>
			<tr>
			<?php 
			$i=1;
			foreach ($transaction as $key => $value) { ?>
				<td>  <?php echo $i; ?> </td>
				<td>  <?php echo $value->outgoing; ?> </td>
				<td>  <?php echo $value->time; ?> </td>
				</tr>

	<?php 			$i++;	} ?>
			
				
			
		</table>

	</div>

</div>