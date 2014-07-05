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

if (isset($mobile))
{
	$mobile = (array) $mobile;
}
$id = isset($mobile['id']) ? $mobile['id'] : '';

?>
<div class="admin-box">
	<h3>Mobile</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('articleDescription') ? 'error' : ''; ?>">
				<?php echo form_label('Article Description'. lang('bf_form_label_required'), 'mobile_articleDescription', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mobile_articleDescription' type='text' name='mobile_articleDescription' maxlength="200" value="<?php echo set_value('mobile_articleDescription', isset($mobile['articleDescription']) ? $mobile['articleDescription'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('articleDescription'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('serialNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Serial Number'. lang('bf_form_label_required'), 'mobile_serialNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mobile_serialNumber' type='text' name='mobile_serialNumber' maxlength="200" value="<?php echo set_value('mobile_serialNumber', isset($mobile['serialNumber']) ? $mobile['serialNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('serialNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('imeiNumber') ? 'error' : ''; ?>">
				<?php echo form_label('IMEI Number'. lang('bf_form_label_required'), 'mobile_imeiNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mobile_imeiNumber' type='text' name='mobile_imeiNumber' maxlength="200" value="<?php echo set_value('mobile_imeiNumber', isset($mobile['imeiNumber']) ? $mobile['imeiNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('imeiNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('inventoryNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Inventory Number', 'mobile_inventoryNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='mobile_inventoryNumber' type='text' name='mobile_inventoryNumber' maxlength="200" value="<?php echo set_value('mobile_inventoryNumber', isset($mobile['inventoryNumber']) ? $mobile['inventoryNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('inventoryNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('customField') ? 'error' : ''; ?>">
				<?php echo form_label('Custom Field', 'mobile_customField', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'mobile_customField', 'id' => 'mobile_customField', 'rows' => '5', 'cols' => '80', 'value' => set_value('mobile_customField', isset($mobile['customField']) ? $mobile['customField'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('customField'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('mobile_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/managemobile/mobile', lang('mobile_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Mobile.Managemobile.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('mobile_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('mobile_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>