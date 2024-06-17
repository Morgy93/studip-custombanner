<?php

declare(strict_types=1);

class EditController extends PluginController
{
    public const NAME = 'edit';
    public const SAVE_ACTION = 'save';
    private const USER_PERM = 'root';

    public function __construct($dispatcher)
    {
        parent::__construct($dispatcher);

        $configFields = Config::get()->getFields('global', CustomBanner::ID);
        foreach ($configFields as $field) {
            $this->config[$field] = Config::get()->getValue($field);
        }
    }

    public function index_action()
    {
        if (Navigation::hasItem(CustomBanner::URL_PATH . CustomBanner::ID)) {
            Navigation::activateItem(CustomBanner::URL_PATH . CustomBanner::ID);
        }

        $this->checkAccess();
    }

    private function checkAccess()
    {
        if (!$GLOBALS['perm']->have_perm(self::USER_PERM)) {
            throw new AccessDeniedException();
        }
    }

    public function save_action()
    {
        $this->checkAccess();

        if (!Request::isPost() && !Request::isAjax()) {
            throw new MethodNotAllowedException();
        }

        CSRFProtection::verifyUnsafeRequest();

        Config::get()->store('CUSTOMBANNER_ENABLED', Request::int('custombanner_enabled', 0));
        Config::get()->store('CUSTOMBANNER_TEXT_COLOR', Request::get('custombanner_text_color'));
        Config::get()->store('CUSTOMBANNER_BACKGROUND_COLOR', Request::get('custombanner_background_color'));
        Config::get()->store('CUSTOMBANNER_MESSAGE', Request::get('custombanner_message'));

        PageLayout::postSuccess(_('Settings saved.'));

        $this->redirect(self::NAME);
    }
}
