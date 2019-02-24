<?php

namespace bertoost\mailjet\traits;

use bertoost\mailjet\services\MessagesService;

/**
 * Trait PluginComponentsTrait
 */
trait PluginComponentsTrait
{
    public function registerComponents(): void
    {
        $this->setComponents([
            'messages' => MessagesService::class,
        ]);
    }

    /**
     * @return MessagesService
     * @throws \yii\base\InvalidConfigException
     */
    public function getMessages(): MessagesService
    {
        return $this->get('messages');
    }
}