<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('Issue_Mobile.Issueset.Delete');
$can_edit		= $this->auth->has_permission('Issue_Mobile.Issueset.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>Issue Mobile</h3>
	
	<?php echo form_open($this->uri->uri_string(),array('class'=>'form-wrapper cf', 'id'=>'search_form')); ?>
				<div>
					<input type="hidden" name="search" value="">
					<select name="searchType" required class="customselect">
					    <option value="">Select Search Type</option>
					    <option value="name" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="name"?" selected='selected'":""?>>Search By Name</option>
					    <option value="serialno" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="serialno"?"selected='selected'":""?>>Search BY Serial Number</option>
					    <option value="imeino" <?php echo isset($_POST['searchType'])&& $_POST['searchType']=="imeino"?"selected='selected'":""?>>Search by IMEI Number</option>
					</select>
				</div>
		        <input type="text" name="searchString" placeholder="Search here..." value="<?php echo isset($_POST['searchString'])?$_POST['searchString']:""?>" required>
		        
		        <button type="submit">Search</button>
		    <?php echo form_close();?>

   <br /><br />
	
	
	 <p><?php echo anchor(SITE_AREA . '/issueset/issue_mobile/returnsets' , '<input type="button" value="View Return Sets" class="btn btn-warning">') ?></p>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Customer</th>
					<th>Mobile</th>
					<th>Sim</th>
					<th>Status</th>
					<th>Charger</th>
					<th>USB Cable</th>
					<th>Issue Date</th>
					<th>Return Date</th>
					<th>Issued By</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('issue_mobile_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
                    <td><?php echo anchor(SITE_AREA . '/issueset/issue_mobile/edit/' . $record->id, '<span class="icon-pencil"></span>' . ucfirst($customers[$record->parentCustomer]->name)); ?></td>
				<?php else : ?>
					<td><?php echo $customers[$record->parentCustomer]->name ?></td>
						
					<?php endif; ?>
					<?php if($record->parentMobile) { ?>
					<td><?php echo $mobilelist[$record->parentMobile]->articleDescription."(".$mobilelist[$record->parentMobile]->serialNumber.")" ?></td>
					<?php } else {?>
					<td>Mobile Not Issue</td>	
					<?php } ?>	
					<?php if($record->parentSim)
					{ ?>
					<td><?php echo $simlist[$record->parentSim]->simCardName."(".$simlist[$record->parentSim]->telephoneNumber.")" ?></td>
						<?php } else { ?>
					<td>Sim Not Issue</td>		
						<?php }?>
					<td><?php e($record->status) ?></td>
					<td><?php e($record->charger) ?></td>
					<td><?php e($record->usbCable) ?></td>
					<td><?php e($record->issueDate) ?></td>
					<td><?php e($record->returnDate) ?></td>
                    <td><?php echo ucfirst($userslist[$record->issueBy]->username) ?></td>
                    <td><?php echo anchor(SITE_AREA . '/issueset/issue_mobile/view_detail/'.$record->id , '<input type="button" value="View Detail" class="btn btn-primary">') ?></td>
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
