<?php

if (isset($issue_mobile))
{
	$issue_mobile = (array) $issue_mobile;
}
$id = isset($issue_mobile['id']) ? $issue_mobile['id'] : '';
$selectedCustomer = $issue_mobile['parentCustomer'];
$selectedMobile = $issue_mobile['parentMobile'];
$selectedSim = $issue_mobile['parentSim'];
$selectedStatus = $issue_mobile['status'];
$selectedAdmin = $issue_mobile['issueBy'];
$charger = $issue_mobile['charger'];
$usb = $issue_mobile['usbCable'];
?>
<style>
	@media print {
	  /* style sheet for print goes here */
	  .hide-from-printer{  display:none; };
	  
	    .desktop #headRow {
        display:none;
	    }
	    
	    .desktop  a {
        display:none;
	    }
	    .desktop  .subnav{
        display:none;
	    }
	    .desktop .navbar {
	        display:none !important;
	    }
	    .print_table{
			padding:20px;
		}
		.print_table td{
			margin-right : 40px;
			width: 400px;
		}
	    
	    
		}
</style>
	
		 <div style="float: right">
		     <input type="button" class="hide-from-printer btn btn-primary" name="Print" value="Print" onclick="javascript:window.print();" />
	    </div>
<div class="admin-box">
	<div class="ruply"><img src="/eventsBonfire/public/themes/default/images/ruptly.jpg" style="width: 200px;height: 40px;"></div>
	<h3>Issue Mobile</h3>
		<fieldset>

			<table class="print_table">
				<tr>
					<td>Customer Name :
						<?php
                        foreach ($cutomers as $customer):
                        if($customer->id==$selectedCustomer)
                        { 
					     echo ucfirst($customer->name);
					    }  
					    endforeach; ?>
				   </td>
				   
				   <td>Status :
				   	<?php echo $issue_mobile['status']; ?></td>
				</tr>
				
				<tr>
					<td>Charger : <?php echo $charger; ?></td>
					<td>USB Cable : <?php echo $usb; ?></td>
				</tr>
				
				<tr>
					<td>Issue Date : <?php echo $issue_mobile['issueDate']; ?></td>
					<td>Return Date : <?php echo $issue_mobile['returnDate']; ?></td>
				</tr>
				
				<tr>
					<td>Issue By :
						<?php
	                    foreach ($admins as $admin):
	                    if($admin->id==$selectedAdmin)
	                    {
						 echo ucfirst($admin->username);
					    } 
					    endforeach; 
				       ?>
				    </td>
				    <td></td>
				    <td></td>
				</tr>
				
				
				<tr style="font-size: 18px; height: 70px;">
					<td >Issue Mobile Details</td>
					<td><td>
					<td></td>
					<td></td>	
				</tr>
				
				<tr>
					<td>Article Description : 
					<?php
					  foreach($mobiles as $mobile) :
						if($mobile->id == $issue_mobile['parentMobile'])
						echo $mobile->articleDescription;					 
					   endforeach;	
                    ?>
                   </td>
					<td>Serial Number: 
					 <?php
						foreach($mobiles as $mobile) :
						if($mobile->id == $issue_mobile['parentMobile'])
						echo $mobile->serialNumber;					 
						endforeach;	
                     ?>
                    </td>
				</tr>
				
				
				<tr>	
					<td>EMEI Number : 
						 <?php
						foreach($mobiles as $mobile) :
						if($mobile->id == $issue_mobile['parentMobile'])
						echo $mobile->imeiNumber;					 
						endforeach;	
                     ?>
					</td>
					
					<td>Inventory Number : 
						<?php
						foreach($mobiles as $mobile) :
						if($mobile->id == $issue_mobile['parentMobile'])
						echo $mobile->inventoryNumber;					 
						endforeach;	
						?>
					</td>
				</tr>
				
				<tr style="font-size: 18px; height: 70px;">
					<td >Issue Sim Details</td>
					<td><td>
					<td></td>
					<td></td>	
				</tr>
				<tr>
					<td>Sim Card Name : 
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->simCardName;					 
						endforeach;	
						?>
					</td>
					
					<td>PUK Code :
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->puk;					 
						endforeach;	
						?>
					</td>
				</tr>
				
				<tr>
					<td>Pin Number : 
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->pin;					 
						endforeach;	
						?>
					</td>
					
					<td>Sim Card Number :
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->simCardNumber;					 
						endforeach;	
						?>
					</td>
				</tr>
				
				
				<tr>
					<td>Telephone No. :
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->telephoneNumber;					 
						endforeach;	
						?>
					</td>
					
					<td>Balance : 
						<?php
						foreach($sims as $sim) :
						if($sim->id == $issue_mobile['parentSim'])
						echo $sim->balance;					 
						endforeach;	
						?>
					</td>
				</tr>
			</table>

		</fieldset>
</div>