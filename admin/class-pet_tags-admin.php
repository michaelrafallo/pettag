<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://Framewrks.io
 * @since      1.0.0
 *
 * @package    Pet_tags
 * @subpackage Pet_tags/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pet_tags
 * @subpackage Pet_tags/admin
 * @author     Framewrks <Framewrks.io>
 */
class Pet_tags_Admin {

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
		 * defined in Pet_tags_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pet_tags_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pet_tags-admin.css', array(), $this->version, 'all' );

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
		 * defined in Pet_tags_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pet_tags_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pet_tags-admin.js', array( 'jquery' ), $this->version, false );

	}

	// add_filter( 'woocommerce_product_data_tabs', 'pet_tags_tab' );
	function pet_tags_tab( $tabs) {
		// Key should be exactly the same as in the class product_type

		$tabs['pet_tags'] = array(
			'label'	 => __( 'Pet Tags', 'wcpt' ),
			'target' => 'pet_tags_options',
			'class'  => array( 'show_if_pet_tags', 'show_if_variable' ),
		);

		return $tabs;
	}

	// https://jeroensormani.com/how-to-include-the-wordpress-media-selector-in-your-plugin/
	// add_action( 'woocommerce_product_data_panels', 'wcpt_pet_tags_options_product_tab_content' );
	function wcpt_pet_tags_options_product_tab_content() {
		global $post_id;

		$meta = get_post_meta($post_id, 'pet_tags_meta', true);
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings.php';
	}

	// add_action( 'admin_footer', 'media_selector_print_scripts' );
	function media_selector_print_scripts() {

		global $post;

		if( @$post->post_type == 'product' ) {
			$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/media.php';
		}
	}


	// add_action( 'save_post', 'save_post_product_function', 1 );
	function save_post_product_function( $post_id ) {
		if( isset($_POST['pet_tags']) ) {
			update_post_meta( $post_id, 'pet_tags_meta', $_POST['pet_tags'] );
		}
		if( isset($_POST['pet_tags_settings']) ) {
			update_post_meta( $post_id, 'pet_tags_settings', $_POST['pet_tags_settings'] );
		}
	}

	// add_action('admin_footer', 'wh_variable_bulk_admin_custom_js');
	function wh_variable_bulk_admin_custom_js() {

	    if ('product' != get_post_type()) :
	        return;
	    endif;

	    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/script.php';
	}

}