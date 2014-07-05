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

if (isset($customers))
{
	$customers = (array) $customers;
}
$id = isset($customers['id']) ? $customers['id'] : '';

?>
<div class="admin-box">
	<h3>Customers</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'customers_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='customers_name' type='text' name='customers_name' maxlength="200" value="<?php echo set_value('customers_name', isset($customers['name']) ? $customers['name'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('customfield') ? 'error' : ''; ?>">
				<?php echo form_label('Custom Field', 'customers_customfield', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'customers_customfield', 'id' => 'customers_customfield', 'rows' => '5', 'cols' => '80', 'value' => set_value('customers_customfield', isset($customers['customfield']) ? $customers['customfield'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('customfield'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('customers_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/settings/customers', lang('customers_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Customers.Settings.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('customers_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('customers_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>