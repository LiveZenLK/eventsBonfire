<?php

if (isset($issue_umts_mobile)) {
	$issue_umts_mobile = (array)$issue_umts_mobile;
}
$id = isset($issue_umts_mobile['id']) ? $issue_umts_mobile['id'] : '';
$selectedAdmin = $issue_umts_mobile['parentAdmin'];
$selectedCustomer = $issue_umts_mobile['parentCustomer'];
?>
<style>
	@media print {
		/* style sheet for print goes here */
		.hide-from-printer {
			display: none;
		};

		.desktop #headRow {
			display: none;
		}

		.desktop  a {
			display: none;
		}
		.desktop  .subnav {
			display: none;
		}
		.desktop .navbar {
			display: none !important;
		}
		.printtable{
			padding:20px;
			width: 500px;
		}
		.printtable td{
			margin-right : 40px;
			width: 300px;
		}

	}
</style>
		 <div style="float: right">
		     <input type="button" class="hide-from-printer btn btn-primary" name="Print" value="Print" onclick="javascript:window.print();" />
	    </div>
<div class="admin-box">
	<div class="ruply"><img src="/eventsBonfire/public/themes/default/images/ruptly.jpg" style="width: 200px;height: 40px;"></div>
	<h3>Issue UMTS Mobile</h3>
		<table class="printtable">
			<tr>
				<td>Customer Name : <?php
				foreach ($cutomers as $customer) :
					if ($customer -> id == $selectedCustomer) {
						echo ucfirst($customer -> name);
					}
				endforeach;
 ?></td>
				
				<td>Status : <?php echo $issue_umts_mobile['status']; ?></td>
			</tr>
			
			<tr>	
				<td>Charger : <?php echo $issue_umts_mobile['charger']; ?></td>
				
				<td>USB Cable :  <?php echo $issue_umts_mobile['usbCable']; ?></td>
			</tr>
			
			<tr>	
				<td>Issue Date : <?php echo $issue_umts_mobile['issueDate']; ?></td>
				
				<td>Return Date : <?php echo $issue_umts_mobile['returnDate']; ?></td>
			</tr>	
				<td>Issue By :
					<?php
					foreach ($admins as $admin) :
						if ($admin -> id == $selectedAdmin) {
							echo ucfirst($admin -> username);
						}
					endforeach;
				    ?>
				</td>
				
			<tr>	
				<td style="font-size: 18px; height: 70px;">UMTS Stick Details</td>
			</tr>
				
			<tr>		
				<td>Article Desription :
					<?php
					foreach ($mobiles as $mobile) :
						if ($mobile -> id == $issue_umts_mobile['parentMobile'])
							echo $mobile -> articleDescription;
					endforeach;
                    ?>
				</td>
				
				<td>Serial Number : 
					<?php
					foreach ($mobiles as $mobile) :
						if ($mobile -> id == $issue_umts_mobile['parentMobile'])
							echo $mobile -> serialNumber;
					endforeach;
                    ?>
				</td>
			</tr>	
			
			<tr>
				<td>IMEI Number : 
					<?php
					foreach ($mobiles as $mobile) :
						if ($mobile -> id == $issue_umts_mobile['parentMobile'])
							echo $mobile -> imeiNumber;
					endforeach;
                    ?>
				</td>
				<td>Inventory Number :
					<?php
					foreach ($mobiles as $mobile) :
						if ($mobile -> id == $issue_umts_mobile['parentMobile'])
							echo $mobile -> inventoryNumber;
					endforeach;
                    ?>
				</td>
			</tr>	
			
			<tr>
				<td style="font-size: 18px; height: 70px;">UMTS Sim Details</td>
			</tr>
			
			<tr>	
				<td>Sim Card Name : 
				 <?php
				foreach ($sims as $sim) :
					if ($sim -> id == $issue_umts_mobile['parentSim'])
						echo $sim -> simCardName;
				endforeach;
				 ?>
				</td>
				<td>PUK :
					 <?php
					foreach ($sims as $sim) :
						if ($sim -> id == $issue_umts_mobile['parentSim'])
							echo $sim -> puk;
					endforeach;
				 ?>
				</td>
			</tr>
			
			<tr>	
				<td>PIN :
					 <?php
					foreach ($sims as $sim) :
						if ($sim -> id == $issue_umts_mobile['parentSim'])
							echo $sim -> pin;
					endforeach;
				 ?>
				</td>
				<td>Sim Card Number :
					 <?php
					foreach ($sims as $sim) :
						if ($sim -> id == $issue_umts_mobile['parentSim'])
							echo $sim -> simCardNumber;
					endforeach;
				 ?>
				</td>
			</tr>
			
			<tr>	
				<td>Telephone Number :
					 <?php
					foreach ($sims as $sim) :
						if ($sim -> id == $issue_umts_mobile['parentSim'])
							echo $sim -> telephoneNumber;
					endforeach;
				 ?>
				</td>
				<td>Balance :
					 <?php
					foreach ($sims as $sim) :
						if ($sim -> id == $issue_umts_mobile['parentSim'])
							echo $sim -> balance;
					endforeach;
				 ?>
				</td>
			</tr>
			
		</table>
</div>