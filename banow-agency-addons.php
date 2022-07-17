<?php
/**
 * Plugin Name: Banow Addons for Elementor
 * Description: This is Personal
 * Version:     0.0.1
 * Author:      Raihan
 * Author URI:  https://github.com/raihanbabu
 */

function register_banow_portfolio_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/banow-portfolio.php' );

	$widgets_manager->register( new \Elementor_Banow_Portfolio_Widget() );

}
add_action( 'elementor/widgets/register', 'register_banow_portfolio_widget' );