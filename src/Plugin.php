<?php

namespace bertoost\mailjet;

use bertoost\mailjet\traits\PluginComponentsTrait;
use bertoost\mailjet\traits\PluginEventsTrait;
use Craft;
use craft\base\Plugin as BasePlugin;
use craft\i18n\PhpMessageSource;

/**
 * Class Plugin
 */
class Plugin extends BasePlugin
{
    use PluginComponentsTrait;
    use PluginEventsTrait;

    /**
     * @inheritdoc
     */
    public function init()
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
}