<?php

namespace bertoost\mailjet\assets\utility;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * Class UtilityAsset
 */
class UtilityAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->sourcePath = __DIR__;
        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/style.css',
        ];

        parent::init();
    }
}