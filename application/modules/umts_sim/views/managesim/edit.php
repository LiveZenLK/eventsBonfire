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

if (isset($umts_sim))
{
	$umts_sim = (array) $umts_sim;
}
$id = isset($umts_sim['id']) ? $umts_sim['id'] : '';

?>
<div class="admin-box">
	<h3>UMTS SIM</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('simCardName') ? 'error' : ''; ?>">
				<?php echo form_label('SIM Card Name'. lang('bf_form_label_required'), 'umts_sim_simCardName', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_simCardName' type='text' name='umts_sim_simCardName' maxlength="200" value="<?php echo set_value('umts_sim_simCardName', isset($umts_sim['simCardName']) ? $umts_sim['simCardName'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('simCardName'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('puk') ? 'error' : ''; ?>">
				<?php echo form_label('PUK'. lang('bf_form_label_required'), 'umts_sim_puk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_puk' type='text' name='umts_sim_puk' maxlength="100" value="<?php echo set_value('umts_sim_puk', isset($umts_sim['puk']) ? $umts_sim['puk'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('puk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('pin') ? 'error' : ''; ?>">
				<?php echo form_label('PIN'. lang('bf_form_label_required'), 'umts_sim_pin', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_pin' type='text' name='umts_sim_pin' maxlength="100" value="<?php echo set_value('umts_sim_pin', isset($umts_sim['pin']) ? $umts_sim['pin'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('pin'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('simCardNumber') ? 'error' : ''; ?>">
				<?php echo form_label('SIM Card Number'. lang('bf_form_label_required'), 'umts_sim_simCardNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_simCardNumber' type='text' name='umts_sim_simCardNumber' maxlength="200" value="<?php echo set_value('umts_sim_simCardNumber', isset($umts_sim['simCardNumber']) ? $umts_sim['simCardNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('simCardNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telephoneNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Telephone Number', 'umts_sim_telephoneNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_telephoneNumber' type='text' name='umts_sim_telephoneNumber' maxlength="20" value="<?php echo set_value('umts_sim_telephoneNumber', isset($umts_sim['telephoneNumber']) ? $umts_sim['telephoneNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telephoneNumber'); ?></span>
				</div>
			</div>

			<!--
			<div class="control-group <?php echo form_error('balance') ? 'error' : ''; ?>">
				<?php echo form_label('Balance', 'umts_sim_balance', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_sim_balance' type='text' name='umts_sim_balance' maxlength="11" value="<?php echo set_value('umts_sim_balance', isset($umts_sim['balance']) ? $umts_sim['balance'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('balance'); ?></span>
				</div>
			</div>
			-->
			<div class="control-group <?php echo form_error('comment') ? 'error' : ''; ?>">
				<?php echo form_label('Comment', 'umts_sim_comment', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'umts_sim_comment', 'id' => 'umts_sim_comment', 'rows' => '5', 'cols' => '80', 'value' => set_value('umts_sim_comment', isset($umts_sim['comment']) ? $umts_sim['comment'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('comment'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('umts_sim_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/managesim/umts_sim', lang('umts_sim_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('UMTS_SIM.Managesim.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('umts_sim_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('umts_sim_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>