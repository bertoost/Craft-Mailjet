<?php

namespace bertoost\mailjet\models;

use craft\base\Model;

class Settings extends Model
{
    public string $apiSmsName = '';

    public string $apiSmsToken = '';

    public function rules(): array
    {
        return [
            [['apiSmsName', 'apiSmsToken'], 'required'],
            [['apiSmsName'], 'string', 'length' => [3, 11]],
        ];
    }
}