<?php

namespace bertoost\mailjet\traits;

use bertoost\mailjet\services\MessagesService;
use bertoost\mailjet\services\SmsService;

/**
 * Trait PluginComponentsTrait
 */
trait PluginComponentsTrait
{
    public function registerComponents(): void
    {
        $this->setComponents([
            'messages' => MessagesService::class,
            'sms'      => SmsService::class,
        ]);
    }

    /**
     * @return MessagesService
     */
    public function getMessages(): MessagesService
    {
        return $this->get('messages');
    }

    /**
     * @return SmsService
     */
    public function getSms(): SmsService
    {
        return $this->get('sms');
    }
}