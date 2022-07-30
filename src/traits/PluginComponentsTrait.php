<?php

namespace bertoost\mailjet\traits;

use bertoost\mailjet\services\MessagesService;
use bertoost\mailjet\services\SmsService;

trait PluginComponentsTrait
{
    public function registerComponents(): void
    {
        $this->setComponents(
            [
                'messages' => MessagesService::class,
                'sms'      => SmsService::class,
            ]
        );
    }

    public function getMessages(): MessagesService
    {
        return $this->get('messages');
    }

    public function getSms(): SmsService
    {
        return $this->get('sms');
    }
}