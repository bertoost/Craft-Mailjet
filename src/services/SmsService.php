<?php

namespace bertoost\mailjet\services;

use Craft;
use bertoost\mailjet\models\Settings;
use bertoost\mailjet\Plugin;
use Mailjet\Client;
use Mailjet\Resources;

/**
 * Class SmsService
 */
class SmsService extends AbstractService
{
    /**
     * @var Settings
     */
    public $settings;

    /**
     * @var Client
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->settings = Plugin::getInstance()->getSettings();

        $this->client = new Client(Craft::parseEnv($this->settings->apiSmsToken));
    }

    /**
     * Sends an SMS message
     *
     * @param string $to
     * @param string $message
     *
     * @return bool
     */
    public function send(string $to, string $message): bool
    {
        $result = $this->client->post(Resources::$SmsSend, [
            'body' => [
                'From' => Craft::parseEnv($this->settings->apiSmsName),
                'To'   => $to,
                'Text' => $message,
            ],
        ]);

        if ($result->success()) {

            return true;
        }

        return false;
    }
}
