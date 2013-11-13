<html>  
	<head>  
        <title><?= $title ?></title>  
    </head>  
    <body>  
    	<p><?= $description ?></p>
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
                	<td><a href="/competitions/edit/<?= $record['id']?>">Edit</a></td>
            	</tr> 
        	<?php endforeach; ?>
			</table>
		<?php endif; ?>
    	</div>
    	<p><a href="/competitions/create">Create Competition</a></p>  
    </body>  
</html>  