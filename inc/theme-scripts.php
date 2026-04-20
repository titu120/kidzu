<?php
function kidzu_scripts() {
	$theme_dir = get_template_directory();
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style( 'kidzu-font-quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap', array(), null );
	wp_enqueue_style( 'kidzu-font-source-sans-3', 'https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap', array(), null );
	wp_enqueue_style( 'kidzu-font-kalam', 'https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap', array(), null );

	$styles = array(
		array( 'bootstrap', 'assets/css/bootstrap.min.css', array(), null ),
		array( 'swiper-bundle-css', 'assets/css/swiper-bundle.min.css', array(), null ),
		array( 'tp-icons', 'assets/css/tp-icons.css', array(), null ),
		array( 'magnific-popup', 'assets/css/magnific-popup.css', array(), null ),
		array( 'nice-select', 'assets/css/nice-select.css', array(), null ),
		array( 'animate', 'assets/css/animate.css', array(), null ),
		array( 'meanmenu', 'assets/css/meanmenu.css', array(), null ),
		array( 'offcanvas-sideslide', 'assets/css/offcanvas_sideslide.css', array(), null ),
		array( 'all-min', 'assets/css/all.min.css', array(), null ),
		array( 'main-css', 'assets/css/main.css', array(), null ),
		array( 'kidzu-theme', 'assets/css/theme.css', array(), time() ),
		array( 'kidzu-responsive', 'assets/css/responsive.css', array(), time() ),
	);

	foreach ( $styles as $style ) {
		list( $handle, $relative_path, $deps, $version ) = $style;
		$file_path = $theme_dir . '/' . $relative_path;

		if ( file_exists( $file_path ) ) {
			wp_enqueue_style( $handle, $theme_uri . '/' . $relative_path, $deps, $version );
		}
	}

	wp_enqueue_style( 'kidzu-style', get_stylesheet_uri() ,array(), time());	

	$scripts = array(
		array( 'bootstrap', 'assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.2.0', true ),
		array( 'swiper-js', 'assets/js/swiper-bundle.min.js', array( 'jquery' ), '8.2.3', true ),
		array( 'wow', 'assets/js/wow.min.js', array( 'jquery' ), '1.1.2', true ),
		array( 'jquery-waypoints', 'assets/js/jquery.waypoints.js', array( 'jquery' ), '2.0.3', true ),
		array( 'jquery-counterup', 'assets/js/jquery.counterup.min.js', array( 'jquery' ), '1.0', true ),
		array( 'jquery-magnific-popup', 'assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true ),
		array( 'jquery-nice-select', 'assets/js/jquery.nice-select.min.js', array( 'jquery' ), '1.1.0', true ),
		array( 'jquery-meanmenu', 'assets/js/jquery.meanmenu.min.js', array( 'jquery' ), '1.0.0', true ),
		array( 'gsap', 'assets/js/gsap.min.js', array(), '3.12.0', true ),
		array( 'scroll-trigger', 'assets/js/ScrollTrigger.min.js', array( 'gsap' ), '3.12.0', true ),
		array( 'scroll-smoother', 'assets/js/ScrollSmoother.min.js', array( 'gsap' ), '3.12.0', true ),
		array( 'scroll-to-plugin', 'assets/js/ScrollToPlugin.min.js', array( 'gsap' ), '3.12.0', true ),
		array( 'text-plugin', 'assets/js/TextPlugin.js', array( 'gsap' ), '3.12.0', true ),
		array( 'split-text', 'assets/js/SplitText.min.js', array( 'gsap' ), '3.12.0', true ),
		array( 'split-type', 'assets/js/split-type.min.js', array(), '1.0.0', true ),
		array( 'tween-max', 'assets/js/tween-max.js', array(), '1.0.0', true ),
		array( 'parallaxie', 'assets/js/parallaxie.js', array( 'jquery' ), '1.0.0', true ),
		array( 'viewport-jquery', 'assets/js/viewport.jquery.js', array( 'jquery' ), '1.0.0', true ),
		array( 'chroma', 'assets/js/chroma.min.js', array(), '2.4.0', true ),
		array( 'three', 'assets/js/three.js', array(), '1.0.0', true ),
		array( 'webgl', 'assets/js/webgl.js', array( 'three' ), '1.0.0', true ),
		array( 'kidzu-theme', 'assets/js/theme.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true ),
		array( 'kidzu-main', 'assets/js/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true ),
	);

	foreach ( $scripts as $script ) {
		list( $handle, $relative_path, $deps, $version, $in_footer ) = $script;
		$file_path = $theme_dir . '/' . $relative_path;

		if ( file_exists( $file_path ) ) {
			wp_enqueue_script( $handle, $theme_uri . '/' . $relative_path, $deps, $version, $in_footer );
		}
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kidzu_scripts' );  

add_action( 'admin_enqueue_scripts', 'kidzu_load_admin_styles' );
function kidzu_load_admin_styles($screen) {
	wp_enqueue_style( 'kidzu-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0' );
	wp_enqueue_script( 'kidzu-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0.0', true );
} 


// Elementor Editor styles - Load admin CSS and add inline CSS for widget icons
add_action('elementor/editor/after_enqueue_styles', 'kidzu_elementor_editor_styles');

function kidzu_elementor_editor_styles()
{
	// Load admin-style.css in Elementor editor
	wp_enqueue_style('kidzu-elementor-editor', get_template_directory_uri() . '/assets/css/admin-style.css', array(), time());
	wp_enqueue_style('kidzu-elementor-tp-icons', get_template_directory_uri() . '/assets/css/tp-icons.css', array(), time());
	
	// Add inline CSS for widget icon with full URL path
	$custom_css = "
		.elementor-panel .elementor-element .icon i.tp-icon::after {
			width: 30px !important;
			height: 30px !important;
			content: '' !important;
			display: inline-block !important;
			border-radius: 5px !important;
			background: url('" . get_template_directory_uri() . "/assets/images/brand-icon.png') no-repeat center center/cover !important;
		}
	";
	wp_add_inline_style('kidzu-elementor-editor', $custom_css);
} 