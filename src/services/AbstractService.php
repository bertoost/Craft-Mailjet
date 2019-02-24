<?php

namespace bertoost\mailjet\services;

use Craft;
use craft\base\Component;
use yii\caching\CacheInterface;

/**
 * Class AbstractService
 */
class AbstractService extends Component
{
    /**
     * @var CacheInterface
     */
    public $cache;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->cache = Craft::$app->getCache();
    }

    /**
     * Clears the cached cache-keys
     */
    public function clearCaches(): void
    {
        $currentCache = $this->cache->get('mailjet.caching_keys');
        if (false !== $currentCache) {

            foreach ($currentCache as $cacheKey) {
                $this->cache->delete($cacheKey);
            }

            $this->cache->delete('mailjet.caching_keys');
        }
    }

    /**
     * @param string   $key
     * @param mixed    $value
     * @param int|null $duration
     */
    public function cacheIt(string $key, $value, int $duration = null): void
    {
        $this->cache->set($key, $value, $duration);
        $this->saveCachingKey($key);
    }

    /**
     * Stores cache keys in the cache, to be able to clear it when a new message is sent (listener)
     *
     * @param string $cacheKey
     */
    public function saveCachingKey(string $cacheKey): void
    {
        $currentCache = $this->cache->get('mailjet.caching_keys');
        if (false === $currentCache) {
            $currentCache = [];
        }

        // add new one to the list
        if (!in_array($cacheKey, $currentCache, true)) {
            $currentCache[] = $cacheKey;
        }

        // save caching keys
        $this->cache->set('mailjet.caching_keys', $currentCache);
    }
}