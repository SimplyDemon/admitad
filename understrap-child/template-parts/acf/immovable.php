<?php if ( ! empty( $area = $fields['area'] ) ) {
	?>
    <p>
        Площадь кв.м <?= $area ?>
    </p>
	<?php
} ?>
<?php if ( ! empty( $liveArea = $fields['liveArea'] ) ) {
	?>
    <p>
        Жилая площадь кв.м <?= $liveArea ?>
    </p>
	<?php
} ?>
<?php if ( ! empty( $price = $fields['price'] ) ) {
	?>
    <p>
        Цена р. <?= $price ?>
    </p>
	<?php
} ?>
<?php if ( ! empty( $stage = $fields['stage'] ) ) {
	?>
    <p>
        Этаж <?= $stage ?>
    </p>
	<?php
} ?>
<?php if ( ! empty( $address = $fields['address'] ) ) {
	?>
    <p>
        Адрес <?= $address ?>
    </p>
	<?php
} ?>