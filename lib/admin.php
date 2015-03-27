<?php

include_once( SURBMA_OPTIMONK_PLUGIN_DIR . '/pages/settings-page.php');

/* Admin options menu */
function surbma_optimonk_add_menus() {
	add_options_page( __( 'OptiMonk Settings', 'surbma-optimonk' ), __( 'OptiMonk Settings', 'surbma-optimonk' ), 'manage_options', 'surbma-optimonk-settings', 'surbma_optimonk_settings_page' );
}
add_action( 'admin_menu', 'surbma_optimonk_add_menus' );

