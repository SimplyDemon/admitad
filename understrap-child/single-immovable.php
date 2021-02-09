<?php
$fields         = get_fields();
$immovableTypes = get_the_terms( $post->ID, 'immovable_type' );
wp_enqueue_script( 'theme-vendors-script', get_stylesheet_directory_uri() . '/js/util.js', null, filemtime( get_stylesheet_directory() . '/js/util.js' ), true );

get_header();
?>

    <main>
        <div class="container">
            <h1><?= get_the_title() ?></h1>
        </div>
        <div class="container">


			<?php if ( ! empty( $photos = $fields['photos'] ) && is_array( $fields['photos'] ) ) {
				include( locate_template( '/template-parts/single/carousel.php', false, false ) );

			} ?>

			<?php if ( ! empty( $fields['cityId'] ) ) {
				?>
                <p>
                    Город: <?= get_the_title( $fields['cityId'] ) ?>
                </p>
				<?php
			}
			if ( ! empty( $immovableTypes ) && is_array( $immovableTypes ) ) {
				foreach ( $immovableTypes as $immovableType ) {
					echo "<p>{$immovableType->name}</p>";
				}
			}

			include( locate_template( '/template-parts/acf/immovable.php', false, false ) );
			?>

        </div>
    </main>

<?php
get_footer();