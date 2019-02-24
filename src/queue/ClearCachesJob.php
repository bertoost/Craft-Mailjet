<?php

namespace bertoost\mailjet\queue;

use bertoost\mailjet\Plugin;
use Craft;
use craft\queue\BaseJob;

/**
 * Class ClearCachesJob
 */
class ClearCachesJob extends BaseJob
{
    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return Craft::t('mailjet', 'Clear Mailjet caches');
    }

    /**
     * {@inheritdoc}
     */
    public function execute($queue)
    {
        Plugin::getInstance()->getMessages()->clearCaches();
    }
}