<?php

$num_columns	= 8;
$can_delete	= $this->auth->has_permission('MCR_Information.Addform.Delete');
$can_edit		= $this->auth->has_permission('MCR_Information.Addform.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>


<div class="admin-box">
   
	<h3>MCR Information <span style="color: red">(Issued Set)</span></h3>
	
	<?php echo form_open($this->uri->uri_string(),array('class'=>'form-wrapper cf', 'id'=>'search_form')); ?>
				<div>
					<input type="hidden" name="search" value="">
					<select name="searchType" required class="customselect">
					    <option value="">Select Search Type</option>
					    <option value="name" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="name"?" selected='selected'":""?>>Search By Name</option>
					    <option value="job" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="job"?"selected='selected'":""?>>Search By Job</option>
					</select>
				</div>
		        <input type="text" name="searchString" placeholder="Search here..." value="<?php echo isset($_POST['searchString'])?$_POST['searchString']:""?>" required>
		        
		        <button type="submit">Search</button>
		    <?php echo form_close();?>

   <br /><br />
   
        <p><?php echo anchor(SITE_AREA . '/addform/mcr_information/return_sets/' , '<input type="button" value="View Return Sets" class="btn btn-warning">') ?></p>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered" style="margin-top: 0px;">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Customer</th>
					<th>Job</th>
					<th>Issued By</th>
					<th>Issue Date</th>
					<th>Status</th>
					<th>Received By</th>
					<th>Return Date</th>
					<th>Set Type</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('mcr_information_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody id="customerList">
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
					<?php endif;?>
					
                                        
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/addform/mcr_information/edit/' . $record->id, '<span class="icon-pencil"></span>' . $customers[$record->parentCustomer]->name); ?></td>
				<?php else : ?>
					<td><?php $customers[$record->parentCustomer]->name; ?></td>
				<?php endif; ?>
					<td><?php e($record->job) ?></td>
					<td><?php echo $userslist[$record->parentMcr]->username ?></td>
					<td><?php e($record->issueDate) ?></td>
					<td><?php e($record->status) ?></td>
					<?php if($record->receivedBy) { ?>
					<td><?php echo $userslist[$record->receivedBy]->username ?></td>
					<?php } else { ?>
						<td>Not Selected</td>
						<?php } ?> 
					<td><?php e($record->returnDate) ?></td>
					<td><?php e($record->type) ?></td>
                    <td><p><?php echo anchor(SITE_AREA . '/addform/mcr_information/mcr_detail/'. $record->id , '<input type="button" value="View Detail" class="btn btn-primary">') ?></p></td>
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