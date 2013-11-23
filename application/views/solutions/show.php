<!doctype html>
<html>
<head>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<body>
   <h1>Solutions</h1>
   <div id="files">
	<?php if(isset($error_msg)): ?>
		<h2><?= $error_msg ?></h2>
	<?php else: ?>
		<?php if (isset($solutions) && count($solutions)): ?>
 		<table border="1">
 			<tr>
 				<th>Username</th>
 				<th>Title</th>
 				<th>Attachment</th>
 				<th>View</th>
 			</tr>
		<?php foreach ($solutions as $solution): ?>
            <tr>
               <td><?= $solution['username']?></td>
               <td><strong><?= $solution['title']?></strong></td>
               <td><?= $solution['file_name']?></td>	
               <td>	
            	<form action="/solutions/download/<?= $solution['competition_id'] ?>/<?= $solution['id'] ?>">
            		<input type="submit" name="submit" value="View"> 
            	</form>
               </td>
            </tr>
       <?php endforeach; ?> 			
 		</table>
   	  <?php else: ?>
   		<p>No Submissions Received</p>
   	  <?php endif; ?>
	<?php endif; ?>
   </div>
</body>
</html>