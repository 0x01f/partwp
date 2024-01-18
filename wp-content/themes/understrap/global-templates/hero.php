<?php
/**
 * Hero setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'hero' ) || is_active_sidebar( 'statichero' ) || is_active_sidebar( 'herocanvas' ) ) :
	?>

	<div class="wrapper" id="wrapper-hero">


	</div>

	<?php
endif;
