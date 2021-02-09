<?php


namespace sd\routes;

require_once get_stylesheet_directory() . '/helpers/saveFilesToACF.php';

class immovableAdd {

	function __construct() {
		$this->registerRoute();
	}


	function registerRoute() {
		register_rest_route( 'sd/v1', '/immovable-add/', [
			'methods'  => 'POST',
			'callback' => [ $this, 'main' ],
			'args'     => [
				'title'    => [
					'type'     => 'string',
					'required' => true,
				],
				'typeId'   => [
					'type'     => 'integer',
					'required' => true,
				],
				'area'     => [
					'type'     => 'integer',
					'required' => true,
				],
				'liveArea' => [
					'type'     => 'integer',
					'required' => true,
				],
				'price'    => [
					'type'     => 'integer',
					'required' => true,
				],
				'stage'    => [
					'type'     => 'integer',
					'required' => false,
				],
				'address'  => [
					'type'     => 'string',
					'required' => true,
				],
				'cityId'   => [
					'type'     => 'integer',
					'required' => true,
				],

			]
		] );
	}

	function main( \WP_REST_Request $request ) {

		if ( empty( $_FILES ) && ! is_array( $_FILES ) ) {
			wp_send_json_error( 'No files found' );
		}


		$data    = $request->get_params();
		$title   = sanitize_text_field( $data['title'] );
		$address = sanitize_text_field( $data['address'] );


		$postID = wp_insert_post( [
			'post_title'  => $title,
			'post_type'   => 'immovable',
			'post_status' => 'publish',

		], true );

		if ( is_wp_error( $postID ) ) {
			wp_send_json_error( $postID->get_error_message() );
		} else {
			wp_set_object_terms( $postID, $data['typeId'], 'immovable_type' );
			update_field( 'area', $data['area'], $postID );
			update_field( 'liveArea', $data['liveArea'], $postID );
			update_field( 'price', $data['price'], $postID );
			update_field( 'stage', $data['stage'], $postID );
			update_field( 'cityId', $data['cityId'], $postID );
			update_field( 'address', $address, $postID );

			$globalFiles = $_FILES;

			$results = [];
			foreach ( $globalFiles as $fieldName => $value ) {
				$results[] = saveFilesToACF( $globalFiles, $fieldName, $postID );
			}

			wp_send_json_success( [ 'immovableId' => $postID ] );
		}
	}
}
