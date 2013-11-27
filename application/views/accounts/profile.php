
<h1>Your Profile Information</h1>

<?php if(isset($validation_error) && $validation_error === TRUE) echo validation_errors(); ?>

<form action="/accounts/profile" method="post" accept-charset="utf-8">
<h2>Contact Information</h2>

<h5>First Name</h5>
<input type="text" name="first_name" value="<?= isset($first_name) ? $first_name : set_value('first_name'); ?>" size="50" />

<h5>Last Name</h5>
<input type="text" name="last_name" value="<?= isset($last_name) ? $last_name : set_value('last_name'); ?>" size="50" />

<h5>City</h5>
<input type="text" name="city" value="<?= isset($city) ? $city : set_value('city'); ?>" size="50" />

<h5>State/Province</h5>
<input type="text" name="state_province" value="<?= isset($state_province) ? $state_province : set_value('state_province'); ?>" size="50" />

<h5>Country</h5>
<input type="text" name="country" value="<?= isset($country) ? $country : set_value('country'); ?>" size="50" />

<h5>Postal Code</h5>
<input type="text" name="postal_code" value="<?= isset($postal_code) ? $postal_code : set_value('postal_code'); ?>" size="50" />

<h5>Phone Number</h5>
<input type="text" name="phone" value="<?= isset($phone) ? $phone : set_value('phone'); ?>" size="50" />

<h5>Email</h5>
<input type="text" name="email" value="<?= isset($email) ? $email : set_value('email'); ?>" size="50" />

<h5>Website</h5>
<input type="text" name="website" value="<?= isset($website) ? $website : set_value('website'); ?>" size="50" />

<h2>Profile</h2>

<h5>Background</h5>
<textarea cols="40" rows="5" name="background">
<?= isset($background) ? $background : set_value('background'); ?>
</textarea>

<h5>Education</h5>
<textarea cols="40" rows="5" name="education">
<?= isset($education) ? $education : set_value('education'); ?>
</textarea>

<h5>Experience</h5>
<textarea cols="40" rows="5" name="experience">
<?= isset($experience) ? $experience : set_value('experience'); ?>
</textarea>

<h5>Skills and Expertise</h5>
<textarea cols="40" rows="5" name="skills">
<?= isset($skills) ? $skills : set_value('skills'); ?>
</textarea>

<h5>Facebook</h5>
<input type="text" name="facebook" value="<?= isset($facebook) ? $facebook : set_value('facebook'); ?>" size="50" />

<h5>LinkedIn</h5>
<input type="text" name="linkedin" value="<?= isset($linkedin) ? $linkedin : set_value('linkedin'); ?>" size="50" />

<h5>Twitter</h5>
<input type="text" name="twitter" value="<?= isset($twitter) ? $twitter : set_value('twitter'); ?>" size="50" />

<h2>Communication Preferences</h2>

<h5>New Competition Notifications</h5>
<select name="notifications">
<?php if(isset($notifications)): ?>
<option value="email" <?= $notifications === 'email' ? 'selected="selected"' : '' ?>>Email</option>
<option value="sms" <?= $notifications === 'sms' ? 'selected="selected"' : '' ?>>Text Message (SMS)</option>
<?php else: ?>
<option value="email"  <?= set_select('competition_notification', 'email'); ?>>Email</option>
<option value="sms" <?= set_select('competition_notification', 'sms'); ?>>Text Message (SMS)</option>
<?php endif; ?>
</select>

<input type="hidden" name="id" value="<?= isset($id) ? $id : set_value('id'); ?>" />
<input type="hidden" name="profile_form" value="1" />
<div><input type="submit" value="Submit" /></div>

</form>
