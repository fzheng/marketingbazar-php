
		<h1>Competition: <?= $record['name'] ?></h1>
		<?php if(isset($show_sign_up) && $show_sign_up === true):?>
		<p>
			<form action="/competitions/signup" method="post">
				<input type="submit" value="Sign Up" />
				<input type="hidden" name="competition_id" value="<?= $record['id'] ?>" />
			</form>	
		</p>
		<?php endif; ?>
		<p>
			<div>
				<h5>Start Time: <?= $record['begin_at']?></h5>
				<h5>End Time: <?= $record['end_at']?></h5>
			</div>
			<div>
				<h5>Description</h5>
				<p><?= $record['description'] ?></p>
			</div>
			<div>
				<h5>Problem Statement</h5>
				<p><?= $record['statement'] ?></p>
			</div>
			<div>
				<h5>Project Type</h5>
				<p><?= $record['project_type']?></p>
			</div>
			<div>
				<h5>Scope</h5>
				<p><?= nl2br($record['scope']) ?></p>
			</div>
			<div>
				<h5>Platform</h5>
				<p><?= $record['platform'] ?></p>
			</div>
			<div>
				<h5>Must Have:</h5>
				<p><?= nl2br($record['must_haves']) ?></p>
			</div>
			<div>
				<h5>Nice to Have:</h5>
				<p><?= nl2br($record['nice_haves']) ?></p>
			</div>
			<div>
				<h5>Must Not Have:</h5>
				<p><?= nl2br($record['not_haves']) ?></p>
			</div>																								
			<div>
				<h5>Criteria:</h5>
				<p><?= $record['criteria'] ?></p>
			</div>
			<div>
				<h5>Deliverables:</h5>
				<p><?= nl2br($record['deliverables']) ?></p>
			</div>
			<div>
				<h5>Award:</h5>
				<p><?= $record['award'] ?></p>
			</div>						
		</p>
		<div>
			<h1>Comments:</h1>
			<?php if (!empty($comments)): ?>
			<?php foreach($comments as $comment): ?>
            	<hr/>	
            	<p>Alias <?= $alias ?> Commented at: <?= $comment['last_modified_time'] ?></p>
            	<p><?= nl2br($comment['text']) ?><p> 
        	<?php endforeach; ?>
			<?php endif; ?>
				<hr/>
		</div>
		<div>
			<h2>Add Comment:</h2>
			<form action="/competitions/comment" method="post" accept-charset="utf-8">
				<textarea cols="100" rows="10" name="comment"></textarea>
				<input type="hidden" name="competition_id" value="<?= $record['id'] ?>">
				<div><input type="submit" value="Add Comment" /></div>
			</form>
		</div>
		