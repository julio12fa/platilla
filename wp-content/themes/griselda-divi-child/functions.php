<?php

/**
* Include Setting
* Include Options
* Plugin Activation
* Import Demo Data
*/

/* Include Setting */
include_once(get_stylesheet_directory() . '/extend/setting.php');

/* Include Options */
include get_stylesheet_directory() . '/extend/options.php';


/* Load CSS and JS */ 
function dc_enqueue_css() { 
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.js', array( 'jquery' ), '1.0.0' , true );
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '1.0.0' , true );
}
add_action( 'wp_enqueue_scripts', 'dc_enqueue_css' );


/* Plugin Activation */
require get_stylesheet_directory() .'/class-tgm-plugin-activation.php';

/* Import Demo Data  */
add_action( 'tgmpa_register', 'dc_register_required_plugins' );
function dc_register_required_plugins() {
  
  $plugins = array(
				array(
				  'name'      => 'Customizer Export/Import',
				  'slug'      => 'customizer-export-import',
				  'required'  => true,
				),
				array(
				  'name'      => 'One Click Demo Import',
				  'slug'      => 'one-click-demo-import',
				  'required'  => true,
				),
				array(
				  'name'      => 'Widget Importer & Exporter',
				  'slug'      => 'widget-importer-exporter',
				  'required'  => true,
				),
			  );


	  $config = array(
		    'id'           => __(dc_themename),                 // Unique ID for hashing notices for multiple instances of TGMPA.
		    'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
		    'parent_slug'  => 'themes.php',            // Parent menu slug.
		    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
		    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		    'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		    'message'      => '',                      // Message to output right before the plugins table.
	  );
	  tgmpa( $plugins, $config );
}

function dc_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'one-click-demo-import' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'one-click-demo-import' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'one-click-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'dc_ocdi_plugin_page_setup' );

function dc_ocdi_before_content_import( $selected_import ) {
    if ( 'Griselda – AI Agency Divi Child Theme' === $selected_import['import_file_name'] ) {
        // Here you can do stuff for the "Griselda – AI Agency Divi Child Theme" before the content import starts.
        echo "before import 1";
    }
    else {
        // Here you can do stuff for all other imports before the content import starts.
        echo "before import 2";
    }
}
add_action( 'ocdi/before_content_import', 'dc_ocdi_before_content_import' );

function dc_ocdi_import_filesv() {
	return [
	  [
		'import_file_name'             => 'Griselda – AI Agency Divi Child Theme',
		'categories'                   => [ 'Category 1', 'Category 2' ],
		'local_import_file'            => __DIR__. '/demo/divi-content.xml',
		'local_import_widget_file'     => __DIR__ . '/demo/divi-widgets.wie',
		'local_import_customizer_file' => __DIR__. '/demo/divi-customizer.dat',
		'import_preview_image_url'     => get_stylesheet_directory_uri().'/screenshot.png',
		'preview_url'                  => 'https://griselda.divicoded.com/',
	  ],
	 
	];
}
add_filter( 'ocdi/import_files', 'dc_ocdi_import_filesv' ); 

function dc_ocdi_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="ocdi__intro-text" style="padding-bottom:20px;">
	<div style="background-color: #F5FAFD; margin:10px 0;padding: 5px 10px;color: #0C518F;border: 2px solid #CAE0F3; clear:both; width:90%; line-height:18px;"> 
	<p style="font-size:18px;">Please click the import button once and wait for the process to complete. Please do not navigate away from this page until the import is complete.</p>
	<p style="font-size:18px;">Please be patient and allow the import to finish before navigating away.</p>';
	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'dc_ocdi_plugin_intro_text' );

function dc_ocdi_importer_options( $options ) {
  $options['aggressive_url_search'] = true;
  return $options;
}
add_filter( 'pt-ocdi/importer_options', 'dc_ocdi_importer_options' );

function dc_ocdi_confirmation_dialog_options ( $options ) {
	return array_merge( $options, array(
		'width'       => 300,
		'dialogClass' => 'wp-dialog',
		'resizable'   => false,
		'height'      => 'auto', 
		'modal'       => true,
	) );
}
add_filter( 'pt-ocdi/import_files', 'dc_ocdi_confirmation_dialog_options' );

function dc_ocdi_after_import_setup() { 
	$main_menu  = get_term_by( 'name', __(main_menu,'Home'), 'nav_menu' );
	$secondary_menu    = get_term_by('name', __(secondary_menu,''), 'nav_menu');
	$footer_menu = get_term_by('name', __(footer_menu,''), 'nav_menu');

	set_theme_mod( 'nav_menu_locations', array(
	  'primary-menu'    =>  $main_menu->term_id,
	  'secondary-menu' => $secondary_menu->term_id,
	  'footer-menu' => $footer_menu->term_id
	));

	$front_page = get_page_by_title( __(front_page,'Home') );
	if(isset( $front_page ) && $front_page->ID) {
	    update_option( 'show_on_front','page' );
	    update_option( 'page_on_front', $front_page->ID );
	}
	global $wpdb;
	$oldurl = "";
	$newurl = site_url();
	$results = array();
	$queries = array(
		'content' => $wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = replace(post_content, %s, %s)", $oldurl, $newurl),
		'excerpts' => $wpdb->prepare("UPDATE {$wpdb->posts} SET post_excerpt = replace(post_excerpt, %s, %s)", $oldurl, $newurl),
		'attachments' => $wpdb->prepare("UPDATE {$wpdb->posts} SET guid = replace(guid, %s, %s) WHERE post_type = 'attachment'", $oldurl, $newurl),
		'guids' => $wpdb->prepare("UPDATE {$wpdb->posts} SET guid = replace(guid, %s, %s)", $oldurl, $newurl),
	);

	foreach ($queries as $query_key => $query) {
		$result = $wpdb->query($query); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$results[$query_key] = $result;
	}
}
add_action( 'pt-ocdi/after_import', 'dc_ocdi_after_import_setup' );
wp_delete_post(1);

function dc_ocdi_before_widgets_import( $selected_import ) {
 delete_option('sidebars_widgets');
}
add_action( 'pt-ocdi/before_widgets_import', 'dc_ocdi_before_widgets_import' );