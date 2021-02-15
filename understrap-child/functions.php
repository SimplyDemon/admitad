<?php


require_once 'Routes/ImmovableAdd.php';

add_action( 'rest_api_init', function () {
	new sd\routes\ImmovableAdd();
} );

add_action( 'wp_enqueue_scripts', 'themeStylesScripts' );
function themeStylesScripts() {
	wp_enqueue_style( 'child-theme-style', get_stylesheet_directory_uri() . '/style.css', null, filemtime( get_stylesheet_directory() . '/style.css' ) );
}

add_action( 'extraIndexData', 'extraIndexData' );
add_action( 'immovableForm', 'immovableForm' );
function extraIndexData() {
	$immovablesArgs = [
		'post_type'      => 'immovable',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
	];

	$citiesArgs      = [
		'post_type'      => 'city',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
	];
	$md              = '6';
	$immovablesPosts = new WP_Query( $immovablesArgs );
	$citiesPosts     = new WP_Query( $citiesArgs );

	if ( $immovablesPosts->have_posts() ) {
		echo '<div class="container">
			<h4>Недвижимость</h4>
			<div class="row">';
		while ( $immovablesPosts->have_posts() ) {
			$immovablesPosts->the_post();
			$fields = get_fields();
			include( locate_template( '/template-parts/cards/immovable.php', false, false ) );
		}
		echo '</div></div>';
		wp_reset_postdata();
	}

	if ( $citiesPosts->have_posts() ) {
		echo '<div class="container">
			<h4>Города</h4>
			<div class="row">';
		while ( $citiesPosts->have_posts() ) {
			$citiesPosts->the_post();
			$fields = get_fields();
			include( locate_template( '/template-parts/cards/city.php', false, false ) );
		}
		echo '</div></div>';
		wp_reset_postdata();
	}
}

function immovableForm() {
	$citiesArgs = [
		'post_type'      => 'city',
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	];

	$immovableTypes = get_terms( 'immovable_type', [ 'hide_empty' => false ] );

	$citiesPosts = new WP_Query( $citiesArgs );

	include( locate_template( '/template-parts/forms/immovableAdd.php', false, false ) );
}