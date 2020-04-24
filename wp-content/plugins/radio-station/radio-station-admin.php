<?php
/*
 *Plugin Admin Functions
 * @Since: 2.2.7
 */

// === Admin Setup ===
// - Enqueue Admin Scripts
// - Admin Style Fixes
// === Admin Menu ===
// - Setting Page Capability Check
// - Add Admin Menu and Submenu Items
// - Fix to Expand Main Menu for Submenu Items
// - Taxonomy Submenu Item Fix
// - Display Import/Export Show Page
// - Display Plugin Help Page
// - Parse Markdown Doc File
// x Display Playlist Export Page
// === Update Notices ===
// - Get Plugin Upgrade Notice
// - Parse Plugin Update Notice
// - Plugin Page Update Message
// - Display Admin Update Notice
// - Display Plugin Notice
// - Get Plugin Notices
// - AJAX Mark Notice Read
// === Admin Notices ===
// - Plugin Settings Page Top
// - Plugin Settings Page Bottom
// - Plugin Takeover Announcement Notice
// - Plugin Takeover Announcement Content
// - Dismiss Plugin Takeover Announcement
// - Show Shift Conflict Notice
// - MailChimp Subscriber Form
// - AJAX Record Subcriber
// - AJAX Clear Subcriber


// -------------------
// === Admin Setup ===
// -------------------

// ---------------------
// Enqueue Admin Scripts
// ---------------------
// 2.2.7: removed from frontend as datepicker is only used on the backend
add_action( 'admin_enqueue_scripts', 'radio_station_enqueue_admin_scripts' );
function radio_station_enqueue_admin_scripts() {

	// --- enqueue admin js file ---
	$script = radio_station_get_template( 'both', 'radio-station-admin.js', 'js' );
	$version = filemtime( $script['file'] );
	$deps = array( 'jquery' );
	wp_enqueue_script( 'radio-station-admin', $script['url'], $deps, $version, true );

	// --- enqueue admin styles ---
	radio_station_enqueue_style( 'admin' );

}

// ------------------
// Enqueue Datepicker
// ------------------
// 2.3.0: enqueued separately by override post type only
function radio_station_enqueue_datepicker() {

	// --- enqueue jquery datepicker ---
	wp_enqueue_script( 'jquery-ui-datepicker' );

	// --- enqueue jquery datepicker styles ---
	// 2.3.0: update theme styles from 1.8.2 to 1.12.1
	// 2.3.0: use local datepicker styles instead of via Google
	// $protocol = 'http';
	// if ( is_ssl() ) {$protocol .= 's';}
	// $url = $protocol . '://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css';
	// wp_enqueue_style( 'jquery-ui-style', $url, array(), '1.12.1' );
	$style = radio_station_get_template( 'both', 'jquery-ui.css', 'css' );
	wp_enqueue_style( 'jquery-ui-smoothness', $style['url'], array(), '1.12.1', 'all' );

}


// -----------------
// Admin Style Fixes
// -----------------
add_action( 'admin_print_styles', 'radio_station_admin_styles' );
function radio_station_admin_styles() {

	// --- hide first admin submenu item to prevent duplicate of main menu item ---
	echo '<style>#toplevel_page_radio-station .wp-first-item {display: none;}' . "\n";

	// --- reduce the height of the playlist editor area ---
	// 2.3.0: also reduce height of override editor area
	// 2.3.0: change isset to is_object and property exists check
	global $post;
	if ( is_object( $post ) && property_exists( $post, 'post_type' ) ) {
		if ( ( RADIO_STATION_PLAYLIST_SLUG === $post->post_type )
		  || ( RADIO_STATION_OVERRIDE_SLUG === $post->post_type ) ) {
			echo '.wp-editor-container textarea.wp-editor-area {height: 100px;}' . "\n";
		}
	}

	echo '</style>';

}


// ------------------
// === Admin Menu ===
// ------------------

// ------------------------------
// Settings Page Capability Check
// ------------------------------
// (recheck permissions for main menu item click)
add_action( 'admin_init', 'radio_station_settings_cap_check' );
function radio_station_settings_cap_check() {
	if ( isset( $_REQUEST['page'] ) && ( 'radio-station' == $_REQUEST['page'] ) ) {
		$settingscap = apply_filters( 'radio_station_settings_capability', 'manage_options' );
		if ( !current_user_can( $settingscap ) ) {
			wp_die( esc_html( __( 'You do not have permissions to access that page.', 'radio-station' ) ) );
		}
	}
}

// --------------------------------
// Add Admin Menu and Submenu Items
// --------------------------------
add_action( 'admin_menu', 'radio_station_add_admin_menus' );
function radio_station_add_admin_menus() {

	$icon = plugins_url( 'images/radio-station-icon.png', RADIO_STATION_FILE );
	$position = apply_filters( 'radio_station_menu_position', 5 );
	$settingscap = apply_filters( 'radio_station_manage_options_capability', 'manage_options' );
	$rs = __( 'Radio Station', 'radio-station' );

	// ---- main menu item ----
	// 2.3.0: set to new plugin admin page (via plugin loader class)
	// (added with publish_playlists capability so that other submenu items remain accessible)
	add_menu_page( $rs . ' ' . __( 'Settings', 'radio-station' ), $rs, 'publish_playlists', 'radio-station', 'radio_station_settings_page', $icon, $position );

	// --- settings submenu item ---
	// 2.3.0: added for ease of access to plugin settings
	add_options_page( $rs . ' ' . __( 'Settings', 'radio-station' ), $rs, $settingscap, 'radio-station', 'radio_station_settings_page' );

	// --- submenu items ---
	// 2.3.0: prefix plugin name on page titles (but not menu items)
	// 2.3.0: remove add playlist and add override to reduce clutter
	// 2.3.0: added actions for adding of other plugin submenu items in position
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Shows', 'radio-station' ), __( 'Shows', 'radio-station' ), 'edit_shows', 'shows' );
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Add Show', 'radio-station' ), __( 'Add Show', 'radio-station' ), 'publish_shows', 'add-show' );
	do_action( 'radio_station_admin_submenu_top' );
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Playlists', 'radio-station' ), __( 'Playlists', 'radio-station' ), 'edit_playlists', 'playlists' );
	// add_submenu_page( 'radio-station', $rs . ' ' .  __( 'Add Playlist', 'radio-station' ), __( 'Add Playlist', 'radio-station' ), 'publish_playlists', 'add-playlist' );
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Genres', 'radio-station' ), __( 'Genres', 'radio-station' ), 'publish_playlists', 'genres' );
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Schedule Overrides', 'radio-station' ), __( 'Schedule Overrides', 'radio-station' ), 'edit_shows', 'schedule-overrides' );
	// add_submenu_page( 'radio-station', $rs . ' ' .  __( 'Add Override', 'radio-station' ), __( 'Add Override', 'radio-station' ), 'publish_shows', 'add-override' );
	do_action( 'radio_station_admin_submenu_middle' );
	// add_submenu_page( 'radio-station', $rs . ' ' . __( 'Hosts', 'radio-station' ), __( 'Hosts', 'radio-station' ), 'edit_hosts', 'hosts' );
	// add_submenu_page( 'radio-station', $rs . ' ' . __( 'Producers', 'radio-station' ), __( 'Producers', 'radio-station' ), 'edit_producers', 'producers' );
	// add_submenu_page( 'radio-station', $rs . ' ' . __( 'Export Playlists', 'radio-station' ), __( 'Export Playlists', 'radio-station' ), $settingscap, 'playlist-export', 'radio_station_playlist_export_page' );

	// --- import / export feature ---
	if ( file_exists( RADIO_STATION_DIR . '/includes/import-export.php' ) ) {
		add_submenu_page( 'radio-station', 	$rs . ' ' . __( 'Import/Export Show Data', 'radio-station' ), __( 'Import/Export', 'radio-station' ), 'manage_options', 'import-export-shows', 'radio_station_import_export_show_page' );
	}
	
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Settings', 'radio-station' ), __( 'Settings', 'radio-station' ), $settingscap, 'radio-station', 'radio_station_settings_page' );	
	// 2.3.0: rename Help page to Documentation
	add_submenu_page( 'radio-station', $rs . ' ' . __( 'Documentation', 'radio-station' ), __( 'Help', 'radio-station' ), 'publish_playlists', 'radio-station-docs', 'radio_station_plugin_docs_page' );
	
	do_action( 'radio_station_admin_submenu_bottom' );

	// --- hack the submenu global to add post type add/edit URLs ---
	global $submenu;
	foreach ( $submenu as $i => $menu ) {
		if ( 'radio-station' === $i ) {
			foreach ( $menu as $j => $item ) {
				switch ( $item[2] ) {
					case 'add-show':
						// 2.3.0: removed capability check as menu cap is already publish_shows
						$submenu[$i][$j][2] = 'post-new.php?post_type=' . RADIO_STATION_SHOW_SLUG;
						break;
					case 'shows':
						$submenu[$i][$j][2] = 'edit.php?post_type=' . RADIO_STATION_SHOW_SLUG;
						break;
					case 'episodes':
						if ( defined( 'RADIO_STATION_EPISODE_SLUG' ) ) {
							$submenu[$i][$j][2] = 'edit.php?post_type=' . RADIO_STATION_EPISODE_SLUG;
						}
						break;
					case 'playlists':
						$submenu[$i][$j][2] = 'edit.php?post_type=' . RADIO_STATION_PLAYLIST_SLUG;
						break;
					case 'add-playlist':
						$submenu[$i][$j][2] = 'post-new.php?post_type=' . RADIO_STATION_PLAYLIST_SLUG;
						break;
					case 'genres':
						$submenu[$i][$j][2] = 'edit-tags.php?taxonomy=' . RADIO_STATION_GENRES_SLUG;
						break;
					case 'schedule-overrides':
						$submenu[$i][$j][2] = 'edit.php?post_type=' . RADIO_STATION_OVERRIDE_SLUG;
						break;
					case 'add-override':
						$submenu[$i][$j][2] = 'post-new.php?post_type=' . RADIO_STATION_OVERRIDE_SLUG;
						break;
					// case 'hosts':
					//	$submenu[$i][$j][2] = 'post-new.php?post_type=' . RADIO_STATION_HOST_SLUG;
					//	break;
					// case 'producers':
					//	$submenu[$i][$j][2] = 'post-new.php?post_type=' . RADIO_STATION_PRODUCER_SLUG;
					//	break;
				}
			}
		}
	}
}

// -----------------------------------------
// Fix to Expand Main Menu for Submenu Items
// -----------------------------------------
// 2.2.2: added fix for genre taxonomy page and post type editing
// 2.2.8: remove strict in_array checking
add_filter( 'parent_file', 'radio_station_fix_genre_parent', 11 );
function radio_station_fix_genre_parent( $parent_file = '' ) {
	global $pagenow, $post;
	$post_types = array( RADIO_STATION_SHOW_SLUG, RADIO_STATION_PLAYLIST_SLUG, RADIO_STATION_OVERRIDE_SLUG );
	$taxonomies = array( RADIO_STATION_GENRES_SLUG, RADIO_STATION_LANGUAGES_SLUG );
	if ( ( 'edit-tags.php' === $pagenow ) && isset( $_GET['taxonomy'] ) && in_array( $_GET['taxonomy'], $taxonomies ) ) {
		// 2.3.0: also apply to language taxonomy
		$parent_file = 'radio-station';
	} elseif ( ( 'post.php' === $pagenow ) && in_array( $post->post_type, $post_types ) ) {
		$parent_file = 'radio-station';
	}

	return $parent_file;
}

// -------------------------
// Taxonomy Submenu Item Fix
// -------------------------
// 2.2.2: so genre submenu item link is set to current (bold)
// 2.3.0: change action to admin_enqueue_scripts
add_action( 'admin_enqueue_scripts', 'radio_station_taxonomy_submenu_fix', 11 );
function radio_station_taxonomy_submenu_fix() {

	global $pagenow;
	if ( ( 'edit-tags.php' == $pagenow ) && isset( $_GET['taxonomy'] ) ) {

		$js = '';
		if ( RADIO_STATION_GENRES_SLUG == $_GET['taxonomy'] ) {
			$js = "jQuery('#toplevel_page_radio-station ul li').each(function() {
	    		if (jQuery(this).find('a').attr('href') == 'edit-tags.php?taxonomy=" . RADIO_STATION_GENRES_SLUG . "') {
		    		jQuery(this).addClass('current').find('a').addClass('current').attr('aria-current', 'page');
			    }
		    });";
		}

		// 2.3.0: add fix for language taxonomy also
		if ( RADIO_STATION_LANGUAGES_SLUG == $_GET['taxonomy'] ) {
			$js = "jQuery('#toplevel_page_radio-station ul li').each(function() {
	    		if (jQuery(this).find('a').attr('href') == 'edit-tags.php?taxonomy=" . RADIO_STATION_LANGUAGES_SLUG . "') {
		    		jQuery(this).addClass('current').find('a').addClass('current').attr('aria-current', 'page');
			    }
		    });";
		}

		// --- enqueue script inline ---
		// 2.3.0: enqueue instead of echoing
		if ( '' != $js ) {
			wp_add_inline_script( 'radio-station-admin', $js );
		}
	}
}

// --------------------
// Role Assignment Info
// --------------------
// 2.3.0: added section for upcoming (Pro) role editor feature
add_action( 'radio_station_admin_page_section_permissions_bottom', 'radio_station_role_editor' );
function radio_station_role_editor() {
	echo "<h3>" . esc_html( __( 'Role Assignments', 'radio-station' ) ) . "</h3>";
	echo esc_html( __( 'You can assign a Radio Station role to users through the WordPress User editor.', 'radio-station' ) );

	// --- info regarding Pro role assignment interface ---
	// TODO: change this text when Pro version becomes available
	echo '<br>' . esc_html( __( 'Radio Station Pro will include a Role Assignment Interface so you can easily assign Radio Station roles to any user.', 'radio-station' ) ) . '<br>';
	
	// --- find out about Pro link ---
	// TODO: change this text/link when Pro version becomes available
	$upgrade_url = radio_station_get_upgrade_url();
	echo "<br><a href='" . esc_url( $upgrade_url ) . "' target='_blank'>";
		// echo esc_html( __( 'Upgrade to Radio Station Pro', 'radio-station' ) );
	 	echo esc_html( __( 'Find out more about Radio Station Pro', 'radio-station' ) );
	echo " &rarr;</a>.";
}

// -------------------------------
// Display Import/Export Show Page
// -------------------------------
function radio_station_import_export_show_page() {

	$importexport = RADIO_STATION_DIR . '/templates/import-export-shows.php';
	if ( file_exists( $importexport ) ) {

		// --- enqueue semantic/ui styles ---
		$suffix = '.min';
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			$suffix = '';
		}
		$semantic_css_url = plugins_url( 'vendor/semantic/ui/dist/semantic' . $suffix . '.css', RADIO_STATION_FILE );
		wp_enqueue_style( 'semantic-ui-style', $semantic_css_url, array(), '2.4.1', 'all' );
		$semantic_js_url = plugins_url( 'vendor/semantic/ui/dist/semantic' . $suffix . '.js', RADIO_STATION_FILE );
		wp_enqueue_script( 'semantic-ui-script', $semantic_js_url, array(), '2.4.1', true );

		// --- display the import/export page ---
		include $importexport;
	}
}

// ------------------------
// Display Plugin Docs Page
// ------------------------
function radio_station_plugin_docs_page() {

	// --- show MailChimp signup form ---
	echo "<p>&nbsp;</p>";
	radio_station_mailchimp_form();

	// --- include help file template ---
	// include RADIO_STATION_DIR . '/templates/help.php';
	
	// --- include markdown reader ---
	include_once RADIO_STATION_DIR . '/reader.php';

	$docs = scandir( RADIO_STATION_DIR . '/docs/' );
	$docs[] = 'CHANGELOG.md';
	foreach ( $docs as $doc ) {
		if ( !in_array( $doc, array( '.', '..' ) ) ) {
			$id = str_replace( '.md', '', $doc );
			echo '<div id="doc-page-' . esc_attr( strtolower( $id ) ) . '" class="doc-page"';
			if ( $id != 'index') {
				echo ' style="display:none;"';
			}
			echo '>';
			// phpcs:ignore WordPress.Security.OutputNotEscaped
			echo radio_station_parse_doc( $id );
			echo '</div>' . PHP_EOL;
		}
	}
	
	echo "<script>function radio_load_doc(id) {
		pages = document.getElementsByClassName('doc-page');
		for (i = 0; i < pages.length; i++) {pages[i].style.display = 'none';}
		hash = '';
		if (id.indexOf('#') > -1) {
			parts = id.split('#');
			id = parts[0]; hash = parts[1];
		} else if (id == 'index') {hash = 'index-top';}
		document.getElementById('doc-page-'+id).style.display = 'block';
		if (hash != '') {
			anchor = document.getElementById(hash);
			atop = anchor.offsetTop; /* do not use 'top' */
			window.scrollTo(0, (atop-20));
		}
	}</script>";

	echo '<style>.doc-page {padding: 20px 40px 20px 10px;}
	.doc-page, .doc-page p {font-size: 14px;}
	.doc-page table {padding: 10px; background-color: #F9F9F9; border: 1px solid #CCC; border-radius: 10px;}
	.doc-page th {text-align: left; padding: 7px 14px;}
	.doc-page td {font-size:16px; padding: 7px 14px;}
	.doc-page td a {text-decoration: none; font-weight: bold;}
	.doc-page td a:hover {text-decoration: underline;}
	h1.docs-heading {font-size: 1.65em; margin-bottom: 1.65em;}
	h2.docs-heading {font-size: 1.5em; margin-top: 1.5em;}
	h3.docs-heading {font-size: 1.3em;}
	h4.docs-heading {font-size: 1.1em;}
	</style>';

	// --- output announcement content ---
	// phpcs:ignore WordPress.Security.OutputNotEscaped
	echo radio_station_announcement_content( false );
	
}

// -----------------------
// Parse Markdown Doc File
// -----------------------
function radio_station_parse_doc( $id ) {

	// --- get docs page contents ---
	if ( 'CHANGELOG' == $id ) {
		$path = RADIO_STATION_DIR . '/CHANGELOG.md';
	} else {
		$path = RADIO_STATION_DIR . '/docs/' . $id . '.md';
	}
	$contents = file_get_contents( $path );
	
	// --- strip top level heading to prevent duplicate title ---
	$sep = '***';
	$backlink = '';
	if ( 'index' != $id ) {
		$backlink = '<alink href="javascript:void(0);" onclick="radio_load_doc(\'index\');">&larr; ';
		$backlink .= esc_html( __( 'Back to Documentation Index', 'radio-station' ) );
		$backlink .= '</a><br>';
	}
	$contents = str_replace( $sep, $backlink, $contents );

	// --- replace relative links ---
	$contents = str_replace( '(#', '(./' . $id . '#', $contents );
	$contents = str_replace( '.md)', ')', $contents );
	$contents = str_replace( '.md#', '#', $contents );

	// --- process markdown formatting ---
	$formatted = Markdown( $contents );

	// --- a # name links to headings ---
	for ( $i = 1; $i < 7; $i++ ) {
		$tag_start = '<h' . $i . '>';
		$tag_end = '</h' . $i . '>';
		if ( stristr( $formatted, $tag_start ) ) {
			while ( stristr( $formatted, $tag_start ) ) {
				$pos = stripos( $formatted, $tag_start );
				$pos2 = $pos + strlen( $tag_start );
				$before = substr( $formatted, 0, $pos );
				$after = substr( $formatted, $pos2, strlen( $formatted ) );
				$pos3 = stripos( $after, $tag_end );
				$anchor = sanitize_title( substr( $after, 0, $pos3 ) );
				$alink = '<a id="' . esc_attr( $anchor ) . '" name="' . esc_attr( $anchor ) .'"></a>';
				$newheading = $alink . '<h' . $i . ' class="docs-heading">';
				$formatted = $before . $newheading . $after;
			}
		}
	}

	// --- replace links with javascript ---
	$tag_start = '<a href="./';
	$tag_end = '"';
	$placeholder = '<alink href="javascript:void(0);"';
	if ( stristr( $formatted, $tag_start ) ) {
		while ( stristr( $formatted, $tag_start ) ) {
			$pos = strpos( $formatted, $tag_start );
			$before = substr( $formatted, 0, $pos );
			$pos = strpos( $formatted, $tag_start ) + strlen( $tag_start );
			$after = substr( $formatted, $pos, strlen( $formatted ) );
			$pos2 = strpos( $after, $tag_end );
			$url = substr( $after, 0, $pos2 );
			$url = strtolower( $url );
			$onclick = ' onclick="radio_load_doc(\'' . esc_js( $url ) . '\');';
			$after = substr( $after, $pos2, strlen( $after ) );
			$formatted = $before . $placeholder . $onclick . $after;
		}
	}
	$formatted = str_replace( '<a href="', '<a target="_blank" href="', $formatted );
	if ( 'index' != $id ) {
		$formatted .= $backlink . '<br>';
	} else {
		$formatted = '<a id="index-top" name="index-top"></a>' . $formatted;
	}
	$formatted = str_replace( '<alink ', '<a ', $formatted );
	
	return $formatted;
}

// ----------------------------
// Display Playlist Export Page
// ----------------------------
// TODO: rewrite playlist export function ?
function radio_station_playlist_export_page() {

	global $wpdb;

	// first, delete any old exports from the export directory
	$dir = RADIO_STATION_DIR . '/export/';
	if ( is_dir( $dir ) ) {
		$get_contents = opendir( $dir );
		while ( $file = readdir( $get_contents ) ) {
			if ( '.' !== $file && '..' !== $file ) {
				unlink( $dir . $file );
			}
		}
		closedir( $get_contents );
	}

	// --- watch for form submission ---
	if ( isset( $_POST['export_action'] ) && ( 'station_playlist_export' === $_POST['export_action'] ) ) {

		// --- validate referrer and nonce field ---
		check_admin_referer( 'station_export_valid' );

		$start = $_POST['station_export_start_year'] . '-' . $_POST['station_export_start_month'] . '-' . $_POST['station_export_start_day'];
		$start .= ' 00:00:00';
		$end = $_POST['station_export_end_year'] . '-' . $_POST['station_export_end_month'] . '-' . $_POST['station_export_end_day'];
		$end .= ' 23:59:59';

		// fetch all records that were created between the start and end dates
		$sql =
			"SELECT posts.ID, posts.post_date
		FROM {$wpdb->posts} AS posts
		WHERE posts.post_type = '" . RADIO_STATION_PLAYLIST_SLUG . " AND
			posts.post_status = 'publish' AND
			TO_DAYS(posts.post_date) >= TO_DAYS(%s) AND
			TO_DAYS(posts.post_date) <= TO_DAYS(%s)
		ORDER BY posts.post_date ASC";
		// prepare query before executing
		$query = $wpdb->prepare( $sql, array( $start, $end ) );
		$playlists = $wpdb->get_results( $query );

		if ( ! $playlists ) {
			$list = 'No playlists found for this period.';
		}

		// fetch the tracks for each playlist from the wp_postmeta table
		foreach ( $playlists as $i => $playlist ) {

			$songs = get_post_meta( $playlist->ID, 'playlist', true );

			// remove any entries that are marked as 'queued'
			foreach ( $songs as $j => $entry ) {
				if ( 'queued' === $entry['playlist_entry_status'] ) {
					unset( $songs[$j] );
				}
			}

			$playlists[$i]->songs = $songs;
		}

		$output = '';

		$date = '';
		foreach ( $playlists as $playlist ) {
			if ( ! isset( $playlist->post_date ) ) {
				continue;
			}
			$playlist_datetime = explode( ' ', $playlist->post_date );
			$playlist_post_date = array_shift( $playlist_datetime );
			if ( empty( $date ) || $date !== $playlist_post_date ) {
				$date = $playlist_post_date;
				$output .= $date . "\n\n";
			}

			foreach ( $playlist->songs as $song ) {
				$output .= $song['playlist_entry_artist'] . ' || ' . $song['playlist_entry_song'] . ' || ' . $song['playlist_entry_album'] . ' || ' . $song['playlist_entry_label'] . "\n";
			}
		}

		// save as file
		// TODO: use WP Filesystem for writing
		$dir = RADIO_STATION_DIR . '/export/';
		$file = $date . '-export.txt';
		if ( ! file_exists( $dir ) ) {
			wp_mkdir_p( $dir );
		}

		$f = fopen( $dir . $file, 'w' );
		fwrite( $f, $output );
		fclose( $f );

		// display link to file
		$url = get_bloginfo( 'url' ) . '/wp-content/plugins/radio-station/tmp/' . $file;
		echo '<div id="message" class="updated"><p><strong>';
		echo '<a href="' . esc_url( $url ) . '">';
		echo esc_html( __( 'Right-click and download this file to save your export', 'radio-station' ) );
		echo '</a>';
		echo '</strong></p></div>';
	}

	// display the export page
	include RADIO_STATION_DIR . '/templates/playlist-export.php';

}


// ----------------------
// === Update Notices ===
// ----------------------

// -------------------------
// Get Plugin Upgrade Notice
// -------------------------
// 2.3.0: added to get plugin upgrade notice
function radio_station_get_upgrade_notice() {

	// --- check updates transient for upgrade notices ---
	$notice = false;
	$pluginslug = 'radio-station';
	$pluginupdates = get_site_transient( 'update_plugins' );
	if ( RADIO_STATION_DEBUG ) {
		echo '<span style="display:none;">Update Transient: ' . print_r( $pluginupdates, true ) . '</span>';
	}
	if ( property_exists( $pluginupdates, 'response' ) ) {
		foreach ( $pluginupdates->response as $file => $update ) {
			if ( $update->slug == $pluginslug ) {
				if ( property_exists( $update, 'upgrade_notice' ) ) {
					// --- parse upgrade notice ---
					$notice = $update->upgrade_notice;
					$notice = radio_station_parse_upgrade_notice( $notice );
					$new_version = $update->new_version;
					$notice['update_id'] = str_replace( '.', '', $new_version );
					if ( property_exists( $update, 'icons' ) && isset( $update->icons['1x'] ) ) {
						$notice['icon_url'] = $update->icons['1x'];
					}
					$notice['plugin_file'] = $file;
					break;
				}
			}
		}
	}
	if ( RADIO_STATION_DEBUG ) {
		echo '<span style="display:none;">Update Notice: ' . print_r( $notice, true ) . '</span>';
	}	
	return $notice;
}

// --------------------
// Parse Upgrade Notice
// --------------------
function radio_station_parse_upgrade_notice( $notice ) {

	$lines = $content_lines = array();
	$notice_url = '';
	if ( strstr( $notice, "\n" ) ) {
		$contents = explode( "\n", $notice );
	} else {
		$contents = array( $notice );
	}

	foreach ( $contents as $content ) {
		if ( trim( $content ) != '' ) {
			// --- extract link from line ---
			if ( strstr( $content, 'http' ) ) {
				$pos = strpos( $content, 'http' );
				$chunks = str_split( $content, $pos );
				unset( $chunks[0] );
				$remainder = implode( '', $chunks );
				$breaks = array( ' ', '<', "\n", "\r" );
				$pos = array();
				foreach ( $breaks as $i => $urlbreak ) {
					if ( strstr( $remainder, $urlbreak ) ) {
						$pos[$i] = strpos( $remainder, $urlbreak );
					}
				}
				if ( count( $pos ) > 0 ) {
					$pos = min( $pos );
					$chunks = str_split( $remainder, $pos );
					$notice_url = $chunks[0];
				} else {
					$notice_url = $remainder;
				}
				$content = str_replace( $notice_url, '', $content );
				$content = str_replace( '<li>', '', $content );
				$content = str_replace( '</li>', '', $content );
			}
		}
		if ( '' != trim( $content ) ) {
			$content_lines[] = $content;
			if ( !in_array( $content, array( '<ul>', '</ul>' ) ) ) {
				$line = str_replace( array( '<li>', '</li>' ), array( '', '' ), $content );
				$lines[] = $line;
			}
		}
	}

	// --- recombine lines and return ---
	$content = implode( "\n", $content_lines );
	$notice = array(
		'content' => $content,
		'lines'   => $lines,
		'url'     => $notice_url,
	);

	return $notice;
}

// --------------------------
// Plugin Page Update Message
// --------------------------
add_action( 'in_plugin_update_message-' . RADIO_STATION_BASENAME, 'radio_station_plugin_update_message', 10, 2 );
function radio_station_plugin_update_message( $plugin_data, $response ) {

	// --- bug out if no update plugins capability ---
	if ( !current_user_can( 'update_plugins' ) ) {
		return;
	}

	// --- get upgrade notice ---
	$notice = radio_station_get_upgrade_notice();
	
	// --- bug out if no upgrade notice ---
	if ( !$notice ) {
		return;
	}

	// --- output update available message ---
	echo '<br><b>' . esc_html( __( 'Take a moment to Update for a better experience. In this update', 'radio-station' ) ) . ":</b><br>";
	foreach ( $notice['lines'] as $line ) {
		echo '&bull; ' . esc_html( $line ) . '<br>';
	}

	// if ( '' != $notice['url'] ) {
	//	echo '<a class="button" href="' . esc_url( $notice['url'] ) . '" target="_blank">' . esc_html( __( 'Full Update Details', 'radio-station' ) ) . ' &rarr;</a>';
	// }
}

// ---------------------------
// Display Admin Update Notice
// ---------------------------
add_action( 'admin_notices', 'radio_station_admin_update_notice' );
function radio_station_admin_update_notice() {
	// --- do not display on settings page ---
	if ( isset( $_GET['page'] ) && ( 'radio-station' == $_GET['page'] ) ) {
		return;
	}
	radio_station_update_notice();
}

// ---------------------------
// Display Admin Update Notice
// ---------------------------
function radio_station_update_notice() {

	// --- bug out if no update plugins capability ---
	if ( !current_user_can( 'update_plugins' ) ) {
		return;
	}

	// --- get upgrade notice ---
	$notice = radio_station_get_upgrade_notice();
	
	// --- bug out if no upgrade notice ---
	if ( !$notice ) {
		return;
	}

	// --- ignore if updating now ---
	if ( isset( $_GET['action'] ) && ( 'upgrade-plugin' == $_GET['action'] )
	  && isset( $_GET['plugin'] ) && ( $notice['plugin_file'] == $_GET['plugin'] ) ) {
		return;
	}

	// --- bug out if already read ---
	$read = get_option( 'radio_station_read_upgrades' );
	if ( $read && is_array( $read ) && isset( $read[$notice['update_id']] ) && ( '1' == $read[$notice['update_id']] ) ) {
		return;
	}

	// --- set plugin update URL ---
	$update_url = admin_url( 'update.php' ) . '?action=upgrade-plugin&plugin=' . $notice['plugin_file'];
	$update_url = wp_nonce_url( $update_url, 'upgrade-plugin_' . $notice['plugin_file'] );

	// --- output update available notice ---
	echo '<div id="radio-station-update-' . esc_attr( $notice['update_id'] ) . '" class="notice update-nag" style="position:relative;">';

	echo '<ul style="list-style:none;">';

	if ( isset( $notice['icon_url'] ) ) {
		echo '<li style="display:inline-block; vertical-align:top; margin-right:40px;">';
		echo '<img src="' . esc_url( $notice['icon_url'] ) . '" style="width:75px; height: 75px;">';
		echo '</li>';
	}

	echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-right:40px; line-height:1.8em;">';
	echo esc_html( __( 'A new version of', 'radio-station' ) ) . '<br>';
	echo '<b><span style="font-size:1.2em;">' . esc_html( __( 'Radio Station', 'radio-station' ) ) . '</span></b><br>';
	echo esc_html( __( 'is available.', 'radio-station' ) );
	echo '</li>';

	echo '<li style="display:inline-block; vertical-align:top; margin-right:40px; max-width:600px;">';
	echo '<b>' . esc_html( __( 'Take a moment to Update for a better experience. In this update', 'radio-station' ) ) . ":</b><br>";
	echo '<ul style="padding:0; list-style:disc;">';
	foreach ( $notice['lines'] as $line ) {
		echo '<li style="text-indent:20px;">' . esc_html( $line ) . '</li>';
	}
	echo '</ul>';
	echo '</li>';

	echo '<li style="display:inline-block; text-align:center; vertical-align:top;">';
	echo '<a class="button button-primary" href="' . esc_url( $update_url ) . '">' . esc_html( __( 'Update Now', 'radio-station' ) ) . '</a>';
	if ( '' != $notice['url'] ) {
		echo '<br><br>';
		echo '<a class="button" href="' . esc_url( $notice['url'] ) . '" target="_blank">' . esc_html( __( 'Full Update Details', 'radio-station' ) ) . ' &rarr;</a>';
	}
	echo '</li>';

	echo '</ul>';

	// --- dismiss notice link ---
	$dismiss_url = add_query_arg( 'action', 'radio_station_notice_dismiss', admin_url( 'admin-ajax.php' ) );
	$dismiss_url = add_query_arg( 'upgrade', $notice['update_id'], $dismiss_url );
	echo '<div style="position:absolute; top:20px; right: 20px;">';
	echo '<a href="' . esc_url( $dismiss_url ) . '" target="radio-station-notice-iframe" style="text-decoration:none;">';
	echo '<span class="dashicons dashicons-dismiss" title="' . esc_attr( __( 'Dismiss this Notice', 'radio-station' ) ) . '"></span></a>';
	echo '</div>';

	echo '</div>';

	// --- notice dismissal iframe (once only) ---
	global $radio_station_notice_iframe;
	if ( !isset( $radio_station_notice_iframe ) ) {
		echo '<iframe src="javascript:void(0);" name="radio-station-notice-iframe" style="display:none;"></iframe>';
		$radio_station_notice_iframe = true;
	}
}

// ---------------------
// Display Plugin Notice
// ---------------------
// 2.3.0: added 2.3.0 template update announcement notice
add_action( 'admin_notices', 'radio_station_notice' );
function radio_station_notice() {

	// --- get latest notice ---
	$notices = radio_station_get_notices();
	if ( RADIO_STATION_DEBUG ) {
		echo "<span style='display:none;'>Notices: " . print_r( $notices, true ) . "</span>";
	}
	if ( count( $notices ) < 1 ) {
		return;
	}
	$notice_ids = array_keys( $notices );
	$notice_id = max( $notice_ids );
	$notice = $notices[$notice_id];

	// --- bug out if already read ---
	$read = get_option( 'radio_station_read_notices' );
	if ( RADIO_STATION_DEBUG ) {
		echo "<span style='display:none;'>Read Notices: " . print_r( $read, true ) . "</span>";
		echo "<span style='display:none;'>Latest Notices: " . print_r( $notice, true ) . "</span>";
	}
	if ( $read && isset( $read[$notice_id] ) && ( '1' == $read[$notice_id] ) ) {
		return;
	}

	// --- display plugin notice ---
	echo '<div id="radio-station-notice-' . esc_attr( $notice['id'] ) . '" class="notice notice-info" style="position:relative;">';

	// --- output plugin notice text ---
	echo '<ul style="list-style:none;">';

	// --- plugin icon ---
	$icon_url = plugins_url( 'images/radio-station.png', RADIO_STATION_FILE );
	echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-right:40px; line-height:1.8em;">';
	echo '<img src="' . esc_url( $icon_url ) . '" style="width:75px; height:75px;">';
	echo '</li>';

	// --- notice title ---
	echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-right:40px; line-height:1.8em;">';
	echo '<b><span style="font-size:1.2em;">' . esc_html( __( 'Radio Station', 'radio-station' ) ) . '</span></b><br>';
	echo '<b>' . esc_html( __( 'Update Notice', 'radio-station' ) ) . '</b>';
	echo '</li>';

	// --- notice details ---
	echo '<li style="display:inline-block; vertical-align:top; margin-right:40px; font-size:16px; line-height:22px; max-width:600px;">';
	echo '<div style="margin-bottom:10px;">';
	echo '<b>' . esc_html( __( 'Thanks for Updating! You can enjoy these improvements now', 'radio-station' ) ) . '</b>:';
	echo '</div>';
	echo '<ul style="padding:0; list-style:disc;">';
	foreach ( $notice['lines'] as $line ) {
		echo '<li style="text-indent:20px;">' . $line . '</li>';
	}
	echo '</ul>';
	echo '</li>';

	echo '<li style="display:inline-block; text-align:center; vertical-align:top;">';

		// --- link to update blog post ---
		if ( isset( $notice['url'] ) && ( '' != $notice['url'] ) ) {	
			echo '<a class="button" href="' . esc_url( $notice['url'] ) . '">' . esc_html( __( 'Full Update Details', 'radio-station' ) ) . ' &rarr;</a>';
			echo '<br><br>';
		}

		// --- link to settings page ---
		if ( !isset( $_REQUEST['page'] ) || ( 'radio-station' != $_REQUEST['page'] ) ) {
			$settings_url = add_query_arg( 'page', 'radio-station', admin_url( 'admin.php' ) );
			echo '<a class="button button-primary" href="' . esc_url( $settings_url ) . '">' . esc_html( __( 'Plugin Settings', 'radio-station' ) ) . '</a>';
		}
		
	echo '</li>';

	echo '</ul>';

	// --- notice dismissal button ---
	$dismiss_url = add_query_arg( 'action', 'radio_station_notice_dismiss', admin_url( 'admin-ajax.php' ) );
	$dismiss_url = add_query_arg( 'notice', $notice['id'], $dismiss_url );
	echo '<div style="position:absolute; top:20px; right: 20px;">';
	echo '<a href="' . esc_url( $dismiss_url ) . '" target="radio-station-notice-iframe" style="text-decoration:none;">';
	echo '<span class="dashicons dashicons-dismiss" title="' . esc_attr( __( 'Dismiss this Notice', 'radio-station' ) ) . '"></span></a>';
	echo '</div>';
	echo '</div>';

	// --- notice dismissal iframe (once only) ---
	global $radio_station_notice_iframe;
	if ( !isset( $radio_station_notice_iframe ) ) {
		echo '<iframe src="javascript:void(0);" name="radio-station-notice-iframe" style="display:none;"></iframe>';
		$radio_station_notice_iframe = true;
	}
}

// ------------------
// Get Plugin Notices
// ------------------
// 2.3.0: added get notices helper
function radio_station_get_notices() {

	// --- check for needed files ---
	$readme = RADIO_STATION_DIR . '/readme.txt';
	$parser = RADIO_STATION_DIR . '/reader.php';

	// --- get upgrade notices ---
	$notices = array();
	if ( file_exists( $parser ) && file_exists( $readme ) ) {

		// --- get readme contents ---
		$contents = file_get_contents( $readme );

		// --- fix to parser failing on license lines ---
		$contents = str_replace( 'License: GPLv2 or later', '', $contents );
		$contents = str_replace( 'License URI: http://www.gnu.org/licenses/gpl-2.0.html', '', $contents );

		// --- include Markdown Readme Parser ---
		include $parser;
		$readme = new WordPress_Readme_Parser();
		$parsed = $readme->parse_readme_contents( $contents );

		// --- parse all the notices to get notice info ---
		if ( isset( $parsed['upgrade_notice'] ) ) {
			$notices = array();
			foreach ( $parsed['upgrade_notice'] as $version => $notice ) {
				if ( trim( $notice ) != '' ) {
					$id = str_replace( '.', '', $version );
					$notice = radio_station_parse_upgrade_notice( $notice );
					$notices[$id] = array(
						'id'      => $id,
						'version' => $version,
						'url'     => $notice['url'],
						'content' => $notice['content'],
						'lines'   => $notice['lines'],
					);
				}
			}
		}
	}

	return $notices;
}

// ---------------------
// AJAX Mark Notice Read
// ---------------------
// 2.3.0: added for plugin notice dismissal
add_action( 'wp_ajax_radio_station_notice_dismiss', 'radio_station_notice_dismiss' );
function radio_station_notice_dismiss() {
	if ( current_user_can( 'manage_options' ) || current_user_can( 'update_plugins' ) ) {
		if ( isset( $_GET['notice'] ) ) {
			$notice = absint( $_GET['notice'] );
			if ( $notice < 0 ) {
				return;
			}
			$notices = get_option( 'radio_station_read_notices' );
			if ( ! $notices ) {
				$notices = array();
			}
			$notices[$notice] = '1';
			update_option( 'radio_station_read_notices', $notices );
			echo "<script>parent.document.getElementById('radio-station-notice-" . esc_js( $notice ) . "').style.display = 'none';</script>";
		} elseif ( isset( $_GET['upgrade'] ) ) {
			$upgrade = absint( $_GET['upgrade'] );
			if ( $upgrade < 0 ) {
				return;
			}
			$upgrades = get_option( 'radio_station_read_upgrades' );
			if ( ! $upgrades ) {
				$upgrades = array();
			}
			$upgrades[$upgrade] = '1';
			update_option( 'radio_station_read_upgrades', $upgrades );
			echo "<script>parent.document.getElementById('radio-station-update-" . esc_js( $upgrade ) . "').style.display = 'none';</script>";
		}
	}
	exit;
}


// ---------------------
// === Admin Notices ===
// ---------------------

// ------------------------
// Plugin Settings Page Top
// ------------------------
add_action( 'radio_station_admin_page_top', 'radio_station_settings_page_top' );
function radio_station_settings_page_top() {
	radio_station_update_notice();
	radio_station_mailchimp_form();
	echo '<br>';
}

// ---------------------------
// Plugin Settings Page Bottom
// ---------------------------
add_action( 'radio_station_admin_page_bottom', 'radio_station_settings_page_bottom' );
function radio_station_settings_page_bottom() {
	// phpcs:ignore WordPress.Security.OutputNotEscaped
	echo radio_station_announcement_content( false );
}

// -----------------------------------
// Plugin Takeover Announcement Notice
// -----------------------------------
// 2.2.2: added plugin announcement notice
add_action( 'admin_notices', 'radio_station_announcement_notice' );
function radio_station_announcement_notice() {

	// --- bug out if already dismissed ---
	if ( get_option( 'radio_station_announcement_dismissed' ) ) {
		return;
	}

	// --- bug out on certain plugin pages ---
	// 2.2.8: remove strict in_array checking
	$pages = array( 'radio-station', 'radio-station-docs' );
	if ( isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], $pages ) ) {
		return;
	}

	// --- display plugin announcement ---
	echo '<div id="radio-station-announcement-notice" class="notice notice-info" style="position:relative;">';
	// phpcs:ignore WordPress.Security.OutputNotEscaped
	echo radio_station_announcement_content();
	echo '</div>';

	// --- notice dismissal frame (once) ---
	global $radio_station_notice_frame;
	if ( !isset( $radio_station_notice_iframe ) ) {
		echo '<iframe src="javascript:void(0);" name="radio-station-notice-iframe" style="display:none;"></iframe>';
		$radio_station_notice_iframe = true;
	}

}

// ------------------------------------
// Plugin Takeover Announcement Content
// ------------------------------------
// 2.2.2: added simple patreon supporter blurb
function radio_station_announcement_content( $dismissable = true ) {

	// --- takeover announcement ---
	$plugin_image = plugins_url( 'images/radio-station.png', RADIO_STATION_FILE );
	$blurb = '<ul style="list-style:none;">';
	$blurb .= '<li style="display:inline-block; vertical-align:middle;">';
	$blurb .= '<img src="' . esc_url( $plugin_image ) . '">';
	$blurb .= '</li>';

	$blurb .= '<li style="display:inline-block; vertical-align:middle; margin-left:40px; font-size:16px; line-height:24px;">';
	$blurb .= '<b style="font-size:17px;">' . esc_html( __( 'Help support us to make improvements, modifications and introduce new features!', 'radio-station' ) ) . '</b><br>';
	$blurb .= esc_html( __( 'With over a thousand radio station users thanks to the original plugin author Nikki Blight', 'radio-station' ) ) . ', <br>';
	$blurb .= esc_html( __( 'since June 2019', 'radio-station' ) ) . ', ';
	$blurb .= '<b>' . esc_html( __( 'Radio Station', 'radio-station' ) ) . '</b> ';
	$blurb .= esc_html( __( ' plugin development has been actively taken over by', 'radio-station' ) );
	$blurb .= ' <a href="https://netmix.com/" target="_blank">Netmix</a>.<br>';
	$blurb .= esc_html( __( 'We invite you to', 'radio-station' ) );
	$blurb .= ' <a href="https://patreon.com/radiostation" target="_blank">';
	$blurb .= esc_html( __( 'Become a Radio Station Patreon Supporter', 'radio-station' ) );
	$blurb .= '</a> ' . esc_html( __( 'to make it better for everyone', 'radio-station' ) ) . '!';
	$blurb .= '</li>';
	$blurb .= '<li style="display:inline-block; text-align:center; vertical-align:middle; margin-left:40px;">';
	$blurb .= radio_station_patreon_button( 'radiostation' );
	// 2.2.7: added WordPress.Org star rating link
	// 2.3.0: only show for dismissable notice
	if ( $dismissable ) {
		$blurb .= '<br><br><span style="color:#FC5;" class="dashicons dashicons-star-filled"></span> ';
		$blurb .= '<a class="notice-link" href="https://wordpress.org/support/plugin/radio-station/reviews/#new-post" target=_blank>';
		$blurb .= esc_html( __( 'Rate on WordPress.Org', 'radio-station' ) );
		$blurb .= '</a>';
	}
	$blurb .= '</li>';
	$blurb .= '</ul>';

	if ( $dismissable ) {
		$dismiss_url = admin_url( 'admin-ajax.php?action=radio_station_announcement_dismiss' );
		$blurb .= '<div style="position:absolute; top:20px; right: 20px;">';
		$blurb .= '<a href="' . esc_url( $dismiss_url ) . '" target="radio-station-notice-iframe" style="text-decoration:none;">';
		$blurb .= '<span class="dashicons dashicons-dismiss" title="' . esc_html( __( 'Dismiss this Notice', 'radio-station' ) ) . '"></span>';
		$blurb .= '</a>';
		$blurb .= '</div>';
	}

	return $blurb;
}

// ------------------------------------
// Dismiss Plugin Takeover Announcement
// ------------------------------------
// 2.2.2: AJAX for takeover announcement notice dismissal
add_action( 'wp_ajax_radio_station_announcement_dismiss', 'radio_station_announcement_dismiss' );
function radio_station_announcement_dismiss() {
	if ( current_user_can( 'manage_options' ) || current_user_can( 'update_plugins' ) ) {
		// --- set option to dismissed ---
		update_option( 'radio_station_announcement_dismissed', true );
		// --- hide the announcement in parent frame ---
		echo "<script>parent.document.getElementById('radio-station-announcement-notice').style.display = 'none';</script>";
		exit;
	}
}

// --------------------------
// Show Shift Conflict Notice
// --------------------------
add_action( 'admin_notices', 'radio_station_shift_conflict_notice' );
function radio_station_shift_conflict_notice() {

	if ( !current_user_can( 'edit_shows' ) ) {
		return;
	}

	// --- get show shifts ---
	// note: calling this will run the shift conflict checker
	$show_shifts = radio_station_get_show_shifts();

	// --- display any shift conflicts found ---
	$conflicts = get_option( 'radio_station_schedule_conflicts' );
	if ( $conflicts && is_array( $conflicts ) && ( count( $conflicts ) > 0 ) ) {

		echo '<div id="radio-station-conflicts" class="notice notice-error" style="position:relative;">';

		echo '<ul style="list-style:none;">';

		echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-left:40px;">';
		echo '<b>' . esc_html( __( 'Radio Station', 'radio-station' ) ) . '</b><br>';
		echo esc_html( __( 'has detected', 'radio-station' ) ) . '<br>';
		echo esc_html( __( 'Schedule conflicts!', 'radio-station' ) );
		echo '</li>';

		echo '<li style="display:inline-block; vertical-align:top; margin-left:40px;">';
		echo '<b>' . esc_html( __( 'The following Shows have conflicting Shift times', 'radio-station' ) ) . ":</b><br>";

		echo '<ul style="list-style:none; margin-top:5px;">';
		$edit_link = add_query_arg( 'action', 'edit', admin_url( 'post.php' ) );
		foreach ( $conflicts as $show => $show_conflicts ) {
			foreach ( $show_conflicts as $conflict ) {
				if ( !$conflict['duplicate'] ) {
					echo '<li>';
					$show_edit_link = add_query_arg( 'post', $conflict['show'], $edit_link );
					$show_title = get_the_title( $conflict['show'] );
					echo '<a href="' . esc_url( $show_edit_link ) . '">' . esc_attr( $show_title ) . '</a>';
					if ( $conflict['disabled'] ) {
						$disabled = ' [disabled] ';
					} else {
						$disabled = '';
					}
					echo ' (' . esc_html( $disabled ) . esc_html( $conflict['day'] ) . ' ';
					echo esc_html( $conflict['start'] ) . ' - ' . esc_html( $conflict['end'] ) . ')';
					echo ' ' . esc_html( __( 'with', 'radio-station' ) ) . ' ';
					$show_edit_link = add_query_arg( 'post', $conflict['with_show'], $edit_link );
					$show_title = get_the_title( $conflict['with_show'] );
					echo '<a href="' . esc_url( $show_edit_link ) . '">' . esc_attr( $show_title ) . '</a>';
					if ( $conflict['with_disabled'] ) {
						$disabled = ' [disabled] ';
					} else {
						$disabled = '';
					}
					echo ' (' . esc_html( $disabled ) . esc_html( $conflict['with_day'] ) . ' ';
					echo esc_html( $conflict['with_start'] ) . ' - ' . esc_html( $conflict['with_end'] ) . ')';
					echo '</li>';
				}
			}
		}
		echo '</ul>';
		echo '</li>';

		// --- show list link ---
		$show_list_url = add_query_arg( 'post_type', RADIO_STATION_SHOW_SLUG, admin_url( 'edit.php' ) );
		echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-left:40px;">';
		echo '<a class="button" style="margin-bottom:5px;" href="' . esc_url( $show_list_url ) . '">' . esc_html( __( 'Go to Show List', 'radio-station' ) ) . ' &rarr;</a><br>';
		echo esc_html( __( 'Conflicts are highlighted', 'radio-station' ) ) . '<br>';
		echo esc_html( __( 'in Show Shift column.', 'radio-station' ) );
		echo '</li>';

		// --- undismissable error notice ---
		echo '<li style="display:inline-block; text-align:center; vertical-align:top; margin-left:40px;">';
		echo esc_html( __( 'This notice will persist', 'radio-station' ) ) . '<br>';
		echo esc_html( __( 'until conflicts are resolved.', 'radio-station' ) );
		echo '</li>';

		echo '</ul>';

		echo '</div>';

	}
}

// -------------------------
// MailChimp Subscriber Form
// -------------------------
function radio_station_mailchimp_form() {

	// --- get current user email ---
	$current_user = wp_get_current_user();
	$user_email = $current_user->user_email;

	// --- bug out if already subscribed ---
	// 2.3.0: added to hide for existing subscribers
	$subscribed = get_option( 'radio_station_subcribed' );
	if ( $subscribed && is_array( $subscribed ) && in_array( $user_email, $subscribed ) ) {
		return;
	}

	// --- enqueue MailChimp form styles ---
	// 2.3.0: prefix mailchimp CSS file
	// 2.3.0: fix to incorrect style handle
	$version = filemtime( RADIO_STATION_DIR . '/css/rs-mailchimp.css' );
	$url = plugins_url( 'css/rs-mailchimp.css', RADIO_STATION_FILE );
	wp_enqueue_style( 'rs-mailchimp', $url, array(), $version, 'all' );

	// --- set radio station plugin icon URL ---
	$icon = plugins_url( 'images/radio-station-icon.png', RADIO_STATION_FILE );

	// --- output MailChimp signup form ---
	?>
	
	<div id="mc_embed_signup">
		<form action="https://netmix.us8.list-manage.com/subscribe/post?u=c53a6feec82d81974edd00a95&amp;id=7130454f20" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<div style="position: absolute; left: -5000px;" aria-hidden="true">
				<input type="text" name="b_c53a6feec82d81974edd00a95_7130454f20" tabindex="-1" value="">
			</div>
			<div id="mc_embed_signup_scroll">
				<div id="plugin-icon">
					<img src="<?php echo esc_url( $icon ); ?>" alt='<?php echo esc_html( __( 'Radio Station', 'radio-station' ) ); ?>'>
				</div>
				<label id="signup-label" for="mce-EMAIL"><?php echo esc_html( __( "Stay tuned! Subscribe to Radio Station's", 'radio-station' ) ); ?>
					<br>
					<?php echo esc_html( __( 'Plugin Updates and Announcements List', 'radio-station' ) ); ?></label>
				<input type="email" name="EMAIL" class="email" id="mce-EMAIL" value="<?php echo esc_html( $user_email ); ?>" placeholder="Your email address" required>
				<div class="subscribe">
					<input type="button" value="Subscribe" name="subscribe" id="mc-embedded-button" class="button">
					<!-- input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" -->
				</div>
			</div>
		</form>
	</div>

	<?php
	
	echo '<iframe id="mc-subscribe-record" src="javascript:void(0);" style="display:none;"></iframe>';
	
	// --- AJAX subscription call ---
	// 2.3.0: added to record subscribers
	$recordurl = add_query_arg( 'action', 'radio_station_record_subscribe', admin_url( 'admin-ajax.php') );
	echo "<script>
	jQuery(document).ready(function() {
		jQuery('#mc-embedded-button').on('click', function(e) {
			email = document.getElementById('mce-EMAIL').value;
			url = '" . esc_url( $recordurl ) . "&email='+encodeURIComponent(email);
			document.getElementById('mc-subscribe-record').src = url;
		});
	});</script>";
	
}

// ---------------------
// AJAX Record Subcriber
// ---------------------
// 2.3.0: added to record subscribers
add_action( 'wp_ajax_radio_station_record_subscribe', 'radio_station_record_subscribe' );
function radio_station_record_subscribe() {

	$email = sanitize_email( $_GET['email'] );
	$subscribed = get_option( 'radio_station_subcribed' );
	if ( !$subscribed || !is_array($subscribed ) ) {
		add_option( 'radio_station_subcribed', array( $email ) );
	} else {
		$subscribed[] = $email;
		update_option( 'radio_station_subcribed', $subscribed );
	}
	echo "<script>console.log('Subscription Recorded');
	parent.jQuery('#mc-embedded-subscribe-form').submit();</script>";
	exit;
	
}

// ------------------
// AJAX Clear Notices
// ------------------
// (manual use for development testing)
add_action( 'wp_ajax_radio_station_clear_option', 'wp_ajax_radio_station_clear_option' );
function wp_ajax_radio_station_clear_option() {
	if ( !current_user_can( 'manage_options' ) ) {return;}
	if ( isset( $_GET['option'] ) && ( 'subscribed' == $_GET['option'] ) ) {
		delete_option( 'radio_station_subcribed' );
	}
	if ( isset( $_GET['option'] ) && ( 'notices' == $_GET['option'] ) ) {
		delete_option( 'radio_station_read_notices' );
	}
	if ( isset( $_GET['option'] ) && ( 'upgrades' == $_GET['option'] ) ) {
		delete_option( 'radio_station_read_upgrades' );
	}
	if ( isset( $_GET['option'] ) && ( 'announcement' == $_GET['option'] ) ) {
		delete_option( 'radio_station_announcement_dismissed' );
	}	
	
	exit;
}