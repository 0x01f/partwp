<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

add_action( 'init', 'true_register_post_type_reality' );

function true_register_post_type_reality() {
 
    $labels = array(
        'name' => 'Недвижимость',
        'singular_name' => 'Недвижимость',
        'add_new' => 'Добавить недвижимость',
        'add_new_item' => 'Добавить недвижимость',
        'edit_item' => 'Редактировать недвижимость',
        'new_item' => 'Новая недвижимость',
        'all_items' => 'Вся недвижимость',
        'search_items' => 'Искать недвижимость',
        'not_found' =>  'Недвижимости по заданным критериям не найдено.',
        'not_found_in_trash' => 'Нет недвижимости.',
        'menu_name' => 'Недвижимость'
    );
 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'rewrite' => array( 'slug' => 'reality' ),
    );
 
    register_post_type( 'reality', $args );
}

add_action( 'init', 'true_register_taxonomy_property_type' );

function true_register_taxonomy_property_type() {

    $labels = array(
        'name'              => 'Тип недвижимости',
        'singular_name'     => 'Тип недвижимости',
        'search_items'      => 'Искать тип недвижимости',
        'all_items'         => 'Все типы недвижимости',
        'parent_item'       => 'Родительский тип недвижимости',
        'parent_item_colon' => 'Родительский тип недвижимости:',
        'edit_item'         => 'Редактировать тип недвижимости',
        'update_item'       => 'Обновить тип недвижимости',
        'add_new_item'      => 'Добавить новый тип недвижимости',
        'new_item_name'     => 'Новое имя типа недвижимости',
        'menu_name'         => 'Тип недвижимости',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'property-type' ),
    );

    register_taxonomy( 'property_type', array( 'reality' ), $args );
}


function add_custom_property_types() {
    $types = array(
        'частный дом',
        'квартира',
        'офис',
    );

    foreach ( $types as $type ) {
        wp_insert_term( $type, 'property_type' );
    }
}

add_action( 'init', 'add_custom_property_types' );

function display_property_meta_after_content() {
    global $post;
	
    if ($post->post_type == 'reality') {
        $area = get_post_meta($post->ID, 'area', true);
        $price = get_post_meta($post->ID, 'price', true);
        $address = get_post_meta($post->ID, 'address', true);
        $living_area = get_post_meta($post->ID, 'living_area', true);
        $floor = get_post_meta($post->ID, 'floor', true);
    }
}

add_action('edit_form_after_editor', 'display_property_meta_after_content');

add_action('add_meta_boxes', 'add_city_meta_box');

function add_city_meta_box() {
    add_meta_box('property_city', 'Город', 'property_city_meta_box', 'reality', 'side', 'default');
}

function property_city_meta_box($post) {
    $selected_city = get_post_meta($post->ID, '_selected_city', true);
    $cities = get_posts(array('post_type' => 'city', 'posts_per_page' => -1));

    if ($cities) {
        echo '<label for="selected_city">Выберите город:</label>';
        echo '<select id="selected_city" name="selected_city">';
        echo '<option value="">Не выбрано</option>';
        
        foreach ($cities as $city) {
            echo '<option value="' . $city->ID . '" ' . selected($selected_city, $city->ID, false) . '>' . $city->post_title . '</option>';
        }

        echo '</select>';
    }
}

add_action('save_post', 'save_property_city');

function save_property_city($post_id) {
    if (array_key_exists('selected_city', $_POST)) {
        update_post_meta($post_id, '_selected_city', $_POST['selected_city']);
    }
}

function create_city_post_type() {
    register_post_type('city',
        array(
            'labels' => array(
                'name' => __('Города'),
                'singular_name' => __('Город'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'city'),
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'create_city_post_type');

function add_realty_callback() {
    check_ajax_referer('realty_nonce', 'realty_nonce');

    $title = sanitize_text_field($_POST['title']);
    $area = sanitize_text_field($_POST['area']);
    $price = sanitize_text_field($_POST['price']);
    $address = sanitize_text_field($_POST['address']);
    $living_area = sanitize_text_field($_POST['living_area']);
    $floor = sanitize_text_field($_POST['floor']);

    $realty_data = array(
        'post_title'   => $title,
        'post_type'    => 'reality',
        'post_status'  => 'publish',
        'meta_input'   => array(
            'area'        => $area,
            'price'       => $price,
            'address'     => $address,
            'living_area' => $living_area,
            'floor'       => $floor,
        ),
    );

    $realty_id = wp_insert_post($realty_data);

    if ($realty_id) {
        $response = array('success' => true, 'message' => 'Объект недвижимости успешно добавлен.');
    } else {
        $response = array('success' => false, 'message' => 'Ошибка при добавлении объекта недвижимости.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_add_realty', 'add_realty_callback');
add_action('wp_ajax_nopriv_add_realty', 'add_realty_callback');








