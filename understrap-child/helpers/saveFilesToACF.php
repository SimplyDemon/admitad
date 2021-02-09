<?php

function loadAttachmentToMedia( $globalFiles, $fileHandler, $postID, $set_thu = false ) {
	// check to make sure its a successful upload
	$_FILES = $globalFiles;
	if ( $_FILES[ $fileHandler ]['error'] !== UPLOAD_ERR_OK ) {
		__return_false();
	}

	require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
	require_once( ABSPATH . "wp-admin" . '/includes/file.php' );
	require_once( ABSPATH . "wp-admin" . '/includes/media.php' );

	$attachID = media_handle_upload( $fileHandler, $postID );

	if ( is_wp_error( $attachID ) ) {
		wp_send_json_error( 'Upload was canceled, unable upload file to library' );
	}


	return $attachID;
}


/**
 * @param array $globalFiles - global $_FILES variable
 * @param string $fieldName - field name in acf and in form
 * @param int $postID
 */
function saveFilesToACF( array $globalFiles, string $fieldName, int $postID ) {
	if ( ! empty( $globalFiles[ $fieldName ] ) ) {
		$files         = $globalFiles[ $fieldName ];
		$attachmentIDs = [];

		$failureText = [ 'status' => false, 'text' => "Photo was NOT added to group $fieldName" ];
		$successText = [ 'status' => true, 'text' => "Photo was added SUCCESSFUL to group $fieldName" ];
		foreach ( $files['name'] as $key => $value ) {
			if ( $files['name'][ $key ] ) {
				$file        = array(
					'name'     => $files['name'][ $key ],
					'type'     => $files['type'][ $key ],
					'tmp_name' => $files['tmp_name'][ $key ],
					'error'    => $files['error'][ $key ],
					'size'     => $files['size'][ $key ]
				);
				$globalFiles = [ $fieldName => $file ];

				foreach ( $globalFiles as $file => $array ) {
					$attachmentIDs[] = loadAttachmentToMedia( $globalFiles, $file, $postID );
				}

			}
		}


		if ( ! empty( $attachmentIDs ) ) {
			update_field( $fieldName, $attachmentIDs, $postID );

			return $successText;
		} else {
			return $failureText;
		}
	}

	return [ 'status' => false, 'text' => 'Not enough data' ];
}

