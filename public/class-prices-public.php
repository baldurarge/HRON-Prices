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
		// wp_enqueue_style('prices_css', plugin_dir_url(__FILE__).'/css/prices-public.css', $this->version);
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


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		// wp_enqueue_script('prices_js', plugin_dir_url( __FILE__ ) . 'js/prices-public.js', array('jquery'), $this->version);

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

	}


}



function preprint($item){
	echo '<pre>';
	var_dump($item);
	echo '</pre>';
}

function baldur_shortcode_wp_enqueue_scripts() {
	
}


// Create Shortcode new_prices
// Shortcode: [new_prices language="danish"]
function create_newprices_shortcode($atts) {
	require_once('includes/product.php');
	require_once('includes/support.php');
	require_once('includes/addon.php');

	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	if (strpos($url,'.local') !== false) {
		
		
	}else{
		wp_enqueue_style('prices_css', plugin_dir_url(__FILE__).'/css/prices-public.css', '2.5.0');
		wp_enqueue_script('prices_js', plugin_dir_url( __FILE__ ) . 'js/prices-public.js', array('jquery'), '2.5.0');
	}


	if (get_locale() == 'da_DK') {
		$signupId = '17840';
	}else if (get_locale() == 'en_US') {
		$signupId = '15853';
	}else{
		// $signupId = get_locale();
		$signupId = '15853';
	}

	$a = shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else'
	), $atts );

	$language = $a['language'];


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

	}

	$recruitProduct = new Product($recruit);
	$staffProduct = new Product($staff);
	$suiteProduct = new Product($suite);

	


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

	// $gold = null;
	// $silver = null;
	$standard = null;


	foreach ($supportLoop as $key => $value) {
		if(get_field('id', $value->ID) === "standard"){
			$standard = $value;
		}
		// if(get_field('id', $value->ID) === "gold"){
		// 	$gold = $value;
		// }
	}

	$standardSupport = new Support($standard);
	// $silverSupport = new Support($silver);
	// $goldSupport = new Support($gold);




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



		if (strpos($url,'.local') !== false) {
			?>
			<!-- <script type="text/javascript" src="https://livejs.com/live.js"></script> -->
			<?php
		}

    ?>
		<div class="ba_prices-container">
		<script>
			var recruitProduct = '<?php echo json_encode($recruitProduct); ?>';
			recruitProduct = JSON.parse(recruitProduct);

			var staffProduct = '<?php echo json_encode($staffProduct); ?>';
			staffProduct = JSON.parse(staffProduct);

			var suiteProduct = '<?php echo json_encode($suiteProduct); ?>';
			suiteProduct = JSON.parse(suiteProduct);

			var standardSupport = '<?php echo json_encode($standardSupport); ?>';
			standardSupport = JSON.parse(standardSupport);

			<?php 
			$addonsClassBetter = json_encode($addonsClass);
			?>

			var addonsClass = '<?php echo addslashes($addonsClassBetter); ?>';
			addonsClass = JSON.parse(addonsClass);

			var languageStrings = {}



		</script>
			<input class="hidden-translate" hidden data-translateID="from" value="<?php _e('from','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="free" value="<?php _e('Free','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="addons" value="<?php _e('addons','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="fullPrice" value="<?php _e('Full price','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="discount" value="<?php _e('Discount','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="totalPrice" value="<?php _e('Total price','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="yearly" value="<?php _e('Yearly','prices'); ?>" type="text" />
			<input class="hidden-translate" hidden data-translateID="Implementation" value="<?php _e('Implementation','prices'); ?>" type="text" />

			<div class="ba_form_control active" id="currencySelectContainer">
					<label class="ba_label" for="currency"><?= _e('Choose currency','prices'); ?></label>
					<select name="currency" id="currency">
						<option value="dkk"><?php _e('DKK','prices'); ?></option>
						<option value="euro"><?php _e('EURO','prices'); ?></option>
					</select>
				</div>
			<div class="ba_products_container" id="baCardsView">
				<!-- ANCHOR Recruit product -->
				<h2 class="my_h2"><?= _e('Tjek pakkerne herunder og v??lg, hvad der passer bedst til dine behov.','prices'); ?></h2>
				
				

				<div class="ba_each_product ba_regular_product">
					<div class="ba_product_header_image">
						<figure>
							<img src="<?= $recruitProduct->image ?>">
						</figure>
						<h4 class="ba_product_name"><?= $recruitProduct->title ?></h4>
					</div>
					<div class="ba_product_price_container">
						<?= _e('from','prices'); ?> <span class="ba_product_price"> <span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="<?= $recruitProduct->minPrice ?>"><?= $recruitProduct->getPriceInNiceText($recruitProduct->minPrice) ?></div></span><span class="ba_small_yearly"> <?= _e('Yearly','prices'); ?></span>
					</div>
					<div class="ba_product_included_container">
						<ul>
							<?php foreach ($recruitProduct->listOfIncludes as $include => $value) {
								echo '<li>'. $value['include'] .'</li>';
							} ?>
						</ul>
					</div>
					<div class="ba_product_cta_container">
						<button data-linkID="<?= '#'.$recruitProduct->url ?>" class="ba_cards_button ba_regular_cta_button"><?= _e('get your final price','prices'); ?></button>
					</div>
					<div class="ba_product_botton_extra_container">
						<div class="ba_special_collapse_button">
							<?= _e('See the full list of features','prices'); ?> <span class="toggle-icon"></span>
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
					<?= _e('from','prices'); ?><span class="ba_product_price"> <span class="currency-display">kr.</span> <div class="priceForDisplay" data-price="<?= $staffProduct->minPrice ?>"><?= $staffProduct->getPriceInNiceText($staffProduct->minPrice) ?></div></span><span class="ba_small_yearly"> <?= _e('Yearly','prices'); ?></span>
					</div>
					<div class="ba_product_botton_extra_container">
						<div class="ba_special_collapse_button">
							<?= _e('See the full list of features','prices'); ?> <span class="toggle-icon"></span>
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
						<button data-linkID="<?= '#'.$staffProduct->url ?>" class="ba_cards_button ba_regular_cta_button"><?= _e('get your final price','prices'); ?></button>
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
					<?= _e('from','prices'); ?><span class="ba_product_price"> <span class="currency-display">kr.</span> <div class="priceForDisplay"  data-price="<?= $suiteProduct->minPrice ?>"><?= $suiteProduct->getPriceInNiceText($suiteProduct->minPrice) ?></div></span><span class="ba_small_yearly"> <?= _e('Yearly','prices'); ?></span>
					</div>
					<div class="ba_product_included_container">
						<ul>
							<?php foreach ($suiteProduct->listOfIncludes as $include => $value) {
								echo '<li>'. $value['include'] .'</li>';
							} ?>
						</ul>
					</div>
					<div class="ba_product_cta_container ba_product_cta_container_special">
						<button data-linkID="<?= '#'.$suiteProduct->url ?>" class="ba_cards_button ba_major_cta_button"><?= _e('get your final price','prices'); ?></button>
					</div>
					<div class="ba_product_botton_extra_container"></div>
				</div>

			</div>

			<!-- ANCHOR PRICE  -->
			<div class="ba_checkout_container_outer" id="checkoutContainer">
				<h2><?= _e('Get up and running in minutes!','prices'); ?></h2>
				<div class="ba_checkout_container" id="baCheckoutView">
					<div class="ba_settings_container">
						<div class="one_settings amount_settings">
							<div class="back-button-container">
								<span id="backToProducts" class="ba_hover"><?= _e('Back to packages','prices'); ?></span>
							</div>
							<div class="ba_row">
								<div class="help-popup" id="recruitHelpPopup">
									<div class="content fade-in-bottom">
										<div class="close-icon" id="closeHelpButton"></div>
										<?= $recruitProduct->helpBigtext ?>
									</div>
								</div>
								<div class="ba_form_control" id="recruitmentsSelectContainer">
									<label class="ba_label" for="recruitments"><?= _e('How many recruitments per year?','prices'); ?><span class="questionmark-icon" id="recruitHelpIcon">
									<div class="help-popover fade-in-bottom-small">
										<?= $recruitProduct->helpSmalltext ?>
										<button class="read-more-button" id="readMoreRecruitHelp"><?php _e('Read more', 'prices'); ?></button>
									</div>
									</span></label>
									<select name="recruitments" id="recruitments">
										<option value="15000" selected><?php _e('Up to', 'prices'); ?> 2 <?= _e('Job slots','prices'); ?></option>
										<option value="24000"><?php _e('Up to', 'prices'); ?> 4 <?= _e('Job slots','prices'); ?></option>
										<option value="36000"><?php _e('Up to', 'prices'); ?> 8 <?= _e('Job slots','prices'); ?></option>
										<option value="44000"><?php _e('Up to', 'prices'); ?> 12 <?= _e('Job slots','prices'); ?></option>
										<option value="63500"><?php _e('Up to', 'prices'); ?> 25 <?= _e('Job slots','prices'); ?></option>
										<option value="88500"><?php _e('Up to', 'prices'); ?> 50 <?= _e('Job slots','prices'); ?></option>
										<option value="126000"><?php _e('Up to', 'prices'); ?> 100 <?= _e('Job slots','prices'); ?></option>
										<option value="enterprise">100+ <?= _e('Job slots','prices'); ?></option>
									</select>
									<span class="special-input-message eneterprise-recruit"><?php _e('You are now at enterprise level','prices'); ?></span>
								</div>

								<div class="ba_form_control" id="staffAmountContainer">
									<label class="ba_label" for="staffAmount"><?= _e('How many employees per year?','prices'); ?></label>
									<select name="staffAmount" id="staffAmount">
										<option value="15000" selected><?php _e('Up to', 'prices'); ?> 25 <?= _e('Employees','prices'); ?></option>
										<option value="24000" selected><?php _e('Up to', 'prices'); ?> 50 <?= _e('Employees','prices'); ?></option>
										<option value="32125"><?php _e('Up to', 'prices'); ?> 75 <?= _e('Employees','prices'); ?></option>
										<option value="39625"><?php _e('Up to', 'prices'); ?> 100 <?= _e('Employees','prices'); ?></option>
										<option value="53375"><?php _e('Up to', 'prices'); ?> 150 <?= _e('Employees','prices'); ?></option>
										<option value="66875"><?php _e('Up to', 'prices'); ?> 200 <?= _e('Employees','prices'); ?></option>
										<option value="93375"><?php _e('Up to', 'prices'); ?> 300 <?= _e('Employees','prices'); ?></option>
										<option value="119375"><?php _e('Up to', 'prices'); ?> 400 <?= _e('Employees','prices'); ?></option>
										<option value="144875"><?php _e('Up to', 'prices'); ?> 500 <?= _e('Employees','prices'); ?></option>
										<option value="enterprise">500+ <?= _e('Employees','prices'); ?></option>
									</select>
									<span class="special-input-message eneterprise-staff"><?php _e('You are now at enterprise level','prices'); ?></span>
								</div>
							</div>
						</div>

						<div class="one_settings support_settings">
							<div class="settings_small_headline_container">
								<h5 class="ba_label"><?= _e('Support package','prices'); ?></h5>
							</div>
							<div class="support_container">
								<div class="each-support active ba_hover" data-support="standard" data-price="<?= $standardSupport->price ?>" data-title="<?= $standardSupport->title ?>">
									<p><?= $standardSupport->title; ?></p>
									<ul>
										<?php foreach ($standardSupport->listOfIncludes as $key => $value) {
											echo '<li>'. $value['include'] .'</li>';
										}?>
									</ul>
									<div class="support_price"><?php _e('Altid inkluderet','prices'); ?></div>
								</div>

							</div>
						</div>
						<!-- ANCHOR TODO  -->
						<!-- TODO: Need to finish the algorithm with displaying price for Featured and basic addons -->
						<div class="one_settings addons_settings">	
							<?= $addonsClass->getFeaturedAddons(); ?>
						</div>
					</div>
					<div class="mobile-ancher"></div>
					<div class="around-prices-content">
						<div class="ba_price_summary-container clearfix sticky-prices" >
							<div class="price-summary-mobile-header" id="finalSummaryMobileHeader">
								<div class="interaction-icon"><div class="icon"></div></div>
								<div class="each-summary-price each-full-price">
									<div>Total price:</div>
									<div class="summary-price"><?= _e('from','prices'); ?> <span class="ba_product_price" id="mobileHeaderPrice"><span class="currency-display">kr.</span> 30.000</span></div>
								</div>
							</div>
							<div class="ba_price_summary">
								
								<!-- <div class=""></div> -->
								<div class="price-header" id="productImageAndName">
									<figure><img src="http://hron.local/product/hr-on-recruit/group-89-copy1x/" alt="product logo"/></figure> HR-ON Suite
								</div>
								<div class="enterprise-price">
									<?php _e('You are at an enterprise level. contact us to get the right price','prices'); ?>
								</div>
								<div class="price-content">
									<div class="basic-info">
										<div class="price-label">
											<?= _e('Basic information','prices'); ?>
										</div>
										<div id="basicPriceContainer">
										</div>
									</div>
									<div class="price-summary" id="finalSummary">
										<div class="each-summary-price">
											<div>Full price:</div>
											<div class="summary-price">From <span class="currency-display">kr.</span> 30.000</div>
										</div>
										<div class="each-summary-price">
											<div>Discount - 20%:</div>
											<div class="summary-price"><span class="currency-display">kr.</span> 30.000</div>
										</div>
										<div class="each-summary-price each-full-price">
											<div>Total price:</div>
											<div class="summary-price">From <span class="currency-display">kr.</span> 30.000</div>
										</div>
									</div>
								</div>
								<div class="price-footer">
									<button class="ba_bigCTA" id="komIGangButton"><?php _e("Let's do it!",'prices'); ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="submit-page-container" id="submitContainer">
			<div class="each-floatin-person rasmus"><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-19.png" alt="hr-on team member" /></div>
			<div class="each-floatin-person rikke"><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-17.png" alt="hr-on team member" /></div>
			<div class="each-floatin-person ali"><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-16.png" alt="hr-on team member" /></div>
			<div class="each-floatin-person tanya"><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-15.png" alt="hr-on team member" /></div>
			<div class="each-floatin-person lisbeth"><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-18.png" alt="hr-on team member" /></div>
				<div class="chat-guy-container">
						<figure><img src="https://hr-on.com/wp-content/uploads/2021/04/Group-10.png" alt="hr-on sales guy" /></figure>
						<div class="chat-bubble">
							<?php _e("Vi er n??sten i m??l. Udfyld dine oplysninger - s?? kontakter vi dig hurtigst muligt. Vi gl??der os rigtig meget til at h??re mere om dig og din virksomheds behov",'prices'); ?>
						</div>
					</div>
				<div class="submit-form-container">
					<div class="back-button-container">
						<span id="backToCheckout" class="ba_hover"><?= _e('Back','prices'); ?></span>
					</div>
					<h3><?php _e("Udfyld formularen og bliv ringet op af os", 'prices'); ?></h3>
					<div class="form-change">
						<?= do_shortcode('[contact-form-7 id="'. $signupId .'" title="Signup Case DK"]'); ?>
					</div>
				</div>
			</div>
		</div>
	<?php

    return ob_get_clean();

}
add_shortcode( 'new_prices', 'create_newprices_shortcode' );