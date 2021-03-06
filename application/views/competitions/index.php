 
    	<p>Your Created Competitions</p>
    	<div>
    	<?php if (!empty($records)): ?>
			<table border="1">
				<tr>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
					<th>Actions</th>
				</tr>
			<?php foreach($records as $record): ?>
            	<tr>
            		<td><?php echo $record['name']?></td>
            		<td><?php echo $record['begin_at']?></td>
            		<td><?php echo $record['end_at']?></td>
                	<td>
                	<a href="/competitions/edit/<?= $record['id']?>">Edit</a> &nbsp;&nbsp;
                	<a href="/solutions/show/<?= $record['id']?>">Submitted Solutions</a> &nbsp;&nbsp;
                	<a href="/payment/payout/<?= $record['id']?>">Pay Winner</a>
                	</td>
            	</tr> 
        	<?php endforeach; ?>
			</table>
		<?php endif; ?>
    	</div>
    	<p><a href="/competitions/create">Create Competition</a></p>  
    	<br/>
    	<br/>
    	<p>Your Joined Competitions</p>
     	<div>
    	<?php if (!empty($attendees)): ?>
			<table border="1">
				<tr>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
					<th>Actions</th>
				</tr>
			<?php foreach($attendees as $attendee): ?>
            	<tr>
            		<td><?php echo $attendee['name']?></td>
            		<td><?php echo $attendee['begin_at']?></td>
            		<td><?php echo $attendee['end_at']?></td>
                	<td><a href="/solutions/submit/<?= $attendee['competition_id'] ?>">Submit Solution</a></td>
            	</tr> 
        	<?php endforeach; ?>
			</table>
		<?php endif; ?>
    	</div>
    	  