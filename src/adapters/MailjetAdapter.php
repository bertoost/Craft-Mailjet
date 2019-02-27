<?php

namespace bertoost\mailjet\adapters;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\mail\transportadapters\BaseTransportAdapter;
use Mailjet\MailjetSwiftMailer\SwiftMailer\MailjetTransport;
use Swift_Events_SimpleEventDispatcher;

/**
 * Class MailjetAdapter
 */
class MailjetAdapter extends BaseTransportAdapter
{
    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var string
     */
    public $apiSecret;

    /**
     * {@inheritdoc}
     */
    public static function displayName(): string
    {
        return 'Mailjet';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apiKey'    => Craft::t('mailjet', 'API Key'),
            'apiSecret' => Craft::t('mailjet', 'API Secret'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apiKey', 'apiSecret'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('mailjet/settings', [
            'adapter' => $this,
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function defineTransport()
    {
        $clientOptions = ['url' => 'api.mailjet.com', 'version' => 'v3.1', 'call' => true];

        return [
            'class' => MailjetTransport::class,
            'constructArgs' => [
                [
                    'class' => Swift_Events_SimpleEventDispatcher::class
                ],
                Craft::parseEnv($this->apiKey),
                Craft::parseEnv($this->apiSecret),
                true,
                $clientOptions
            ],
        ];
    }

    /**
     * Returns whether or not the system is using this adapter
     *
     * @return bool
     */
    public static function isUsed(): bool
    {
        $mailTransport = Craft::$app->getMailer()->getTransport();

        return $mailTransport instanceof MailjetTransport;
    }
}