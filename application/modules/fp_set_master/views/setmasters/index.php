<?php

$num_columns	= 5;
$can_delete	= $this->auth->has_permission('FP_Set_Master.Setmasters.Delete');
$can_edit		= $this->auth->has_permission('FP_Set_Master.Setmasters.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	<h3>FP Set Master</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>FP Set</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('fp_set_master_delete_confirm'))); ?>')" />
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
					
					<td><font style="color: red; font-weight: bold;"><?php e($record->setType); ?></font></td>
				<?php if ($can_edit) : ?>
					<td>
					   <a href="<?php echo site_url('admin/setmasters/fp_set_master/edit').'/'.$record->id; ?>" >
							<button type="button" class="btn btn-danger" >
								<span class="icon-pencil"></span>&nbsp;<?php echo "Edit" ?>
						    </button>
					   </a>
					</td>	    
				<?php endif; ?>
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