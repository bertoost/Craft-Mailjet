<?php

namespace bertoost\mailjet\adapters;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\helpers\App;
use craft\mail\transportadapters\BaseTransportAdapter;
use Mailjet\MailjetSwiftMailer\SwiftMailer\MailjetTransport;
use Swift_Events_SimpleEventDispatcher;

class MailjetAdapter extends BaseTransportAdapter
{
    public string $apiKey = '';

    public string $apiSecret = '';

    public static function displayName(): string
    {
        return 'Mailjet';
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['parser'] = [
            'class'      => EnvAttributeParserBehavior::class,
            'attributes' => [
                'apiKey',
                'apiSecret',
            ],
        ];

        return $behaviors;
    }

    public function attributeLabels(): array
    {
        return [
            'apiKey'    => Craft::t('mailjet', 'API Key'),
            'apiSecret' => Craft::t('mailjet', 'API Secret'),
        ];
    }

    public function rules(): array
    {
        return [
            [['apiKey', 'apiSecret'], 'required'],
        ];
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('mailjet/settings', [
            'adapter' => $this,
        ]);
    }


    public function defineTransport(): array|AbstractTransport
    {
        return [
            'class' => MailjetTransport::class,
            'constructArgs' => [
                [
                    'class' => Swift_Events_SimpleEventDispatcher::class
                ],
                Craft::parseEnv($this->apiKey),
                Craft::parseEnv($this->apiSecret),
                true
            ],
        ];
    }

    /**
     * Returns whether or not the system is using this adapter
     */
    public static function isUsed(): bool
    {
        $mailTransport = Craft::$app->getMailer()->getTransport();

        return $mailTransport instanceof MailjetTransport;
    }
}