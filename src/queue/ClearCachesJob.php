<?php

namespace bertoost\mailjet\queue;

use bertoost\mailjet\Plugin;
use Craft;
use craft\queue\BaseJob;

class ClearCachesJob extends BaseJob
{
    public function getDescription(): ?string
    {
        return Craft::t('mailjet', 'Clear Mailjet caches');
    }

    public function execute($queue): void
    {
        Plugin::getInstance()->getMessages()->clearCaches();
    }
}