<?php
if (isset($drone_information))
{
$drone_information = (array) $drone_information;
}
$issueby=$drone_information['issueBy'];
$receivedBy=$drone_information['receivedBy'];
$id = isset($drone_information['id']) ? $drone_information['id'] : '';
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
 	<input type="button" value="Print" class="hide-from-printer btn btn-primary" onclick="javascript:window.print();">
</div> 
<div class="admin-box">
	<div class="ruply"><img src="/eventsBonfire/public/themes/default/images/ruptly.jpg" style="width: 200px;height: 40px;"></div>
	<h3>Issue Drone Information</h3>
	<?php echo form_open($this -> uri -> uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
                         
                         <table class="viewtable clear print_table" style="width:700px;">
                                
                             <tr>
                             	 <td>Customer :-
	                                <?php echo ucfirst($customers[$drone_information['drone_customer']]->name); ?>
	                             </td> 
                                
                                 <td>Issue Date :-
                                  <?php echo set_value('drone_information_issueDate', isset($drone_information['issueDate']) ? $drone_information['issueDate'] : ''); ?>
                                 </td>
                                 
                                  <td>Issue By :-
                                     <?php echo ucfirst($userslist[$drone_information['issueBy']]->username) ?>
                            	 </td> 
                        	</tr>
                         
                         	<tr>
                             
                             <td>Return Date :-
                                <?php echo set_value('drone_information_returnDate', isset($drone_information['returnDate']) ? $drone_information['returnDate'] : ''); ?>
                             </td>
                             
	                          <td>Received By:-
	                          
	                          <?php if($drone_information['receivedBy']) { ?>    
	                         
	                             <?php echo ucfirst($userslist[$drone_information['receivedBy']]->username)?>
	                         
	                          <?php } else {?>
	                          	Not Seleted
	                          	<?php } ?> 
	                          	
	                          	
	                           <td>Job:-
	                             <?php echo $drone_information['job'];?>
	                          </td>
                      
						</tr>
                            </table>

						<div style="margin-top: 32px; margin-bottom: -22px;">
							<div style="float: left;>
                             <?php echo form_label('Set Type :', '', array('class' => 'control-label', 'id' => 'drone_information_drone_set_type_label')); ?>
                            </div>
                            
                            <div>
                                <?php echo $drones[$drone_information['drone_set_type']]->setType; ?>
                            </div>
						 </div>
							<br><br>
                    
                    
                         <table class="customTable">
                              <tr>  
                                <td  class="column-check"> 
                                    <input type='checkbox' id='drone_information_djiphantom' name='drone_information_djiphantom' value='1' <?php echo (isset($drone_information['djiphantom']) && $drone_information['djiphantom'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_djiphantom', 1); ?>>1 DJI Phantom 11(Landing gear mounted on)
                                </td> 
                                   
                                 <td  class="column-check">    
                                    <?php echo $drone_information['djiphantom_Val'];?>
                                 </td>
                           
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_zenmuseh_gimbal' name='drone_information_zenmuseh_gimbal' value='1' <?php echo (isset($drone_information['zenmuseh_gimbal']) && $drone_information['zenmuseh_gimbal'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_zenmuseh_gimbal', 1); ?>>2 Zenmuse H3-2D gimbal(Mounted on phantom 11)
                                 </td> 
                                    
                                 <td  class="column-check">        
                                      <?php echo $drone_information['zenmuseh_gimbal_val'];?>
                                </td>
                             </tr>
                            
                             <tr>
                               
                                <td  class="column-check">
								      <input type='checkbox' id='drone_information_geprohero' name='drone_information_geprohero' value='1' <?php echo (isset($drone_information['geprohero']) && $drone_information['geprohero'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_geprohero', 1); ?>>1 Gepro Hero 3+ Silver 
                                 </td>    
                                 <td  class="column-check">        
                                      <?php echo $drone_information['geprohero_val']; ?>
                                </td>
                             
                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_propellers' name='drone_information_propellers' value='1' <?php echo (isset($drone_information['propellers']) && $drone_information['propellers'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_propellers', 1); ?>>2 Sets propellers(8 pics) 
                                 </td>    
                                 <td  class="column-check">       
                                     <?php echo $drone_information['propellers_val']; ?>
                                </td>
                            </tr>
                             
                             <tr>

                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_phantom_batteries' name='drone_information_phantom_batteries' value='1' <?php echo (isset($drone_information['phantom_batteries']) && $drone_information['phantom_batteries'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_phantom_batteries', 1); ?>>6 phantom 11 batteries 
                                 </td>    
                                 <td  class="column-check">      
                                    <?php echo $drone_information['phantom_batteries_val']?>
                                </td>
                            
                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_phantom_chargers' name='drone_information_phantom_chargers' value='1' <?php echo (isset($drone_information['phantom_chargers']) && $drone_information['phantom_chargers'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_phantom_chargers', 1); ?>>2 Phantom 11 Chargers 
                                 </td>    
                                 <td  class="column-check">     
                                    <?php echo $drone_information['phantom_chargers_val']; ?>
                                 </td>
                             </tr>
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_propellor_protection' name='drone_information_propellor_protection' value='1' <?php echo (isset($drone_information['propellor_protection']) && $drone_information['propellor_protection'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_propellor_protection', 1); ?>>1 Set propellor protection 
                                </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['propellor_protection_val']; ?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_screwdriver_set' name='drone_information_screwdriver_set' value='1' <?php echo (isset($drone_information['screwdriver_set']) && $drone_information['screwdriver_set'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_screwdriver_set', 1); ?>>1 Screwdriver Set 
                                 </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['screwdriver_set_val']; ?>
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_single_screwdriver' name='drone_information_single_screwdriver' value='1' <?php echo (isset($drone_information['single_screwdriver']) && $drone_information['single_screwdriver'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_single_screwdriver', 1); ?>>1 Single Screwdriver 
                                </td>
                                
                                 <td  class="column-check">     
                                  <?php echo $drone_information['single_screwdriver_val']; ?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_remote_control' name='drone_information_remote_control' value='1' <?php echo (isset($drone_information['remote_control']) && $drone_information['remote_control'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_remote_control', 1); ?>>DJI DJ6 Remote Control  
                                 </td>
                                
                                 <td  class="column-check">     
                                   <?php echo $drone_information['remote_control_val']; ?>
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_fpv_monitor' name='drone_information_fpv_monitor' value='1' <?php echo (isset($drone_information['fpv_monitor']) && $drone_information['fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_fpv_monitor', 1); ?>>1 FPV Monitor  
                                </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['fpv_monitor_val']; ?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_antennas_fpv_monitor' name='drone_information_antennas_fpv_monitor' value='1' <?php echo (isset($drone_information['antennas_fpv_monitor']) && $drone_information['antennas_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_antennas_fpv_monitor', 1); ?>>2 Antennas for FPV monitor   
                                 </td>
                                
                                 <td  class="column-check">     
                                   <?php echo $drone_information['antennas_fpv_monitor_val'];?>
                                 </td>
                             </tr>   
                             
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_batteries_fpv_monitor' name='drone_information_batteries_fpv_monitor' value='1' <?php echo (isset($drone_information['batteries_fpv_monitor']) && $drone_information['batteries_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_batteries_fpv_monitor', 1); ?>>2 Batteries for FPV monitor   
                                </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['batteries_fpv_monitor_val'];?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_charger_fpv_monitor' name='drone_information_charger_fpv_monitor' value='1' <?php echo (isset($drone_information['charger_fpv_monitor']) && $drone_information['charger_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_charger_fpv_monitor', 1); ?>>1 Charger for FPV monitor batteries    
                                 </td>
                                
                                 <td  class="column-check">     
                                  <?php echo $drone_information['charger_fpv_monitor_val']; ?>
                                 </td>
                             </tr>
                             
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_sun_shades_fpv_monitor' name='drone_information_sun_shades_fpv_monitor' value='1' <?php echo (isset($drone_information['sun_shades_fpv_monitor']) && $drone_information['sun_shades_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_sun_shades_fpv_monitor', 1); ?>>1 Set sun shades for FPV monitor(3pcs)    
                                </td>
                                
                                 <td  class="column-check">     
                                   <?php echo $drone_information['sun_shades_fpv_monitor_val'];?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_console_fpv_monitor' name='drone_information_console_fpv_monitor' value='1' <?php echo (isset($drone_information['console_fpv_monitor']) && $drone_information['console_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_console_fpv_monitor', 1); ?>>1 Monitor console for FPV monitor     
                                 </td>
                                
                                 <td  class="column-check">     
                                   <?php echo $drone_information['console_fpv_monitor_val']; ?>
                                 </td>
                             </tr>
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_micro_sd_cards' name='drone_information_micro_sd_cards' value='1' <?php echo (isset($drone_information['micro_sd_cards']) && $drone_information['micro_sd_cards'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_micro_sd_cards', 1); ?>>2 16GB class 10 micro SD cards with adapter    
                                </td>
                                
                                 <td  class="column-check">     
                                  <?php echo $drone_information['micro_sd_cards_val']; ?>
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_hardcase' name='drone_information_hardcase' value='1' <?php echo (isset($drone_information['hardcase']) && $drone_information['hardcase'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_hardcase', 1); ?>>1 Hardcase     
                                 </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['hardcase_val']; ?>
                                 </td>
                             </tr>
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_spare_screws' name='drone_information_spare_screws' value='1' <?php echo (isset($drone_information['spare_screws']) && $drone_information['spare_screws'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_spare_screws', 1); ?>>1 bag with spare screws,rubber for landing gear,tape,propeller wrench,small allen key     
                                </td>
                                
                                 <td  class="column-check">     
                                    <?php echo $drone_information['spare_screws_val'];?>
                                 </td>
                                
                             </tr>
                             
                        </table>     

		</fieldset>
    <?php echo form_close(); ?>
</div>