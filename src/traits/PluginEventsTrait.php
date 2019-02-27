<?php

namespace bertoost\mailjet\traits;

use bertoost\mailjet\adapters\MailjetAdapter;
use bertoost\mailjet\Plugin;
use bertoost\mailjet\queue\ClearCachesJob;
use bertoost\mailjet\utilities\MailjetEventsUtility;
use Craft;
use craft\events\RegisterCacheOptionsEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use craft\mail\Mailer;
use craft\services\Utilities;
use craft\utilities\ClearCaches;
use yii\base\Event;
use yii\mail\MailEvent;

/**
 * Trait PluginEventsTrait
 */
trait PluginEventsTrait
{
    /**
     * Register event listeners
     */
    public function registerEvents(): void
    {
        // register adapter
        Event::on(
            MailerHelper::class,
            MailerHelper::EVENT_REGISTER_MAILER_TRANSPORT_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = MailjetAdapter::class;
            }
        );

        // when using Mailject
        if (MailjetAdapter::isUsed()) {

            // register utility
            Event::on(
                Utilities::class,
                Utilities::EVENT_REGISTER_UTILITY_TYPES,
                function (RegisterComponentTypesEvent $event) {
                    $event->types[] = MailjetEventsUtility::class;
                }
            );

            // clear cache when new email is sent
            Event::on(
                Mailer::class,
                Mailer::EVENT_AFTER_SEND,
                function (MailEvent $event) {
                    Craft::$app->getQueue()->push(new ClearCachesJob());
                }
            );

            // add-in clear cache tool
            Event::on(
                ClearCaches::class,
                ClearCaches::EVENT_REGISTER_CACHE_OPTIONS,
                function (RegisterCacheOptionsEvent $event) {
                    $event->options[] = [
                        'key'    => 'mailjet-caches',
                        'label'  => Craft::t('mailjet', 'Mailjet caches'),
                        'action' => [Plugin::getInstance()->getMessages(), 'clearCaches'],
                    ];
                }
            );
        }
    }
}
