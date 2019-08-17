<?php
/**
 * @package Test Plugin
 */
/*
Plugin Name: A Test Plugin
Plugin URI: http://wordpress.org/plugins/test-plugin/
Description: This is a description. Demo for WordCamp.
Author: Carl Alberto
Version: 1.0.1
Author URI: https:/carlalberto.code.blog/
*/



/**
 * @since 0.1.0
 */
function admin_notice_example_activation_hook() {
    set_transient( 'admin-notice-example', true, 5 );
}
register_activation_hook( __FILE__, 'admin_notice_example_activation_hook' );

/**
 * Add Admin message here in the admin notification notices.
 */
function admin_notice_example_notice(){
    if( get_transient( 'admin-notice-example' ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>Plugin is activate! <strong>Nice!</strong></p>
        </div>
        <?php
        delete_transient( 'admin-notice-example' );
    }
}
add_action( 'admin_notices', 'admin_notice_example_notice' );

/**
 * This will create a table called test2.
 *
 * @return void
 */
function your_plugin_install() {
	global $wpdb;
	$your_db_name = $wpdb->prefix . 'test2';

	$sql = 'CREATE TABLE ' . $your_db_name . ' (
	`id` mediumint(9) NOT NULL AUTO_INCREMENT,
	`field_1` mediumtext NOT NULL,
	`field_2` varchar(255),
	UNIQUE KEY id (id)
	);';

	$wpdb->query( $sql );

}
register_activation_hook( __FILE__, 'your_plugin_install' );

/**
 * Deactivation Hook. This will delete the table test2.
 *
 * @return void
 */
function pluginprefix_deactivation() {
	global $wpdb;
	$your_db_name = $wpdb->prefix . 'test2';
	$sql          = 'DROP TABLE ' . $your_db_name . ';';
	$wpdb->query( $sql );

}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

////////////////////////////////////////////////// Sample filter

/**
 * This will allow you to filter or modify the title.
 */
function wpshout_filter_example($title) {
	return 'Filtered: '.$title;
}
// add_filter('the_title', 'wpshout_filter_example');


//////////////////////////////////////////////// Custom Post types

/**
 * Register Custom Post Type for Cars
 *
 * @return void
 */
function ctp_sample_plugin() {

	$labels = array(
		'name'                  => _x( 'Cars', 'Post Type General Name', 'carl-test-plugin' ),
		'singular_name'         => _x( 'Car', 'Post Type Singular Name', 'carl-test-plugin' ),
		'menu_name'             => __( 'Car Post Type', 'carl-test-plugin' ),
		'name_admin_bar'        => __( 'Cars', 'carl-test-plugin' ),
		'archives'              => __( 'Cars Archives', 'carl-test-plugin' ),
		'attributes'            => __( 'Cars Attributes', 'carl-test-plugin' ),
		'parent_item_colon'     => __( 'Parent Cars:', 'carl-test-plugin' ),
		'all_items'             => __( 'All Cars', 'carl-test-plugin' ),
		'add_new_item'          => __( 'Add New Car', 'carl-test-plugin' ),
		'add_new'               => __( 'Add New', 'carl-test-plugin' ),
		'new_item'              => __( 'New Car', 'carl-test-plugin' ),
		'edit_item'             => __( 'Edit Car', 'carl-test-plugin' ),
		'update_item'           => __( 'Update Car', 'carl-test-plugin' ),
		'view_item'             => __( 'View Car', 'carl-test-plugin' ),
		'view_items'            => __( 'View Car', 'carl-test-plugin' ),
		'search_items'          => __( 'Search Car', 'carl-test-plugin' ),
		'not_found'             => __( 'Not found', 'carl-test-plugin' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'carl-test-plugin' ),
		'featured_image'        => __( 'Featured Image', 'carl-test-plugin' ),
		'set_featured_image'    => __( 'Set featured image', 'carl-test-plugin' ),
		'remove_featured_image' => __( 'Remove featured image', 'carl-test-plugin' ),
		'use_featured_image'    => __( 'Use as featured image', 'carl-test-plugin' ),
		'insert_into_item'      => __( 'Insert into Car', 'carl-test-plugin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'carl-test-plugin' ),
		'items_list'            => __( 'Car list', 'carl-test-plugin' ),
		'items_list_navigation' => __( 'Car list navigation', 'carl-test-plugin' ),
		'filter_items_list'     => __( 'Filter Car list', 'carl-test-plugin' ),
	);
	$args   = array(
		'label'               => __( 'Car', 'carl-test-plugin' ),
		'description'         => __( 'Car Description', 'carl-test-plugin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'taxonomies'          => array( 'manufacturer', 'classification' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'cars', $args );

}
add_action( 'init', 'ctp_sample_plugin', 0 );

/**
 * Taxonomy for Car post types
 *
 * @return void
 */
function tax_car_manufacturer() {

	$labels = array(
		'name'                       => _x( 'Car Manufacturers', 'Taxonomy General Name', 'carl-test-plugin' ),
		'singular_name'              => _x( 'Car Manufacturer', 'Taxonomy Singular Name', 'carl-test-plugin' ),
		'menu_name'                  => __( 'Car Manufacturer', 'carl-test-plugin' ),
		'all_items'                  => __( 'All Car Manufacturers', 'carl-test-plugin' ),
		'parent_item'                => __( 'Parent Car Manufacturer', 'carl-test-plugin' ),
		'parent_item_colon'          => __( 'Parent Car Manufacturer:', 'carl-test-plugin' ),
		'new_item_name'              => __( 'New Car Manufacturer Name', 'carl-test-plugin' ),
		'add_new_item'               => __( 'Add New Car Manufacturer', 'carl-test-plugin' ),
		'edit_item'                  => __( 'Edit Car Manufacturer', 'carl-test-plugin' ),
		'update_item'                => __( 'Update Car Manufacturer', 'carl-test-plugin' ),
		'view_item'                  => __( 'View Car Manufacturer', 'carl-test-plugin' ),
		'separate_items_with_commas' => __( 'Separate Car Manufacturer with commas', 'carl-test-plugin' ),
		'add_or_remove_items'        => __( 'Add or remove Car Manufacturer', 'carl-test-plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'carl-test-plugin' ),
		'popular_items'              => __( 'Popular Car Manufacturer', 'carl-test-plugin' ),
		'search_items'               => __( 'Search Car Manufacturer', 'carl-test-plugin' ),
		'not_found'                  => __( 'Not Found', 'carl-test-plugin' ),
		'no_terms'                   => __( 'No Car Manufacturer', 'carl-test-plugin' ),
		'items_list'                 => __( 'Car Manufacturer list', 'carl-test-plugin' ),
		'items_list_navigation'      => __( 'Car Manufacturer list navigation', 'carl-test-plugin' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'car_manufacturer', array( 'cars' ), $args );

}
// add_action( 'init', 'tax_car_manufacturer', 0 );

/**
 * Return custom taxonomy for cars
 *
 * @return void
 */
function tax_car_classification() {

	$labels = array(
		'name'                       => _x( 'Car Class', 'Taxonomy General Name', 'carl-test-plugin' ),
		'singular_name'              => _x( 'Car Class', 'Taxonomy Singular Name', 'carl-test-plugin' ),
		'menu_name'                  => __( 'Car Class', 'carl-test-plugin' ),
		'all_items'                  => __( 'All Car Class', 'carl-test-plugin' ),
		'parent_item'                => __( 'Parent Car Class', 'carl-test-plugin' ),
		'parent_item_colon'          => __( 'Parent Car Class:', 'carl-test-plugin' ),
		'new_item_name'              => __( 'New Car Class Name', 'carl-test-plugin' ),
		'add_new_item'               => __( 'Add New Car Class', 'carl-test-plugin' ),
		'edit_item'                  => __( 'Edit Car Class', 'carl-test-plugin' ),
		'update_item'                => __( 'Update Car Class', 'carl-test-plugin' ),
		'view_item'                  => __( 'View Car Class', 'carl-test-plugin' ),
		'separate_items_with_commas' => __( 'Separate Car Class with commas', 'carl-test-plugin' ),
		'add_or_remove_items'        => __( 'Add or remove Car Class', 'carl-test-plugin' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'carl-test-plugin' ),
		'popular_items'              => __( 'Popular Car Class', 'carl-test-plugin' ),
		'search_items'               => __( 'Search Car Class', 'carl-test-plugin' ),
		'not_found'                  => __( 'Not Found', 'carl-test-plugin' ),
		'no_terms'                   => __( 'No Car Class', 'carl-test-plugin' ),
		'items_list'                 => __( 'Car Class list', 'carl-test-plugin' ),
		'items_list_navigation'      => __( 'Car Class list navigation', 'carl-test-plugin' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'car_class', array( 'cars' ), $args );

}
add_action( 'init', 'tax_car_classification', 0 );

/////////////////////////////////// Settings API

/**
 * Register Settings page functions. 
 *
 * @return void
 */
function cpd_settings_init() {
	// This initiates the settings API 
	register_setting( 'wporg', 'wporg_options' );
	// Adds a section in WP Settings page
	add_settings_section(
		'wporg_section_developers',
		__( 'Carl Plugin Demo.', 'wporg' ),
		'wporg_section_developers_cb',
		'wporg'
	);
	// This add the dropdown
	add_settings_field(
		'wporg_field_pill',
		__( 'Question Dropdown', 'wporg' ),
		'wporg_field_pill_cb',
		'wporg',
		'wporg_section_developers',
		[
			'label_for'         => 'wporg_field_pill',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		]
	);
	// This add the inputbox
	add_settings_field(
		'wporg_field_pill2',
		__( 'Inputbox', 'wporg' ),
		'wporg_field_pill_cb2', // Must match the CAllback function below
		'wporg',
		'wporg_section_developers',
		[
			'label_for'         => 'wporg_field_pill2',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		]
	);
}
add_action( 'admin_init', 'cpd_settings_init' );

/**
 * Add Description settings in the settings page
 *
 * @param [type] $args
 * @return void
 */
function wporg_section_developers_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow us with some description here.', 'wporg' ); ?></p>
	<?php
}

/**
 * This is the callback in the html part of the settings page.
 */
function wporg_field_pill_cb( $args ) {
	$options = get_option( 'wporg_options' );
	// output the field
	?>
	<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
	data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
	name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	>
	<option value="yes" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'yes', false ) ) : ( '' ); ?>>
	<?php esc_html_e( 'Yes', 'wporg' ); ?>
	</option>
	<option value="no" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'no', false ) ) : ( '' ); ?>>
	<?php esc_html_e( 'No', 'wporg' ); ?>
	</option>
	</select>

	<p class="description">
	<?php esc_html_e( 'Dropdown text', 'wporg' ); ?>
	</p>
	<?php
}

/**
 * Register field types. You can add here your dropdowns, inputboxes, selectbox, etc..
 *
 * @param [type] $args
 * @return void
 */
function wporg_field_pill_cb2( $args ) {
	$options = get_option( 'wporg_options' );
	?>
	<input id="<?php echo esc_attr( $args['label_for'] ); ?>"
	data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
	name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	value="<?php echo isset( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : ( '' ); ?>"
	>

	<p class="description">
	<?php echo esc_attr( $options[ $args['label_for'] ] ); ?>
	</p>
	<p class="description">
	<?php esc_html_e( 'Textbox description.', 'wporg' ); ?>
	</p>
	<?php
}

/**
 * Main wrapper for the html Options page
 *
 * @return void
 */
function wporg_options_page_html() {
	// Add user checks here to make sure a user's role and capability is allowed to edit options
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
	}

	settings_errors( 'wporg_messages' );
	?>
	<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
	<?php
	settings_fields( 'wporg' );
	do_settings_sections( 'wporg' );
	submit_button( 'Save Settings' );
	?>
	</form>
	</div>
	<?php
}

/**
 * Add menu item to the admin menu.
 *
 * @return void
 */
function wporg_options_page() {
	add_menu_page(
		'WP Plugin Settings Page',
		'WP test Settings',
		'manage_options',
		'wporg',
		'wporg_options_page_html'
	);
}
add_action( 'admin_menu', 'wporg_options_page' );

////////////////////////////////////////////////// Sample WP Query

/**
 * WP Query sample that queries our CPT cars
 *
 * @return void
 */
function showthis_template() {
	$args = array (
		'post_type'              => array( 'cars' ),
		'post_status'            => array( 'publish' ),
		'nopaging'               => true,
		'order'                  => 'ASC',
		'orderby'                => 'title',
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'car_manufacturer',
				'field'    => 'slug',
				'terms'    => 'honda',
			),
			array(
				'taxonomy' => 'car_class',
				'field'    => 'slug',
				'terms'    => 'sports',
			),
		),
	);
	$services = new WP_Query( $args );
	$q = '';

	if ( $services->have_posts() ) {
		while ( $services->have_posts() ) {
			$services->the_post();
			$q .= '<li>' . get_the_title() . '</li>';
		}
	} else {
		$q = 'Empty Data';
	}

	wp_reset_postdata();
	// return $q;
	echo $q;
}

add_shortcode( 'list_cars', 'showthis_template' );
// add_action( 'showthis', 'showthis_template' );

/**
 * Modify headers
 *
 * @param [type] $headers
 * @return void
 */
function add_header_xua( $headers ) {

	if ( ! is_admin() ) {
		$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
	}
	return $headers;
}
add_filter( 'wp_headers', 'add_header_xua' ); 

// Enqueue styles


