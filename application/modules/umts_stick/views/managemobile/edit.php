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

if (isset($umts_stick))
{
	$umts_stick = (array) $umts_stick;
}
$id = isset($umts_stick['id']) ? $umts_stick['id'] : '';

?>
<div class="admin-box">
	<h3>UMTS Stick</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('articleDescription') ? 'error' : ''; ?>">
				<?php echo form_label('Article Description'. lang('bf_form_label_required'), 'umts_stick_articleDescription', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_stick_articleDescription' type='text' name='umts_stick_articleDescription' maxlength="100" value="<?php echo set_value('umts_stick_articleDescription', isset($umts_stick['articleDescription']) ? $umts_stick['articleDescription'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('articleDescription'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('serialNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Serial Number'. lang('bf_form_label_required'), 'umts_stick_serialNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_stick_serialNumber' type='text' name='umts_stick_serialNumber' maxlength="100" value="<?php echo set_value('umts_stick_serialNumber', isset($umts_stick['serialNumber']) ? $umts_stick['serialNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('serialNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('imeiNumber') ? 'error' : ''; ?>">
				<?php echo form_label('IMEI Number'. lang('bf_form_label_required'), 'umts_stick_imeiNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_stick_imeiNumber' type='text' name='umts_stick_imeiNumber' maxlength="200" value="<?php echo set_value('umts_stick_imeiNumber', isset($umts_stick['imeiNumber']) ? $umts_stick['imeiNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('imeiNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('inventoryNumber') ? 'error' : ''; ?>">
				<?php echo form_label('Inventory Number', 'umts_stick_inventoryNumber', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='umts_stick_inventoryNumber' type='text' name='umts_stick_inventoryNumber' maxlength="200" value="<?php echo set_value('umts_stick_inventoryNumber', isset($umts_stick['inventoryNumber']) ? $umts_stick['inventoryNumber'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('inventoryNumber'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('customField') ? 'error' : ''; ?>">
				<?php echo form_label('Custom Field', 'umts_stick_customField', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'umts_stick_customField', 'id' => 'umts_stick_customField', 'rows' => '5', 'cols' => '80', 'value' => set_value('umts_stick_customField', isset($umts_stick['customField']) ? $umts_stick['customField'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('customField'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('umts_stick_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/managemobile/umts_stick', lang('umts_stick_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('UMTS_Stick.Managemobile.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('umts_stick_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('umts_stick_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>