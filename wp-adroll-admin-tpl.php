<h2>AdRoll Plugin for WordPress</h2>

<div>
<p>Please enter your unique AdRoll ID numbers below.</p>

<p>NOTE: Your unique AdRoll IDs will be found in your AdRoll account, under “Manage” → “Retargeting Pixel”</p>
</div>

<form action="options.php" method="POST">
	
	<?php settings_fields('adrl_setting') ?>
	<?php do_settings_sections( 'wp_adroll' ) ?>
	
	<input type="submit" value="Update AdRoll Settings" />
</form>