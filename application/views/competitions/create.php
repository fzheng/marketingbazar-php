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

<h5>Begin Time</h5>
<input type="text" name="begin_at" value="<?php echo set_value('begin_at'); ?>" size="50" />

<h5>End Time</h5>
<input type="text" name="end_at" value="<?php echo set_value('end_at'); ?>" size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
