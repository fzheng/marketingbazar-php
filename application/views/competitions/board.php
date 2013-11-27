  
    	<p>
    		<h1>Active Competitions</h1>
    	</p>
    	<div>
    	<?php if (!empty($records)): ?>
			<table border="1">
				<tr>
					<th>Name</th>
					<th>Start</th>
					<th>End</th>
					<th>Action</th>
				</tr>
			<?php foreach($records as $record): ?>
            	<tr>
            		<td><?php echo $record['name']?></td>
            		<td><?php echo $record['begin_at']?></td>
            		<td><?php echo $record['end_at']?></td>
                	<td><a href="/competitions/wall/<?= $record['id']?>">View Wall</a></td>
            	</tr> 
        	<?php endforeach; ?>
			</table>
		<?php endif; ?>
    	</div>  
  