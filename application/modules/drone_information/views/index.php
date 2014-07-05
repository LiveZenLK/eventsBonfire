<div>
	<h1 class="page-header">Drone Information</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				
		<th>Customer</th>
		<th>Issue Date</th>
		<th>Return Date</th>
		<th>Issue By</th>
		<th>Received By</th>
		<th>Status</th>
		<th>Drone Set 1</th>
		<th>DJI Phantom</th>
		<th>DJI Phantom Text</th>
		<th>Zenmuse Gimbal</th>
		<th>Zenmuse Gimbal Text</th>
		<th>Gepro Hero Silver</th>
		<th>Gepro Hero Silver Text</th>
		<th>Sets propellers</th>
		<th>Sets propellers Text</th>
		<th>Phantom Batteries</th>
		<th>Phantom Batteries Text</th>
		<th>Phantom Chargers</th>
		<th>Phantom Chargers Text</th>
		<th>Propellor Protection</th>
			</tr>
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'id') : ?>
					<td>
						<?php if ($field == 'deleted'): ?>
							<?php e(($value > 0) ? lang('drone_information_true') : lang('drone_information_false')); ?>
						<?php else: ?>
							<?php e($value); ?>
						<?php endif ?>
					</td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>