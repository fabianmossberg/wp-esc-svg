<?php
/**
 * WordPress esc_svg
 *
 * This plugin adds the functions esc_svg and esc_svg_e to WordPress.
 *
 * @link              https://mossberg.xyz/esc-svg/
 * @since             1.0.0
 * @package           Esc_Svg
 *
 * @wordpress-plugin
 * Plugin Name:       esc_svg
 * Plugin URI:        https://github.com/fabianmossberg/wp-esc-svg
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Fabian Mossberg <fabian@mossberg.xyz>
 * Author URI:        https://mossberg.xyz
 * License:           MIT
 * License URI:       https://github.com/fabianmossberg/wp-esc-svg/blob/master/LICENSE
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ESC_SVG_VERSION', '1.0.0' );

if ( ! function_exists( 'esc_svg' ) ) {
	/**
	 * Escape an inline SVG
	 *
	 * @param string  $inline_svg Inlined SVG.
	 * @param boolean $echo Echoes if true, returns if false.
	 *
	 * @return string
	 */
	function esc_svg( $inline_svg, $echo = false ) {

		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		if ( $echo ) {
			echo wp_kses( $inline_svg, $allowed_tags );
		} else {
			return wp_kses( $inline_svg, $allowed_tags );
		}

	}
}

if ( ! function_exists( 'esc_svg_e' ) ) {
	/**
	 * Echo an inlined SVG
	 *
	 * @param string $inline_svg an inlined SVG.
	 */
	function esc_svg_e( $inline_svg ) {
		esc_svg( $inline_svg, true );
	}
}
