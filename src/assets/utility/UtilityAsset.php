<?php

namespace bertoost\mailjet\assets\utility;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class UtilityAsset extends AssetBundle
{
    public function init(): void
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