<html>
<head>
<title>Competition Form</title>
</head>
<body>
<h1>Create A Competition</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('competitions/create'); ?>

<h5>Name</h5>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" size="50" />

<h5>Description</h5>
<input type="text" name="description" value="<?php echo set_value('description'); ?>" size="150" />

<h5>Problem Statement</h5>
<textarea cols="40" rows="5" name="statement">
<?php echo set_value('statement'); ?>
</textarea>

<h5>Project Type</h5>
<select name="project_type">
<option value="Targeting"  <?php echo set_select('project_type', 'Targeting'); ?>>Targeting</option>
<option value="Engagement" <?php echo set_select('project_type', 'Engagement'); ?>>Engagement</option>
<option value="Alignment" <?php echo set_select('project_type', 'Alignment'); ?>>Alignment</option>
<option value="Automation" <?php echo set_select('project_type', 'Automation'); ?>>Automation</option>
<option value="Analytics" <?php echo set_select('project_type', 'Analytics'); ?>>Analytics</option>
</select>

<h5>Project Scope</h5>
<textarea cols="40" rows="5" name="scope">
<?php echo set_value('scope'); ?>
</textarea>

<h5>Platform</h5>
<input type="text" name="platform" value="<?php echo set_value('platform'); ?>" size="50" />

<h5>Design Considerations</h5>
<div>
<p>Must Have:</p>
<textarea cols="40" rows="5" name="must_haves">
<?php echo set_value('must_haves'); ?>
</textarea>
</div>
<div>
<p>Nice to Have:</p>
<textarea cols="40" rows="5" name="nice_haves">
<?php echo set_value('nice_haves'); ?>
</textarea>
</div>
<div>
<p>Must Not Have:</p>
<textarea cols="40" rows="5" name="not_haves">
<?php echo set_value('not_haves'); ?>
</textarea>
</div>

<h5>Criteria</h5>
<select name="criteria">
<option value="Qualitative" <?php echo set_select('criteria', 'Qualitative'); ?>>Qualitative</option>
<option value="Quantitative" <?php echo set_select('criteria', 'Quantitative'); ?>>Quantitative</option>
</select>

<h5>Deliverables</h5>
<textarea cols="40" rows="5" name="deliverables">
<?php echo set_value('deliverables'); ?>
</textarea>

<h5>Begin Time</h5>
<input type="text" name="begin_at" value="<?php echo set_value('begin_at'); ?>" size="50" />

<h5>End Time</h5>
<input type="text" name="end_at" value="<?php echo set_value('end_at'); ?>" size="50" />

<h5>Award</h5>
<input type="text" name="award" value="<?php echo set_value('award'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

<?php echo form_close(); ?>

</body>
</html>
