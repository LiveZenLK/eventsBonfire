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

if (isset($issue_umts_mobile))
{
	$issue_umts_mobile = (array) $issue_umts_mobile;
}
$id = isset($issue_umts_mobile['id']) ? $issue_umts_mobile['id'] : '';
$selectedCustomer = $issue_umts_mobile['parentCustomer'];
$selectedMobile = $issue_umts_mobile['parentMobile'];
$selectedSim = $issue_umts_mobile['parentSim'];
$selectedStatus = $issue_umts_mobile['status'];
$selectedAdmin = $issue_umts_mobile['parentAdmin'];
$charger = $issue_umts_mobile['charger'];
$usb = $issue_umts_mobile['usbCable'];
?>
<div class="admin-box">
	<h3>Issue UMTS Mobile</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('issue_umts_mobile_parentCustomer') ? 'error' : ''; ?>">
			<?php echo form_label('Customer Name'. lang('bf_form_label_required'), 'issue_umts_mobile_parentCustomer', array('class' => 'control-label') ); ?>	
                <div class='controls'>
					<select id="issue_umts_mobile_parentCustomer" name="issue_umts_mobile_parentCustomer">
						 <option value="">--Select Customer--</option>
                        <?php
                        foreach ($cutomers as $customer):
                        if($customer->id==$selectedCustomer){ ?>
						<option selected="selected" value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
					   <?php } else {  ?>
                       <option value="<?php echo $customer->id;?>"><?php echo $customer->name;?></option>
                       <?php } endforeach; ?>
				    </select>	
                </div>
			</div>
                    
                    
			<div class="control-group <?php echo form_error('issue_umts_mobile_parentMobile') ? 'error' : ''; ?>">
			<?php echo form_label('Mobile'. lang('bf_form_label_required'), 'issue_umts_mobile_parentMobile', array('class' => 'control-label') ); ?>	
                            <div class='controls'>
				<select id="issue_umts_mobile_parentMobile" name="issue_umts_mobile_parentMobile">
					 <option value="">--Select UMTS Stick--</option>
                                    
                                    <?php
                                    foreach ($mobiles as $mobile):
                                    if($mobile->id==$selectedMobile){ ?>
					<option selected="selected" value="<?php echo $mobile->id?>"><?php echo $mobile->articleDescription."(".$mobile->imeiNumber.")"?></option>
				   <?php }
                                   else{
                                        ?>
                                    
                                   <option value="<?php echo $mobile->id;?>"><?php echo $mobile->articleDescription;?></option>
                                   <?php } endforeach; ?>
                                </select>	
                            </div>
			</div>

			<div class="control-group <?php echo form_error('issue_umts_mobile_parentSim') ? 'error' : ''; ?>">
			  <?php echo form_label('Sim'. lang('bf_form_label_required'), 'issue_umts_mobile_parentSim', array('class' => 'control-label') ); ?>	
                    <div class='controls'>
						<select id="issue_umts_mobile_parentSim" name="issue_umts_mobile_parentSim">
							<option value="">---Select Sim---</option>
                            <?php
                            foreach ($sims as $sim):
                            if($sim->id==$selectedSim){ ?>
							<option selected="selected" value="<?php echo $sim->id?>"><?php echo $sim->simCardName."(".$sim->telephoneNumber.")"?></option>
						   <?php } else{   ?>
                           <option value="<?php echo $sim->id;?>"><?php echo $sim->simCardName."(".$sim->telephoneNumber.")";?></option>
                           <?php } endforeach; ?>
				        </select>	
                    </div>
			</div>

			<div  class="control-group <?php echo form_error('issue_umts_mobile_status') ? 'error' : ''; ?>">
			<?php echo form_label('Status'. lang('bf_form_label_required'), 'issue_umts_mobile_status', array('class' => 'control-label') ); ?>	
                            <div class='controls'>
				<select id="issue_umts_mobile_status" name="issue_umts_mobile_status"  >
                                    <option value="">--Select Status--</option>
                                    <?php
                   
                                     if($selectedStatus=='Issue'){ ?>
                                    <option selected="selected" value="<?php echo $issue_umts_mobile['status']?>"><?php echo $issue_umts_mobile['status']?></option>
                                    <option value="Return" >Return</option>
				   <?php }
                                   else{
                                    ?>
                                   <option selected="selected" value="<?php echo $issue_umts_mobile['status']?>"><?php echo $issue_umts_mobile['status']?></option>
                                    <option value="Issue" >Issue</option>
                                    <?php } ?>
                                </select>	
                            </div>
			</div>   


			<!--
			<div class="control-group <?php echo form_error('charger') ? 'error' : ''; ?>">
				<?php echo form_label('Charger'. lang('bf_form_label_required'), '', array('class' => 'control-label', 'id' => 'issue_umts_mobile_charger_label') ); ?>
				<div class='controls' aria-labelled-by='issue_umts_mobile_charger_label'>
					<label class='radio' for='issue_umts_mobile_charger_option1'>
						<input id='issue_umts_mobile_charger_option1' name='issue_umts_mobile_charger' type='radio' class='' value='Yes' <?php if($charger=='Yes') { echo set_radio('issue_umts_mobile_charger', 'Yes' , TRUE ); } ?> />
						Yes
					</label>
					<label class='radio' for='issue_umts_mobile_charger_option2'>
						<input id='issue_umts_mobile_charger_option2' name='issue_umts_mobile_charger' type='radio' class='' value='No' <?php if($charger=='No') { echo set_radio('issue_umts_mobile_charger', 'No' , TRUE); }?> />
						No
					</label>
					<span class='help-inline'><?php echo form_error('charger'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('usbCable') ? 'error' : ''; ?>">
				<?php echo form_label('USB Cable'. lang('bf_form_label_required'), '', array('class' => 'control-label', 'id' => 'issue_umts_mobile_usbCable_label') ); ?>
				<div class='controls' aria-labelled-by='issue_umts_mobile_usbCable_label'>
					<label class='radio' for='issue_umts_mobile_usbCable_option1'>
						<input id='issue_umts_mobile_usbCable_option1' name='issue_umts_mobile_usbCable' type='radio' class='' value='Yes' <?php if($usb=='Yes') { echo set_radio('issue_umts_mobile_usbCable', 'Yes' , TRUE); } ?> />
						Yes
					</label>
					<label class='radio' for='issue_umts_mobile_usbCable_option2'>
						<input id='issue_umts_mobile_usbCable_option2' name='issue_umts_mobile_usbCable' type='radio' class='' value='No' <?php if($usb=='No') { echo set_radio('issue_umts_mobile_usbCable', 'No', TRUE); } ?> />
						No
					</label>
					<span class='help-inline'><?php echo form_error('usbCable'); ?></span>
				</div>
			</div>
			-->	

			<div class="control-group <?php echo form_error('issueDate') ? 'error' : ''; ?>">
				<?php echo form_label('Issue Date'. lang('bf_form_label_required'), 'issue_umts_mobile_issueDate', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='issue_umts_mobile_issueDate' type='text' name='issue_umts_mobile_issueDate' maxlength="50" value="<?php echo set_value('issue_umts_mobile_issueDate', isset($issue_umts_mobile['issueDate']) ? $issue_umts_mobile['issueDate'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('issueDate'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('returnDate') ? 'error' : ''; ?>">
				<?php echo form_label('Return Date', 'issue_umts_mobile_returnDate', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='issue_umts_mobile_returnDate' type='text' name='issue_umts_mobile_returnDate' maxlength="50" value="<?php echo set_value('issue_umts_mobile_returnDate', isset($issue_umts_mobile['returnDate']) ? $issue_umts_mobile['returnDate'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('returnDate'); ?></span>
				</div>
			</div>


			<!-- 
			<div class="control-group <?php echo form_error('issue_umts_mobile_parentAdmin') ? 'error' : ''; ?>">
			<?php echo form_label('Issued By'. lang('bf_form_label_required'), 'issue_umts_mobile_parentAdmin', array('class' => 'control-label') ); ?>	
                            <div class='controls'>
				<select id="issue_umts_mobile_parentAdmin" name="issue_umts_mobile_parentAdmin">
                                    
                                    <?php
                                    foreach ($admins as $admin):
                                    if($admin->id==$selectedAdmin){ ?>
					<option selected="selected" value="<?php echo $admin->id?>"><?php echo $admin->username?></option>
				   <?php }
                                   else{
                                        ?>
                                    
                                   <option value="<?php echo $admin->id;?>"><?php echo $admin->username;?></option>
                                   <?php } endforeach; ?>
                                </select>	
                            </div>
			</div>
			-->

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('issue_umts_mobile_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/issueset/issue_umts_mobile', lang('issue_umts_mobile_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Issue_UMTS_Mobile.Issueset.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('issue_umts_mobile_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('issue_umts_mobile_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>