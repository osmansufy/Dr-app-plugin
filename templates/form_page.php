<?php



/**
 * include post submit CLass
 */

require_once(plugin_dir_path(__DIR__).'/inc/ClassForm.php');

$postSubmit= new FormPost();

$postSubmit->post_submit();

?>

<!-- Form start -->

<div class="container">
    <div class="row"><h1>Fillup Patient details</h1></div>
</div>

<div class="wpcf7">
		<form id="new_post" name="new_post" method="post" action="" class="wpcf7-form" enctype="multipart/form-data">
			<!-- post name -->
			<fieldset name="name">
				<label for="title">Patient Name:</label>
				<input type="text" id="title" value="" tabindex="5" name="title" />
			</fieldset>
			<fieldset name="">
				<label for="title">Patient Email:</label>
				<input type="text"  value="" tabindex="5" name="f_email" />
			</fieldset>
			<fieldset name="">
				<label for="title">Patient Phone:</label>
				<input type="text"  value="" tabindex="5" name="f_phone" />
			</fieldset>
			<fieldset name="">
				<label for="title">Patient date:</label>
				<input type="text"  value="" tabindex="5" name="f_date" />
			</fieldset>
			<fieldset name="">
				<label for="title">Patient address:</label>
				<input type="text"  value="" tabindex="5" name="f_address" />
			</fieldset>

			<!-- pt Doctor -->
			<fieldset class="category">
				<label for="cat">Doctors:</label>
				<?php wp_dropdown_categories( 'tab_index=10&taxonomy=doctors&hide_empty=0' ); ?>
			
			</fieldset>
            
			<!-- pt diseases -->
			<fieldset class="tags">
				<label for="post_tags">Patient Diseases (comma separated):</label>
				<input type="text" value="" tabindex="35" name="pt_disease" id="post_tags" />
			</fieldset>

			<fieldset class="submit">
				<input type="submit" value="Booking" tabindex="40" id="submit" name="submit" />
			</fieldset>

			<input type="hidden" name="action" value="new_post" />
			<?php wp_nonce_field( 'new-post' ); ?>
		</form>
		</div> <!-- END CF7 -->

<?php
