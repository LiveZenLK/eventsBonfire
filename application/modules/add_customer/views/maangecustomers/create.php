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

if (isset($add_customer))
{
	$add_customer = (array) $add_customer;
}
$id = isset($add_customer['id']) ? $add_customer['id'] : '';

?>
<div class="admin-box">
	<h3>Add Customer</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'add_customer_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='add_customer_name' type='text' name='add_customer_name' maxlength="200" value="<?php echo set_value('add_customer_name', isset($add_customer['name']) ? $add_customer['name'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('name'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('customfield') ? 'error' : ''; ?>">
				<?php echo form_label('Custom Field', 'add_customer_customfield', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'add_customer_customfield', 'id' => 'add_customer_customfield', 'rows' => '5', 'cols' => '80', 'value' => set_value('add_customer_customfield', isset($add_customer['customfield']) ? $add_customer['customfield'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('customfield'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('add_customer_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/maangecustomers/add_customer', lang('add_customer_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>