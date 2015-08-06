<?php
/**
 * New\Edit City Form
 *
 * @package    EBloodBank
 * @subpackage Views
 */
use EBloodBank\Models\City;
use EBloodBank\Kernal\Notices;

if (! $this->isExists('city')) {
    $city = new City();
}
?>

<?php Notices::displayNotices() ?>

<form id="form-city" class="form-horizontal" method="POST">

	<div class="form-group">
		<div class="col-sm-2">
			<label for="city_name"><?php _e('Name') ?></label>
		</div>
		<div class="col-sm-4">
			<input type="text" name="city_name" id="city_name" class="form-control" value="<?php $city->display('city_name', 'attr') ?>" required />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary"><?php _e('Submit') ?></button>
		</div>
	</div>

	<input type="hidden" name="action" value="submit_city" />

</form>