<?php
/**
 * Settings page template
 *
 * @package    WinryTheme
 * @subpackage Templates
 * @since      1.0
 */

use EBloodBank as EBB;
use EBloodBank\Roles;
use EBloodBank\Options;
use EBloodBank\Locales;
use EBloodBank\Themes;

$view->displayView('header', ['title' => d__('winry', 'Settings')]);
?>

    <?php $view->displayView('notices') ?>

    <form id="form-settings" class="form-horizontal" method="POST">

        <fieldset>

            <legend><?= EBB\escHTML(d__('winry', 'Site Options')) ?></legend>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_url"><?= EBB\escHTML(d__('winry', 'Site URL')) ?> <span class="form-required">*</span></label>
                </div>
                <div class="col-sm-4">
                    <input type="url" name="site_url" id="site_url" class="form-control" value="<?= EBB\escURL(Options::getOption('site_url')) ?>" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_name"><?= EBB\escHTML(d__('winry', 'Site Name')) ?> <span class="form-required">*</span></label>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="site_name" id="site_name" class="form-control" value="<?= EBB\escAttr(Options::getOption('site_name')) ?>" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_slogan"><?= EBB\escHTML(d__('winry', 'Site Slogan')) ?></label>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="site_slogan" id="site_slogan" class="form-control" value="<?= EBB\escAttr(Options::getOption('site_slogan')) ?>" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_email"><?= EBB\escHTML(d__('winry', 'Site E-mail')) ?> <span class="form-required">*</span></label>
                </div>
                <div class="col-sm-4">
                    <input type="email" name="site_email" id="site_email" class="form-control" value="<?= EBB\escAttr(Options::getOption('site_email')) ?>" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_locale"><?= EBB\escHTML(d__('winry', 'Site Locale')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="site_locale" id="site_locale" class="form-control">
                        <option></option>
                        <?php foreach (Locales::getAvailableLocales() as $locale) : ?>
                        <option<?= EBB\toAttributes(['selected' => Locales::isCurrentLocale($locale)]) ?>><?= EBB\escHTML($locale->getCode()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="site_theme"><?= EBB\escHTML(d__('winry', 'Site Theme')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="site_theme" id="site_theme" class="form-control">
                        <?php foreach (Themes::getAvailableThemes() as $theme) : ?>
                        <option<?= EBB\toAttributes(['selected' => Themes::isCurrentTheme($theme)]) ?>><?= EBB\escHTML($theme->getName()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </fieldset>

        <fieldset>

            <legend><?= EBB\escHTML(d__('winry', 'Users Options')) ?></legend>

            <div class="form-group">
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label>
                            <input<?= EBB\toAttributes(['type' => 'checkbox', 'name' => 'self_registration', 'id' => 'self_registration', 'value' => 'on', 'checked' => ('on' === Options::getOption('self_registration'))]) ?>/>
                            <?= EBB\escHTML(d__('winry', 'Enable self-registration.')) ?>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="new_user_role"><?= EBB\escHTML(d__('winry', 'New User Role')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="new_user_role" id="new_user_role" class="form-control">
                        <?php $newUserRole = Options::getOption('new_user_role') ?>
                        <?php foreach ($acl->getRoles() as $role) : ?>
                        <option<?= EBB\toAttributes(['value' => $role, 'selected' => $role === $newUserRole]) ?>><?= EBB\escHTML($role) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="new_user_status"><?= EBB\escHTML(d__('winry', 'New User Status')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="new_user_status" id="new_user_status" class="form-control">
                        <?php $newUserStatus = Options::getOption('new_user_status') ?>
                        <?php foreach (['pending' => d__('winry', 'Pending'), 'activated' => d__('winry', 'Activated')] as $slug => $title) : ?>
                        <option<?= EBB\toAttributes(['value' => $slug, 'selected' => $slug === $newUserStatus]) ?>><?= EBB\escHTML($title) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </fieldset>

        <fieldset>

            <legend><?= EBB\escHTML(d__('winry', 'Donors Options')) ?></legend>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="new_user_role"><?= EBB\escHTML(d__('winry', 'Default E-mail Visibility')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="default_donor_email_visibility" id="default_donor_email_visibility" class="form-control">
                        <?php $defaultDonorEmailVisibility = Options::getOption('default_donor_email_visibility') ?>
                        <?php foreach (EBB\getVisibilities() as $visibilityKey => $visibilityTitle) : ?>
                        <option<?= EBB\toAttributes(['value' => $visibilityKey, 'selected' => $visibilityKey === $defaultDonorEmailVisibility]) ?>><?= EBB\escHTML($visibilityTitle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="new_user_role"><?= EBB\escHTML(d__('winry', 'Default Phone Visibility')) ?></label>
                </div>
                <div class="col-sm-4">
                    <select name="default_donor_phone_visibility" id="default_donor_phone_visibility" class="form-control">
                        <?php $defaultDonorPhoneVisibility = Options::getOption('default_donor_phone_visibility') ?>
                        <?php foreach (EBB\getVisibilities() as $visibilityKey => $visibilityTitle) : ?>
                        <option<?= EBB\toAttributes(['value' => $visibilityKey, 'selected' => $visibilityKey === $defaultDonorPhoneVisibility]) ?>><?= EBB\escHTML($visibilityTitle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </fieldset>

        <fieldset>

            <legend><?= EBB\escHTML(d__('winry', 'Reading Options')) ?></legend>

            <div class="form-group">
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label>
                            <input<?= EBB\toAttributes(['type' => 'checkbox', 'name' => 'site_publication', 'id' => 'site_publication', 'value' => 'on', 'checked' => ('on' === Options::getOption('site_publication'))]) ?>/>
                            <?= EBB\escHTML(d__('winry', 'Publicly accessible.')) ?>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <label for="entities_per_page"><?= EBB\escHTML(d__('winry', 'Entities Per Page')) ?> <span class="form-required">*</span></label>
                </div>
                <div class="col-sm-4">
                    <input type="number" name="entities_per_page" id="entities_per_page" class="form-control" value="<?= EBB\escAttr(Options::getOption('entities_per_page')) ?>" min="1" required />
                </div>
            </div>

        </fieldset>

        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary"><?= EBB\escHTML(d__('winry', 'Save Settings')) ?></button>
            </div>
        </div>

        <input type="hidden" name="action" value="save_settings" />

    </form>

<?php
$view->displayView('footer');
