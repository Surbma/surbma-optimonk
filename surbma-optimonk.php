<?php

/*
Plugin Name: Surbma | OptiMonk
Plugin URI: https://surbma.com/wordpress-plugins/
Description: OptiMonk for WordPress

Version: 2.1

Author: Surbma
Author URI: https://surbma.com/

License: GPLv2

Text Domain: surbma-optimonk
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) {
	die( 'Good try! :)' );
}

define( 'SURBMA_OPTIMONK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SURBMA_OPTIMONK_PLUGIN_URL', plugins_url( '', __FILE__ ) );

// Localization
function surbma_optimonk_init() {
	load_plugin_textdomain( 'surbma-optimonk', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'surbma_optimonk_init' );

// Include files
if ( is_admin() ) {
	include_once( SURBMA_OPTIMONK_PLUGIN_DIR . '/lib/admin.php' );
}

// Insert the OptiMonk code
function surbma_optimonk_code() {
	$options = get_option( 'surbma_optimonk_settings_fields' );
	if ( !is_user_logged_in() && isset( $options['id'] ) && $options['id'] != '' ) {
?>
<script type="text/javascript">
	(function(d, a) {
		var h = d.getElementsByTagName("head")[0], p = d.location.protocol, s;
		s = d.createElement("script");
		s.type = "text/javascript";
		s.charset = "utf-8";
		s.async = true;
		s.defer = true;
		s.src = p + "//front.optimonk.com/public/" + a + "/js/preload.js";
		h.appendChild(s);
	})(document, '<?php echo $options['id']; ?>');
</script>
<?php }
}
add_action( 'wp_head', 'surbma_optimonk_code' );

