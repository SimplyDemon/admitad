<div class="col-12 col-md-<?= $md ?? '4' ?> col-lg-<?= $md ?? '4' ?>">
    <div class="new-card" style="width: 18rem;">
		<?php if ( ! empty( $photos = $fields['photos'] ) && is_array( $fields['photos'] ) ) {
			?>
            <img src="<?= $photos[0] ?>" alt="<?= get_the_title() ?>">
			<?php
		} ?>

        <div class="card-body">
            <h5 class="card-title"><?= get_the_title() ?></h5>
			<?php
			include( locate_template( '/template-parts/acf/immovable.php', false, false ) );
			?>
            <a href="<?= get_the_permalink() ?>" class="btn btn-primary">Посмотреть недвижимость</a>
        </div>
    </div>
</div>