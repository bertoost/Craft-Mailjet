<?php

namespace bertoost\mailjet\adapters;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\helpers\App;
use craft\mail\transportadapters\BaseTransportAdapter;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetApiTransport;
use Symfony\Component\Mailer\Transport\AbstractTransport;

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
        return Craft::$app->getView()->renderTemplate(
            'mailjet/settings', [
                'adapter' => $this,
            ]
        );
    }


    public function defineTransport(): array|AbstractTransport
    {
        return new MailjetApiTransport(
            App::parseEnv($this->apiKey),
            App::parseEnv($this->apiSecret)
        );
    }

    public static function isUsed(): bool
    {
        $transportType = Craft::$app->getProjectConfig()->get('email.transportType');

        return $transportType === self::class;
    }
}