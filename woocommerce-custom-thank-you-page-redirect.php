<?php 

//it will be rather simple to make redirection by creating a new plugin or opening the file functions.php that you can find in wp-content/themes/your-theme-name/ and enter the following code to the end of the file:

add_action( 'template_redirect', 'woo_custom_redirect_after_purchase' );
function woo_custom_redirect_after_purchase() {
	global $wp;
	if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {
		wp_redirect( 'http://localhost:8888/woocommerce/custom-thank-you/' );
		exit;
	}
}
?>
