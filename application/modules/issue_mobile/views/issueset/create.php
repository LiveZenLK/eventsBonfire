<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php endif;

if (isset($issue_mobile))
{
$issue_mobile = (array) $issue_mobile;
}
$id = isset($issue_mobile['id']) ? $issue_mobile['id'] : '';
?>
<div class="admin-box">
	<h3>Issue Mobile</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('issue_mobile_parentCustomer') ? 'error' : ''; ?>">
			 <?php echo form_label('Customer Name'. lang('bf_form_label_required'), 'issue_mobile_parentCustomer', array('class' => 'control-label') ); ?>	
                 <div class='controls'>
					<select id="issue_mobile_parentCustomer" name="issue_mobile_parentCustomer" >
                        <option value="">--Select Customer--</option>
                        <?php
                        foreach ($users as $user):
                        ?>
                       <option value="<?php echo $user->id?>" <?php echo set_value('issue_mobile_parentCustomer')==$user->id?'selected':''; ?>><?php echo $user->name?></option>
                       <?php endforeach;?>
	                </select>	
             	 </div>
			 </div>


			<div class="control-group <?php echo form_error('issue_mobile_parentMobile') ? 'error' : ''; ?>">
			<?php echo form_label('Mobile', 'issue_mobile_parentMobile', array('class' => 'control-label') ); ?>	
              <div class='controls'>
				<select id="issue_mobile_parentMobile" name="issue_mobile_parentMobile" style="width:220px;">
					 <option value="">--Select Mobile--</option>
	                <?php
	                foreach ($mobiles as $mobile):
	                ?>
	               <option value="<?php echo $mobile->id?>"  <?php echo set_value('issue_mobile_parentMobile')==$mobile->id?'selected':''; ?> ><?php echo $mobile->articleDescription."(".$mobile->imeiNumber.")" ?></option>
	               <?php endforeach;?>
                </select>	
              </div>
			</div>

			<div class="control-group <?php echo form_error('issue_mobile_parentSim') ? 'error' : ''; ?>">
			<?php echo form_label('Sim', 'issue_mobile_parentSim', array('class' => 'control-label') ); ?>	
              <div class='controls'>
				<select id="issue_mobile_parentSim" name="issue_mobile_parentSim" style="width:220px;">
                    <option value="">--Select SIM--</option>
                    <?php
                    foreach ($sims as $sim):
                    ?>
                   <option value="<?php echo $sim->id?>" <?php echo set_value('issue_mobile_parentSim')==$sim->id?'selected':''; ?> ><?php echo $sim->simCardName."(".$sim->telephoneNumber.")" ?></option>
                   <?php endforeach;?>
                 </select>	
               </div>
			</div>
			
			<div class="control-group <?php echo form_error('issue_mobile_status') ? 'error' : ''; ?>">
			  <?php echo form_label('Status'. lang('bf_form_label_required'), 'issue_mobile_status', array('class' => 'control-label') ); ?>	
                <div class='controls'>
					<select id="issue_mobile_status" name="issue_mobile_status">
	                    <option value="Issue" >Issue</option>
	                </select>	
            	</div>
			</div>

			<div class="control-group <?php echo form_error('charger') ? 'error' : ''; ?>">
				<?php echo form_label('Charger', '', array('class' => 'control-label', 'id' => 'issue_mobile_charger_label') ); ?>
				<div class='controls' aria-labelled-by='issue_mobile_charger_label'>
					<label class='radio' for='issue_mobile_charger_yes'>
						<input id='issue_mobile_charger_yes' name='issue_mobile_charger' type='radio' class='' value='Yes' <?php echo set_value('issue_mobile_charger')=='Yes'?"checked" : ''; ?> />
						Yes
					</label>
					<label class='radio' for='issue_mobile_charger_no'>
						<input id='issue_mobile_charger_no' name='issue_mobile_charger' type='radio' class='' value='No' <?php echo set_value('issue_mobile_charger')=='No'? "checked" : ''; ?> />
						No
					</label>
					<span class='help-inline'><?php echo form_error('charger'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('usbCable') ? 'error' : ''; ?>">
				<?php echo form_label('USB Cable', '', array('class' => 'control-label', 'id' => 'issue_mobile_usbCable_label') ); ?>
				<div class='controls' aria-labelled-by='issue_mobile_usbCable_label'>
					<label class='radio' for='issue_mobile_usbCable_yes'>
						<input id='issue_mobile_usbCable_yes' name='issue_mobile_usbCable' type='radio' class='' value='Yes' <?php echo set_value('issue_mobile_usbCable')=='Yes'?"checked" : ''; ?> />
						Yes
					</label>
					<label class='radio' for='issue_mobile_usbCable_no'>
						<input id='issue_mobile_usbCable_no' name='issue_mobile_usbCable' type='radio' class='' value='No'  <?php echo set_value('issue_mobile_usbCable')=='No'? "checked" : ''; ?>  />
						No
					</label>
					<span class='help-inline'><?php echo form_error('usbCable'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('issueDate') ? 'error' : ''; ?>">
				<?php echo form_label('Issue Date'. lang('bf_form_label_required'), 'issue_mobile_issueDate', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='issue_mobile_issueDate' type='text' name='issue_mobile_issueDate' maxlength="50" value="<?php echo set_value('issue_mobile_issueDate', isset($issue_mobile['issueDate']) ? $issue_mobile['issueDate'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('issueDate'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('returnDate') ? 'error' : ''; ?>">
				<?php echo form_label('Return Date', 'issue_mobile_returnDate', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='issue_mobile_returnDate' type='text' name='issue_mobile_returnDate' maxlength="50" value="<?php echo set_value('issue_mobile_returnDate', isset($issue_mobile['returnDate']) ? $issue_mobile['returnDate'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('returnDate'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('issue_mobile_issueBy') ? 'error' : ''; ?>">
			  <?php echo form_label('Issued By'. lang('bf_form_label_required'), 'issue_mobile_issueBy', array('class' => 'control-label') ); ?>	
                <div class='controls'>
				<select id="issue_mobile_issueBy" name="issue_mobile_issueBy">
                    <option value="">--Issued By--</option>
                    <?php
                    foreach ($admins as $admin):
                    ?>
                   <option value="<?php echo $admin->id?>" <?php echo set_value('issue_mobile_issueBy')==$admin->id?'selected':''; ?> ><?php echo $admin->username?></option>
                   <?php endforeach;?>
                </select>	
                </div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('issue_mobile_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/issueset/issue_mobile', lang('issue_mobile_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<?php 
Assets::add_js('
$("#issue_mobile_parentMobile").select2();
$("#issue_mobile_parentSim").select2();
',"inline")
?>
