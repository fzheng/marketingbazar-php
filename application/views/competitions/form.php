
<link rel="stylesheet" type="text/css" href="/www/css/jquery-ui-1.9.2.custom.css">
<link rel="stylesheet" type="text/css" href="/www/css/jquery-ui-timepicker-addon.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="/www/js/jquery-ui-timepicker-addon.js"></script>

<h1>Competition Form</h1>

<?php if(isset($validation_error) && $validation_error === TRUE) echo validation_errors(); ?>

<?php if($action === 'update'): ?>
<form action="/competitions/update" method="post" accept-charset="utf-8">
<?php elseif($action === 'create'): ?>
<form action="/competitions/create" method="post" accept-charset="utf-8">
<?php endif; ?>

<h5>Name</h5>
<input type="text" name="name" value="<?= isset($name) ? $name : set_value('name'); ?>" size="50" />

<h5>Description</h5>
<input type="text" name="description" value="<?= isset($description) ? $description : set_value('description'); ?>" size="150" />

<h5>Problem Statement</h5>
<textarea cols="40" rows="5" name="statement">
<?= isset($statement) ? $statement : set_value('statement'); ?>
</textarea>

<h5>Project Type</h5>
<select name="project_type">
<?php if (isset($project_type)): ?>
<option value="Targeting"  <?= $project_type === 'Targeting' ? 'selected="selected"' : '' ?>>Targeting</option>
<option value="Engagement" <?= $project_type === 'Engagement' ? 'selected="selected"' : '' ?>>Engagement</option>
<option value="Alignment" <?= $project_type === 'Alignment' ? 'selected="selected"' : '' ?>>Alignment</option>
<option value="Automation" <?= $project_type === 'Automation' ? 'selected="selected"' : '' ?>>Automation</option>
<option value="Analytics" <?= $project_type === 'Analytics' ? 'selected="selected"' : '' ?>>Analytics</option>
<?php else: ?>
<option value="Targeting"  <?= set_select('project_type', 'Targeting'); ?>>Targeting</option>
<option value="Engagement" <?= set_select('project_type', 'Engagement'); ?>>Engagement</option>
<option value="Alignment" <?= set_select('project_type', 'Alignment'); ?>>Alignment</option>
<option value="Automation" <?= set_select('project_type', 'Automation'); ?>>Automation</option>
<option value="Analytics" <?= set_select('project_type', 'Analytics'); ?>>Analytics</option>
<?php endif; ?>
</select>

<h5>Project Scope</h5>
<textarea cols="40" rows="5" name="scope">
<?= isset($scope) ? $scope : set_value('scope'); ?>
</textarea>

<h5>Platform</h5>
<input type="text" name="platform" value="<?= isset($platform) ? $platform : set_value('platform'); ?>" size="50" />

<h5>Design Considerations</h5>
<div>
<p>Must Have:</p>
<textarea cols="40" rows="5" name="must_haves">
<?= isset($must_haves) ? $must_haves : set_value('must_haves'); ?>
</textarea>
</div>
<div>
<p>Nice to Have:</p>
<textarea cols="40" rows="5" name="nice_haves">
<?= isset($nice_haves) ? $nice_haves : set_value('nice_haves'); ?>
</textarea>
</div>
<div>
<p>Must Not Have:</p>
<textarea cols="40" rows="5" name="not_haves">
<?= isset($not_haves) ? $not_haves : set_value('not_haves'); ?>
</textarea>
</div>

<h5>Criteria</h5>
<select name="criteria">
<?php if(isset($criteria)): ?>
<option value="Qualitative" <?= $criteria === 'Qualitative' ? 'selected="selected"' : '' ?>>Qualitative</option>
<option value="Quantitative" <?= $criteria === 'Quantitative' ? 'selected="selected"' : '' ?>>Quantitative</option>
<?php else: ?>
<option value="Qualitative" <?= set_select('criteria', 'Qualitative'); ?>>Qualitative</option>
<option value="Quantitative" <?= set_select('criteria', 'Quantitative'); ?>>Quantitative</option>
<?php endif; ?>
</select>

<h5>Deliverables</h5>
<textarea cols="40" rows="5" name="deliverables">
<?= isset($deliverables) ? $deliverables : set_value('deliverables'); ?>
</textarea>

<h5>Begin Time</h5>
<input id="begin_at" type="text" name="begin_at" value="<?= isset($begin_at) ? $begin_at : set_value('begin_at'); ?>" size="20" />

<h5>End Time</h5>
<input id="end_at" type="text" name="end_at" value="<?= isset($end_at) ? $end_at : set_value('end_at'); ?>" size="20" />

<h5>Award</h5>
<input type="text" name="award" value="<?= isset($award) ? $award : set_value('award'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

<?php if($action === 'update'): ?>
<input type="hidden" name="id" value="<?= isset($id) ? $id : set_value('id'); ?>" />
<?php endif; ?>
</form>

<script>
$(function() {
	function roundMinutes(date) {

	    date.setHours(date.getHours() + 1);
	    date.setMinutes(0);
		date.setSeconds(0);
	    return date;
	}
	
	var config = {
			"dateTimePicker": {
	        	dateFormat: "yy-mm-dd",
	           	minDate: roundMinutes(new Date()),
	           	timeFormat: "H:mm:ss",
	           	stepHour: 1,
	        	showMinute: false,
	        	showSecond: false
	        }
		};
		$('#begin_at').datetimepicker(config.dateTimePicker);
		$('#end_at').datetimepicker(config.dateTimePicker);
});
</script>
