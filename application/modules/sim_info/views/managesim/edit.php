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

if (isset($sim_info))
{
	$sim_info = (array) $sim_info;
}
$id = isset($sim_info['id']) ? $sim_info['id'] : '';

?>
<div class="admin-box">
	<h3>SIM Info</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('simCardName') ? 'error' : ''; ?>">
				<?php echo form_label('SIM Card Name'. lang('bf_form_label_required'), 'sim_info_simCardName', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_simCardName' type='text' name='sim_info_simCardName' maxlength="200" value="<?php echo set_value('sim_info_simCardName', isset($sim_info['simCardName']) ? $sim_info['simCardName'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('simCardName'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('puk') ? 'error' : ''; ?>">
				<?php echo form_label('PUK'. lang('bf_form_label_required'), 'sim_info_puk', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_puk' type='text' name='sim_info_puk' maxlength="200" value="<?php echo set_value('sim_info_puk', isset($sim_info['puk']) ? $sim_info['puk'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('puk'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('pin') ? 'error' : ''; ?>">
				<?php echo form_label('PIN'. lang('bf_form_label_required'), 'sim_info_pin', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_pin' type='text' name='sim_info_pin' maxlength="200" value="<?php echo set_value('sim_info_pin', isset($sim_info['pin']) ? $sim_info['pin'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('pin'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('simCardNumber') ? 'error' : ''; ?>">
				<?php echo form_label('SIM Card Number'. lang('bf_form_label_required'), 'sim_info_simCardNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_simCardNumber' type='text' name='sim_info_simCardNumber' maxlength="200" value="<?php echo set_value('sim_info_simCardNumber', isset($sim_info['simCardNumber']) ? $sim_info['simCardNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('simCardNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('telephoneNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Telephone Number'. lang('bf_form_label_required'), 'sim_info_telephoneNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_telephoneNumber' type='text' name='sim_info_telephoneNumber' maxlength="20" value="<?php echo set_value('sim_info_telephoneNumber', isset($sim_info['telephoneNumber']) ? $sim_info['telephoneNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('telephoneNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('balance') ? 'error' : ''; ?>">
				<?php echo form_label('Balance', 'sim_info_balance', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_balance' type='text' name='sim_info_balance' maxlength="11" value="<?php echo set_value('sim_info_balance', isset($sim_info['balance']) ? $sim_info['balance'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('balance'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('comment') ? 'error' : ''; ?>">
				<?php echo form_label('Comment', 'sim_info_comment', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='sim_info_comment' type='text' name='sim_info_comment' maxlength="1000" value="<?php echo set_value('sim_info_comment', isset($sim_info['comment']) ? $sim_info['comment'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('comment'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('sim_info_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/managesim/sim_info', lang('sim_info_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('SIM_Info.Managesim.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('sim_info_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('sim_info_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>