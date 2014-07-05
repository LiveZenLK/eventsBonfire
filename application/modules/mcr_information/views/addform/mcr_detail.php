<?php
if (isset($mcr_information))
{
	$mcr_information = (array) $mcr_information;
}
$id = isset($mcr_information['id']) ? $mcr_information['id'] : '';

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
		.details_table td{
			padding-bottom: 10px;
		}
		.set_detail td
		{
			padding : 5px;
		}
		
	    
		}
</style>
 <div style="float: right">
     <input type="button" class="hide-from-printer btn btn-primary"  name="Print" value="Print" onclick="javascript:window.print();" />
</div>
<div class="admin-box">
	<div class="ruply"><img src="/eventsBonfire/public/themes/default/images/ruptly.jpg" style="width: 200px;height: 40px;"></div>
	<h3>MCR Information</h3>
		<fieldset>
           	<table class="details_table" style="width:900px;">
           		<tr>
           			<td>Customer:-
           				<?php echo $customers[$mcr_information['parentCustomer']]->name;?>
           			</td>
           			
           			<td>Issue By:-
           				<?php echo  $userslist[$mcr_information['parentMcr']]->username;?>
           			</td>
           			
           			<td>Issue Date:-
           				 <?php echo $mcr_information['issueDate']; ?>
           			</td>
           		</tr>
           		
           		<tr>
           			<td>Signature
           				 <?php echo "_______________"; ?>
           			</td>
           			<td>Received By:-
           				<?php echo $userslist[$mcr_information['receivedBy']]->username;?>
           			</td>
           			<td> Return Date :-
           				 <?php echo $mcr_information['returnDate']; ?>
           			</td>
           		</tr>
           		
           		<tr>
           			<td>Job :-
           				<?php echo $mcr_information['job']; ?>
           			</td>
           			<td>Set Type :-
           				<?php echo $fpsets[$mcr_information['type']]->setType; ?> 
           			</td>
           		</tr>
           	</table>
                
                
        <h4>Borrowed Equipment</h4>
		<table class="set_detail" style="width:900px;">
                <tr>
                    <th style="width: 520px;text-align: left">Camera:</th>
                    <th style="width: 450px;text-align: left">Audio:</th>
                    <th style="width: 450px;text-align: left">Peripherals:</th>
                </tr>
                
                <tr>
                    <td class="column-check" style="width: 520px;;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['panasonic_HCV700']) && $mcr_information['panasonic_HCV700'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_panasonic_HCV700', 1); ?>/>Panasonic HC-V700 <b>:</b>
                        <?php echo $mcr_information['V700']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['microphone_rode']) && $mcr_information['microphone_rode'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_microphone_rode', 1); ?>/>Microphone Rode
                    </td>
                    <td class="column-check" style="width: 450px;;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['macbook13']) && $mcr_information['macbook13'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_macbook13', 1); ?>/>MacBook 13 <b>:</b>
                        <?php echo $mcr_information['mac13'];?>
                    </td>
                </tr>
               
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['panasonic_HCV727']) && $mcr_information['panasonic_HCV727'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_panasonic_HCV727', 1); ?>/>Panasonic HC-V727 <b>:</b>
                        <?php echo $mcr_information['V727']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['extension_cable']) && $mcr_information['extension_cable'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_extension_cable', 1); ?>/>Extension Cable
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['macbook15']) && $mcr_information['macbook15'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_macbook15', 1); ?>/>MacBook 15
                    </td>
                </tr>
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['camera_checkbox1']) && $mcr_information['camera_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox1', 1); ?>/>
                        <?php echo $mcr_information['camera_value1'];?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['audio_checkbox1']) && $mcr_information['audio_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_audio_checkbox1', 1); ?>/>
                        <?php echo $mcr_information['audio_value1']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['recorder_sony_PMW50']) && $mcr_information['recorder_sony_PMW50'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_recorder_sony_PMW50', 1); ?>/> Recorder Sony PMW 50
                    </td>
                </tr>
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['camera_checkbox2']) && $mcr_information['camera_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox2', 1); ?>/>
                        <?php echo $mcr_information['camera_value2']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['audio_checkbox2']) && $mcr_information['audio_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_audio_checkbox2', 1); ?>/>
                        <?php echo $mcr_information['audio_value2']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['aja_interface']) && $mcr_information['aja_interface'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_aja_interface', 1); ?>/>  AJA Interface
                    </td>
                    
                </tr>
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['camera_checkbox3']) && $mcr_information['camera_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_camera_checkbox3', 1); ?>/>
                        <?php echo $mcr_information['camera_value3']; ?>
                    </td>
                    <th class="column-check" style="width: 450px;text-align: left">Broadcast:</th>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['sxs_card_reader']) && $mcr_information['sxs_card_reader'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_sxs_card_reader', 1); ?>/> SxS Card Reader
                    </td>
                    
                </tr>
                
                
                <tr>
                    <th class="column-check" style="width: 520px;text-align: left">Storage:</th>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['liveu']) && $mcr_information['liveu'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_liveu', 1); ?>/>LiveU
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['thunderbold_SSD_cable']) && $mcr_information['thunderbold_SSD_cable'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_thunderbold_SSD_cable', 1); ?>/> Thunderbold SSD + Cable
                    </td>
                    
                </tr>
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox"  <?php echo (isset($mcr_information['SD_card_amount']) && $mcr_information['SD_card_amount'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_SD_card_amount', 1); ?>/>SD Card
                     <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                        <?php echo $mcr_information['sccard_amount']; ?></span>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['minicaster']) && $mcr_information['minicaster'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_minicaster', 1); ?>/>Minicaster
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['mac_charger']) && $mcr_information['mac_charger'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_mac_charger', 1); ?> />Mac Charger
                    </td>
                    
                </tr>
                
                
                 <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" <?php echo (isset($mcr_information['mini_sd_card']) && $mcr_information['mini_sd_card'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_mini_sd_card', 1); ?>/>Mini-SD Card
                     <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                        <?php echo $mcr_information['mini_sd_card_amount']; ?>
                     </span>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['newsspotter']) && $mcr_information['newsspotter'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_newsspotter', 1); ?>/>Newsspotter
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['peripherals_checkbox1']) && $mcr_information['peripherals_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_peripherals_checkbox1', 1); ?>/>
                         <?php echo $mcr_information['peripherals_value1']; ?>
                    </td>
                    
                </tr>
                
                 <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                    <input type="checkbox" <?php echo (isset($mcr_information['sd_card_adaptor']) && $mcr_information['sd_card_adaptor'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_sd_card_adaptor', 1); ?>/>SD Card Adaptor
                     
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['BGAN_explorer']) && $mcr_information['BGAN_explorer'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_BGAN_explorer', 1); ?>/> BGAN Explorer
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['peripherals_checkbox2']) && $mcr_information['peripherals_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_peripherals_checkbox2', 1); ?>/>
                          <?php echo $mcr_information['peripherals_value2']; ?>
                    </td>
                    
                </tr>
                
                <tr>
                    <th style="width: 520px;text-align: left">Camera Accessories:</th>
                    <th style="width: 450px;text-align: left">Tripods:</th>
                    <th style="width: 450px;text-align: left">Miscellaneous:</th>
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" <?php echo (isset($mcr_information['battery_700_small']) && $mcr_information['battery_700_small'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_700_small', 1); ?>/> Battery 700 small
                     <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                        <?php echo $mcr_information['battery_700_small_amount']; ?>
                     </span>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['cullmann_magnesit']) && $mcr_information['cullmann_magnesit'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_cullmann_magnesit', 1); ?>/>Cullmann Magnesit
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['walkie_talkie']) && $mcr_information['walkie_talkie'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_walkie_talkie', 1); ?>/>Walkie Talkie UV-5R+
                    </td>
                    
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" <?php echo (isset($mcr_information['battery_700_big']) && $mcr_information['battery_700_big'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_700_big', 1); ?>/>Battery 700 big
                     <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                        <?php echo $mcr_information['battery_700_big_amount']; ?>
                     </span>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['cullmann_nanomax']) && $mcr_information['cullmann_nanomax'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_cullmann_nanomax', 1); ?>/>Cullmann Nanomax
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['first_aid_kit']) && $mcr_information['first_aid_kit'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_first_aid_kit', 1); ?>/>First Aid Kit
                    </td>
                    
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" <?php echo (isset($mcr_information['battery_727VWVBT190']) && $mcr_information['battery_727VWVBT190'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_727VWVBT190', 1); ?>/>Battery 727 VW-VBT190 <b>:</b>
                       <?php echo $mcr_information['battery_727VWVBT190_amount'] ; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['tripods_checkbox1']) && $mcr_information['tripods_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox1', 1); ?>/>Tripode Plate
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['backpack']) && $mcr_information['backpack'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_backpack', 1); ?>/> Backpack
                    </td>
                    
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" <?php echo (isset($mcr_information['battery_727VWVBT380']) && $mcr_information['battery_727VWVBT380'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_727VWVBT380', 1); ?>/>Battery 727 VW-VBT380 <b>:</b>
                       <?php echo $mcr_information['battery_727VWVBT380_amount']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['tripods_checkbox2']) && $mcr_information['tripods_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox2', 1); ?>/>
                          <?php echo $mcr_information['tripods_value2']; ?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['miscellaneous_checkbox1']) && $mcr_information['miscellaneous_checkbox1'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox1', 1); ?>/>
                           <?php echo $mcr_information['miscellaneous_value1'] ?>
                    </td>
                    
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox" name="mcr_information_battery_handycam" id="mcr_information_battery_handycam" value='1' <?php echo (isset($mcr_information['battery_handycam']) && $mcr_information['battery_handycam'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_battery_handycam', 1); ?>/>Battery Handycam
                     <span style="float: right;margin-right: 30px;"><b>Amount:</b>
                       <?php echo $mcr_information['battery_handycam_amount']; ?>
                     </span>  
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input name="mcr_information_tripods_checkbox3" type="checkbox" id="mcr_information_tripods_checkbox3" value='1' <?php echo (isset($mcr_information['tripods_checkbox3']) && $mcr_information['tripods_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox3', 1); ?>/>
                         <?php echo $mcr_information['tripods_value3'];?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" name="mcr_information_miscellaneous_checkbox2" id="mcr_information_miscellaneous_checkbox2" value='1' <?php echo (isset($mcr_information['miscellaneous_checkbox2']) && $mcr_information['miscellaneous_checkbox2'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox2', 1); ?>/>
                          <?php echo $mcr_information['miscellaneous_value2'];?>
                    </td>
                    
                </tr>
                
                
                 <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox"  <?php echo (isset($mcr_information['charger_patona']) && $mcr_information['charger_patona'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_charger_patona', 1); ?>/>Charger Patona
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input  type="checkbox" <?php echo (isset($mcr_information['tripods_checkbox4']) && $mcr_information['tripods_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox4', 1); ?>/>
                          <?php echo $mcr_information['tripods_value4']?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox" <?php echo (isset($mcr_information['miscellaneous_checkbox3']) && $mcr_information['miscellaneous_checkbox3'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox3', 1); ?>/>
                          <?php echo $mcr_information['miscellaneous_value3']; ?>
                    </td>
                    
                </tr>
                
                
                 <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox"  <?php echo (isset($mcr_information['charger_panasonic_VSK0781SND3BMT']) && $mcr_information['charger_panasonic_VSK0781SND3BMT'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_charger_panasonic_VSK0781SND3BMT', 1); ?>/>Charger Panasonic VSK0781 SN D3 BMT 
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input  type="checkbox" <?php echo (isset($mcr_information['tripods_checkbox5']) && $mcr_information['tripods_checkbox5'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_tripods_checkbox5', 1); ?>/>
                         <?php echo $mcr_information['tripods_value5'];?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['miscellaneous_checkbox4']) && $mcr_information['miscellaneous_checkbox4'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_miscellaneous_checkbox4', 1); ?>/>
                         <?php echo $mcr_information['miscellaneous_value4'];?>
                    </td>
                    
                </tr>
                
                
                <tr>
                    <td class="column-check" style="width: 520px;text-align: left">
                     <input type="checkbox"  <?php echo (isset($mcr_information['Battery_small_panasonic']) && $mcr_information['Battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_Battery_small_panasonic', 1); ?>/>2 Battery Small Panasonic VW-VBK-180  <b>:</b>
                      <?php echo $mcr_information['batterysmallpanasonic'];?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input  type="checkbox"  <?php echo (isset($mcr_information['one_cam_charger_panasonic']) && $mcr_information['one_cam_charger_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_one_cam_charger_panasonic', 1); ?>/>1 Cam-Charger Panasonic VSK0781  <b>:</b>
                        <?php echo $mcr_information['onecamchargerpanasonic'];?>
                    </td>
                    <td class="column-check" style="width: 450px;text-align: left">
                        <input type="checkbox"  <?php echo (isset($mcr_information['one_battery_small_panasonic']) && $mcr_information['one_battery_small_panasonic'] == 1) ? 'checked="checked"' : set_checkbox('mcr_information_one_battery_small_panasonic', 1); ?>/>1 Battery Small Panasonic VW-VBK-190<b>:</b>
                        <?php echo $mcr_information['onebatterysmallpanasonic'];?>
                    </td>
                    
                </tr>
                
                <tr>
                    <td colspan="4">
                        <p style="text-align: justify; line-height: 20px">
                        By signing this form, I agree to the following: I am responsible for the equipment or property issued to me; I will use  
                        it/them in the manner intended; I will be responsible for any damage done (excluding normal wear and tear); upon 
                        seperation from the company; I will return the item(s) issued to at proper working order (excluding normal wear and tear);
                        I will replaceany items issued to me that are damaged or lost at my expense; I authorize a payroll deduction to cover
                        the replacement cost of any item issued to me that is not returned for whatever reason, all is not returned 
                        in good working order.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="right">MCR Signature : 
                    _________________________</td>
                </tr>
            </table>

		</fieldset>
</div>