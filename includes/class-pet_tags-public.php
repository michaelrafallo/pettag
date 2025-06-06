<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://Framewrks.io
 * @since      1.0.0
 *
 * @package    Pet_tags
 * @subpackage Pet_tags/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pet_tags
 * @subpackage Pet_tags/public
 * @author     Framewrks <Framewrks.io>
 */
class Pet_tags_Publicxx {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pet_tags-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pet_tags-public.js', array( 'jquery' ), $this->version, false );

	}
    

    add_action( 'woocommerce_before_add_to_cart_button', 'cfwc_display_custom_field' );
	
	function cfwc_display_custom_field() {
		global $post;
    	$meta = get_post_meta($post->ID, 'pet_tags_meta', true);

		if( @$meta['enable'] ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/custom-fields.php';		
		}
	}


	// add_action('wp_footer', 'custom_footer');
	/*
	function custom_footer(){
		global $post;
		$meta = get_post_meta($post->ID, 'pet_tags_meta', true);

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/footer-script.php';
	}
	*/

	// https://pluginrepublic.com/add-custom-cart-item-data-in-woocommerce/

	/**
	 * Add custom cart item data
	 */
	// add_filter( 'woocommerce_add_cart_item_data', 'plugin_republic_add_cart_item_data', 10, 3 );
	function plugin_republic_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
		
		$size = $_POST['attribute_pa_size'];

		$pet_tags = $_POST['pet_tags']['size'][$size];
		if( isset( $pet_tags ) ) {
			$cart_item_data['pet_tags'] = $pet_tags;
		}

		$pet_name = $_POST['pet_name'];
		if( isset( $pet_name ) ) {
			$cart_item_data['pet_name'] = $pet_name;
		}

	 	return $cart_item_data;
	}

	/**
	 * Display custom item data in the cart
	 */
	// add_filter( 'woocommerce_get_item_data', 'plugin_republic_get_item_data', 10, 2 );
	function plugin_republic_get_item_data( $item_data, $cart_item_data ) {

		foreach ( $cart_item_data['pet_tags'] as $cart_item_k => $cart_item_v ) {
			foreach( $cart_item_v as $item_k => $item_v ) {
				if( $item_v ) {
					$item_data[] = array(
						'key'   => ucwords($cart_item_k).' Line '.$item_k,
						'value' => strtoupper($item_v)
					);					
				}
			}
		}

		if( isset($cart_item_data['pet_name']) ) {
			$item_data[] = array(
				'key'   => 'Pet Name',
				'value' => strtoupper( $cart_item_data['pet_name'] )
			);		


		}

		return $item_data;
	}

	/**
	 * Add custom meta to order
	 */
	// add_action( 'woocommerce_checkout_create_order_line_item', 'plugin_republic_checkout_create_order_line_item', 10, 4 );
	function plugin_republic_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
		
		if( isset( $values['pet_tags'] ) ) {
			foreach ( $values['pet_tags'] as $cart_item_k => $cart_item_v ) {
				foreach( $cart_item_v as $item_k => $item_v ) {
					if( $item_v ) {
						$item->add_meta_data(ucwords($cart_item_k).' Line '.$item_k, strtoupper($item_v), true);		
					}
				}
			}
		}

		if( isset( $values['pet_name'] ) ) {
			$item->add_meta_data('Pet Name', strtoupper($values['pet_name']), true);
		}

	}


	function dt_action_woocommerce_after_shop_loop_item() { 
		



	}
	         


}
