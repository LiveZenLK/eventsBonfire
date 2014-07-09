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
                        foreach ($customers as $customer):
                        ?>
                        <option value="<?php echo $customer->id?>"  <?php echo set_value('issue_umts_mobile_parentCustomer')==$customer->id?'selected':''; ?>><?php echo ucfirst($customer->name)?></option>
                       <?php endforeach;?>
                    </select>	
                </div>
			</div>
                    
                    
                    
			<div class="control-group <?php echo form_error('issue_umts_mobile_parentMobile') ? 'error' : ''; ?>">
			<?php echo form_label('Mobile'. lang('bf_form_label_required'), 'issue_umts_mobile_parentMobile', array('class' => 'control-label') ); ?>	
                <div class='controls'>
					<select id="issue_umts_mobile_parentMobile" name="issue_umts_mobile_parentMobile" style="width:220px;">
                        <option value="">--Select UMTS Stick--</option>
	                        <?php
	                        foreach ($mobiles as $mobile):
	                        ?>
	                       <option value="<?php echo $mobile->id?>" <?php echo set_value('issue_umts_mobile_parentMobile')==$mobile->id?'selected':''; ?>><?php echo $mobile->articleDescription."(".$mobile->imeiNumber.")" ?></option>
                       <?php endforeach;?>
	                </select>	
                </div>
			</div>
                    
                    
                    
			<div class="control-group <?php echo form_error('issue_umts_mobile_parentSim') ? 'error' : ''; ?>">
			<?php echo form_label('Sim'. lang('bf_form_label_required'), 'issue_umts_mobile_parentSim', array('class' => 'control-label') ); ?>	
                <div class='controls'>
					<select id="issue_umts_mobile_parentSim" name="issue_umts_mobile_parentSim" style="width:220px;">
                        <option value="">--Select Sim--</option>
                        <?php
                        foreach ($sims as $sim):
                        ?>
                       <option value="<?php echo $sim->id?>" <?php echo set_value('issue_umts_mobile_parentSim')==$sim->id?'selected':''; ?>><?php echo $sim->simCardName."(".$sim->telephoneNumber.")"?></option>
                       <?php endforeach;?>
                    </select>	
                </div>
			</div>
                    
                    
                    
			<div class="control-group <?php echo form_error('issue_umts_mobile_status') ? 'error' : ''; ?>">
			<?php echo form_label('Status'. lang('bf_form_label_required'), 'issue_umts_mobile_status', array('class' => 'control-label') ); ?>	
            <div class='controls'>
				<select id="issue_umts_mobile_status" name="issue_umts_mobile_status">
                    <option value="Issue">Issue</option>
                </select>	
            </div>
			</div>
                    
                    

			<!--	
			<div class="control-group <?php echo form_error('charger') ? 'error' : ''; ?>">
				<?php echo form_label('Charger'. lang('bf_form_label_required'), '', array('class' => 'control-label', 'id' => 'issue_umts_mobile_charger_label') ); ?>
				<div class='controls' aria-labelled-by='issue_umts_mobile_charger_label'>
					<label class='radio' for='issue_umts_mobile_charger_yes'>
						<input id='issue_umts_mobile_charger_option1' name='issue_umts_mobile_charger' type='radio' class='' value='Yes' <?php echo set_radio('issue_umts_mobile_charger', 'yes'); ?> />
						Yes
					</label>
					<label class='radio' for='issue_umts_mobile_charger_option2'>
						<input id='issue_umts_mobile_charger_option2' name='issue_umts_mobile_charger' type='radio' class='' value='No' <?php echo set_radio('issue_umts_mobile_charger', 'no'); ?> />
						No
					</label>
					<span class='help-inline'><?php echo form_error('charger'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('usbCable') ? 'error' : ''; ?>">
				<?php echo form_label('USB Cable'. lang('bf_form_label_required'), '', array('class' => 'control-label', 'id' => 'issue_umts_mobile_usbCable_label') ); ?>
				<div class='controls' aria-labelled-by='issue_umts_mobile_usbCable_label'>
					<label class='radio' for='issue_umts_mobile_usbCable_option1'>
						<input id='issue_umts_mobile_usbCable_option1' name='issue_umts_mobile_usbCable' type='radio' class='' value='Yes' <?php echo set_radio('issue_umts_mobile_usbCable', 'option1'); ?> />
						Yes
					</label>
					<label class='radio' for='issue_umts_mobile_usbCable_option2'>
						<input id='issue_umts_mobile_usbCable_option2' name='issue_umts_mobile_usbCable' type='radio' class='' value='No' <?php echo set_radio('issue_umts_mobile_usbCable', 'option2'); ?> />
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
                        <option value="">--Issued By--</option>
                        <?php
                        foreach ($admins as $admin):
                        ?>
                        <option value="<?php echo $admin->id?>" <?php echo set_value('issue_umts_mobile_parentAdmin')==$admin->id?'selected':''; ?>><?php echo ucfirst($admin->username)?></option>
                       <?php endforeach;?>
                    </select>	
                </div>
			</div>
			-->
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('issue_umts_mobile_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/issueset/issue_umts_mobile', lang('issue_umts_mobile_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<?php 
Assets::add_js('
$("#issue_umts_mobile_parentMobile").select2();
$("#issue_umts_mobile_parentSim").select2();
',"inline")
?>