<?php

$postsArgs = [
	'post_type'      => 'immovable',
	'posts_per_page' => 10,
	'post_status'    => 'publish',
	'meta_key'       => 'cityId',
	'meta_value'     => get_the_ID(),
	'meta_compare'   => 'LIKE',
];
$posts     = new WP_Query( $postsArgs );

get_header()
?>
    <main>
        <div class="container">
            <h1><?= get_the_title() ?></h1>
        </div>
        <div class="container">
            <div class="row">

				<?php
				if ( $posts->have_posts() ) {
					while ( $posts->have_posts() ) {
						$posts->the_post();
						$fields = get_fields();
						include( locate_template( '/template-parts/cards/immovable.php', false, false ) );
					}
					wp_reset_postdata();
				}
				?>
            </div>
        </div>
    </main>

<?php
get_footer();
