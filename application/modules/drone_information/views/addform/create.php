<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;
if (isset($drone_information))
{
$drone_information = (array) $drone_information;
}
$id = isset($drone_information['id']) ? $drone_information['id'] : '';
?>
<div class="admin-box">
	<h3>Drone Information</h3>
	<?php echo form_open($this -> uri -> uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
                    
            <div class="control-group" style="height: 60px;">
                 <div class="control-group <?php echo form_error('drone_information_drone_customer') ? 'error' : ''; ?>" style="float: left; width: 350px; border: none;">
                      <!--
						<?php // Change the values in this array to populate your dropdown as required
							$options =  array();
							foreach ($customers as $customer):
								$options[$customer -> id] = $customer->name;
							 endforeach;
			
							echo form_dropdown('drone_information_drone_customer', $options, set_value('drone_information_drone_customer', isset($select_test['status']) ? $drone_information['drone_customer'] : ''), 'Customer'. lang('bf_form_label_required'));
						?>
                     -->
                    <?php echo form_label('Customer'. lang('bf_form_label_required'), 'drone_information_drone_customer', array('class' => 'control-label') ); ?>	
                        <div class='controls'>
                            <select id="drone_information_drone_customer" name="drone_information_drone_customer">
                                <option value="">--Select Customer--</option>
                                <?php
                                foreach ($customers as $customer):
                                ?>
                               <option value="<?php echo $customer->id;?>" <?php echo set_value('drone_information_drone_customer')==$customer->id?'selected':''; ?> ><?php echo $customer->name;?></option>
                               <?php endforeach;?>
                            </select>	
                        </div>
                 </div> 
                    
                 <div  style="float: left;" > 
                    <div class="control-group <?php echo form_error('issueDate') ? 'error' : ''; ?>">
                        <?php echo form_label('Issue Date' . lang('bf_form_label_required'), 'drone_information_issueDate', array('class' => 'control-label')); ?>
                        <div class='controls'>
                                <input id='drone_information_issueDate' type='text' name='drone_information_issueDate' maxlength="50" value="<?php echo set_value('drone_information_issueDate', isset($drone_information['issueDate']) ? $drone_information['issueDate'] : ''); ?>" />
                                <span class='help-inline'><?php echo form_error('issueDate'); ?></span>
                        </div>
                    </div>
                 </div>    

                
                 <div class="control-group <?php echo form_error('drone_information_issueBy') ? 'error' : ''; ?>">
                    <?php echo form_label('Issued By'. lang('bf_form_label_required'), 'drone_information_issueBy', array('class' => 'control-label') ); ?>	
                        <div class='controls'>
                            <select id="drone_information_issueBy" name="drone_information_issueBy">
                                <option value="">--Issue By--</option>
                                <?php
                                foreach ($mcrs as $mcr):
                                ?>
                               <option value="<?php echo $mcr->id;?>"  <?php echo set_value('drone_information_issueBy')==$mcr->id?'selected':''; ?>><?php echo $mcr->username;?></option>
                               <?php endforeach;?>
                            </select>	
                        </div>
                    </div> 
            </div>
        
                    
                        <div class="control-group" style="height: 68px;">
                            
                            <div  style="float: left; width: 350px;" > 
                                <div class="control-group <?php echo form_error('returnDate') ? 'error' : ''; ?>" style="border: none;">
                                    <?php echo form_label('Return Date', 'drone_information_returnDate', array('class' => 'control-label')); ?>
                                    <div class='controls'>
                                            <input id='drone_information_returnDate' type='text' name='drone_information_returnDate' maxlength="50" value="<?php echo set_value('drone_information_returnDate', isset($drone_information['returnDate']) ? $drone_information['returnDate'] : ''); ?>" />
                                            <span class='help-inline'><?php echo form_error('returnDate'); ?></span>
                                    </div>
                                </div>
                            </div>

                      
                      		 <div style="float: left;border: medium none;" class="control-group" >
                                <?php echo form_label('Received By', 'drone_information_receivedBy', array('class' => 'control-label') ); ?>	
                                <div class='controls' >
                                    <select id="drone_information_receivedBy" name="drone_information_receivedBy">
                                        <option value="">--Received By--</option>
                                        <?php
                                        foreach ($mcrs as $mcr):
                                        ?>
                                       <option value="<?php echo $mcr->id;?>" <?php echo set_value('drone_information_receivedBy')==$mcr->id?'selected':''; ?>><?php echo $mcr->username;?></option>
                                       <?php endforeach;?>
                                    </select>	
                                </div>
                             </div> 
                      
                      
                            <div>
                                <?php // Change the values in this array to populate your dropdown as required
								$options = array(
								
								"Issue" => "Issue" 
								
								);

								echo form_dropdown('drone_information_status', $options, set_value('drone_information_status', isset($drone_information['status']) ? $drone_information['status'] : ''), 'Status' . lang('bf_form_label_required'));
                                ?>
                            </div>    

                            
                        </div>    
                        
                        <div class="control-group" style=" margin-left: 120px; margin-top: 10px;">
 							<span style="margin-right: 50px;"><b>Job</b></span> 
                            <input type="text" id="drone_information_job"  name="drone_information_job" maxlength="200" value="<?php echo set_value('drone_information_job', isset($mcr_information['job']) ? $mcr_information['job'] : ''); ?>"/>
                        </div>

						<div class="control-group <?php echo form_error('drone_set_type') ? 'error' : ''; ?>">
                            <?php echo form_label('Set Type' . lang('bf_form_label_required'), '', array('class' => 'control-label', 'id' => 'drone_information_drone_set_type_label')); ?>
                            <div class='controls' aria-labelled-by='drone_information_drone_set_type_label'>
                                <select name="drone_information_drone_set_type" id="drone_information_drone_set_type" onchange="loadDrone(this.value);">
                                	<option value="">Select Set Type</option>
                                	<?php foreach ($droneset as $drone) : ?>
                                    <option value="<?php echo $drone->id;?>" <?php echo set_value('drone_information_drone_set_type')==$drone->id?'selected':''; ?>><?php echo $drone->setType;?></option>
									<?php endforeach; ?>	
                                </select>					
                                <span class='help-inline'><?php echo form_error('drone_set_type'); ?></span>
                            </div>
						 </div>

                    
                    
                         <table class="customTable">
                              <tr>  
                                <td  class="column-check"> 
                                    <input type='checkbox' id='drone_information_djiphantom' name='drone_information_djiphantom' value='1' <?php echo (isset($drone_information['djiphantom']) && $drone_information['djiphantom'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_djiphantom', 1); ?>>1 DJI Phantom 11(Landing gear mounted on)
                                </td> 
                                   
                                 <td  class="column-check">    
                                    <input id='drone_information_djiphantom_Val' type='text' name='drone_information_djiphantom_Val' maxlength="200" value="<?php echo set_value('drone_information_djiphantom_Val', isset($drone_information['djiphantom_Val']) ? $drone_information['djiphantom_Val'] : ''); ?>" />
                                 </td>
                           
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_zenmuseh_gimbal' name='drone_information_zenmuseh_gimbal' value='1' <?php echo (isset($drone_information['zenmuseh_gimbal']) && $drone_information['zenmuseh_gimbal'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_zenmuseh_gimbal', 1); ?>>2 Zenmuse H3-2D gimbal(Mounted on phantom 11)
                                 </td> 
                                    
                                 <td  class="column-check">        
                                      <input id='drone_information_zenmuseh_gimbal_val' type='text' name='drone_information_zenmuseh_gimbal_val' maxlength="200" value="<?php echo set_value('drone_information_zenmuseh_gimbal_val', isset($drone_information['zenmuseh_gimbal_val']) ? $drone_information['zenmuseh_gimbal_val'] : ''); ?>" />
                                </td>
                             </tr>
                            
                             <tr>
                               
                                <td  class="column-check">
								      <input type='checkbox' id='drone_information_geprohero' name='drone_information_geprohero' value='1' <?php echo (isset($drone_information['geprohero']) && $drone_information['geprohero'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_geprohero', 1); ?>>1 Gepro Hero 3+ Silver 
                                 </td>    
                                 <td  class="column-check">        
                                      <input id='drone_information_geprohero_val' type='text' name='drone_information_geprohero_val' maxlength="200" value="<?php echo set_value('drone_information_geprohero_val', isset($drone_information['geprohero_val']) ? $drone_information['geprohero_val'] : ''); ?>" />
                                </td>
                             
                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_propellers' name='drone_information_propellers' value='1' <?php echo (isset($drone_information['propellers']) && $drone_information['propellers'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_propellers', 1); ?>>2 Sets propellers(8 pics) 
                                 </td>    
                                 <td  class="column-check">       
                                     <input id='drone_information_propellers_val' type='text' name='drone_information_propellers_val' maxlength="200" value="<?php echo set_value('drone_information_propellers_val', isset($drone_information['propellers_val']) ? $drone_information['propellers_val'] : ''); ?>" />
                                </td>
                            </tr>
                             
                             <tr>

                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_phantom_batteries' name='drone_information_phantom_batteries' value='1' <?php echo (isset($drone_information['phantom_batteries']) && $drone_information['phantom_batteries'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_phantom_batteries', 1); ?>>6 phantom 11 batteries 
                                 </td>    
                                 <td  class="column-check">      
                                    <input id='drone_information_phantom_batteries_val' type='text' name='drone_information_phantom_batteries_val' maxlength="200" value="<?php echo set_value('drone_information_phantom_batteries_val', isset($drone_information['phantom_batteries_val']) ? $drone_information['phantom_batteries_val'] : ''); ?>" />
                                      
                                </td>
                            
                                <td  class="column-check">
                                     <input type='checkbox' id='drone_information_phantom_chargers' name='drone_information_phantom_chargers' value='1' <?php echo (isset($drone_information['phantom_chargers']) && $drone_information['phantom_chargers'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_phantom_chargers', 1); ?>>2 Phantom 11 Chargers 
                                 </td>    
                                 <td  class="column-check">     
                                    <input id='drone_information_phantom_chargers_val' type='text' name='drone_information_phantom_chargers_val' maxlength="200" value="<?php echo set_value('drone_information_phantom_chargers_val', isset($drone_information['phantom_chargers_val']) ? $drone_information['phantom_chargers_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_propellor_protection' name='drone_information_propellor_protection' value='1' <?php echo (isset($drone_information['propellor_protection']) && $drone_information['propellor_protection'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_propellor_protection', 1); ?>>1 Set propellor protection 
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_propellor_protection_val' type='text' name='drone_information_propellor_protection_val' maxlength="200" value="<?php echo set_value('drone_information_propellor_protection_val', isset($drone_information['propellor_protection_val']) ? $drone_information['propellor_protection_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_screwdriver_set' name='drone_information_screwdriver_set' value='1' <?php echo (isset($drone_information['screwdriver_set']) && $drone_information['screwdriver_set'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_screwdriver_set', 1); ?>>1 Screwdriver Set 
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_screwdriver_set_val' type='text' name='drone_information_screwdriver_set_val' maxlength="200" value="<?php echo set_value('drone_information_screwdriver_set_val', isset($drone_information['screwdriver_set_value']) ? $drone_information['screwdriver_set_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_single_screwdriver' name='drone_information_single_screwdriver' value='1' <?php echo (isset($drone_information['single_screwdriver']) && $drone_information['single_screwdriver'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_single_screwdriver', 1); ?>>1 Single Screwdriver 
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_single_screwdriver_val' type='text' name='drone_information_single_screwdriver_val' maxlength="200" value="<?php echo set_value('drone_information_single_screwdriver_val', isset($drone_information['single_screwdriver_val']) ? $drone_information['single_screwdriver_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_remote_control' name='drone_information_remote_control' value='1' <?php echo (isset($drone_information['remote_control']) && $drone_information['remote_control'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_remote_control', 1); ?>>DJI DJ6 Remote Control  
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_remote_control_val' type='text' name='drone_information_remote_control_val' maxlength="200" value="<?php echo set_value('drone_information_remote_control_val', isset($drone_information['remote_control_value']) ? $drone_information['remote_control_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_fpv_monitor' name='drone_information_fpv_monitor' value='1' <?php echo (isset($drone_information['fpv_monitor']) && $drone_information['fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_fpv_monitor', 1); ?>>1 FPV Monitor  
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_fpv_monitor_val' type='text' name='drone_information_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_fpv_monitor_val', isset($drone_information['fpv_monitor_val']) ? $drone_information['fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_antennas_fpv_monitor' name='drone_information_antennas_fpv_monitor' value='1' <?php echo (isset($drone_information['antennas_fpv_monitor']) && $drone_information['antennas_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_antennas_fpv_monitor', 1); ?>>2 Antennas for FPV monitor   
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_antennas_fpv_monitor_val' type='text' name='drone_information_antennas_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_antennas_fpv_monitor_val', isset($drone_information['antennas_fpv_monitor_value']) ? $drone_information['antennas_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_batteries_fpv_monitor' name='drone_information_batteries_fpv_monitor' value='1' <?php echo (isset($drone_information['batteries_fpv_monitor']) && $drone_information['batteries_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_batteries_fpv_monitor', 1); ?>>2 Batteries for FPV monitor   
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_batteries_fpv_monitor_val' type='text' name='drone_information_batteries_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_batteries_fpv_monitor_val', isset($drone_information['batteries_fpv_monitor_val']) ? $drone_information['batteries_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_charger_fpv_monitor' name='drone_information_charger_fpv_monitor' value='1' <?php echo (isset($drone_information['charger_fpv_monitor']) && $drone_information['charger_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_charger_fpv_monitor', 1); ?>>1 Charger for FPV monitor batteries    
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_charger_fpv_monitor_val' type='text' name='drone_information_charger_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_charger_fpv_monitor_val', isset($drone_information['charger_fpv_monitor_value']) ? $drone_information['charger_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_sun_shades_fpv_monitor' name='drone_information_sun_shades_fpv_monitor' value='1' <?php echo (isset($drone_information['sun_shades_fpv_monitor']) && $drone_information['sun_shades_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_sun_shades_fpv_monitor', 1); ?>>1 Set sun shades for FPV monitor(3pcs)    
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_sun_shades_fpv_monitor_val' type='text' name='drone_information_sun_shades_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_sun_shades_fpv_monitor_val', isset($drone_information['sun_shades_fpv_monitor_val']) ? $drone_information['sun_shades_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_console_fpv_monitor' name='drone_information_console_fpv_monitor' value='1' <?php echo (isset($drone_information['console_fpv_monitor']) && $drone_information['console_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_console_fpv_monitor', 1); ?>>1 Monitor console for FPV monitor     
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_console_fpv_monitor_val' type='text' name='drone_information_console_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_information_console_fpv_monitor_val', isset($drone_information['console_fpv_monitor_value']) ? $drone_information['console_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_micro_sd_cards' name='drone_information_micro_sd_cards' value='1' <?php echo (isset($drone_information['micro_sd_cards']) && $drone_information['micro_sd_cards'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_micro_sd_cards', 1); ?>>2 16GB class 10 micro SD cards with adapter    
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_micro_sd_cards_val' type='text' name='drone_information_micro_sd_cards_val' maxlength="200" value="<?php echo set_value('drone_information_micro_sd_cards_val', isset($drone_information['micro_sd_cards_val']) ? $drone_information['micro_sd_cards_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_information_hardcase' name='drone_information_hardcase' value='1' <?php echo (isset($drone_information['hardcase']) && $drone_information['hardcase'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_hardcase', 1); ?>>1 Hardcase     
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_hardcase_val' type='text' name='drone_information_hardcase_val' maxlength="200" value="<?php echo set_value('drone_information_hardcase_val', isset($drone_information['hardcase_value']) ? $drone_information['hardcase_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_information_spare_screws' name='drone_information_spare_screws' value='1' <?php echo (isset($drone_information['spare_screws']) && $drone_information['spare_screws'] == 1) ? 'checked="checked"' : set_checkbox('drone_information_spare_screws', 1); ?>>1 bag with spare screws,rubber for landing gear,tape,propeller wrench,small allen key     
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_information_spare_screws_val' type='text' name='drone_information_spare_screws_val' maxlength="200" value="<?php echo set_value('drone_information_spare_screws_val', isset($drone_information['spare_screws_val']) ? $drone_information['spare_screws_val'] : ''); ?>" />
                                 </td>
                                
                             </tr>
                             
                              <tr style="height: 100px;">
                                
					              <td colspan='4'>
						              <p style=" text-align: justify; line-height: 20px ">
						                By signing this form, I agree to the following: I am responsible for the equipment or property issued to me; I will use  
						                it/them in the manner intended; I will be responsible for any damage done (excluding normal wear and tear); upon 
						                seperation from the company; I will return the item(s) issued to at proper working order (excluding normal wear and tear);
						                I will replaceany items issued to me that are damaged or lost at my expense; I authorize a payroll deduction to cover
						                the replacement cost of any item issued to me that is not returned for whatever reason, all is not returned 
						                in good working order.
						              </p>
					             </td>
          					 </tr>
                        </table>     

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('drone_information_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA . '/addform/drone_information', lang('drone_information_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
		
    <?php echo form_close(); ?>
   <script>
			function loadDrone (value) 
				 {
					$.ajax({
				      type: "get",
		              async: false,
		              url: "<?php echo site_url('/admin/setmasters/drone_master/loadDrone')?>",
		              data: {droneid: value},
		              dataType: "json",
			
					   success: function(data) 
					   {
		                if(data!='')
			                {
		                	 $.each(data,function(key,val) 
			                	 {
			                	 	var elem = document.getElementById('drone_information_' + key);
			                	 	if(elem)
				                	 	{
				                	 		if(elem.type == 'checkbox')
					                	 		{
					                	 			elem.checked = val== '1' ? true : false;
					                	 		}
				                	 		else if(elem.type == 'text')
					                	 		{
					                	 			elem.value = val;
					                	 		}
				                	 	}
			                	 });
			                }
		                },
		                
		             error: function()
		             {
		                alert('Error loading Drone Sets');
		                return false;
		             }	
				});  
				}
		</script>
</div>