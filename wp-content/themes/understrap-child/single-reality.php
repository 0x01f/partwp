<?php
/**
 * Template Name: Single Reality 
 *
 * Template for displaying a blank page.
 *
 * @package Understrap
 */

get_header();

$property_data = get_post_meta(get_the_ID());

$area = isset($property_data['area'][0]) ? $property_data['area'][0] : '';
$price = isset($property_data['price'][0]) ? $property_data['price'][0] : '';
$address = isset($property_data['address'][0]) ? $property_data['address'][0] : '';
$living_area = isset($property_data['living_area'][0]) ? $property_data['living_area'][0] : '';
$floor = isset($property_data['floor'][0]) ? $property_data['floor'][0] : '';
$thumbnail_id = isset($property_data['_thumbnail_id'][0]) ? $property_data['_thumbnail_id'][0] : '';

echo '<div class="property-info-block">';
if ($thumbnail_id) {
    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
    echo '<div class="property-image"><img src="' . $thumbnail_url[0] . '" alt="Изображение объекта"></div>';
}

echo '<div class="property-info">';
echo '<h2>Площадь: ' . $area . '</h2>';
echo '<p>Стоимость: ' . $price . '</p>';
echo '<p>Адрес: ' . $address . '</p>';
echo '<p>Жилая площадь: ' . $living_area . '</p>';
echo '<p>Этаж: ' . $floor . '</p>';

echo '</div>';
echo '</div>';


get_footer();
?>
