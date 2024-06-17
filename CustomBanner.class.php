<?php

declare(strict_types=1);

class CustomBanner extends StudIPPlugin implements SystemPlugin
{
    public const ID = 'custombanner';
    public const URL_PATH = '/admin/config/';

    public function __construct()
    {
        parent::__construct();

        $this->addNavigation();

        if (Config::get()->getValue('CUSTOMBANNER_ENABLED')) {
            $this->addBanner();
        }
    }

    private function addNavigation()
    {
        $navigation = Navigation::getItem(
            self::URL_PATH
        );
        $customBannerNav = new Navigation(
            _($this->getPluginName()),
            PluginEngine::getURL($this, [], 'edit')
        );
        $navigation->addSubNavigation(
            self::ID,
            $customBannerNav
        );
    }

    private function addBanner()
    {
        PageLayout::addStylesheet($this->getPluginURL() . '/assets/custom-banner.css');
        PageLayout::addScript($this->getPluginURL() . '/assets/custom-banner.js');

        $textColor = Config::get()->getValue('CUSTOMBANNER_TEXT_COLOR');
        $backgroundColor = Config::get()->getValue('CUSTOMBANNER_BACKGROUND_COLOR');
        $message = Config::get()->getValue('CUSTOMBANNER_MESSAGE');

        $customBannerHtml = <<<HTML
        <custom-banner
            style="color: ${textColor}; background-color: ${backgroundColor};"
        >
            ${message}
        </custom-banner>
        HTML;
        PageLayout::addBodyElements($customBannerHtml);
    }
}
