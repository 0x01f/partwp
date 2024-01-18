<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php
			$city_slug = get_query_var('city');

			$args = array(
				'post_type' => 'reality', 
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'city',
						'value' => $city_slug,
						'compare' => '=',
					),
				),
			);

			// Создаем запрос
			$realty_query = new WP_Query($args);

			if ($realty_query->have_posts()) :
				while ($realty_query->have_posts()) : $realty_query->the_post();
					the_title();
				endwhile;
				wp_reset_postdata();
			else :
				echo 'Нет доступной недвижимости для этого города.';
			endif;
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
