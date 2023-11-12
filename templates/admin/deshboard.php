<div class="wrap fbs-cart-admin">
	<h1>Fbs Cart Table</h1>

	<?php settings_errors() ?>

	<ul class="fbs-ct-tabs">
		<li class="fbs-tab active" data-tab="tab-1">Table Columns</li>
		<li class="fbs-tab" data-tab="tab-2">Table Design</li>
		<li class="fbs-tab" data-tab="tab-3">Others</li>
	</ul>
	<form action="options.php" method="post" id="fbs-ct-settings-form" accept-charset="utf-8">
		<div class="fbs-tab-content first active" id="tab-1">
			<?php
			settings_fields('fbs_ct_settings');
			do_settings_sections('fbs_ct_cols');
			?>
		</div>
		<div class="fbs-tab-content" id="tab-2">
			<?php do_settings_sections('fbs_ct_design'); ?>
		</div>
		<div class="fbs-tab-content" id="tab-3">
			<?php do_settings_sections('fbs_ct_others'); ?>
		</div>
		<div class="fbs-submit">
			<?php
			submit_button('Save', 'primary fbs-scroll-button', 'submit', false);
			submit_button();
			?>
		</div>
	</form>

</div>