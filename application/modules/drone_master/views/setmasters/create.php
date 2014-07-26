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

if (isset($drone_master))
{
	$drone_master = (array) $drone_master;
}
$id = isset($drone_master['id']) ? $drone_master['id'] : '';

?>
<div class="admin-box">
	<h3>Drone Master</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('setType') ? 'error' : ''; ?>">
				<?php echo form_label('Set Type'. lang('bf_form_label_required'), 'drone_master_setType', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='drone_master_setType' type='text' name='drone_master_setType' maxlength="50" value="<?php echo set_value('drone_master_setType', isset($drone_master['setType']) ? $drone_master['setType'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('setType'); ?></span>
				</div>
			</div>

	<!-- ==================================================================================================== -->
			 <table class="customTable">
                          <tr>  
                            <td  class="column-check"> 
                                <input type='checkbox' id='drone_master_djiphantom' name='drone_master_djiphantom' value='1' <?php echo (isset($drone_master['djiphantom']) && $drone_master['djiphantom'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_djiphantom', 1); ?>> <label style="display: inline" for="drone_master_djiphantom">1 DJI Phantom 11(Landing gear mounted on)</label>
                            </td> 
                               
                             <td  class="column-check">    
                                <input id='drone_master_djiphantom_Val' type='text' name='drone_master_djiphantom_Val' maxlength="200" value="<?php echo set_value('drone_master_djiphantom_Val', isset($drone_master['djiphantom_Val']) ? $drone_master['djiphantom_Val'] : ''); ?>" />
                             </td>
                       
                            <td class="column-check">
                                  <input type='checkbox' id='drone_master_zenmuseh_gimbal' name='drone_master_zenmuseh_gimbal' value='1' <?php echo (isset($drone_master['zenmuseh_gimbal']) && $drone_master['zenmuseh_gimbal'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_zenmuseh_gimbal', 1); ?>> <label style="display: inline" for="drone_master_zenmuseh_gimbal">2 Zenmuse H3-2D gimbal(Mounted on phantom 11)</label>
                             </td> 
                                
                             <td  class="column-check">        
                                  <input id='drone_master_zenmuseh_gimbal_val' type='text' name='drone_master_zenmuseh_gimbal_val' maxlength="200" value="<?php echo set_value('drone_master_zenmuseh_gimbal_val', isset($drone_master['zenmuseh_gimbal_val']) ? $drone_master['zenmuseh_gimbal_val'] : ''); ?>" />
                            </td>
                         </tr>
                            
                         <tr>
                           
                             <td class="column-check">
							      <input type='checkbox' id='drone_master_geprohero' name='drone_master_geprohero' value='1' <?php echo (isset($drone_master['geprohero']) && $drone_master['geprohero'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_geprohero', 1); ?>><label style="display: inline" for="drone_master_geprohero"> Gepro Hero 3+ Silver</label> 
                             </td> 
                                
                             <td class="column-check">        
                                  <input id='drone_master_geprohero_val' type='text' name='drone_master_geprohero_val' maxlength="200" value="<?php echo set_value('drone_master_geprohero_val', isset($drone_master['geprohero_val']) ? $drone_master['geprohero_val'] : ''); ?>" />
                             </td>
                         
                             <td class="column-check">
                                 <input type='checkbox' id='drone_master_propellers' name='drone_master_propellers' value='1' <?php echo (isset($drone_master['propellers']) && $drone_master['propellers'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_propellers', 1); ?>><label style="display: inline" for="drone_master_propellers">2 Sets propellers(8 pics) </label>
                             </td>  
                               
                             <td class="column-check">       
                                 <input id='drone_master_propellers_val' type='text' name='drone_master_propellers_val' maxlength="200" value="<?php echo set_value('drone_master_propellers_val', isset($drone_master['propellers_val']) ? $drone_master['propellers_val'] : ''); ?>" />
                             </td>
                             
                        </tr>
                             
                             <tr>

                                <td  class="column-check">
                                     <input type='checkbox' id='drone_master_phantom_batteries' name='drone_master_phantom_batteries' value='1' <?php echo (isset($drone_master['phantom_batteries']) && $drone_master['phantom_batteries'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_phantom_batteries', 1); ?>><label style="display: inline" for="drone_master_phantom_batteries">6 phantom 11 batteries</label> 
                                 </td>    
                                 <td  class="column-check">      
                                    <input id='drone_master_phantom_batteries_val' type='text' name='drone_master_phantom_batteries_val' maxlength="200" value="<?php echo set_value('drone_master_phantom_batteries_val', isset($drone_master['phantom_batteries_val']) ? $drone_master['phantom_batteries_val'] : ''); ?>" />
                                      
                                </td>
                            
                                <td  class="column-check">
                                     <input type='checkbox' id='drone_master_phantom_chargers' name='drone_master_phantom_chargers' value='1' <?php echo (isset($drone_master['phantom_chargers']) && $drone_master['phantom_chargers'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_phantom_chargers', 1); ?>><label style="display: inline" for="drone_master_phantom_chargers">2 Phantom 11 Chargers</label> 
                                 </td>    
                                 <td  class="column-check">     
                                    <input id='drone_master_phantom_chargers_val' type='text' name='drone_master_phantom_chargers_val' maxlength="200" value="<?php echo set_value('drone_master_phantom_chargers_val', isset($drone_master['phantom_chargers_val']) ? $drone_master['phantom_chargers_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_propellor_protection' name='drone_master_propellor_protection' value='1' <?php echo (isset($drone_master['propellor_protection']) && $drone_master['propellor_protection'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_propellor_protection', 1); ?>><label style="display: inline" for="drone_master_propellor_protection">1 Set propellor protection</label> 
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_propellor_protection_val' type='text' name='drone_master_propellor_protection_val' maxlength="200" value="<?php echo set_value('drone_master_propellor_protection_val', isset($drone_master['propellor_protection_val']) ? $drone_master['propellor_protection_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_screwdriver_set' name='drone_master_screwdriver_set' value='1' <?php echo (isset($drone_master['screwdriver_set']) && $drone_master['screwdriver_set'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_screwdriver_set', 1); ?>><label style="display: inline" for="drone_master_screwdriver_set">1 Screwdriver Set</label> 
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_screwdriver_set_val' type='text' name='drone_master_screwdriver_set_val' maxlength="200" value="<?php echo set_value('drone_master_screwdriver_set_val', isset($drone_master['screwdriver_set_value']) ? $drone_master['screwdriver_set_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_single_screwdriver' name='drone_master_single_screwdriver' value='1' <?php echo (isset($drone_master['single_screwdriver']) && $drone_master['single_screwdriver'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_single_screwdriver', 1); ?>><label style="display: inline" for="drone_master_single_screwdriver">1 Single Screwdriver</label> 
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_single_screwdriver_val' type='text' name='drone_master_single_screwdriver_val' maxlength="200" value="<?php echo set_value('drone_master_single_screwdriver_val', isset($drone_master['single_screwdriver_val']) ? $drone_master['single_screwdriver_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_remote_control' name='drone_master_remote_control' value='1' <?php echo (isset($drone_master['remote_control']) && $drone_master['remote_control'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_remote_control', 1); ?>><label style="display: inline" for="drone_master_remote_control">DJI DJ6 Remote Control</label>  
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_remote_control_val' type='text' name='drone_master_remote_control_val' maxlength="200" value="<?php echo set_value('drone_master_remote_control_val', isset($drone_master['remote_control_value']) ? $drone_master['remote_control_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_fpv_monitor' name='drone_master_fpv_monitor' value='1' <?php echo (isset($drone_master['fpv_monitor']) && $drone_master['fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_fpv_monitor">1 FPV Monitor</label>  
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_fpv_monitor_val' type='text' name='drone_master_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_fpv_monitor_val', isset($drone_master['fpv_monitor_val']) ? $drone_master['fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_antennas_fpv_monitor' name='drone_master_antennas_fpv_monitor' value='1' <?php echo (isset($drone_master['antennas_fpv_monitor']) && $drone_master['antennas_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_antennas_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_antennas_fpv_monitor">2 Antennas for FPV monitor</label>   
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_antennas_fpv_monitor_val' type='text' name='drone_master_antennas_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_antennas_fpv_monitor_val', isset($drone_master['antennas_fpv_monitor_value']) ? $drone_master['antennas_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>   
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_batteries_fpv_monitor' name='drone_master_batteries_fpv_monitor' value='1' <?php echo (isset($drone_master['batteries_fpv_monitor']) && $drone_master['batteries_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_batteries_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_batteries_fpv_monitor">2 Batteries for FPV monitor</label>   
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_batteries_fpv_monitor_val' type='text' name='drone_master_batteries_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_batteries_fpv_monitor_val', isset($drone_master['batteries_fpv_monitor_val']) ? $drone_master['batteries_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_charger_fpv_monitor' name='drone_master_charger_fpv_monitor' value='1' <?php echo (isset($drone_master['charger_fpv_monitor']) && $drone_master['charger_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_charger_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_charger_fpv_monitor">1 Charger for FPV monitor batteries</label>    
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_charger_fpv_monitor_val' type='text' name='drone_master_charger_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_charger_fpv_monitor_val', isset($drone_master['charger_fpv_monitor_value']) ? $drone_master['charger_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             
                              <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_sun_shades_fpv_monitor' name='drone_master_sun_shades_fpv_monitor' value='1' <?php echo (isset($drone_master['sun_shades_fpv_monitor']) && $drone_master['sun_shades_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_sun_shades_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_sun_shades_fpv_monitor">1 Set sun shades for FPV monitor(3pcs)</label>    
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_sun_shades_fpv_monitor_val' type='text' name='drone_master_sun_shades_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_sun_shades_fpv_monitor_val', isset($drone_master['sun_shades_fpv_monitor_val']) ? $drone_master['sun_shades_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_console_fpv_monitor' name='drone_master_console_fpv_monitor' value='1' <?php echo (isset($drone_master['console_fpv_monitor']) && $drone_master['console_fpv_monitor'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_console_fpv_monitor', 1); ?>><label style="display: inline" for="drone_master_console_fpv_monitor">1 Monitor console for FPV monitor</label>     
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_console_fpv_monitor_val' type='text' name='drone_master_console_fpv_monitor_val' maxlength="200" value="<?php echo set_value('drone_master_console_fpv_monitor_val', isset($drone_master['console_fpv_monitor_value']) ? $drone_master['console_fpv_monitor_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_micro_sd_cards' name='drone_master_micro_sd_cards' value='1' <?php echo (isset($drone_master['micro_sd_cards']) && $drone_master['micro_sd_cards'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_micro_sd_cards', 1); ?>><label style="display: inline" for="drone_master_micro_sd_cards">2 16GB class 10 micro SD cards with adapter</label>    
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_micro_sd_cards_val' type='text' name='drone_master_micro_sd_cards_val' maxlength="200" value="<?php echo set_value('drone_master_micro_sd_cards_val', isset($drone_master['micro_sd_cards_val']) ? $drone_master['micro_sd_cards_val'] : ''); ?>" />
                                 </td>
                                
                                
                                 <td class="column-check">
                                      <input type='checkbox' id='drone_master_hardcase' name='drone_master_hardcase' value='1' <?php echo (isset($drone_master['hardcase']) && $drone_master['hardcase'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_hardcase', 1); ?>><label style="display: inline" for="drone_master_hardcase">1 Hardcase</label>     
                                 </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_hardcase_val' type='text' name='drone_master_hardcase_val' maxlength="200" value="<?php echo set_value('drone_master_hardcase_val', isset($drone_master['hardcase_value']) ? $drone_master['hardcase_val'] : ''); ?>" />
                                 </td>
                             </tr>
                             
                             
                             <tr>
                             	
                                <td class="column-check">
                                      <input type='checkbox' id='drone_master_spare_screws' name='drone_master_spare_screws' value='1' <?php echo (isset($drone_master['spare_screws']) && $drone_master['spare_screws'] == 1) ? 'checked="checked"' : set_checkbox('drone_master_spare_screws', 1); ?>><label style="display: inline" for="drone_master_spare_screws">1 bag with spare screws,rubber for landing gear,tape,propeller wrench,small allen key</label>     
                                </td>
                                
                                 <td  class="column-check">     
                                    <input id='drone_master_spare_screws_val' type='text' name='drone_master_spare_screws_val' maxlength="200" value="<?php echo set_value('drone_master_spare_screws_val', isset($drone_master['spare_screws_val']) ? $drone_master['spare_screws_val'] : ''); ?>" />
                                 </td>
                                
                             </tr>
                             
                        </table>     



	<!-- ==================================================================================================== -->

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('drone_master_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/setmasters/drone_master', lang('drone_master_cancel'), 'class="btn btn-warning"'); ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>