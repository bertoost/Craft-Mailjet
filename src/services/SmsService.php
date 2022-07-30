<?php

namespace bertoost\mailjet\services;

use bertoost\mailjet\models\Settings;
use bertoost\mailjet\Plugin;
use craft\helpers\App;
use Mailjet\Client;
use Mailjet\Resources;

class SmsService extends AbstractService
{
    public Settings $settings;

    private Client $client;

    public function init(): void
    {
        parent::init();

        $this->settings = Plugin::getInstance()->getSettings();

        $this->client = new Client(App::parseEnv($this->settings->apiSmsToken));
    }

    public function send(string $to, string $message): bool
    {
        $result = $this->client->post(
            Resources::$SmsSend, [
                'body' => [
                    'From' => App::parseEnv($this->settings->apiSmsName),
                    'To'   => $to,
                    'Text' => $message,
                ],
            ]
        );

        if ($result->success()) {
            return true;
        }

        return false;
    }
}
