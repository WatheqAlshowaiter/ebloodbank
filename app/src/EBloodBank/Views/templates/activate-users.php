<?php
/**
 * Activate users page template
 *
 * @package    EBloodBank\Views
 * @subpackage Templates
 * @since      1.1
 */

use EBloodBank as EBB;

$view->displayView('header', ['title' => __('Activate Users')]);
?>

    <?php $view->displayView('notices') ?>

    <form id="form-activate-user" class="form-horizontal" method="POST">

        <p><?= EBB\escHTML(__('Activate each user in the list below?')) ?></p>

        <ul>
            <?php foreach($view->get('users') as $user) : ?>
            <li>
                <?php $user->display('name') ?>
                <input type="hidden" name="users[]" value="<?php $user->display('id', 'attr') ?>" />
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-danger"><?= EBB\escHTML(__('Activate')) ?></button>
            </div>
        </div>

        <input type="hidden" name="action" value="activate_users" />
        <?= EBB\getTokenField(['name' => 'token']) ?>

    </form>

<?php
$view->displayView('footer');
