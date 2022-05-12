<?php
/**
 * Plugin Name: Elementor Santo Embrujo Widgets
 * Description: Widgets personalizados de Elementor para Santo Embrujo.
 * Version:     1.0.1
 * Author:      Alunizar
 * Author URI:  https://www.alunizar.co/
 */

function register_santoembrujo_widgets( $widgets_manager ) {
	include_once __DIR__ . '/widgets/audio-player.php';
	include_once __DIR__ . '/widgets/encyclopedia.php';

	$widgets_manager->register( new \Elementor_Audio_Player() );
	$widgets_manager->register( new \Elementor_Encyclopedia() );
}
add_action( 'elementor/widgets/register', 'register_santoembrujo_widgets' );
