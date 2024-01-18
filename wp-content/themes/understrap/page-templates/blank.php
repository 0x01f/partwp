<?php
/**
 * Template Name: Blank Page Template
 *
 * Template for displaying a blank page.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body>
    <?php get_header(); ?>

    <!-- 4.1. Вывести последние объекты недвижимости -->
    <?php
    $args_realty = array(
        'post_type'      => 'reality', // Тип поста объекта недвижимости
        'posts_per_page' => 5,         // Количество отображаемых объектов
        'order'          => 'DESC',
    );
    
    $query_realty = new WP_Query($args_realty);
    
    if ($query_realty->have_posts()) : ?>
        <div class="container text-center">
            <section class="latest-realty">
                <h2 class="mb-4">Последние объекты недвижимости</h2>
                <div class="card-group">
                    <?php while ($query_realty->have_posts()) : $query_realty->the_post(); ?>
                        <div class="card mb-4">
                            <?php
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium');
                            ?>
                            <img src="<?php echo $thumbnail_url[0]; ?>" class="card-img-top" alt="Изображение объекта">
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <p class="card-text">Площадь: <?php echo get_post_meta(get_the_ID(), 'area', true); ?></p>
                                <p class="card-text">Стоимость: <?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>
                                <!-- Добавьте другие характеристики по необходимости -->
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </div>
        <?php wp_reset_postdata();
    endif;
    ?>



    
    <?php
	$args_cities = array(
		'post_type'      => 'city', // Тип поста города
		'posts_per_page' => 5,       // Количество отображаемых городов
		'order'          => 'DESC',
	);

	$query_cities = new WP_Query($args_cities);

	if ($query_cities->have_posts()) : ?>
		<div class="container text-center">
			<section class="latest-cities">
				<h2 class="mb-4">Последние города</h2>
				<div class="card-group">
					<?php while ($query_cities->have_posts()) : $query_cities->the_post(); ?>
						<div class="card mb-4">
							<?php
							$thumbnail_id = get_post_thumbnail_id();
							$thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium');
							?>
							<img src="<?php echo $thumbnail_url[0]; ?>" class="card-img-top" alt="Изображение города">
							<div class="card-body">
								<h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</section>
		</div>
		<?php wp_reset_postdata();
	endif;
	?>
    
    <!-- 4.3. Внизу форма добавления объекта недвижимости -->
    <section class="realty-form">
        <h2>Добавить объект недвижимости</h2>
        <form id="realty-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
			<div id="notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    	<div id="notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Уведомление</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Объект недвижимости успешно добавлен!
            </div>
        </div>
</div>
    <!-- Другие основные поля формы -->

    <!-- Поля ACF -->
    <label for="title">Название объекта:</label>
    <input type="text" name="title" id="title" required>

    <label for="area">Площадь:</label>
    <input type="text" name="area" id="area" required>

    <label for="price">Стоимость:</label>
    <input type="text" name="price" id="price" required>

    <label for="address">Адрес:</label>
    <input type="text" name="address" id="address" required>

    <label for="living_area">Жилая площадь:</label>
    <input type="text" name="living_area" id="living_area" required>

    <label for="floor">Этаж:</label>
    <input type="text" name="floor" id="floor" required>

    <!-- Добавьте другие поля ACF, если необходимо -->

    <!-- Поле для nonce-защиты -->
    <?php wp_nonce_field('realty_nonce', 'realty_nonce'); ?>

    <input type="hidden" name="action" value="add_realty">

    <button type="submit">Добавить</button>
</form>
		<!-- JavaScript -->
<script>
    jQuery(document).ready(function($) {
    $('#submit-btn').on('click', function() {
        var formData = $('#realty-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: formData + '&action=add_realty',
            success: function(response) {
                console.log(response);

                // Отображение уведомления на странице
                if (response.success) {
                    $('#notification .toast-body').text(response.message);
                    $('#notification').slideDown();

                    // Скрытие формы
                    $('#realty-form').hide();
                }
            },
            error: function(xhr, str) {
                console.log('Error: ' + xhr.responseCode);
            }
        });
    });

    // Закрытие уведомления
    $('#close-notification').on('click', function() {
        $('#notification').slideUp();
    });
});
</script>


    </section>

<?php get_footer(); ?>
</body>
</html>
