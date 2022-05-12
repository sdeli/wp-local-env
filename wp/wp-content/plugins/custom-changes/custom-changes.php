<?php
/**
 * @package custom-changes
 * @version 5.9.3
 */
/*
Plugin Name: custom-changes
*/
define( 'CUSTOM_CHANGES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// require_once(CUSTOM_CHANGES_PLUGIN_DIR . 'apply-filters-test.php');
require_once(CUSTOM_CHANGES_PLUGIN_DIR . 'change-welcome-message.php');
require_once(CUSTOM_CHANGES_PLUGIN_DIR . 'wp-admin-page-example.php');
require_once(CUSTOM_CHANGES_PLUGIN_DIR . 'my-admin-page.php');
// require_once(CUSTOM_CHANGES_PLUGIN_DIR . 'create-custom-data.php');