<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       hr-on.com
 * @since      1.0.0
 *
 * @package    Prices
 * @subpackage Prices/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Prices
 * @subpackage Prices/public
 * @author     Baldur <baldur.sveinsson@hr-on.com>
 */
class Prices_Public {

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
		 * defined in Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/prices-public.css', array(), $this->version, 'all' );

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
		 * defined in Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/prices-public.js', array( 'jquery' ), $this->version, false );

	}


}



function preprint($item){
	echo '<pre>';
	var_dump($item);
	echo '</pre>';
}



// Create Shortcode new_prices
// Shortcode: [new_prices language="danish"]
function create_newprices_shortcode($atts) {
	require_once('includes/product.php');
	require_once('includes/support.php');
	require_once('includes/addon.php');

	$atts = shortcode_atts(
		array(
			'language' => 'danish',
		),
		$atts,
		'new_prices'
	);

	$language = $atts['language'];


	// ANCHOR products fetching
	$products = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page'=>-1,
		'orderby' => 'order',
		'order' => 'ASC'
	  );

	$recruit = null;
	$staff = null;
	$suite = null;
	$custom = null;

	$productLoop = query_posts($products);
	wp_reset_query();

	
	
	foreach ($productLoop as $key => $value) {
		if($value->post_title === "HR-ON Recruit"){
			$recruit = $value;
		}
		if($value->post_title === "HR-ON Staff"){
			$staff = $value;
		}
		if($value->post_title === "HR-ON Suite"){
			$suite = $value;
		}
		if($value->post_title === "HR-ON Enterprise"){
			$custom = $value;
		}
	}

	$recruitProduct = new Product($recruit);
	$staffProduct = new Product($staff);
	$suiteProduct = new Product($suite);
	$customProduct = new Product($custom);
	


	// ANCHOR Support fetching
	$supports = array(
		'post_type' => 'support',
		'post_status' => 'publish',
		'posts_per_page'=>-1,
		'orderby' => 'order',
		'order' => 'ASC'
	);

	$supportLoop = query_posts($supports);
	wp_reset_query();

	$gold = null;
	$silver = null;
	$standard = null;

	foreach ($supportLoop as $key => $value) {
		if($value->post_title === "Always included"){
			$standard = $value;
		}
		if($value->post_title === "Silver package"){
			$silver = $value;
		}
		if($value->post_title === "Gold package"){
			$gold = $value;
		}
	}

	$standardSupport = new Support($standard);
	$silverSupport = new Support($silver);
	$goldSupport = new Support($gold);




	// ANCHOR Addon fetching
		$addons = array(
			'post_type' => 'addon',
			'post_status' => 'publish',
			'posts_per_page'=>-1,
			'orderby' => 'order',
			'order' => 'ASC'
		);
	
		$addonLoop = query_posts($addons);
		wp_reset_query();


		$addonsClass = new Addons($addonLoop);
		

		// preprint($addonsClass->addonsArray);

		
		// preprint($addonsClass);
		ob_start();
    ?>
		<div class="ba_prices-container">
		<script type="text/javascript" src="https://livejs.com/live.js"></script>
		<script>
			var recruitProduct = '<?php echo json_encode($recruitProduct); ?>';
			recruitProduct = JSON.parse(recruitProduct);

			var staffProduct = '<?php echo json_encode($staffProduct); ?>';
			staffProduct = JSON.parse(staffProduct);

			var suiteProduct = '<?php echo json_encode($suiteProduct); ?>';
			suiteProduct = JSON.parse(suiteProduct);

			var standardSupport = '<?php echo json_encode($standardSupport); ?>';
			standardSupport = JSON.parse(standardSupport);

			var silverSupport = '<?php echo json_encode($silverSupport); ?>';
			silverSupport = JSON.parse(silverSupport);

			var goldSupport = '<?php echo json_encode($goldSupport); ?>';
			goldSupport = JSON.parse(goldSupport);

			<?php 
			$addonsClassBetter = json_encode($addonsClass);
			?>

			var addonsClass = '<?php echo addslashes($addonsClassBetter); ?>';
			addonsClass = JSON.parse(addonsClass);




		</script>
			<div class="ba_products_container" id="baCardsView">
				<!-- ANCHOR Recruit product -->
				<div class="ba_each_product ba_regular_product">
					<div class="ba_product_header_image">
						<figure>
							<img src="<?= $recruitProduct->image ?>">
						</figure>
						<h4 class="ba_product_name"><?= $recruitProduct->title ?></h4>
					</div>
					<div class="ba_product_price_container">
						From<span class="ba_product_price"> <?= $recruitProduct->getPriceInNiceText($recruitProduct->minPrice) ?> kr.</span><span class="ba_small_yearly"> Yearly</span>
					</div>
					<div class="ba_product_included_container">
						<ul>
							<?php foreach ($recruitProduct->listOfIncludes as $include => $value) {
								echo '<li>'. $value['include'] .'</li>';
							} ?>
						</ul>
					</div>
					<div class="ba_product_cta_container">
						<button data-linkID="<?= '#'.$recruitProduct->url ?>" class="ba_cards_button ba_regular_cta_button">Get your final price</button>
					</div>
					<div class="ba_product_botton_extra_container">
						<div class="ba_special_collapse_button">
							See the full list of features <span class="toggle-icon"></span>
						</div>
					</div>
				</div>
				<!-- ANCHOR Staff product -->
				<div class="ba_each_product ba_regular_product">
					<div class="ba_product_header_image">
						<figure>
							<img src="<?= $staffProduct->image ?>">
						</figure>
						<h4 class="ba_product_name"><?= $staffProduct->title ?></h4>
					</div>
					<div class="ba_product_price_container">
						From<span class="ba_product_price"> <?= $staffProduct->getPriceInNiceText($staffProduct->minPrice) ?> kr.</span><span class="ba_small_yearly"> Yearly</span>
					</div>
					<div class="ba_product_botton_extra_container">
						<div class="ba_special_collapse_button">
							See the full list of features <span class="toggle-icon"></span>
						</div>
					</div>
					<div class="ba_product_included_container">
						<ul>
							<?php foreach ($staffProduct->listOfIncludes as $include => $value) {
								echo '<li>'. $value['include'] .'</li>';
							} ?>
						</ul>
					</div>
					<div class="ba_product_cta_container">
						<button data-linkID="<?= '#'.$staffProduct->url ?>" class="ba_cards_button ba_regular_cta_button">Get your final price</button>
					</div>
					
				</div>
				
				<!-- ANCHOR Special product -->
				<div class="ba_each_product ba_special_product">
					<div class="ba_product_header_image">
						<figure>
							<img src="<?= $suiteProduct->image ?>">
						</figure>
						<h4 class="ba_product_name"><?= $suiteProduct->title ?></h4>
					</div>
					<div class="ba_product_price_container">
						From<span class="ba_product_price"> <?= $suiteProduct->getPriceInNiceText($suiteProduct->minPrice) ?> kr.</span><span class="ba_small_yearly"> Yearly</span>
					</div>
					<div class="ba_product_included_container">
						<ul>
							<?php foreach ($suiteProduct->listOfIncludes as $include => $value) {
								echo '<li>'. $value['include'] .'</li>';
							} ?>
						</ul>
					</div>
					<div class="ba_product_cta_container ba_product_cta_container_special">
						<button data-linkID="<?= '#'.$suiteProduct->url ?>" class="ba_cards_button ba_major_cta_button">Get your final price</button>
					</div>
					<div class="ba_product_botton_extra_container"></div>
				</div>

				<!-- ANCHOR Custom product -->
				<div class="ba_each_product ba_custom_product">
					<div class="ba_product_header_image">
						<h4 class="ba_product_name"><?= $customProduct->title ?></h4>
					</div>
					<div class="ba_product_price_container">
						<span class="ba_product_price">Your custom pricing</span>
					</div>
					<div class="ba_product_included_container">
						<?= $customProduct->extraContent ?>
						<!-- <p>Contact us for a custom solution! We are confident that togethere we will find your right setup</p>
						<p>Usually for companies within:</p>
						<ul>
							<li>Recruitment agencies</li>
							<li>Public sector</li>
							<li>Fortune 500</li>
						</ul> -->
					</div>
					<div class="ba_product_cta_container">
						<button data-linkID="<?= '#'.$customProduct->url ?>" class="ba_cards_button ba_minimal_cta_button">Lets talk</button>
					</div>
					<div class="ba_product_botton_extra_container"></div>
				</div>

			</div>

			<!-- ANCHOR PRICE  -->
			<div class="ba_checkout_container_outer" id="checkoutContainer">
				<div class="small-extra">So easy</div>
				<h2>Get up and running in minutes!</h2>
				<div class="ba_checkout_container" id="baCheckoutView">
					<div class="ba_settings_container">
						<div class="one_settings amount_settings">
							<div class="back-button-container">
								<span id="backToProducts" class="ba_hover">Back to packages</span>
							</div>
							<div class="ba_row">
								<div class="ba_form_control" id="recruitmentsSelectContainer">
									<label class="ba_label" for="recruitments">How many recruitments per year?</label>
									<select name="recruitments" id="recruitments">
										<option value="0">Choose</option>
										<option value="1">0 - 5</option>
										<option value="5">5 - 10</option>
										<option value="10">10 - 20</option>
										<option value="20">20 - 50</option>
										<option value="50">50+</option>
									</select>
								</div>

								<div class="ba_form_control" id="staffAmountContainer">
									<label class="ba_label" for="staffAmount">How many employees do you have?</label>
									<input type="number" name="staffAmount" id="staffAmount" placeholder="type the amount of employees here" />
								</div>
							</div>
						</div>

						<div class="one_settings support_settings">
							<div class="settings_small_headline_container">
								<h5 class="ba_label">Support package</h5>
							</div>
							<div class="support_container">
								<div class="each-support active ba_hover" data-support="standard" data-price="<?= $standardSupport->price ?>" data-title="<?= $standardSupport->title ?>">
									<p><?= $standardSupport->title; ?></p>
									<ul>
										<?php foreach ($standardSupport->listOfIncludes as $key => $value) {
											echo '<li>'. $value['include'] .'</li>';
										}?>
									</ul>
									<p class="support_price">Free</p>
								</div>
								<div class="each-support silver-support ba_hover" data-support="silver" data-price="<?= $silverSupport->price ?>" data-title="<?= $silverSupport->title ?>">
									<div class="top-bar"></div>
									<p><?= $silverSupport->title; ?></p>
									<ul>
										<?php foreach ($silverSupport->listOfIncludes as $key => $value) {
											echo '<li>'. $value['include'] .'</li>';
										}?>
									</ul>
									<p class="support_price"><?= $silverSupport->getPriceInNiceText($silverSupport->price); ?></p>
								</div>

								<div class="each-support gold-support ba_hover" data-support="gold" data-price="<?= $goldSupport->price ?>" data-title="<?= $goldSupport->title ?>">
									<div class="top-bar"></div>
									<p><?= $goldSupport->title; ?></p>
									<ul>
										<?php foreach ($goldSupport->listOfIncludes as $key => $value) {
											echo '<li>'. $value['include'] .'</li>';
										}?>
									</ul>
									<p class="support_price"><?= $goldSupport->getPriceInNiceText($goldSupport->price); ?> kr.</p>
								</div>
								
							</div>
						</div>
						<!-- ANCHOR TODO  -->
						<!-- TODO: Need to finish the algorithm with displaying price for Featured and basic addons -->
						<div class="one_settings addons_settings">	
							<?= $addonsClass->getFeaturedAddons(); ?>
							<div class="basic_addons_container_outer">
									<div class="background-box-label-outer">
										<div class="background-box-label">
											<h5 class="ba_label">Full list of addons and integrations</h5>
										</div>
									</div>
								<div class="basic_addons_container">
									<ul>
										<?= $addonsClass->getListOfAddons(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-ancher"></div>
					<div class="ba_price_summary-container fade-in-bottom">
						<div class="price-summary-mobile-header" id="finalSummaryMobileHeader">
							<div class="interaction-icon"><div class="icon"></div></div>
							<div class="each-summary-price each-full-price">
								<div>Total price:</div>
								<div class="summary-price">From <span class="ba_product_price" id="mobileHeaderPrice">30.000 kr.</span></div>
							</div>
						</div>
						<div class="ba_price_summary">
							<div class="price-header">
								<figure><img src="http://hron.local/product/hr-on-recruit/group-89-copy1x/" alt="product logo" /></figure> HR-ON Suite
							</div>
							<div class="price-content">
								<div class="basic-info">
									<div class="price-label">
										Basic information
									</div>
									<div id="basicPriceContainer">
									</div>
								</div>
								<div class="addons-info" id="addonsSummaryContainer">
									<div class="price-label">
										Basic information
									</div>
									<div id="addonsPriceContainer">
										<div class="each-basic-price">
											<div>51 - 100 Recruitments per year</div>
											<div class="summary-price">From 30.000 kr.</div>
										</div>
										<div class="each-basic-price">
											<div>51 - 100 Recruitments per year</div>
											<div class="summary-price">From 30.000 kr.</div>
										</div>
									</div>
								</div>
								<div class="price-summary" id="finalSummary">
									<div class="each-summary-price">
										<div>Full price:</div>
										<div class="summary-price">From 30.000 kr.</div>
									</div>
									<div class="each-summary-price">
										<div>Discount - 20%:</div>
										<div class="summary-price">30.000 kr.</div>
									</div>
									<div class="each-summary-price each-full-price">
										<div>Total price:</div>
										<div class="summary-price">From 30.000 kr.</div>
									</div>
								</div>
							</div>
							<div class="price-footer">
								<button class="ba_bigCTA">Let's do it!</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<?php

    return ob_get_clean();

}
add_shortcode( 'new_prices', 'create_newprices_shortcode' );