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
class Pet_tags_Public {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pet_tags-public.css', array(), date('YmdHis'), 'all' );

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
		wp_enqueue_script('jquery');
		 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pet_tags-public-imager11.js', array( 'jquery' ), date('YmdHis'), false );
		
	}

	// add_action( 'woocommerce_before_add_to_cart_button', 'cfwc_display_custom_field' );
	


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

		$pet_dob    = $_POST['pet_dob'];
		$check_date = strtotime($pet_dob) ? TRUE : FALSE;

		if( $check_date ) {
			$newdate = date("d/m/Y", strtotime($pet_dob));
			
			$cart_item_data['pet_dob'] = $newdate;
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
						'value' => str_replace('\\','', strtoupper( $item_v ))
					);					
				}
			}
		}

		if( isset($cart_item_data['pet_name']) ) {
			$item_data[] = array(
				'key'   => 'Pet Name',
				'value' => str_replace('\\','', strtoupper( $cart_item_data['pet_name'] ))
				
			);	
		}

		if( isset($cart_item_data['pet_dob']) ) {
			$item_data[] = array(
				
				'key'   => 'Birthday',
				'value' => $cart_item_data['pet_dob']
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
						$item->add_meta_data(ucwords($cart_item_k).' Line '.$item_k, str_replace('\\','', strtoupper($item_v)), true);		
					}
				}
			}
		}

		if( isset( $values['pet_name'] ) ) {
			$item->add_meta_data('Pet Name', str_replace('\\','', strtoupper($values['pet_name'])), true);
		}
		if( isset( $values['pet_dob'] ) ) {
			$item->add_meta_data('Birthday', strtoupper($values['pet_dob']), true);
		}

	}

    
	function cfwc_display_custom_field() {
		global $post;
    	$meta = get_post_meta($post->ID, 'pet_tags_meta', true);

		if( @$meta['enable'] ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/custom-fields.php';		
		}
	}

	function dt_action_woocommerce_after_shop_loop_item() { 
		global $woocommerce, $product, $post;

		if ($product->is_type( 'variable' )) {
		    $available_variations = wc_get_product_terms( $product->id, 'pa_colour', array( 'fields' => 'all' ) );
		    $default_attributes = $product->get_default_attributes();
		?>

		<div data-slug="<?php echo $variation->slug; ?>" data-pid="<?php echo $product->id; ?>" style="text-align: left;">
		<?php foreach( $available_variations as $variation ): 
			  $args = array(
			    'post_type'             => ['product_variation'],
			    'post_status'           => 'publish',
			    'fields' => 'ids',
			    'post_parent'           => $product->id,
			    'posts_per_page'        => 1,
			    'orderby' => 'title', 
			    'order'   => 'ASC', 
			  	'meta_query' => array(
			  		 'relation'    => 'AND',
			        array(
			            'key' => '_thumbnail_id',
			            'value' => '',
			            'compare' => '!='
			        ),
		        array(
			            'key' => 'attribute_pa_colour',
			            'value'    =>  [$variation->slug],
			            'compare' => 'IN'
			        ),
			    ),
			);
			$product_varations = new WP_Query($args);

			$pid = $product_varations->posts[0]->ID;
			?>

			<?php 
			// product_attribute_image
			// $attachment_id = get_term_meta($variation->term_id, 'product_attribute_image', true); 
			// wp_get_attachment_image($attachment_id)
			$color = str_replace(['-', '_', ' '], '', $variation->slug);

			/*
			echo '<pre>';
			print_R( @$default_attributes['pa_colour'] == @$variation->slug  );
			echo '</pre>';
			*/	

			$color = get_term_meta($variation->term_id, 'slctd_clr', true); 
			$display_type = get_term_meta($variation->term_id, 'display_type', true); 



			$img = get_the_post_thumbnail_url($product_varations->posts[0], [400, 400]);
			?>

			<a href="" class="attr-icon" title="<?php echo $variation->name; ?>" data-img="<?php echo $img; ?>">
				<?php $img = get_term_meta($variation->term_id, 'slctd_img', true); ?>
				<?php  
					/*
					$pe  = pathinfo($img, PATHINFO_EXTENSION); 
					$new_img = str_replace('.'.$pe, '-100x100.'.$pe.'.webp', $img);
					$new_img_c = str_replace(site_url().'/', '', $new_img);

					if( file_exists( $new_img_c ) ){
					    $img = $new_img;
					}
	
					$new_img = $img.'.webp';
					$new_img_c = str_replace(site_url().'/', '', $new_img);
					if( file_exists( $new_img_c ) ){
					    $img = $new_img;
					}
					*/
				?>

				<?php if( $display_type == 1 ): ?>
				<img alt="<?php echo $variation->name; ?>" 
				src="<?php echo $img; ?>" 
				data-lazy-type="image" 
				data-src="<?php echo $img; ?>" 
				width="26" 
				height="26" style="background:#fff;">
				<?php endif; ?>

				<?php if( $display_type == 2 ): ?>
					<div class="attr-bg" style="height:26px;width:26px;background: <?php echo $color; ?>"></div>
				<?php endif; ?>

			</a>

		<?php endforeach; ?>	
		</div>

		<?php
		}


	}


}
// REDAUS
define('REDDINGO_USERNAME', get_option( 'reddingo_username' ) );
define('REDDINGO_PASSWORD', get_option( 'reddingo_password' ) );
define('AUDTORG', get_option( 'reddingo_audtorg' ) );
define('IDCUST', get_option( 'reddingo_idcust' ) );

$reddingo_url = 'testing/api/';
if( get_option( 'reddingo_live' ) == 'yes' ) {
	$reddingo_url = 'api/';
}
define('REDDINGO_URL', 'https://tags.reddingo.com/'.$reddingo_url);		


function custom_footer_wk(){
		global $post;
		global $product;
		$meta = get_post_meta($post->ID, 'pet_tags_meta', true);
		
		$variations = $product->get_available_variations();
		$i=1;
		foreach ( $variations as $variation ) {
			$thumb['full_src'.$i] = $variation['image']['full_src'];
			$attr['attributes'.$i] = @$variation['attributes']['attribute_pa_colour'];
			$attr1['attributes'.$i] = $variation['attributes']['attribute_pa_size'];
			$i++;
		}
		
		$getdata = require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/footer-script.php';
	}

add_shortcode('Pet-Tag-2Images', 'custom_footer_wk');

function cfwc_display_custom_fieldx() {
	
	global $post;

	$meta = get_post_meta($post->ID, 'pet_tags_meta', true); 
	
	if( @$meta['enable'] ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/custom-fields.php';		
	}
}

add_shortcode('Engrave-fields', 'cfwc_display_custom_fieldx');

//----------------------------------------------------------------------------------------

function dd($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	exit;
}

//----------------------------------------------------------------------------------------

function getClient() {

    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
    $client->setAuthConfig( plugin_dir_path( __DIR__ ).'plugins/sheet/credentials.json' );
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    $tokenPath = plugin_dir_path( __DIR__ ).'plugins/sheet/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    return $client;
}

add_action( 'woocommerce_order_status_changed', 'pet_tag_woocommerce_order_status_changed',  1, 1  );
function pet_tag_woocommerce_order_status_changed( $order_id ) {
	/*
		pending
		processing
		completed
		on-hold
		cancelled
		refunded
		failed
		wcf-main-order
	*/
	// Add in spread sheet from first column
	// Website | Reddingo Order ID

	$order = wc_get_order( $order_id );

	if( ! get_post_meta( $order_id, 'reddingo_submitted', true) && in_array($order->get_status(), ['pending', 'processing', 'completed']) ) {

		$reddingo_response = post_data_reddingo_api($order_id);
		$reddingo_response = json_decode($reddingo_response);

		if( @$reddingo_response->order ) {
			update_post_meta( $order_id, 'reddingo_submitted', date('Y-m-d H:i:s') );
			update_post_meta( $order_id, 'reddingo_order_id', $reddingo_response->order );
		}
	}

	post_data_spreadsheet_api($order_id);
}

function pettags_log($log_msg, $filename='') {

	if( is_array($log_msg) ) {
		$log_msg = json_encode($log_msg);
	}

	$log_msg = date('Y-m-d H:i:s').' => '. $log_msg;

    $log_filename = plugin_dir_path( dirname( __FILE__ ) ) ."logs";
    
    if (!file_exists($log_filename))
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/'.$filename. '.log';
    file_put_contents($log_file_data, $log_msg . "\n\n", FILE_APPEND);
}

function post_data_spreadsheet_api($order_id) {

	$order = wc_get_order( $order_id );

	foreach ($order->get_items() as $item_id => $item) {

		$product = wc_get_product($item->get_product_id());
		$item_sku = $product->get_sku();

		$args = array(
		    'post_id' => $order_id,
		    'orderby' => 'comment_ID',
		    'order'   => 'DESC',
		    'type'    => 'order_note',
			'approve' => 'approve',
		    'number'  => 5
		);

		remove_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ), 10, 1 );
		$notes = get_comments( $args );
		add_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ), 10, 1 );

		$post_data = [
		    'Website'                      => $_SERVER['HTTP_HOST'],
		    'reddingo_order_id'            => get_post_meta($order_id, 'reddingo_order_id', true),
		    'order_id' 					   => $order_id,
		    'order_number' 				   => $order_id,
		    'date' 						   => date('Y-m-d H:i:s'),
		    'status' 				       => $order->get_status(),
		    'ReddingoStatus' 			   => 'shipped',
		    'shipping_total' 			   => $order->get_shipping_total(),
		    'shipping_tax_total' 		   => $order->get_shipping_tax(),
		    'fee_total' 				   => $order->get_subtotal(),
		    'fee_tax_total' 			   => $order->get_total_tax(),
		    'tax_total' 				   => $order->get_total_tax(),
		    'discount_total' 			   => $order->get_discount_total(),
		    'order_total' 				   => $order->get_total(),
		    'refunded_total' 			   => $order->get_total_refunded(),
		    'order_currency' 			   => $order->get_currency(),
		    'payment_method' 			   => $order->get_payment_method(),
		    'shipping_method' 			   => $order->get_shipping_method(),
		    'customer_id' 				   => $order->get_user_id(),
		    'billing_first_name' 		   => $order->get_billing_first_name(),
		    'billing_last_name' 		   => $order->get_billing_last_name(),
		    'billing_company' 			   => $order->get_billing_company(),
		    'billing_email' 			   => $order->get_billing_email(),
		    'billing_phone' 			   => $order->get_billing_phone(),
		    'billing_address_1' 		   => $order->get_billing_address_1(),
		    'billing_address_2' 		   => $order->get_billing_address_2(),
		    'billing_postcode' 			   => $order->get_billing_postcode(),
		    'billing_city' 				   => $order->get_billing_city(),
		    'billing_state' 			   => $order->get_billing_state(),
		    'billing_country' 			   => $order->get_billing_country(),

		    'shipping_first_name' 		   => $order->get_shipping_first_name() ? $order->get_shipping_first_name() : $order->get_billing_first_name(),
		    'shipping_last_name' 		   => $order->get_shipping_last_name() ? $order->get_shipping_last_name() : $order->get_shipping_last_name(),
		    'shipping_address_1' 		   => $order->get_shipping_address_1() ? $order->get_shipping_address_1() : $order->get_shipping_address_1(),
		    'shipping_address_2'		   => $order->get_shipping_address_2() ? $order->get_shipping_address_2() : $order->get_shipping_address_2(),
		    'shipping_postcode' 		   => $order->get_shipping_postcode() ? $order->get_shipping_postcode() : $order->get_shipping_postcode(),
		    'shipping_city' 			   => $order->get_shipping_city() ? $order->get_shipping_city() : $order->get_shipping_city(),
		    'shipping_state' 			   => $order->get_shipping_state() ? $order->get_shipping_state() : $order->get_shipping_state(),
		    'shipping_country' 			   => $order->get_shipping_country() ? $order->get_shipping_country() : $order->get_shipping_country(),
		    'shipping_company' 			   => $order->get_shipping_company() ? $order->get_shipping_company() : $order->get_shipping_company(),

		    'customer_note' 			   => $order->get_customer_note(),
		    'item_id' 					   => $item_id,
		    'item_product_id'		  	   => $item->get_product_id(),
		    'item_name' 				   => $item->get_name(),
		    'item_sku' 					   => $product->get_sku(),
		    'item_quantity' 			   => $item->get_quantity(),
		    'item_subtotal' 			   => $item->get_subtotal(),
		    'item_subtotal_tax'	 	       => $item->get_subtotal_tax(),
		    'item_total' 				   => $item->get_total(),
		    'item_total_tax' 			   => $item->get_total_tax(),
		    'item_refunded' 			   => $order->get_total_refunded_for_item( $item_id ),
		    'item_refunded_qty' 		   => $order->get_qty_refunded_for_item( $item_id ),
		    'item_meta' 				   => '',
		    'shipping_items' 			   => '',
		    'fee_items' 				   => '',
		    'tax_items' 				   => '',
		    'coupon_items' 				   => '',
		    'order_notes' 				   => implode('|', wp_list_pluck($notes, 'comment_content')),
		    'download_permissions_granted' => $product->is_downloadable() ? 1 : 0,
		    'EngraveFrontL1' 			   => $item->get_meta( 'Front Line 1', true ),
		    'EngraveFrontL2' 			   => $item->get_meta( 'Front Line 2', true ),
		    'EngraveFrontL3' 			   => $item->get_meta( 'Front Line 3', true ),
		    'EngraveFrontL4' 			   => $item->get_meta( 'Front Line 4', true ),
		    'EngraveFrontL5' 			   => $item->get_meta( 'Front Line 5', true ),
		    'EngraveFrontL6' 			   => $item->get_meta( 'Front Line 6', true ),
		    'EngraveBackL1' 			   => $item->get_meta( 'Back Line 1', true ),
		    'EngraveBackL2' 			   => $item->get_meta( 'Back Line 2', true ),
		    'EngraveBackL3' 			   => $item->get_meta( 'Back Line 3', true ),
		    'EngraveBackL4' 			   => $item->get_meta( 'Back Line 4', true ),
		    'EngraveBackL5' 			   => $item->get_meta( 'Back Line 5', true ),
		    'EngraveBackL6' 			   => $item->get_meta( 'Back Line 6', true ),
		    'PetName' 				       => $item->get_meta( 'Pet Name', true ),
		    'Birthday' 					   => $item->get_meta( 'Birthday', true ),
		];

		$data = send_spreadsheet_api($post_data);

		pettags_log($post_data, 'google_sheet');
		pettags_log( (array)$data, 'google_sheet_response');

	}

	update_post_meta( $order_id, 'google_sheet_imported', 1 );
	update_post_meta( $order_id, 'google_sheet_imported_date', date('Y-m-d H:i:s') );

}

function post_data_reddingo_api($order_id) {

	$data        = array();
	$order       = wc_get_order( $order_id );
	$user_id     = $order->get_user_id();
	$order_total = $order->get_total();

	$url = REDDINGO_URL.'stores/submit/';

	$red_tags = send_tag_api(REDDINGO_URL.'stores/tags/', [], 'GET');
	$red_tags = json_decode($red_tags, true);

	foreach ($order->get_items() as $item_id => $item) {
	
		$pid = $item->get_variation_id() ? $item->get_variation_id() : $item->get_product_id();
		$product = wc_get_product($pid);
		$item_sku = $product->get_sku();

		$frontline = $backline = array();

		foreach( range(1, 6) as $r ) {
			$frontline[] = $item->get_meta( 'Front Line '. $r, true );
			$backline[]  = $item->get_meta( 'Back Line '. $r, true );
		}

		$frontline = array_values(array_filter($frontline));
		$backline  = array_values(array_filter($backline));

		$size = strtoupper(substr($item->get_meta( 'pa_size', true ), 0, 1));

		$tag_key = array_keys(array_combine(array_keys($red_tags), array_column($red_tags, 'shortCode')), $item_sku);
		if( count($tag_key) == 0 ) {
			$shortcode = implode('', array_filter([$item_sku, $size]) );
			$tag_key = array_keys(array_combine(array_keys($red_tags), array_column($red_tags, 'shortCode')), $shortcode);			
		}

		if( !$frontline && $backline ) {
			$frontline = $backline;
			$backline  = [];
		}

		$post_data = array (
		  'AUDTORG' 					=> AUDTORG,
		  'IDCUST' 						=> IDCUST,
		  'ownerFirstName' 				=> $order->get_billing_first_name(),
		  'ownerLastName' 				=> $order->get_billing_last_name(),
		  'petName' 					=> $item->get_meta( 'Pet Name', true ),
		  'ownerPhone' 					=> $order->get_billing_phone(),
		  'ownerEmail' 					=> $order->get_billing_email(),
		  'ownerAddress' 				=> $order->get_billing_address_1(),
		  'ownerSuburbTownCity' 	 	=> $order->get_billing_city(),
		  'ownerStateProvinceRegion' 	=> $order->get_billing_state(),
		  'ownerPostZipCode' 		 	=> $order->get_billing_postcode(),
		  'ownerCountryCode' 		 	=> $order->get_billing_country(),
		  'receiver' 				 	=> implode(' ', array_filter([$order->get_billing_first_name(), $order->get_billing_last_name()]) ),
		  'receiverAddress' 		 	=> $order->get_billing_address_1(),
		  'receiverSuburbTownCity' 		=> $order->get_billing_city(),
		  'receiverStateProvinceRegion' => $order->get_billing_state(),
		  'receiverPostZipCode' 		=> $order->get_billing_postcode(),
		  'receiverCountryCode' 		=> $order->get_billing_country(),
		  'customerMessage' 			=> $order->get_customer_note(),
		  'quantity' 					=> $item->get_quantity(),
		  // 'layout' 						=> NULL,
		  'tag' 						=> @$tag_key[0],
		  'font' 						=> 'engrave',
		  'doubleSided' 				=> ($frontline && $backline) ? true : false,
		  'noEngraving' 				=> ($frontline || $backline) ? false : true,
		  'engravingLines' 				=> $frontline,
		  'engravingLines2' 			=> $backline,
		  'sendToStore' 				=> false,
		  'reference' 					=> $order_id,
		  'emailStatusUpdates' 			=> true,
		  'draft' 						=> false,
		);

		$data = send_tag_api($url, $post_data);

		pettags_log( $post_data, 'reddingo');
		pettags_log( (array)$data, 'reddingo_response');

	}

	return $data;
}

add_action( 'woocommerce_order_status_processing', 'pet_tag_checkout_order_processing',  1, 1  );
function pet_tag_checkout_order_processing( $order_id ) {

}	   

//----------------------------------------------------------------------------------------

add_action('init', function(){
    

    if( @$_GET['gheet-import'] ) {

		$orders = get_posts( array(
			'post_type'   => 'shop_order',
			'numberposts' => -1,
			'fields'      => 'ids',
			'orderby'     => 'ID', 
			'order'       => 'ASC', 
			'post_status' => array_keys( wc_get_order_statuses() ),
			 'meta_query' => array(
		       array(
		           'key'     => 'google_sheet_imported_date',
		           'compare' => 'NOT EXISTS',
		       )
	  		)
		));

		foreach ($orders as $order_id) {
			post_data_spreadsheet_api($order_id);
		}

		dd($orders);
    }

});

function send_tag_api($url, $post_data, $method = 'POST') {

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL 			=> $url,
		CURLOPT_RETURNTRANSFER  => true,
		CURLOPT_ENCODING 		=> '',
		CURLOPT_MAXREDIRS       => 10,
		CURLOPT_TIMEOUT 		=> 0,
		CURLOPT_FOLLOWLOCATION  => true,
		CURLOPT_HTTP_VERSION 	=> CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST   => $method,
		CURLOPT_POSTFIELDS 	 	=> json_encode($post_data),
		CURLOPT_HTTPHEADER 	 	=> array(
			'Authorization: Basic '.base64_encode( implode(':', [REDDINGO_USERNAME, REDDINGO_PASSWORD])),
			'Content-Type: application/json'
		),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	return $response;

}

function send_spreadsheet_api($post_data) {

	require plugin_dir_path( __DIR__ ).'plugins/sheet/vendor/autoload.php' ;

	$client = getClient();
	$service = new Google_Service_Sheets($client);

	$spreadsheetId = get_option( 'pet_tags_spreadsheet_id' );
	$range = get_option( 'pet_tags_spreadsheet_range' );

	$values[] = array_values($post_data);

	$body = new Google_Service_Sheets_ValueRange([
	    'values' => $values 
	]);

	$params = [
	    'valueInputOption' => 'USER_ENTERED'
	];

	return $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

}

add_filter( 'woocommerce_get_sections_products', 'wcslider_add_section' );
function wcslider_add_section( $sections ) {
	
	$sections['pet_tags_settings'] = __( 'Pet Tags API', 'text-domain' );
	return $sections;
	
}

/**
 * Add settings to the specific section we created before
 */
add_filter( 'woocommerce_get_settings_products', 'pet_tags_settings_all_settings', 10, 2 );
function pet_tags_settings_all_settings( $settings, $current_section ) {
	/**
	 * Check the current section is what we want
	 **/
	if ( $current_section == 'pet_tags_settings' ) {

		$pet_tags_settings = array();

		// Add Title to the Settings
		$pet_tags_settings[] = array( 
			'name' => __( 'Pet Tags API Settings', 'text-domain' ), 
			'type' => 'title', 
			'desc' => __( 'The following options are used to configure Pet tags API', 'text-domain' ), 
			'id' => 'pet_tags_settings' 
		);

		$pet_tags_settings[] = array(
			'name'     => __( 'Spread Sheet ID', 'text-domain' ),
			'id'       => 'pet_tags_spreadsheet_id',
			'type'     => 'text',
		);
		$pet_tags_settings[] = array(
			'name'     => __( 'Spread Sheet Range', 'text-domain' ),
			'id'       => 'pet_tags_spreadsheet_range',
			'type'     => 'text',
		);


		$pet_tags_settings[] = array(
			'name'     => __( 'Reddingo', 'text-domain' ),
			'id'       => 'reddingo_live',
			'type'     => 'checkbox',
			'css'      => 'min-width:300px;',
			'desc'     => __( 'Enable LIVE API', 'text-domain' ),
		);
		$pet_tags_settings[] = array(
			'name'     => __( 'Reddingo Username', 'text-domain' ),
			'id'       => 'reddingo_username',
			'type'     => 'text',
		);
		$pet_tags_settings[] = array(
			'name'     => __( 'Reddingo Password', 'text-domain' ),
			'id'       => 'reddingo_password',
			'type'     => 'text',
		);
		$pet_tags_settings[] = array(
			'name'     => __( 'AUDTORG', 'text-domain' ),
			'id'       => 'reddingo_audtorg',
			'type'     => 'text',
		);
		$pet_tags_settings[] = array(
			'name'     => __( 'IDCUST', 'text-domain' ),
			'id'       => 'reddingo_idcust',
			'type'     => 'text',
		);


		$pet_tags_settings[] = array( 
			'type' => 'sectionend', 
			'id' => 'pet_tags_settings' 
		);

		return $pet_tags_settings;
	
	/**
	 * If not, return the standard settings
	 **/
	} else {
		return $settings;
	}
}
