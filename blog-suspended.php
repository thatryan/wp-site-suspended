<?php
/*
Plugin Name: Suspended Site
Plugin URI: http://sequoiaims.com
Description: Custom page and styles for suspended site page
Author: Ryan Olson
Author URI: http://thatryan.com
Version: 1.0.0
*/

// Return header to remove from search engines
status_header(410);

// Output the header for the suspended page
function suspended_page_header( ) {

// Don't index any of this
add_action( 'login_head', 'wp_no_robots' );

// Create the head markup
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php bloginfo('name'); ?> &rarr; Website Suspended</title>

	<?php
	// Include the standard styling for the login page
	// to maintain some consistency
	wp_admin_css( 'login', true );

	// Enqueue scripts and styles for the login page
	do_action( 'login_enqueue_scripts' );

	/**
	 * Fires in the login page header after scripts are enqueued.
	 */
	do_action( 'login_head' );

	// Get the current site infos
	$login_header_url   = network_home_url();
	$login_header_title = get_current_site()->site_name; ?>

	<style type="text/css" media="screen">
		.suspended-message {
		    margin-top: 20px;
		    margin-left: 0;
		    padding: 14px;
		    text-align: center;
		    background: #fff;
		    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
		    box-shadow: 0 1px 3px rgba(0,0,0,.13);
		}
		.suspended-message h2 {
			line-height: 1.25;
		}
	</style>
</head>
<body class="login suspended-site">
	<div id="login">
		<h1>
			<a href="<?php echo esc_url( $login_header_url ); ?>" title="<?php echo esc_attr( $login_header_title ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a>
		</h1>
	</div>
	<?php
}
// End suspended_page_header()

// Output the footer for the suspended page
function suspended_page_footer() {

	// Fire the login_footer action to allow any other custom scripts/styles
	do_action( 'login_footer' ); ?>
</body>
</html>
<?php
}

// Create the content of the page
nocache_headers();
header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
suspended_page_header(); ?>

<div class="suspended-message">
	<h2>Website is currently unavailable.</h2>
</div>

<?php
suspended_page_footer();
