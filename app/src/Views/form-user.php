<?php
/**
 * New\Edit User Form
 *
 * @package    eBloodBank
 * @subpackage Views
 */
use eBloodBank\EntityManager;
use eBloodBank\Models\User;
use eBloodBank\Kernal\Roles;

if (! isset($__userID)) {
    $user = new User();
} else {
    $user = EntityManager::getUserRepository()->find($__userID);
}
?>
<form id="form-user" class="form-horizontal" method="POST">

	<div class="form-group">
		<div class="col-sm-2">
			<label for="user_logon"><?php _e('Username') ?></label>
		</div>
		<div class="col-sm-4">
			<input type="text" name="user_logon" id="user_logon" class="form-control" value="<?php $user->display('user_logon', 'attr') ?>" required />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-2">
			<label for="user_pass"><?php _e('New Password') ?></label>
		</div>
		<div class="col-sm-4">
			<input type="password" name="user_pass_1" id="user_pass_1" class="form-control" value="" placeholder="<?php echo esc_attr(__('Type your new password')) ?>" autocomplete="off" />
			&nbsp;
			<input type="password" name="user_pass_2" id="user_pass_2" class="form-control" value="" placeholder="<?php echo esc_attr(__('Type your new password again')) ?>" autocomplete="off" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-2">
			<label for="user_role"><?php _e('Role') ?></label>
		</div>
		<div class="col-sm-4">
			<select name="user_role" id="user_role" class="form-control">
				<?php foreach (Roles::getRoles() as $role) : ?>
				<option<?php html_atts(array( 'value' => $role->slug, 'selected' => ($role->slug === $user->get('user_role')) )) ?>><?php echo $role->title ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-6">
			<button type="submit" class="btn btn-primary"><?php _e('Submit') ?></button>
		</div>
	</div>

	<input type="hidden" name="action" value="submit_user" />

</form>
