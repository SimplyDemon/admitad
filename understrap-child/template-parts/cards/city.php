<div class="col-12 col-md-<?= $md ?? '4' ?> col-lg-<?= $md ?? '4' ?>">
    <div class="new-card" style="width: 18rem;">
		<?php the_post_thumbnail() ?>
        <div class="card-body">
            <h5 class="card-title"><?= get_the_title() ?></h5>
            <p class="card-text"><?= get_the_content() ?></p>
            <a href="<?= get_the_permalink() ?>" class="btn btn-primary">Посмотреть недвижимость</a>
        </div>
    </div>
</div>