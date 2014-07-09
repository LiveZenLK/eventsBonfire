<?php

$num_columns	= 6;
$can_delete	= $this->auth->has_permission('Mobile.Managemobile.Delete');
$can_edit		= $this->auth->has_permission('Mobile.Managemobile.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Mobile</h3>
	
		<?php echo form_open($this->uri->uri_string(),array('class'=>'form-wrapper cf', 'id'=>'search_form')); ?>
				<div>
					<input type="hidden" name="search" value="">
					<select name="searchType" class="customselect">
					    <option value="">Select Search Type</option>
					    <option value="imei" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="imei"?" selected='selected'":""?>>Search By IMEI No</option>
					</select>
				</div>
		        <input type="text" name="searchString" placeholder="Search here..." value="<?php echo isset($_POST['searchString'])?$_POST['searchString']:""?>">
		        
		        <button type="submit">Search</button>
		    <?php echo form_close();?>

   <br /><br />
	
	
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Article Description</th>
					<th>Serial Number</th>
					<th>IMEI Number</th>
					<th>Inventory Number</th>
					<th>Custom Field</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('mobile_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
						if($record->deleted == 1) { ?>
				<tr style="color: red">
					<?php  } else { ?>
				<tr>
					<?php } ?>		
					<?php if ($can_delete) : ?>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/managemobile/mobile/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->articleDescription); ?></td>
				<?php else : ?>
					<td><?php e($record->articleDescription); ?></td>
				<?php endif; ?>
					<td><?php e($record->serialNumber) ?></td>
					<td><?php e($record->imeiNumber) ?></td>
					<td><?php e($record->inventoryNumber) ?></td>
					<td><?php e($record->customField) ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); 
	echo $this->pagination->create_links();
	?>
</div>
<?php 
Assets::add_js('
$(".pagination a").click(function(e){
		e.preventDefault();
		$("#search_form").attr("action", $(this).attr("href"));
		$("#search_form").submit();
		return;
});
',"inline")
?>