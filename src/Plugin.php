<?php

namespace bertoost\mailjet;

use bertoost\mailjet\adapters\MailjetAdapter;
use craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use yii\base\Event;

/**
 * Class Plugin
 */
class Plugin extends BasePlugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // register adapter
        Event::on(
            MailerHelper::class,
            MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES,
            function(RegisterComponentTypesEvent $event) {
                $event->types[] = MailjetAdapter::class;
            }
        );
    }
}