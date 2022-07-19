<?php

namespace bertoost\mailjet;

use bertoost\mailjet\models\Settings;
use bertoost\mailjet\traits\PluginComponentsTrait;
use bertoost\mailjet\traits\PluginEventsTrait;
use Craft;
use craft\base\Plugin as BasePlugin;
use craft\i18n\PhpMessageSource;

class Plugin extends BasePlugin
{
    use PluginComponentsTrait,
        PluginEventsTrait;

    public bool $hasCpSettings = true;

    public function init(): void
    {
        Craft::setAlias('@bertoost\mailjet', $this->getBasePath());

        parent::init();

        $this->registerComponents();
        $this->registerEvents();
        $this->registerTranslations();
    }

    /**
     * Registers translation definition
     */
    private function registerTranslations()
    {
        Craft::$app->i18n->translations['mailjet*'] = [
            'class'          => PhpMessageSource::class,
            'sourceLanguage' => 'en',
            'basePath'       => $this->getBasePath() . '/translations',
            'allowOverrides' => true,
            'fileMap'        => [
                'mailjet'     => 'site',
                'mailjet-app' => 'app',
            ],
        ];
    }

    protected function createSettingsModel(): ?Settings
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        $settings = $this->getSettings();
        if (empty($settings->apiSmsName)) {

            $systemName = Craft::$app->getSystemName();
            $systemName = preg_replace('/[^a-zA-Z0-9]+/', '', $systemName);

            $settings->apiSmsName = substr($systemName, 0, 11);
        }

        return \Craft::$app->getView()->renderTemplate('mailjet/sms/settings', [
            'settings' => $settings,
        ]);
    }
}