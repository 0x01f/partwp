<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

while (have_posts()) : the_post();
    the_content();

    function get_latest_realities_by_city() {
        global $post;

        // Получаем ID текущей страницы
        $city_id = $post->ID;

        $args = array(
            'post_type'      => 'reality',
            'posts_per_page' => 10,
            'meta_query'     => array(
                array(
                    'key'   => '_selected_city',
                    'value' => $city_id,
                ),
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $query = new WP_Query($args);

        return $query->posts;
    }

	$realities = get_latest_realities_by_city();

	echo '<div class="container">';
	the_title('<h1>', '</h1>');
	echo '<div class="row">';
	foreach ($realities as $reality) {
		$area = get_field('area', $reality->ID);
		$price = get_field('price', $reality->ID);
		$address = get_field('address', $reality->ID);
		$living_area = get_field('living_area', $reality->ID);
		$floor = get_field('floor', $reality->ID);
		$selected_city = get_post_meta($reality->ID, '_selected_city', true);

		$image = wp_get_attachment_image_src(get_post_thumbnail_id($reality->ID), 'full');
		$image_url = $image ? $image[0] : '';

		echo '<div class="col-md-4">';
		echo '<div class="card mb-3">';
		echo '<img src="' . esc_url($image_url) . '" class="card-img-top" alt="' . esc_attr($reality->post_title) . '">';
		echo '<div class="card-body">';
		echo '<h5 class="card-title">' . esc_html($reality->post_title) . '</h5>';
		echo '<p class="card-text">Area: ' . esc_html($area) . '</p>';
		echo '<p class="card-text">Price: ' . esc_html($price) . '</p>';
		echo '<p class="card-text">Address: ' . esc_html($address) . '</p>';
		echo '<p class="card-text">Living Area: ' . esc_html($living_area) . '</p>';
		echo '<p class="card-text">Floor: ' . esc_html($floor) . '</p>';
		echo '<p class="card-text">City: ' . esc_html(get_the_title($selected_city)) . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	echo '</div>';

endwhile;

get_footer();