<h4>Добавить недвижимость</h4>
<form method="post" enctype="multipart/form-data" action="<?= home_url( 'wp-json/sd/v1/immovable-add' ) ?>">
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Название" required>
    </div>
    <div class="form-group">
        <label for="address">Адрес</label>
        <input type="text" name="address" id="address" class="form-control" placeholder="Адрес" required>
    </div>
    <div class="form-row">
        <div class="col-4">
            <label for="area">Общая площадь</label>
            <input type="number" name="area" id="area" class="form-control" placeholder="Общая площадь" required>
        </div>
        <div class="col-4">
            <label for="liveArea">Жилая площадь</label>
            <input type="number" id="liveArea" name="liveArea" class="form-control" placeholder="Жилая площадь"
                   required>
        </div>

    </div>
    <div class="form-row">
        <div class="col-4">
            <label for="price">Цена</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Цена" required>
        </div>
        <div class="col-4">
            <label for="stage">Этаж</label>
            <input type="number" name="stage" id="stage" class="form-control" placeholder="Этаж">
        </div>

    </div>

    <div class="form-row">
		<?php if ( $citiesPosts->have_posts() ) { ?>
            <div class="col-4">
                <label for="city">Город</label>
                <select name="cityId" class="form-control" id="city" required>
					<?php
					while ( $citiesPosts->have_posts() ) {
						$citiesPosts->the_post();
						?>
                        <option value="<?= get_the_ID() ?>"><?= get_the_title() ?></option>

						<?php
					}
					wp_reset_postdata();
					?>
                </select>
            </div>
		<?php } ?>

		<?php if ( ! empty( $immovableTypes ) && is_array( $immovableTypes ) ) { ?>
            <div class="col-4">
                <label for="type">Тип</label>
                <select name="typeId" class="form-control" id="type" required>
					<?php
					foreach ( $immovableTypes as $immovableType ) {
						?>
                        <option value="<?= $immovableType->term_id ?>"><?= $immovableType->name ?></option>

						<?php
					}
					wp_reset_postdata();
					?>
                </select>
            </div>
		<?php } ?>
    </div>

    <div class="form-group">
        <label for="photos">Фотографии</label>
        <input type="file" class="form-control-file" name="photos[]" id="photos" multiple="multiple" required>
    </div>
    <div class="form-group">
        <button type="submit">Добавить</button>
    </div>

</form>