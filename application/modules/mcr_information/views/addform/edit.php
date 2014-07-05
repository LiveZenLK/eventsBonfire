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

if (isset($mcr_information))
{
	$mcr_information = (array) $mcr_information;
}
$id = isset($mcr_information['id']) ? $mcr_information['id'] : '';
$selectedCustomer = $mcr_information['parentCustomer'];
$selectedMCR = $mcr_information['parentMcr'];
$selectReceivedBy = $mcr_information['receivedBy'];
$Selectedstatus = $mcr_information['status'];
$selectfpset = $mcr_information['type'];
?>
<div class="admin-box">
	<h3>MCR Information</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

                        <div class="control-group" style="height: 50px;">
                        <div  style="float: left" >
							<div class="control-group <?php echo form_error('mcr_information_parentCustomer') ? 'error' : ''; ?>">
							<?php echo form_label('Customer Name'. lang('bf_form_label_required'), 'mcr_information_parentCustomer', array('class' => 'control-label') ); ?>	
					             <div class='controls'>
									<select id="mcr_information_parentCustomer" name="mcr_information_parentCustomer">
					                                    
	                                    <?php
	                                    foreach ($users as $user):
	                                    if($user->id==$selectedCustomer){ ?>
										<option selected="selected" value="<?php echo $user->id?>"><?php echo $user->name?></option>
									   <?php }
	                                   else{?>
	                                   <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
	                                   <?php } endforeach; ?>
					                </select>	
					             </div>
							</div>
                        </div> 
                        <div>
							<div class="control-group <?php echo form_error('mcr_information_parentMcr') ? 'error' : ''; ?>">
								<?php echo form_label('MCR Name'. lang('bf_form_label_required'), 'mcr_information_parentMcr', array('class' => 'control-label') ); ?>	
				                <div class='controls'>
									<select id="mcr_information_parentMcr" name="mcr_information_parentMcr">
					                     <option value="">--Issue By--</option>
	                                    <?php
	                                    foreach ($mcrs as $mcr):
	                                         if($mcr->id==$selectedMCR){ ?>
												<option selected="selected" value="<?php echo $mcr->id?>"><?php echo $mcr->username?></option>
											   <?php }
			                                   else { ?>
	                                   <option value="<?php echo $mcr->id;?>"><?php echo $mcr->username;?></option>
	                                   <?php } endforeach;?>
					               </select>	
				               </div>
							</div>
						</div>
                         </div>
                    
                        <div class="control-group" style="height: 50px;">
                        <div style="float: left;margin-top: 20px" <?php echo form_error('issueDate') ? 'error' : ''; ?>>
				<?php echo form_label('Issue Date', 'mcr_information_issueDate', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mcr_information_issueDate' type='text' name='mcr_information_issueDate' maxlength="50" value="<?php echo set_value('mcr_information_issueDate', isset($mcr_information['issueDate']) ? $mcr_information['issueDate'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('issueDate'); ?></span>
				</div>
			</div>

                    
                        <div  class="control-group <?php echo form_error('mcr_information_status') ? 'error' : ''; ?>">
							<?php echo form_label('Status'. lang('bf_form_label_required'), 'mcr_information_status', array('class' => 'control-label') ); ?>	
				               <div class='controls'>
								<select id="mcr_information_status" name="mcr_information_status"  >
                                    <option value="">--Select Status--</option>
                                    <?php
                   
                                     if($mcr_information['status']=='Issue'){ ?>
                                    <option selected="selected" value="<?php echo $mcr_information['status']?>"><?php echo $mcr_information['status']?></option>
                                    <option value="Return" >Return</option>
								   <?php }
                                   else{
                                    ?>
                                    <option value="Issue" >Issue</option>
                                    <option selected="selected" value="<?php echo $mcr_information['status']?>"><?php echo $mcr_information['status']?></option>
                                    <?php } ?>
				                </select>	
				            </div>
						</div>
						
						
                        </div>     


                        <div class="control-group">
                        <div style="float: left">
							<div class="control-group <?php echo form_error('mcr_information_receivedBy') ? 'error' : ''; ?>">
							<?php echo form_label('Received By'. lang('bf_form_label_required'), 'mcr_information_receivedBy', array('class' => 'control-label') ); ?>	
		                        <div class='controls'>
								   <select id="mcr_information_receivedBy" name="mcr_information_receivedBy">
                                    <option value="">--Received By--</option>
                                    <?php
                                    foreach ($mcrs as $mcr):
                                        if($mcr->id==$selectReceivedBy){ ?>
									<option selected="selected" value="<?php echo $mcr->id?>"><?php echo $mcr->username?></option>
								   <?php }
	                                   else{
	                                        ?>
	                                   <option value="<?php echo $mcr->id;?>"><?php echo $mcr->username;?></option>
	                                   <?php } endforeach;?>
	                                </select>	
		                        </div>
							</div>
                        </div>    
                        
						<div style="margin-top: 20px" <?php echo form_error('returnDate') ? 'error' : ''; ?>>
							<?php echo form_label('Return Date', 'mcr_information_returnDate', array('class' => 'control-label') ); ?>
							<div class='controls'>
								<input id='mcr_information_returnDate' type='text' name='mcr_information_returnDate' maxlength="50" value="<?php echo set_value('mcr_information_returnDate', isset($mcr_information['returnDate']) ? $mcr_information['returnDate'] : ''); ?>" />
								<span class='help-inline'><?php echo form_error('returnDate'); ?></span>
							</div>
						</div>
                        </div>    
                        
                        <div class="control-group" style=" margin-left: 120px; margin-top: 10px;">
 							<span style="margin-right: 50px;"><b>Job</b></span> 
                            <input type="text" id="mcr_information_job"  name="mcr_information_job" maxlength="200" value="<?php echo set_value('mcr_information_job', isset($mcr_information['job']) ? $mcr_information['job'] : ''); ?>"/>
                        </div>
                    
                    <h3>MCR Set Detail</h3>
                  	<div class="control-group <?php echo form_error('mcr_information_type') ? 'error' : ''; ?>">
                            <?php echo form_label('Set Type', '', array('class' => 'control-label', 'id' => 'mcr_information_type_label')); ?>
                            <div class='controls' aria-labelled-by='mcr_information_type_label'>
                                <select name="mcr_information_type" id="mcr_information_type"  onchange="loadFpSet(this.value);">
                                	<option value="">Select Set Type</option>
                                	<?php foreach ($fpsets as $fpset) :
									if($fpset->id == $selectfpset) :
									 ?>
                                    <option selected="selected" value="<?php echo $fpset->id;?>" ><?php echo $fpset->setType;?></option>
									<?php endif; endforeach;  ?>	
                                </select>					
                                <span class='help-inline'><?php echo form_error('mcr_information_type'); ?></span>
                            </div>
					</div>
                    	
                    
                        
                        <h4>Borrowed Equipment</h4>
			<table >
                            
                            <tr>
                                <th style="width: 520px;text-align: left">Camera:</th>
                                <th style="width: 450px;text-align: left">Audio:</th>
                                <th style="width: 450px;text-align: left">Peripherals:</th>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;;text-align: left">
                                    <input type="checkbox" name="mcr_information_panasonic_HCV700" id="mcr_information_panasonic_HCV700" value='1' <?php echo (isset($mcr_information['panasonic_HCV700']) && $mcr_information['panasonic_HCV700'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_panasonic_HCV700', 1); ?>/>Panasonic HC-V700
                                    <input type="text" id="mcr_information_V700"  name="mcr_information_V700" maxlength="200" value="<?php echo set_value('mcr_information_V700', isset($mcr_information['V700']) ? $mcr_information['V700'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;;text-align: left">
                                    <input name="mcr_information_microphone_rode" type="checkbox" id="mcr_information_microphone_rode" value='1' <?php echo (isset($mcr_information['microphone_rode']) && $mcr_information['microphone_rode'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_microphone_rode', 1); ?>/>Microphone Rode
                                </td>
                                <td class="column-check" style="width: 450px;;text-align: left">
                                    <input type="checkbox" name="mcr_information_macbook13" id="mcr_information_macbook13" value='1' <?php echo (isset($mcr_information['macbook13']) && $mcr_information['macbook13'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_macbook13', 1); ?>/>MacBook 13
                                    <input type="text" id="mcr_information_mac13"  name="mcr_information_mac13" maxlength="200" value="<?php echo set_value('mcr_information_mac13', isset($mcr_information['mac13']) ? $mcr_information['mac13'] : ''); ?>"/>
                                </td>
                            </tr>
                           
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="mcr_information_panasonic_HCV727" id="mcr_information_panasonic_HCV727" value='1' <?php echo (isset($mcr_information['panasonic_HCV727']) && $mcr_information['panasonic_HCV727'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_panasonic_HCV727', 1); ?>/>Panasonic HC-V727
                                    <input type="text" id="mcr_information_V727"  name="mcr_information_V727" maxlength="200" value="<?php echo set_value('mcr_information_V727', isset($mcr_information['V727']) ? $mcr_information['V727'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_extension_cable" type="checkbox" id="mcr_information_extension_cable" value='1' <?php echo (isset($mcr_information['extension_cable']) && $mcr_information['extension_cable'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_extension_cable', 1); ?>/>Extension Cable
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_macbook15" id="mcr_information_macbook15" value='1' <?php echo (isset($mcr_information['macbook15']) && $mcr_information['macbook15'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_macbook15', 1); ?>/>MacBook 15
                                </td>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="mcr_information_camera_checkbox1" id="mcr_information_camera_checkbox1" value='1' <?php echo (isset($mcr_information['camera_checkbox1']) && $mcr_information['camera_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox1', 1); ?>/>
                                    <input type="text" id="mcr_information_camera_value1"  name="mcr_information_camera_value1" maxlength="200" value="<?php echo set_value('mcr_information_camera_value1', isset($mcr_information['camera_value1']) ? $mcr_information['camera_value1'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_audio_checkbox1" type="checkbox" id="mcr_information_audio_checkbox1" value='1' <?php echo (isset($mcr_information['audio_checkbox1']) && $mcr_information['audio_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_audio_checkbox1', 1); ?>/>
                                    <input type="text" id="mcr_information_audio_value1"  name="mcr_information_audio_value1" maxlength="200" value="<?php echo set_value('mcr_information_audio_value1', isset($mcr_information['audio_value1']) ? $mcr_information['audio_value1'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_recorder_sony_PMW50" id="mcr_information_recorder_sony_PMW50" value='1' <?php echo (isset($mcr_information['recorder_sony_PMW50']) && $mcr_information['recorder_sony_PMW50'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_recorder_sony_PMW50', 1); ?>/> Recorder Sony PMW 50
                                </td>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="mcr_information_camera_checkbox2" id="mcr_information_camera_checkbox2" value='1' <?php echo (isset($mcr_information['camera_checkbox2']) && $mcr_information['camera_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox2', 1); ?>/>
                                    <input type="text" id="mcr_information_camera_value2"  name="mcr_information_camera_value2" maxlength="200" value="<?php echo set_value('mcr_information_camera_value2', isset($mcr_information['camera_value2']) ? $mcr_information['camera_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_audio_checkbox2" type="checkbox" id="mcr_information_audio_checkbox2" value='1' <?php echo (isset($mcr_information['audio_checkbox2']) && $mcr_information['audio_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_audio_checkbox2', 1); ?>/>
                                    <input type="text" id="mcr_information_audio_value2"  name="mcr_information_audio_value2" maxlength="200" value="<?php echo set_value('mcr_information_audio_value2', isset($mcr_information['audio_value2']) ? $mcr_information['audio_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_aja_interface" id="mcr_information_aja_interface" value='1' <?php echo (isset($mcr_information['aja_interface']) && $mcr_information['aja_interface'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_aja_interface', 1); ?>/>  AJA Interface
                                </td>
                                
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="mcr_information_camera_checkbox3" id="mcr_information_camera_checkbox3" value='1' <?php echo (isset($mcr_information['camera_checkbox3']) && $mcr_information['camera_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox3', 1); ?>/>
                                    <input type="text" id="mcr_information_camera_value3"  name="mcr_information_camera_value3" maxlength="200" value="<?php echo set_value('mcr_information_camera_value3', isset($mcr_information['camera_value3']) ? $mcr_information['camera_value3'] : ''); ?>"/>
                                </td>
                                <th class="column-check" style="width: 450px;text-align: left">Broadcast:</th>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_sxs_card_reader" id="mcr_information_sxs_card_reader" value='1' <?php echo (isset($mcr_information['sxs_card_reader']) && $mcr_information['sxs_card_reader'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_sxs_card_reader', 1); ?>/> SxS Card Reader
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <th class="column-check" style="width: 520px;text-align: left">Storage:</th>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_liveu" id="mcr_information_liveu" value='1' <?php echo (isset($mcr_information['liveu']) && $mcr_information['liveu'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_liveu', 1); ?>/>LiveU
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_thunderbold_SSD_cable" id="mcr_information_thunderbold_SSD_cable" value='1' <?php echo (isset($mcr_information['thunderbold_SSD_cable']) && $mcr_information['thunderbold_SSD_cable'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_thunderbold_SSD_cable', 1); ?>/> Thunderbold SSD + Cable
                                </td>
                                
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_SD_card_amount" id="mcr_information_SD_card_amount" value='1' <?php echo (isset($mcr_information['SD_card_amount']) && $mcr_information['SD_card_amount'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_SD_card_amount', 1); ?>/>SD Card
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="mcr_information_sccard_amount"  name="mcr_information_sccard_amount" maxlength="200" value="<?php echo set_value('mcr_information_sccard_amount', isset($mcr_information['sccard_amount']) ? $mcr_information['sccard_amount'] : ''); ?>"/></span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_minicaster" type="checkbox" id="mcr_information_minicaster" value='1' <?php echo (isset($mcr_information['minicaster']) && $mcr_information['minicaster'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_minicaster', 1); ?>/>Minicaster
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_mac_charger" id="mcr_information_mac_charger" value='1' <?php echo (isset($mcr_information['mac_charger']) && $mcr_information['mac_charger'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_mac_charger', 1); ?> />Mac Charger
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_mini_sd_card" id="mcr_information_mini_sd_card" value='1' <?php echo (isset($mcr_information['mini_sd_card']) && $mcr_information['mini_sd_card'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_mini_sd_card', 1); ?>/>Mini-SD Card
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="mcr_information_mini_sd_card_amount"  name="mcr_information_mini_sd_card_amount" maxlength="200" value="<?php echo set_value('mcr_information_mini_sd_card_amount', isset($mcr_information['mini_sd_card_amount']) ? $mcr_information['mini_sd_card_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_newsspotter" type="checkbox" id="mcr_information_newsspotter" value='1' <?php echo (isset($mcr_information['newsspotter']) && $mcr_information['newsspotter'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_newsspotter', 1); ?>/>Newsspotter
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_peripherals_checkbox1" id="mcr_information_peripherals_checkbox1" value='1' <?php echo (isset($mcr_information['peripherals_checkbox1']) && $mcr_information['peripherals_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_peripherals_checkbox1', 1); ?>/>
                                    <input type="text" id="mcr_information_peripherals_value1"  name="mcr_information_peripherals_value1" maxlength="200" value="<?php echo set_value('mcr_information_peripherals_value1', isset($mcr_information['peripherals_value1']) ? $mcr_information['peripherals_value1'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                <input type="checkbox" name="mcr_information_sd_card_adaptor" id="mcr_information_sd_card_adaptor" value='1' <?php echo (isset($mcr_information['sd_card_adaptor']) && $mcr_information['sd_card_adaptor'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_sd_card_adaptor', 1); ?>/>SD Card Adaptor
                                 
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_BGAN_explorer" type="checkbox" id="mcr_information_BGAN_explorer" value='1' <?php echo (isset($mcr_information['BGAN_explorer']) && $mcr_information['BGAN_explorer'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_BGAN_explorer', 1); ?>/> BGAN Explorer
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_peripherals_checkbox2" id="mcr_information_peripherals_checkbox2" value='1' <?php echo (isset($mcr_information['peripherals_checkbox2']) && $mcr_information['peripherals_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_peripherals_checkbox2', 1); ?>/>
                                    <input type="text" id="mcr_information_peripherals_value2"  name="mcr_information_peripherals_value2" maxlength="200" value="<?php echo set_value('mcr_information_peripherals_value2', isset($mcr_information['peripherals_value2']) ? $mcr_information['peripherals_value2'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                <th style="width: 520px;text-align: left">Camera Accessories:</th>
                                <th style="width: 450px;text-align: left">Tripods:</th>
                                <th style="width: 450px;text-align: left">Miscellaneous:</th>
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_battery_700_small" id="mcr_information_battery_700_small" value='1' <?php echo (isset($mcr_information['battery_700_small']) && $mcr_information['battery_700_small'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_700_small', 1); ?>/> Battery 700 small
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="mcr_information_battery_700_small_amount"  name="mcr_information_battery_700_small_amount" maxlength="200" value="<?php echo set_value('mcr_information_battery_700_small_amount', isset($mcr_information['battery_700_small_amount']) ? $mcr_information['battery_700_small_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_cullmann_magnesit" type="checkbox" id="mcr_information_cullmann_magnesit" value='1' <?php echo (isset($mcr_information['cullmann_magnesit']) && $mcr_information['cullmann_magnesit'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_cullmann_magnesit', 1); ?>/>Cullmann Magnesit
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_walkie_talkie" id="mcr_information_walkie_talkie" value='1' <?php echo (isset($mcr_information['walkie_talkie']) && $mcr_information['walkie_talkie'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_walkie_talkie', 1); ?>/>Walkie Talkie UV-5R+
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_battery_700_big" id="mcr_information_battery_700_big" value='1' <?php echo (isset($mcr_information['battery_700_big']) && $mcr_information['battery_700_big'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_700_big', 1); ?>/>Battery 700 big
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="mcr_information_battery_700_big_amount"  name="mcr_information_battery_700_big_amount" maxlength="200" value="<?php echo set_value('mcr_information_battery_700_big_amount', isset($mcr_information['battery_700_big_amount']) ? $mcr_information['battery_700_big_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_cullmann_nanomax" type="checkbox" id="mcr_information_cullmann_nanomax" value='1' <?php echo (isset($mcr_information['cullmann_nanomax']) && $mcr_information['cullmann_nanomax'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_cullmann_nanomax', 1); ?>/>Cullmann Nanomax
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_first_aid_kit" id="mcr_information_first_aid_kit" value='1' <?php echo (isset($mcr_information['first_aid_kit']) && $mcr_information['first_aid_kit'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_first_aid_kit', 1); ?>/>First Aid Kit
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_battery_727VWVBT190" id="mcr_information_battery_727VWVBT190" value='1' <?php echo (isset($mcr_information['battery_727VWVBT190']) && $mcr_information['battery_727VWVBT190'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_727VWVBT190', 1); ?>/>Battery 727 VW-VBT190
                                   <input type="text" id="mcr_information_battery_727VWVBT190_amount"  name="mcr_information_battery_727VWVBT190_amount" maxlength="200" value="<?php echo set_value('mcr_information_battery_727VWVBT190_amount', isset($mcr_information['battery_727VWVBT190_amount']) ? $mcr_information['battery_727VWVBT190_amount'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_tripods_checkbox1" type="checkbox" id="mcr_information_tripods_checkbox1" value='1' <?php echo (isset($mcr_information['tripods_checkbox1']) && $mcr_information['tripods_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox1', 1); ?>/>Tripode Plate
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_backpack" id="mcr_information_backpack" value='1' <?php echo (isset($mcr_information['backpack']) && $mcr_information['backpack'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_backpack', 1); ?>/> Backpack
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_battery_727VWVBT380" id="mcr_information_battery_727VWVBT380" value='1' <?php echo (isset($mcr_information['battery_727VWVBT380']) && $mcr_information['battery_727VWVBT380'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_727VWVBT380', 1); ?>/>Battery 727 VW-VBT380
                                   <input type="text" id="mcr_information_battery_727VWVBT380_amount"  name="mcr_information_battery_727VWVBT380_amount" maxlength="200" value="<?php echo set_value('mcr_information_battery_727VWVBT380_amount', isset($mcr_information['battery_727VWVBT380_amount']) ? $mcr_information['battery_727VWVBT380_amount'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_tripods_checkbox2" type="checkbox" id="mcr_information_tripods_checkbox2" value='1' <?php echo (isset($mcr_information['tripods_checkbox2']) && $mcr_information['tripods_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox2', 1); ?>/>
                                    <input type="text" id="mcr_information_tripods_value2"  name="mcr_information_tripods_value2" maxlength="200" value="<?php echo set_value('mcr_information_tripods_value2', isset($mcr_information['tripods_value2']) ? $mcr_information['tripods_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_miscellaneous_checkbox1" id="mcr_information_miscellaneous_checkbox1" value='1' <?php echo (isset($mcr_information['miscellaneous_checkbox1']) && $mcr_information['miscellaneous_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox1', 1); ?>/>
                                    <input type="text" id="mcr_information_miscellaneous_value1"  name="mcr_information_miscellaneous_value1" maxlength="200" value="<?php echo set_value('mcr_information_miscellaneous_value1', isset($mcr_information['miscellaneous_value1']) ? $mcr_information['miscellaneous_value1'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_battery_handycam" id="mcr_information_battery_handycam" value='1' <?php echo (isset($mcr_information['battery_handycam']) && $mcr_information['battery_handycam'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_handycam', 1); ?>/>Battery Handycam
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                   <input type="text" id="mcr_information_battery_handycam_amount"  name="mcr_information_battery_handycam_amount" maxlength="200" value="<?php echo set_value('mcr_information_battery_handycam_amount', isset($mcr_information['battery_handycam_amount']) ? $mcr_information['battery_handycam_amount'] : ''); ?>"/>
                                 </span>  
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_tripods_checkbox3" type="checkbox" id="mcr_information_tripods_checkbox3" value='1' <?php echo (isset($mcr_information['tripods_checkbox3']) && $mcr_information['tripods_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox3', 1); ?>/>
                                    <input type="text" id="mcr_information_tripods_value3"  name="mcr_information_tripods_value3" maxlength="200" value="<?php echo set_value('mcr_information_tripods_value3', isset($mcr_information['tripods_value3']) ? $mcr_information['tripods_value3'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_miscellaneous_checkbox2" id="mcr_information_miscellaneous_checkbox2" value='1' <?php echo (isset($mcr_information['miscellaneous_checkbox2']) && $mcr_information['miscellaneous_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox2', 1); ?>/>
                                    <input type="text" id="mcr_information_miscellaneous_value2"  name="mcr_information_miscellaneous_value2" maxlength="200" value="<?php echo set_value('mcr_information_miscellaneous_value2', isset($mcr_information['miscellaneous_value2']) ? $mcr_information['miscellaneous_value2'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_charger_patona" id="mcr_information_charger_patona" value='1' <?php echo (isset($mcr_information['charger_patona']) && $mcr_information['charger_patona'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_charger_patona', 1); ?>/>Charger Patona
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_tripods_checkbox4" type="checkbox" id="mcr_information_tripods_checkbox4" value='1' <?php echo (isset($mcr_information['tripods_checkbox4']) && $mcr_information['tripods_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox4', 1); ?>/>
                                    <input type="text" id="mcr_information_tripods_value4"  name="mcr_information_tripods_value4" maxlength="200" value="<?php echo set_value('mcr_information_tripods_value4', isset($mcr_information['tripods_value4']) ? $mcr_information['tripods_value4'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_miscellaneous_checkbox3" id="mcr_information_miscellaneous_checkbox3" value='1' <?php echo (isset($mcr_information['miscellaneous_checkbox3']) && $mcr_information['miscellaneous_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox3', 1); ?>/>
                                    <input type="text" id="mcr_information_miscellaneous_value3"  name="mcr_information_miscellaneous_value3" maxlength="200" value="<?php echo set_value('mcr_information_miscellaneous_value3', isset($mcr_information['miscellaneous_value3']) ? $mcr_information['miscellaneous_value3'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_charger_panasonic_VSK0781SND3BMT" id="mcr_information_charger_panasonic_VSK0781SND3BMT" value='1' <?php echo (isset($mcr_information['charger_panasonic_VSK0781SND3BMT']) && $mcr_information['charger_panasonic_VSK0781SND3BMT'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_charger_panasonic_VSK0781SND3BMT', 1); ?>/>Charger Panasonic VSK0781 SN D3 BMT
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_tripods_checkbox5" type="checkbox" id="mcr_information_tripods_checkbox5" value='1' <?php echo (isset($mcr_information['tripods_checkbox5']) && $mcr_information['tripods_checkbox5'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox5', 1); ?>/>
                                    <input type="text" id="mcr_information_tripods_value5"  name="mcr_information_tripods_value5" maxlength="200" value="<?php echo set_value('mcr_information_tripods_value5', isset($mcr_information['tripods_value5']) ? $mcr_information['tripods_value5'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_miscellaneous_checkbox4" id="mcr_information_miscellaneous_checkbox4" value='1' <?php echo (isset($mcr_information['miscellaneous_checkbox4']) && $mcr_information['miscellaneous_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox4', 1); ?>/>
                                    <input type="text" id="mcr_information_miscellaneous_value4"  name="mcr_information_miscellaneous_value4" maxlength="200" value="<?php echo set_value('mcr_information_miscellaneous_value4', isset($mcr_information['miscellaneous_value4']) ? $mcr_information['miscellaneous_value4'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="mcr_information_Battery_small_panasonic" id="mcr_information_Battery_small_panasonic" value='1' <?php echo (isset($mcr_information['Battery_small_panasonic']) && $mcr_information['Battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_Battery_small_panasonic', 1); ?>/>2 Battery Small Panasonic VW-VBK-180
                                 <input type="text" id="mcr_information_batterysmallpanasonic"  name="mcr_information_batterysmallpanasonic" maxlength="200" value="<?php echo set_value('mcr_information_batterysmallpanasonic', isset($mcr_information['batterysmallpanasonic']) ? $mcr_information['batterysmallpanasonic'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="mcr_information_one_cam_charger_panasonic" type="checkbox" id="mcr_information_one_cam_charger_panasonic" value='1' <?php echo (isset($mcr_information['one_cam_charger_panasonic']) && $mcr_information['one_cam_charger_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_one_cam_charger_panasonic', 1); ?>/>1 Cam-Charger Panasonic VSK0781
                                    <input type="text" id="mcr_information_onecamchargerpanasonic"  name="mcr_information_onecamchargerpanasonic" maxlength="200" value="<?php echo set_value('mcr_information_onecamchargerpanasonic', isset($mcr_information['onecamchargerpanasonic']) ? $mcr_information['onecamchargerpanasonic'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="mcr_information_one_battery_small_panasonic" id="mcr_information_one_battery_small_panasonic" value='1' <?php echo (isset($mcr_information['one_battery_small_panasonic']) && $mcr_information['one_battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_one_battery_small_panasonic', 1); ?>/>1 Battery Small Panasonic VW-VBK-190
                                    <input type="text" id="mcr_information_onebatterysmallpanasonic"  name="mcr_information_onebatterysmallpanasonic" maxlength="200" value="<?php echo set_value('mcr_information_onebatterysmallpanasonic', isset($mcr_information['onebatterysmallpanasonic']) ? $mcr_information['onebatterysmallpanasonic'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td colspan="4">
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
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('mcr_information_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/addform/mcr_information', lang('mcr_information_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('MCR_Information.Addform.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('mcr_information_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('mcr_information_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>