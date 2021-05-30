<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Darchitect
 * @since Darchitect 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'darchitect_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Darchitect 1.0
	 *
	 * @return void
	 */
	function darchitect_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Darchitect, use a find and replace
		 * to change 'darchitect' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'darchitect', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/**
		 * Jetpack infinite scroll.
		 */
		// add_theme_support( 'infinite-scroll', array(
		// 	'container' => 'main',
		//  ) );

		add_theme_support( 'infinite-scroll', array(
			'type' => 'click',
			'footer_widgets' => false,
			'container' => 'main',
			'wrapper' => 'false',
			'render' => 'darchitect_infinite_scroll_render'
		) );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'darchitect' ),
				'footer'  => __( 'Secondary menu', 'darchitect' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', '000000' );
		if ( 127 > Darchitect_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		// add_editor_style( $editor_stylesheet_path );
		add_editor_style(
			array(
				'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=IBM+Plex+Serif:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap',
				$editor_stylesheet_path,
			)
		);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'darchitect' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'darchitect' ),
					'size'      => 12,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'darchitect' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'darchitect' ),
					'size'      => 14,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'darchitect' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'darchitect' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'darchitect' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'darchitect' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'darchitect' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'darchitect' ),
					'size'      => 32,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'darchitect' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'darchitect' ),
					'size'      => 40,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'darchitect' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'darchitect' ),
					'size'      => 56,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		// Editor color palette.
		// $black     = '#000000';
		// $dark_gray = '#28303D';
		// $gray      = '#39414D';
		// $green     = '#D1E4DD';
		// $blue      = '#D1DFE4';
		// $purple    = '#D1D1E4';
		// $red       = '#E4D1D1';
		// $orange    = '#E4DAD1';
		// $yellow    = '#EEEADD';
		// $white     = '#FFFFFF';

		// add_theme_support(
		// 	'editor-color-palette',
		// 	array(
		// 		array(
		// 			'name'  => esc_html__( 'Black', 'darchitect' ),
		// 			'slug'  => 'black',
		// 			'color' => $black,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Dark gray', 'darchitect' ),
		// 			'slug'  => 'dark-gray',
		// 			'color' => $dark_gray,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Gray', 'darchitect' ),
		// 			'slug'  => 'gray',
		// 			'color' => $gray,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Green', 'darchitect' ),
		// 			'slug'  => 'green',
		// 			'color' => $green,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Blue', 'darchitect' ),
		// 			'slug'  => 'blue',
		// 			'color' => $blue,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Purple', 'darchitect' ),
		// 			'slug'  => 'purple',
		// 			'color' => $purple,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Red', 'darchitect' ),
		// 			'slug'  => 'red',
		// 			'color' => $red,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Orange', 'darchitect' ),
		// 			'slug'  => 'orange',
		// 			'color' => $orange,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'Yellow', 'darchitect' ),
		// 			'slug'  => 'yellow',
		// 			'color' => $yellow,
		// 		),
		// 		array(
		// 			'name'  => esc_html__( 'White', 'darchitect' ),
		// 			'slug'  => 'white',
		// 			'color' => $white,
		// 		),
		// 	)
		// );

		// add_theme_support(
		// 	'editor-gradient-presets',
		// 	array(
		// 		array(
		// 			'name'     => esc_html__( 'Purple to yellow', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
		// 			'slug'     => 'purple-to-yellow',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Yellow to purple', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
		// 			'slug'     => 'yellow-to-purple',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Green to yellow', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
		// 			'slug'     => 'green-to-yellow',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Yellow to green', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
		// 			'slug'     => 'yellow-to-green',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Red to yellow', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
		// 			'slug'     => 'red-to-yellow',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Yellow to red', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
		// 			'slug'     => 'yellow-to-red',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Purple to red', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
		// 			'slug'     => 'purple-to-red',
		// 		),
		// 		array(
		// 			'name'     => esc_html__( 'Red to purple', 'darchitect' ),
		// 			'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
		// 			'slug'     => 'red-to-purple',
		// 		),
		// 	)
		// );

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', darchitect_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
	}
}
add_action( 'after_setup_theme', 'darchitect_setup' );


function darchitect_infinite_scroll_render() {
	while (have_posts()) {
		the_post();
		get_template_part('template-parts/content/content-excerpt', get_post_format());
	}
}


/**
 * Register widget area.
 *
 * @since Darchitect 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function darchitect_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'darchitect' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'darchitect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'darchitect_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Darchitect 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function darchitect_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'darchitect_content_width', 750 );
}
add_action( 'after_setup_theme', 'darchitect_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.

	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'darchitect-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'darchitect-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'darchitect-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'darchitect-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'darchitect-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'darchitect-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'darchitect-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'darchitect-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'darchitect-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'darchitect-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'darchitect-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'darchitect-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'darchitect_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_block_editor_script() {

	wp_enqueue_script( 'darchitect-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'darchitect_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function darchitect_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	}

	// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'darchitect_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_non_latin_languages() {
	$custom_css = darchitect_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'darchitect-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'darchitect_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-darchitect-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-darchitect-custom-colors.php';
new Darchitect_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-darchitect-customize.php';
new Darchitect_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-darchitect-dark-mode.php';
new Darchitect_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_customize_preview_init() {
	wp_enqueue_script(
		'darchitect-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'darchitect-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'darchitect-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'darchitect_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'darchitect-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'darchitect_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_the_html_classes() {
	$classes = apply_filters( 'darchitect_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Darchitect 1.0
 *
 * @return void
 */
function darchitect_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'darchitect_add_ie_class' );
