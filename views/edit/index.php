<?php

declare(strict_types=1);
?>
<h1><?= _('Custom Banner') ?></h1>

<div>
    <p><?= _('On this page you can setup a custom banner to be displayed across all pages.') ?></p>
</div>

<div>
    <form class="default" method="post"
        action="<?= PluginEngine::getLink($plugin, [], EditController::NAME . DIRECTORY_SEPARATOR . EditController::SAVE_ACTION) ?>">
        <?= CSRFProtection::tokenTag() ?>

        <div>
            <label for="banner_enabled">
                <?= _('Banner enabled:') ?>
            </label>
            <select name="custombanner_enabled">
                <option value="0" <?php if (!$config['CUSTOMBANNER_ENABLED']): ?> selected<?php endif; ?>>
                    <?= _('No') ?>
                </option>
                <option value="1" <?php if ($config['CUSTOMBANNER_ENABLED']): ?> selected<?php endif; ?>>
                    <?= _('Yes') ?>
                </option>
            </select>
        </div>

        <div>
            <label for="banner_text_color">
                <?= _('Banner text color:') ?>
            </label>
            <input type="text" id="banner_text_color" name="custombanner_text_color"
                placeholder="<?= _('CSS color value') ?>" value="<?= $config['CUSTOMBANNER_TEXT_COLOR'] ?>"></input>
        </div>

        <div>
            <label for="banner_background_color">
                <?= _('Banner background color:') ?>
            </label>
            <input type="text" id="banner_background_color" name="custombanner_background_color"
                placeholder="<?= _('CSS color value') ?>"
                value="<?= $config['CUSTOMBANNER_BACKGROUND_COLOR'] ?>"></input>
        </div>

        <div>
            <label for="banner_message">
                <?= _('Banner message:') ?>
            </label>
            <div>
                <textarea id="banner_message" name="custombanner_message"
                    placeholder="<?= _('Enter your banner message') ?>" rows="2"
                    cols="60"><?= $config['CUSTOMBANNER_MESSAGE'] ?></textarea>
            </div>
        </div>

        <div>
            <?= \Studip\Button::create(
                _(
                    'Save'
                ),
                'save'
            ) ?>
        </div>
    </form>
</div>
