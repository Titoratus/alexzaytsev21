<?php
/**
 * CenturyZaytsev functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CenturyZaytsev
 */

if ( ! function_exists( 'centuryzaytsev_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function centuryzaytsev_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CenturyZaytsev, use a find and replace
		 * to change 'centuryzaytsev' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'centuryzaytsev', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'centuryzaytsev' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'centuryzaytsev_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'centuryzaytsev_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function centuryzaytsev_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'centuryzaytsev_content_width', 640 );
}
add_action( 'after_setup_theme', 'centuryzaytsev_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function centuryzaytsev_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'centuryzaytsev' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'centuryzaytsev' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'centuryzaytsev_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function centuryzaytsev_scripts() {
	wp_enqueue_style( 'centuryzaytsev-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'centuryzaytsev_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

remove_action( 'wp_head', 'wp_resource_hints', 1);
remove_action( 'wp_head', 'feed_links',2);
remove_action( 'wp_head', 'feed_links_extra',3);
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'wp_generator');
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles', 'print_emoji_styles');
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

add_filter( 'wp_default_scripts', 'change_default_jquery' );

function change_default_jquery( &$scripts){
	if ( !is_admin() ) $scripts->remove( 'jquery');
}

function remove_all_theme_styles() {
  global $wp_styles;
  $wp_styles->queue = array();
}
add_action('wp_print_styles', 'remove_all_theme_styles', 100);

add_action( 'widgets_init', 'sheensay_remove_recent_comments_style' );
 
function sheensay_remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory -> widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

function my_deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

show_admin_bar(false);

// Произвольные поля
function my_more_options() {
	add_settings_field('agent_phone', 'Телефон агента', 'display_a_phone', 'general');
	register_setting('general', 'agent_phone');
	add_settings_field('agent_email', 'Email агента', 'display_a_email', 'general');
	register_setting('general', 'agent_email');	
	add_settings_field('comp_phone', 'Телефон компании', 'display_comp_phone', 'general');
	register_setting('general', 'comp_phone');
	add_settings_field('comp_email', 'Email компании', 'display_comp_email', 'general');
	register_setting('general', 'comp_email');
	add_settings_field('agent_vk', 'VK агента', 'display_agent_vk', 'general');
	register_setting('general', 'agent_vk');
}

add_action('admin_init', 'my_more_options');

function display_a_phone() {
	echo "<input type='text' name='agent_phone' autocomplete='off' value='".esc_attr(get_option('agent_phone'))."'>";
}

function display_a_email() {
	echo "<input type='text' name='agent_email' autocomplete='off' value='".esc_attr(get_option('agent_email'))."'>";
}

function display_comp_phone() {
	echo "<input type='text' name='comp_phone' autocomplete='off' value='".esc_attr(get_option('comp_phone'))."'>";
}

function display_comp_email() {
	echo "<input type='text' name='comp_email' autocomplete='off' value='".esc_attr(get_option('comp_email'))."'>";
}

function display_agent_vk() {
	echo "<input type='text' name='agent_vk' autocomplete='off' value='".esc_attr(get_option('agent_vk'))."'>";
}

// Custom Post Type
function create_post_type() {
  register_post_type( 'property',
    array(
      'labels' => array(
        'name' => __( 'Недвижимость' ),
        'singular_name' => __( 'Недвижимость' ),
        'add_new_item' => 'Новая недвижимость'
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-admin-multisite',
      'supports' => array('title', 'custom-fields')
    )
  );
}
add_action( 'init', 'create_post_type' );


// Custom columns for custom post
add_filter( 'manage_property_posts_columns', 'set_custom_edit_property_columns' );
function set_custom_edit_property_columns($columns) {
    $columns['prop_cost'] = __( 'Стоимость', 'prop_cost' );
    $columns['prop_img'] = __( 'Изображение', 'your_text_domain' );
    $columns['prop_size'] = __( 'Количество комнат', 'your_text_domain' );
    $columns['prop_place'] = __( 'Район', 'your_text_domain' );

    return $columns;
}

// Custom columns
add_action( 'manage_property_posts_custom_column' , 'custom_property_column', 10, 2 );
function custom_property_column( $column, $post_id ) {
    switch ( $column ) {

        case 'prop_cost' :
						echo get_post_meta( $post_id , 'prop_cost' , true ); 
            break;

        case 'prop_size' :
						echo get_post_meta( $post_id , 'prop_size' , true ); 
            break;             

        case 'prop_place' :
						echo get_post_meta( $post_id , 'prop_place' , true ); 
            break;

        case 'prop_img' :
            echo "<img src='".get_post_meta( $post_id, 'prop_img', true )."' width='200'>";
            break;

    }
}

// Column order
function column_order($columns) {
  $n_columns = array();
 
  foreach ($columns as $key => $value) {
    if ($key=='date') {
      $n_columns['prop_place'] = '';
      $n_columns['prop_cost'] = '';
      $n_columns['prop_size'] = '';
      $n_columns['prop_img'] = '';
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}
add_filter('manage_posts_columns', 'column_order');  