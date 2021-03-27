<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       hr-on.com
 * @since      1.0.0
 *
 * @package    Prices
 * @subpackage Prices/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Prices
 * @subpackage Prices/admin
 * @author     Baldur <baldur.sveinsson@hr-on.com>
 */
class Prices_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/prices-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/prices-admin.js', array( 'jquery' ), $this->version, false );

	}







}



include_once('updater.php');


if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
	$config = array(
		'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
		'proper_folder_name' => 'prices', // this is the name of the folder your plugin lives in
		'api_url' => 'https://api.github.com/repos/baldurarge/HRON-Prices', // the GitHub API url of your GitHub repo
		'raw_url' => 'https://raw.github.com/baldurarge/HRON-Prices/master', // the GitHub raw url of your GitHub repo
		'github_url' => 'https://github.com/baldurarge/HRON-Prices.git', // the GitHub url of your GitHub repo
		'zip_url' => 'https://github.com/baldurarge/HRON-Prices/zipball/master', // the zip url of the GitHub repo
		'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
		'requires' => '3.0', // which version of WordPress does your plugin require?
		'tested' => '5.7', // which version of WordPress is your plugin tested up to?
		'readme' => 'README.md', // which file to use as the readme for the version number
		'access_token' => '4a50e029436871aa067b7db01ae4698d9f5d4dc5', // Access private repositories by authorizing under Plugins > GitHub Updates when this example plugin is installed
	);
	new WP_GitHub_Updater($config);
}



function price_admin_page_add() {


	add_menu_page(
        'Prices',
        'Prices',
        'read',
        'prices',
        '',
        'dashicons-admin-home',
        1
    );


	// $link_our_new_CPT = 'edit.php?post_type=product';

	// add_menu_page(
	// 	"Products",
	// 	"Prices", 
	// 	"edit_posts",
	// 	$link_our_new_CPT,
	// 	null,
	// 	null,
	// 	3
	// );

	// add_submenu_page(
	// 	$link_our_new_CPT,
	// 	'Products',
	// 	'products',
	// 	'edit_posts',
	// 	$link_our_new_CPT
	// );

	// add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null )

	// add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )

	// add_menu_page(
	// 	__( 'Prices', 'my-textdomain' ),
	// 	__( 'Products', 'my-textdomain' ),
	// 	'manage_options',
	// 	'prices-page',
	// 	'my_admin_page_contents',
	// 	'dashicons-schedule',
	// 	3
	// );

	

	// add_submenu_page(
	// 	'edit.php',
	// 	'Genre',
	// 	'Genre',
	// 	'manage_options',
	// 	'edit-tags.php?taxonomy=genre'
	// );

	// add_submenu_page(
	// 	'prices-page',
	// 	'products',
	// 	'products',
	// 	'manage_options',
	// 	'products',
	// 	'my_admin_page_contents_products'
	// );

	// Create submenu with href to view custom_plugin_post_type
	// add_submenu_page(
	// 	'prices-page',
	// 	'products',
	// 	'products',
	// 	'manage_options',
	// 	$link_our_new_CPT
	// );



	// add_menu_page('MyPlugin', 'MyPlugin', 'manage_options', 'myPluginSlug', 'callback_render_plugin_menu');

	// add_menu_page(
	// 	'Products',
	// 	'Products',
	// 	'manage_options',
	// 	$link_our_new_CPT,
	// 	'dashicons-schedule',
	// 	3
	// );
}

function my_admin_page_contents() {
	include('partials/prices-admin-display.php');
}


add_action( 'admin_menu', 'price_admin_page_add' );



// Register Custom Post Type product
function create_product_cpt() {

	$labels = array(
		'name' => _x( 'products', 'Post Type General Name', 'product' ),
		'singular_name' => _x( 'product', 'Post Type Singular Name', 'product' ),
		'menu_name' => _x( 'products', 'Admin Menu text', 'product' ),
		'name_admin_bar' => _x( 'product', 'Add New on Toolbar', 'product' ),
		'archives' => __( 'product Archives', 'product' ),
		'attributes' => __( 'product Attributes', 'product' ),
		'parent_item_colon' => __( 'Parent product:', 'product' ),
		'all_items' => __( 'All products', 'product' ),
		'add_new_item' => __( 'Add New product', 'product' ),
		'add_new' => __( 'Add New', 'product' ),
		'new_item' => __( 'New product', 'product' ),
		'edit_item' => __( 'Edit product', 'product' ),
		'update_item' => __( 'Update product', 'product' ),
		'view_item' => __( 'View product', 'product' ),
		'view_items' => __( 'View products', 'product' ),
		'search_items' => __( 'Search product', 'product' ),
		'not_found' => __( 'Not found', 'product' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'product' ),
		'featured_image' => __( 'Featured Image', 'product' ),
		'set_featured_image' => __( 'Set featured image', 'product' ),
		'remove_featured_image' => __( 'Remove featured image', 'product' ),
		'use_featured_image' => __( 'Use as featured image', 'product' ),
		'insert_into_item' => __( 'Insert into product', 'product' ),
		'uploaded_to_this_item' => __( 'Uploaded to this product', 'product' ),
		'items_list' => __( 'products list', 'product' ),
		'items_list_navigation' => __( 'products list navigation', 'product' ),
		'filter_items_list' => __( 'Filter products list', 'product' ),
	);
	$args = array(
		'label' => __( 'product', 'product' ),
		'description' => __( 'HR-ON Products', 'product' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'custom-fields', 'thumbnail'),
		'taxonomies' => array(),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => 'prices',
		'menu_position' => 1,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'product', $args );

}
add_action( 'init', 'create_product_cpt', 0 );



// Register Custom Post Type addon
function create_addon_cpt() {

	$labels = array(
		'name' => _x( 'addons', 'Post Type General Name', 'addon' ),
		'singular_name' => _x( 'addon', 'Post Type Singular Name', 'addon' ),
		'menu_name' => _x( 'addons', 'Admin Menu text', 'addon' ),
		'name_admin_bar' => _x( 'addon', 'Add New on Toolbar', 'addon' ),
		'archives' => __( 'addon Archives', 'addon' ),
		'attributes' => __( 'addon Attributes', 'addon' ),
		'parent_item_colon' => __( 'Parent addon:', 'addon' ),
		'all_items' => __( 'All addons', 'addon' ),
		'add_new_item' => __( 'Add New addon', 'addon' ),
		'add_new' => __( 'Add New', 'addon' ),
		'new_item' => __( 'New addon', 'addon' ),
		'edit_item' => __( 'Edit addon', 'addon' ),
		'update_item' => __( 'Update addon', 'addon' ),
		'view_item' => __( 'View addon', 'addon' ),
		'view_items' => __( 'View addons', 'addon' ),
		'search_items' => __( 'Search addon', 'addon' ),
		'not_found' => __( 'Not found', 'addon' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'addon' ),
		'featured_image' => __( 'Featured Image', 'addon' ),
		'set_featured_image' => __( 'Set featured image', 'addon' ),
		'remove_featured_image' => __( 'Remove featured image', 'addon' ),
		'use_featured_image' => __( 'Use as featured image', 'addon' ),
		'insert_into_item' => __( 'Insert into addon', 'addon' ),
		'uploaded_to_this_item' => __( 'Uploaded to this addon', 'addon' ),
		'items_list' => __( 'addons list', 'addon' ),
		'items_list_navigation' => __( 'addons list navigation', 'addon' ),
		'filter_items_list' => __( 'Filter addons list', 'addon' ),
	);
	$args = array(
		'label' => __( 'addon', 'addon' ),
		'description' => __( 'HR-ON Addons', 'addon' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'custom-fields'),
		'taxonomies' => array(),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => 'prices',
		'menu_position' => 1,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'addon', $args );

}
add_action( 'init', 'create_addon_cpt', 0 );


// Register Custom Post Type Support
function create_support_cpt() {

	$labels = array(
		'name' => _x( 'supports', 'Post Type General Name', 'support' ),
		'singular_name' => _x( 'Support', 'Post Type Singular Name', 'support' ),
		'menu_name' => _x( 'supports', 'Admin Menu text', 'support' ),
		'name_admin_bar' => _x( 'Support', 'Add New on Toolbar', 'support' ),
		'archives' => __( 'Support Archives', 'support' ),
		'attributes' => __( 'Support Attributes', 'support' ),
		'parent_item_colon' => __( 'Parent Support:', 'support' ),
		'all_items' => __( 'All supports', 'support' ),
		'add_new_item' => __( 'Add New Support', 'support' ),
		'add_new' => __( 'Add New', 'support' ),
		'new_item' => __( 'New Support', 'support' ),
		'edit_item' => __( 'Edit Support', 'support' ),
		'update_item' => __( 'Update Support', 'support' ),
		'view_item' => __( 'View Support', 'support' ),
		'view_items' => __( 'View supports', 'support' ),
		'search_items' => __( 'Search Support', 'support' ),
		'not_found' => __( 'Not found', 'support' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'support' ),
		'featured_image' => __( 'Featured Image', 'support' ),
		'set_featured_image' => __( 'Set featured image', 'support' ),
		'remove_featured_image' => __( 'Remove featured image', 'support' ),
		'use_featured_image' => __( 'Use as featured image', 'support' ),
		'insert_into_item' => __( 'Insert into Support', 'support' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Support', 'support' ),
		'items_list' => __( 'supports list', 'support' ),
		'items_list_navigation' => __( 'supports list navigation', 'support' ),
		'filter_items_list' => __( 'Filter supports list', 'support' ),
	);
	$args = array(
		'label' => __( 'Support', 'support' ),
		'description' => __( 'HR-ON Support', 'support' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'custom-fields'),
		'taxonomies' => array(),
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => 'prices',
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'support', $args );

}
add_action( 'init', 'create_support_cpt', 0 );




if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_605b129835d0e',
		'title' => 'Addons',
		'fields' => array(
			array(
				'key' => 'field_605b4628f57d1',
				'label' => 'Different price for each product?',
				'name' => 'different_price_for_each_product',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_605b46f9be9d2',
				'label' => 'Default price group',
				'name' => 'default_price_group',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b4628f57d1',
							'operator' => '!=',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_605b12a6417be',
						'label' => 'price',
						'name' => 'price',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_605b4628f57d1',
									'operator' => '!=',
									'value' => '1',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_605b44e4bae7a',
						'label' => 'from price?',
						'name' => 'from_price',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_605b4628f57d1',
									'operator' => '!=',
									'value' => '1',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),
			array(
				'key' => 'field_605b46a7f57d5',
				'label' => 'Recruit price group',
				'name' => 'recruit_price_group',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b4628f57d1',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_605b465cf57d3',
						'label' => 'Recruit price',
						'name' => 'recruit_price',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_605b4669f57d4',
						'label' => 'Is it a from price?',
						'name' => 'recruit_from_price',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),
			array(
				'key' => 'field_605b4725be9d3',
				'label' => 'Staff price group',
				'name' => 'staff_price_group',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b4628f57d1',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_605b4725be9d4',
						'label' => 'Staff price',
						'name' => 'staff_price',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_605b4725be9d5',
						'label' => 'Is it a from price?',
						'name' => 'staff_from_price',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),
			array(
				'key' => 'field_605b12b0417bf',
				'label' => 'Featured',
				'name' => 'featured',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_605b12c9417c0',
				'label' => 'Icon',
				'name' => 'icon',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b12b0417bf',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_605b12ed417c1',
				'label' => 'Included in product',
				'name' => 'included_in_product',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'Recruit' => 'Recruit',
					'Staff' => 'Staff',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'addon',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_605b0d53091c0',
		'title' => 'Products - main content',
		'fields' => array(
			array(
				'key' => 'field_605b0dd1f66f3',
				'label' => 'ID',
				'name' => 'url_id',
				'type' => 'text',
				'instructions' => 'The unique Id that is accessable through # in the URL. for example: #recruit',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_605b0d59f66f1',
				'label' => 'List of includes',
				'name' => 'list_of_includes',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_605b0d82f66f2',
						'label' => 'Include',
						'name' => 'include',
						'type' => 'text',
						'instructions' => 'A item that is included in this product. Displayed on the prices landing page in the cards',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_605b0e39f66f5',
				'label' => 'Custom text',
				'name' => 'custom_text',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_605b0a9cc86b5',
		'title' => 'Products - Sidebar',
		'fields' => array(
			array(
				'key' => 'field_605b1088dfaf9',
				'label' => 'Type of product',
				'name' => 'type_of_product',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'Recruit' => 'Recruit',
					'Staff' => 'Staff',
					'Custom' => 'Custom',
				),
				'allow_custom' => 0,
				'default_value' => array(
				),
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_605b0aac60d63',
				'label' => 'Price per user',
				'name' => 'price_per_user',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '==',
							'value' => 'Staff',
						),
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '!=',
							'value' => 'Custom',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_605b10dccb9c4',
				'label' => 'Price per Job posting',
				'name' => 'price_per_jobposting',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '==',
							'value' => 'Recruit',
						),
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '!=',
							'value' => 'Custom',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_605b0b0360d64',
				'label' => 'Min price',
				'name' => 'min_price',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '!=empty',
						),
						array(
							'field' => 'field_605b1088dfaf9',
							'operator' => '!=',
							'value' => 'Custom',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	acf_add_local_field_group(array(
		'key' => 'group_605b1356cef93',
		'title' => 'Support',
		'fields' => array(
			array(
				'key' => 'field_605b135b16368',
				'label' => 'Price',
				'name' => 'price',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_605b136616369',
				'label' => 'List of includes',
				'name' => 'list_of_includes',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_605b13721636a',
						'label' => 'include',
						'name' => 'include',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'support',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	endif;