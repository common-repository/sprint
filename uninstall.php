<?php
/**
 * @package sprint
 */
if (!defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
} 
function erp_sprint_remove_database() { 
	global $wpdb;
	$table_name = $wpdb->prefix . 'logixgridsetting';
	$sql = "DROP TABLE IF EXISTS $table_name";
	$wpdb->query($sql);
	delete_option("my_plugin_db_version");
}
register_deactivation_hook( __FILE__, 'erp_sprint_remove_database' );