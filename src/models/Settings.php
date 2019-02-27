<?php

namespace bertoost\mailjet\models;

use craft\base\Model;

/**
 * Class Settings
 */
class Settings extends Model
{
    /**
     * @var string
     */
    public $apiSmsName;

    /**
     * @var string
     */
    public $apiSmsToken;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apiSmsName', 'apiSmsToken'], 'required'],
            [['apiSmsName'], 'string', 'length' => [3, 11]],
        ];
    }
}