<?php
/**
 * Astra Sites Uninstall
 *
 * @package Astra Sites
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$site_pages = get_option( 'astra-sites-requests' );
if ( ! empty( $site_pages ) ) {

	// Delete all sites.
	for ( $site_page = 1; $site_page <= $site_pages; $site_page++ ) {
		delete_site_option( 'astra-sites-and-pages-page-' . $site_page );
	}

	// Delete all pages count.
	delete_site_option( 'astra-sites-requests' );
}

delete_option( 'astra_sites_recent_import_log_file' );
delete_option( 'astra_sites_import_data' );
delete_option( 'astra_sites_wpforms_ids_mapping' );
delete_option( '_astra_sites_old_customizer_data' );
delete_option( '_astra_sites_old_site_options' );
delete_option( '_astra_sites_old_widgets_data' );
delete_option( 'astra_sites_settings' );
delete_option( 'astra_parent_page_url' );
delete_option( 'astra-sites-favorites' );
delete_site_option( 'astra-sites-tags' );
delete_site_option( 'astra-sites-fresh-site' );
delete_site_option( 'astra-sites-batch-status' );
delete_site_option( 'astra-sites-batch-status-string' );
