<?php
get_header();

while (have_posts()) : the_post();
    the_title('<h1>', '</h1>');
    the_content();

    function get_latest_realities_by_city() {
        global $post;

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

    foreach ($realities as $reality) {
        echo '<h2>' . $reality->post_title . '</h2>';
        echo '<p>' . $reality->post_content . '</p>';s
    }

    endwhile;

get_footer();

