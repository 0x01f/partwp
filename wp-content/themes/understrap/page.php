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
			// Получаем город из текущей страницы
			$city_slug = get_query_var('city');

			// Аргументы для запроса к базе данных
			$args = array(
				'post_type' => 'reality', // Замените 'reality' на тип вашего поста
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' => 'city', // Замените 'city' на название поля мета, где хранится информация о городе
						'value' => $city_slug,
						'compare' => '=',
					),
				),
			);

			// Создаем запрос
			$realty_query = new WP_Query($args);

			// Проверяем, есть ли записи
			if ($realty_query->have_posts()) :
				while ($realty_query->have_posts()) : $realty_query->the_post();
					// Здесь ваш код для вывода каждой записи
					the_title(); // Пример вывода заголовка
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
