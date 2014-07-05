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

if (isset($fp_set_master))
{
	$fp_set_master = (array) $fp_set_master;
}
$id = isset($fp_set_master['id']) ? $fp_set_master['id'] : '';

?>
<div class="admin-box">
	<h3>FP Set Master</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('setType') ? 'error' : ''; ?>">
				<?php echo form_label('FP Set'. lang('bf_form_label_required'), 'fp_set_master_setType', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='fp_set_master_setType' type='text' name='fp_set_master_setType' maxlength="50" value="<?php echo set_value('fp_set_master_setType', isset($fp_set_master['setType']) ? $fp_set_master['setType'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('setType'); ?></span>
				</div>
			</div>

			<table>
                            
                            <tr>
                                <th style="width: 520px;text-align: left">Camera:</th>
                                <th style="width: 450px;text-align: left">Audio:</th>
                                <th style="width: 450px;text-align: left">Peripherals:</th>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_panasonic_HCV700" id="fp_set_master_panasonic_HCV700" value='1' <?php echo (isset($fp_set_master['panasonic_HCV700']) && $fp_set_master['panasonic_HCV700'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_panasonic_HCV700', 1); ?>/>Panasonic HC-V700
                                    <input type="text" id="fp_set_master_V700"  name="fp_set_master_V700" maxlength="200" value="<?php echo set_value('fp_set_master_V700', isset($fp_set_master['V700']) ? $fp_set_master['V700'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;;text-align: left">
                                    <input name="fp_set_master_microphone_rode" type="checkbox" id="fp_set_master_microphone_rode" value='1' <?php echo (isset($fp_set_master['microphone_rode']) && $fp_set_master['microphone_rode'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_microphone_rode', 1); ?>/>Microphone Rode
                                </td>
                                <td class="column-check" style="width: 450px;;text-align: left">
                                    <input type="checkbox" name="fp_set_master_macbook13" id="fp_set_master_macbook13" value='1' <?php echo (isset($fp_set_master['macbook13']) && $fp_set_master['macbook13'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_macbook13', 1); ?>/>MacBook 13
                                    <input type="text" id="fp_set_master_mac13"  name="fp_set_master_mac13" maxlength="200" value="<?php echo set_value('fp_set_master_mac13', isset($fp_set_master['mac13']) ? $fp_set_master['mac13'] : ''); ?>"/>
                                </td>
                            </tr>
                           
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_panasonic_HCV727" id="fp_set_master_panasonic_HCV727" value='1' <?php echo (isset($fp_set_master['panasonic_HCV727']) && $fp_set_master['panasonic_HCV727'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_panasonic_HCV727', 1); ?>/>Panasonic HC-V727
                                    <input type="text" id="fp_set_master_V727"  name="fp_set_master_V727" maxlength="200" value="<?php echo set_value('fp_set_master_V727', isset($fp_set_master['V727']) ? $fp_set_master['V727'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_extension_cable" type="checkbox" id="fp_set_master_extension_cable" value='1' <?php echo (isset($fp_set_master['extension_cable']) && $fp_set_master['extension_cable'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_extension_cable', 1); ?>/>Extension Cable
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_macbook15" id="fp_set_master_macbook15" value='1' <?php echo (isset($fp_set_master['macbook15']) && $fp_set_master['macbook15'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_macbook15', 1); ?>/>MacBook 15
                                </td>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_camera_checkbox1" id="fp_set_master_camera_checkbox1" value='1' <?php echo (isset($fp_set_master['camera_checkbox1']) && $fp_set_master['camera_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_camera_checkbox1', 1); ?>/>
                                    <input type="text" id="fp_set_master_camera_value1"  name="fp_set_master_camera_value1" maxlength="200" value="<?php echo set_value('fp_set_master_camera_value1', isset($fp_set_master['camera_value1']) ? $fp_set_master['camera_value1'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_audio_checkbox1" type="checkbox" id="fp_set_master_audio_checkbox1" value='1' <?php echo (isset($fp_set_master['audio_checkbox1']) && $fp_set_master['audio_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_audio_checkbox1', 1); ?>/>
                                    <input type="text" id="fp_set_master_audio_value1"  name="fp_set_master_audio_value1" maxlength="200" value="<?php echo set_value('fp_set_master_audio_value1', isset($fp_set_master['audio_value1']) ? $fp_set_master['audio_value1'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_recorder_sony_PMW50" id="fp_set_master_recorder_sony_PMW50" value='1' <?php echo (isset($fp_set_master['recorder_sony_PMW50']) && $fp_set_master['recorder_sony_PMW50'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_recorder_sony_PMW50', 1); ?>/> Recorder Sony PMW 50
                                </td>
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_camera_checkbox2" id="fp_set_master_camera_checkbox2" value='1' <?php echo (isset($fp_set_master['camera_checkbox2']) && $fp_set_master['camera_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_camera_checkbox2', 1); ?>/>
                                    <input type="text" id="fp_set_master_camera_value2"  name="fp_set_master_camera_value2" maxlength="200" value="<?php echo set_value('fp_set_master_camera_value2', isset($fp_set_master['camera_value2']) ? $fp_set_master['camera_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_audio_checkbox2" type="checkbox" id="fp_set_master_audio_checkbox2" value='1' <?php echo (isset($fp_set_master['audio_checkbox2']) && $fp_set_master['audio_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_audio_checkbox2', 1); ?>/>
                                    <input type="text" id="fp_set_master_audio_value2"  name="fp_set_master_audio_value2" maxlength="200" value="<?php echo set_value('fp_set_master_audio_value2', isset($fp_set_master['audio_value2']) ? $fp_set_master['audio_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_aja_interface" id="fp_set_master_aja_interface" value='1' <?php echo (isset($fp_set_master['aja_interface']) && $fp_set_master['aja_interface'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_aja_interface', 1); ?>/>  AJA Interface
                                </td>
                                
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_camera_checkbox3" id="fp_set_master_camera_checkbox3" value='1' <?php echo (isset($fp_set_master['camera_checkbox3']) && $fp_set_master['camera_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_camera_checkbox3', 1); ?>/>
                                    <input type="text" id="fp_set_master_camera_value3"  name="fp_set_master_camera_value3" maxlength="200" value="<?php echo set_value('fp_set_master_camera_value3', isset($fp_set_master['camera_value3']) ? $fp_set_master['camera_value3'] : ''); ?>"/>
                                </td>
                                <th class="column-check" style="width: 450px;text-align: left">Broadcast:</th>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_sxs_card_reader" id="fp_set_master_sxs_card_reader" value='1' <?php echo (isset($fp_set_master['sxs_card_reader']) && $fp_set_master['sxs_card_reader'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_sxs_card_reader', 1); ?>/> SxS Card Reader
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <th class="column-check" style="width: 520px;text-align: left">Storage:</th>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_liveu" id="fp_set_master_liveu" value='1' <?php echo (isset($fp_set_master['liveu']) && $fp_set_master['liveu'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_liveu', 1); ?>/>LiveU
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_thunderbold_SSD_cable" id="fp_set_master_thunderbold_SSD_cable" value='1' <?php echo (isset($fp_set_master['thunderbold_SSD_cable']) && $fp_set_master['thunderbold_SSD_cable'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_thunderbold_SSD_cable', 1); ?>/> Thunderbold SSD + Cable
                                </td>
                                
                            </tr>
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_SD_card_amount" id="fp_set_master_SD_card_amount" value='1' <?php echo (isset($fp_set_master['SD_card_amount']) && $fp_set_master['SD_card_amount'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_SD_card_amount', 1); ?>/>SD Card
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="fp_set_master_sccard_amount"  name="fp_set_master_sccard_amount" maxlength="200" value="<?php echo set_value('fp_set_master_sccard_amount', isset($fp_set_master['sccard_amount']) ? $fp_set_master['sccard_amount'] : ''); ?>"/></span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_minicaster" type="checkbox" id="fp_set_master_minicaster" value='1' <?php echo (isset($fp_set_master['minicaster']) && $fp_set_master['minicaster'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_minicaster', 1); ?>/>Minicaster
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_mac_charger" id="fp_set_master_mac_charger" value='1' <?php echo (isset($fp_set_master['mac_charger']) && $fp_set_master['mac_charger'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_mac_charger', 1); ?> />Mac Charger
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_mini_sd_card" id="fp_set_master_mini_sd_card" value='1' <?php echo (isset($fp_set_master['mini_sd_card']) && $fp_set_master['mini_sd_card'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_mini_sd_card', 1); ?>/>Mini-SD Card
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="fp_set_master_mini_sd_card_amount"  name="fp_set_master_mini_sd_card_amount" maxlength="200" value="<?php echo set_value('fp_set_master_mini_sd_card_amount', isset($fp_set_master['mini_sd_card_amount']) ? $fp_set_master['mini_sd_card_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_newsspotter" type="checkbox" id="fp_set_master_newsspotter" value='1' <?php echo (isset($fp_set_master['newsspotter']) && $fp_set_master['newsspotter'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_newsspotter', 1); ?>/>Newsspotter
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_peripherals_checkbox1" id="fp_set_master_peripherals_checkbox1" value='1' <?php echo (isset($fp_set_master['peripherals_checkbox1']) && $fp_set_master['peripherals_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_peripherals_checkbox1', 1); ?>/>
                                    <input type="text" id="fp_set_master_peripherals_value1"  name="fp_set_master_peripherals_value1" maxlength="200" value="<?php echo set_value('fp_set_master_peripherals_value1', isset($fp_set_master['peripherals_value1']) ? $fp_set_master['peripherals_value1'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                <input type="checkbox" name="fp_set_master_sd_card_adaptor" id="fp_set_master_sd_card_adaptor" value='1' <?php echo (isset($fp_set_master['sd_card_adaptor']) && $fp_set_master['sd_card_adaptor'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_sd_card_adaptor', 1); ?>/>SD Card Adaptor
                                 
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_BGAN_explorer" type="checkbox" id="fp_set_master_BGAN_explorer" value='1' <?php echo (isset($fp_set_master['BGAN_explorer']) && $fp_set_master['BGAN_explorer'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_BGAN_explorer', 1); ?>/> BGAN Explorer
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_peripherals_checkbox2" id="fp_set_master_peripherals_checkbox2" value='1' <?php echo (isset($fp_set_master['peripherals_checkbox2']) && $fp_set_master['peripherals_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_peripherals_checkbox2', 1); ?>/>
                                    <input type="text" id="fp_set_master_peripherals_value2"  name="fp_set_master_peripherals_value2" maxlength="200" value="<?php echo set_value('fp_set_master_peripherals_value2', isset($fp_set_master['peripherals_value2']) ? $fp_set_master['peripherals_value2'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                <th style="width: 520px;text-align: left">Camera Accessories:</th>
                                <th style="width: 450px;text-align: left">Tripods:</th>
                                <th style="width: 450px;text-align: left">Miscellaneous:</th>
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_battery_700_small" id="fp_set_master_battery_700_small" value='1' <?php echo (isset($fp_set_master['battery_700_small']) && $fp_set_master['battery_700_small'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_battery_700_small', 1); ?>/> Battery 700 small
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="fp_set_master_battery_700_small_amount"  name="fp_set_master_battery_700_small_amount" maxlength="200" value="<?php echo set_value('fp_set_master_battery_700_small_amount', isset($fp_set_master['battery_700_small_amount']) ? $fp_set_master['battery_700_small_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_cullmann_magnesit" type="checkbox" id="fp_set_master_cullmann_magnesit" value='1' <?php echo (isset($fp_set_master['cullmann_magnesit']) && $fp_set_master['cullmann_magnesit'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_cullmann_magnesit', 1); ?>/>Cullmann Magnesit
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_walkie_talkie" id="fp_set_master_walkie_talkie" value='1' <?php echo (isset($fp_set_master['walkie_talkie']) && $fp_set_master['walkie_talkie'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_walkie_talkie', 1); ?>/>Walkie Talkie UV-5R+
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_battery_700_big" id="fp_set_master_battery_700_big" value='1' <?php echo (isset($fp_set_master['battery_700_big']) && $fp_set_master['battery_700_big'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_battery_700_big', 1); ?>/>Battery 700 big
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                    <input type="text" id="fp_set_master_battery_700_big_amount"  name="fp_set_master_battery_700_big_amount" maxlength="200" value="<?php echo set_value('fp_set_master_battery_700_big_amount', isset($fp_set_master['battery_700_big_amount']) ? $fp_set_master['battery_700_big_amount'] : ''); ?>"/>
                                 </span>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_cullmann_nanomax" type="checkbox" id="fp_set_master_cullmann_nanomax" value='1' <?php echo (isset($fp_set_master['cullmann_nanomax']) && $fp_set_master['cullmann_nanomax'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_cullmann_nanomax', 1); ?>/>Cullmann Nanomax
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_first_aid_kit" id="fp_set_master_first_aid_kit" value='1' <?php echo (isset($fp_set_master['first_aid_kit']) && $fp_set_master['first_aid_kit'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_first_aid_kit', 1); ?>/>First Aid Kit
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_battery_727VWVBT190" id="fp_set_master_battery_727VWVBT190" value='1' <?php echo (isset($fp_set_master['battery_727VWVBT190']) && $fp_set_master['battery_727VWVBT190'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_battery_727VWVBT190', 1); ?>/>Battery 727 VW-VBT190
                                   <input type="text" id="fp_set_master_battery_727VWVBT190_amount"  name="fp_set_master_battery_727VWVBT190_amount" maxlength="200" value="<?php echo set_value('fp_set_master_battery_727VWVBT190_amount', isset($fp_set_master['battery_727VWVBT190_amount']) ? $fp_set_master['battery_727VWVBT190_amount'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_tripods_checkbox1" type="checkbox" id="fp_set_master_tripods_checkbox1" value='1' <?php echo (isset($fp_set_master['tripods_checkbox1']) && $fp_set_master['tripods_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_tripods_checkbox1', 1); ?>/>Tripode Plate
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_backpack" id="fp_set_master_backpack" value='1' <?php echo (isset($fp_set_master['backpack']) && $fp_set_master['backpack'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_backpack', 1); ?>/> Backpack
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_battery_727VWVBT380" id="fp_set_master_battery_727VWVBT380" value='1' <?php echo (isset($fp_set_master['battery_727VWVBT380']) && $fp_set_master['battery_727VWVBT380'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_battery_727VWVBT380', 1); ?>/>Battery 727 VW-VBT380
                                   <input type="text" id="fp_set_master_battery_727VWVBT380_amount"  name="fp_set_master_battery_727VWVBT380_amount" maxlength="200" value="<?php echo set_value('fp_set_master_battery_727VWVBT380_amount', isset($fp_set_master['battery_727VWVBT380_amount']) ? $fp_set_master['battery_727VWVBT380_amount'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_tripods_checkbox2" type="checkbox" id="fp_set_master_tripods_checkbox2" value='1' <?php echo (isset($fp_set_master['tripods_checkbox2']) && $fp_set_master['tripods_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_tripods_checkbox2', 1); ?>/>
                                    <input type="text" id="fp_set_master_tripods_value2"  name="fp_set_master_tripods_value2" maxlength="200" value="<?php echo set_value('fp_set_master_tripods_value2', isset($fp_set_master['tripods_value2']) ? $fp_set_master['tripods_value2'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_miscellaneous_checkbox1" id="fp_set_master_miscellaneous_checkbox1" value='1' <?php echo (isset($fp_set_master['miscellaneous_checkbox1']) && $fp_set_master['miscellaneous_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_miscellaneous_checkbox1', 1); ?>/>
                                    <input type="text" id="fp_set_master_miscellaneous_value1"  name="fp_set_master_miscellaneous_value1" maxlength="200" value="<?php echo set_value('fp_set_master_miscellaneous_value1', isset($fp_set_master['miscellaneous_value1']) ? $fp_set_master['miscellaneous_value1'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_battery_handycam" id="fp_set_master_battery_handycam" value='1' <?php echo (isset($fp_set_master['battery_handycam']) && $fp_set_master['battery_handycam'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_battery_handycam', 1); ?>/>Battery Handycam
                                 <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                                   <input type="text" id="fp_set_master_battery_handycam_amount"  name="fp_set_master_battery_handycam_amount" maxlength="200" value="<?php echo set_value('fp_set_master_battery_handycam_amount', isset($fp_set_master['battery_handycam_amount']) ? $fp_set_master['battery_handycam_amount'] : ''); ?>"/>
                                 </span>  
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_tripods_checkbox3" type="checkbox" id="fp_set_master_tripods_checkbox3" value='1' <?php echo (isset($fp_set_master['tripods_checkbox3']) && $fp_set_master['tripods_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_tripods_checkbox3', 1); ?>/>
                                    <input type="text" id="fp_set_master_tripods_value3"  name="fp_set_master_tripods_value3" maxlength="200" value="<?php echo set_value('fp_set_master_tripods_value3', isset($fp_set_master['tripods_value3']) ? $fp_set_master['tripods_value3'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_miscellaneous_checkbox2" id="fp_set_master_miscellaneous_checkbox2" value='1' <?php echo (isset($fp_set_master['miscellaneous_checkbox2']) && $fp_set_master['miscellaneous_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_miscellaneous_checkbox2', 1); ?>/>
                                    <input type="text" id="fp_set_master_miscellaneous_value2"  name="fp_set_master_miscellaneous_value2" maxlength="200" value="<?php echo set_value('fp_set_master_miscellaneous_value2', isset($fp_set_master['miscellaneous_value2']) ? $fp_set_master['miscellaneous_value2'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_charger_patona" id="fp_set_master_charger_patona" value='1' <?php echo (isset($fp_set_master['charger_patona']) && $fp_set_master['charger_patona'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_charger_patona', 1); ?>/>Charger Patona
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_tripods_checkbox4" type="checkbox" id="fp_set_master_tripods_checkbox4" value='1' <?php echo (isset($fp_set_master['tripods_checkbox4']) && $fp_set_master['tripods_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_tripods_checkbox4', 1); ?>/>
                                    <input type="text" id="fp_set_master_tripods_value4"  name="fp_set_master_tripods_value4" maxlength="200" value="<?php echo set_value('fp_set_master_tripods_value4', isset($fp_set_master['tripods_value4']) ? $fp_set_master['tripods_value4'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_miscellaneous_checkbox3" id="fp_set_master_miscellaneous_checkbox3" value='1' <?php echo (isset($fp_set_master['miscellaneous_checkbox3']) && $fp_set_master['miscellaneous_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_miscellaneous_checkbox3', 1); ?>/>
                                    <input type="text" id="fp_set_master_miscellaneous_value3"  name="fp_set_master_miscellaneous_value3" maxlength="200" value="<?php echo set_value('fp_set_master_miscellaneous_value3', isset($fp_set_master['miscellaneous_value3']) ? $fp_set_master['miscellaneous_value3'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                             <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_charger_panasonic_VSK0781SND3BMT" id="fp_set_master_charger_panasonic_VSK0781SND3BMT" value='1' <?php echo (isset($fp_set_master['charger_panasonic_VSK0781SND3BMT']) && $fp_set_master['charger_panasonic_VSK0781SND3BMT'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_charger_panasonic_VSK0781SND3BMT', 1); ?>/>Charger Panasonic VSK0781 SN D3 BMT
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_tripods_checkbox5" type="checkbox" id="fp_set_master_tripods_checkbox5" value='1' <?php echo (isset($fp_set_master['tripods_checkbox5']) && $fp_set_master['tripods_checkbox5'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_tripods_checkbox5', 1); ?>/>
                                    <input type="text" id="fp_set_master_tripods_value5"  name="fp_set_master_tripods_value5" maxlength="200" value="<?php echo set_value('fp_set_master_tripods_value5', isset($fp_set_master['tripods_value5']) ? $fp_set_master['tripods_value5'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_miscellaneous_checkbox4" id="fp_set_master_miscellaneous_checkbox4" value='1' <?php echo (isset($fp_set_master['miscellaneous_checkbox4']) && $fp_set_master['miscellaneous_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_miscellaneous_checkbox4', 1); ?>/>
                                    <input type="text" id="fp_set_master_miscellaneous_value4"  name="fp_set_master_miscellaneous_value4" maxlength="200" value="<?php echo set_value('fp_set_master_miscellaneous_value4', isset($fp_set_master['miscellaneous_value4']) ? $fp_set_master['miscellaneous_value4'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                            
                            <tr style="height: 50px;">
                                <td class="column-check" style="width: 520px;text-align: left">
                                 <input type="checkbox" name="fp_set_master_Battery_small_panasonic" id="fp_set_master_Battery_small_panasonic" value='1' <?php echo (isset($fp_set_master['Battery_small_panasonic']) && $fp_set_master['Battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_Battery_small_panasonic', 1); ?>/>2 Battery Small Panasonic VW-VBK-180
                                 <input type="text" id="fp_set_master_batterysmallpanasonic"  name="fp_set_master_batterysmallpanasonic" maxlength="200" value="<?php echo set_value('fp_set_master_batterysmallpanasonic', isset($fp_set_master['batterysmallpanasonic']) ? $fp_set_master['batterysmallpanasonic'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input name="fp_set_master_one_cam_charger_panasonic" type="checkbox" id="fp_set_master_one_cam_charger_panasonic" value='1' <?php echo (isset($fp_set_master['one_cam_charger_panasonic']) && $fp_set_master['one_cam_charger_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_one_cam_charger_panasonic', 1); ?>/>1 Cam-Charger Panasonic VSK0781
                                    <input type="text" id="fp_set_master_onecamchargerpanasonic"  name="fp_set_master_onecamchargerpanasonic" maxlength="200" value="<?php echo set_value('fp_set_master_onecamchargerpanasonic', isset($fp_set_master['onecamchargerpanasonic']) ? $fp_set_master['onecamchargerpanasonic'] : ''); ?>"/>
                                </td>
                                <td class="column-check" style="width: 450px;text-align: left">
                                    <input type="checkbox" name="fp_set_master_one_battery_small_panasonic" id="fp_set_master_one_battery_small_panasonic" value='1' <?php echo (isset($fp_set_master['one_battery_small_panasonic']) && $fp_set_master['one_battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('fp_set_master_one_battery_small_panasonic', 1); ?>/>1 Battery Small Panasonic VW-VBK-190
                                    <input type="text" id="fp_set_master_onebatterysmallpanasonic"  name="fp_set_master_onebatterysmallpanasonic" maxlength="200" value="<?php echo set_value('fp_set_master_onebatterysmallpanasonic', isset($fp_set_master['onebatterysmallpanasonic']) ? $fp_set_master['onebatterysmallpanasonic'] : ''); ?>"/>
                                </td>
                                
                            </tr>
                            
                        </table>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('fp_set_master_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/setmasters/fp_set_master', lang('fp_set_master_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>