<?php

function surbma_optimonk_settings_page() {
?>
<style type="text/css">
	.clearline{border-top:1px solid #ccc;clear:both;margin:10px 0;}
	.section-block{background:#fdfdfd;padding:20px;border:1px solid #ccc;border-radius: 3px;}
	.section-block h3{margin:0 0 20px;}
</style>
	<div class="wrap">
		<img alt="OptiMonk" src="<?php echo SURBMA_OPTIMONK_PLUGIN_URL . '/images/logo.png'; ?>" />

		<div class="section-block">
			<form method="post" action="options.php">
				<?php settings_fields( 'surbma_optimonk_settings_options' ); ?>
				<?php do_settings_sections( 'surbma-optimonk-settings' ); ?>

				<p><input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
			</form>
		</div>

		<div class="clearline"></div>

		<div class="section-block">
			<h3><?php _e( 'OptiMonk Help', 'surbma-optimonk' ); ?></h3>
			<ul>
				<li><a href="<?php echo esc_url( __( 'https://www.optimonk.com/', 'surbma-optimonk' ) ); ?>" target="_blank"><?php _e( 'Official OptiMonk Webpage', 'surbma-optimonk' ); ?> →</a></li>
				<li><a href="<?php echo esc_url( __( 'http://support.optimonk.com/hc/en-us', 'surbma-optimonk' ) ); ?>" target="_blank"><?php _e( 'Official OptiMonk Help Page', 'surbma-optimonk' ); ?> →</a></li>
			</ul>
		</div>
	</div>
<?php
}

function surbma_optimonk_settings_init() {
	register_setting( 'surbma_optimonk_settings_options', 'surbma_optimonk_settings_fields', 'surbma_optimonk_settings_validate' );
	add_settings_section( 'surbma_optimonk_settings', __( 'OptiMonk Settings', 'surbma-optimonk' ), 'surbma_optimonk_settings_section_text', 'surbma-optimonk-settings' );
	add_settings_field( 'surbma_optimonk_id', __( 'OptiMonk document ID', 'surbma-optimonk' ), 'surbma_optimonk_id_string', 'surbma-optimonk-settings', 'surbma_optimonk_settings' );
}
add_action( 'admin_init', 'surbma_optimonk_settings_init', 50 );

function surbma_optimonk_settings_section_text() {
	echo '<p><strong>' . __( 'Warning!', 'surbma-optimonk' ) . '</strong> ' . __( 'You only need to add the document ID! You can find it at the end of your integration code, in the document line.', 'surbma-optimonk' ) . '</p><p>' . __( 'Here is an example script from your OptiMonk admin dashboard page. You can see the highlighted part, this is the ID, that you need to add here on the field below.', 'surbma-optimonk' ) . '</p><img src="' . SURBMA_OPTIMONK_PLUGIN_URL . '/images/optimonk-script.jpg" alt="OptiMonk Script">';
}

function surbma_optimonk_id_string() {
	$options = get_option('surbma_optimonk_settings_fields');
	echo "<input id='surbma_optimonk_settings_fields[id]' name='surbma_optimonk_settings_fields[id]' type='text' value='{$options['id']}' placeholder='1234' maxlength='14' size='14' />";
}

function surbma_optimonk_settings_validate( $input ) {
	// Our text option must be safe text with no HTML tags
	$input['id'] = wp_filter_nohtml_kses( $input['id'] );
	return $input;
}

