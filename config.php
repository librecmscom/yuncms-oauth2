<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
return [
    'name' => 'oauth2',
    'migrationNamespace' => 'yuncms\oauth2\migrations',
    'i18n' => [
        'class' => 'yii\i18n\PhpMessageSource',
        'sourceLanguage' => 'en-US',
        'basePath' => '@yuncms/oauth2/messages'
    ],
    'backend' => [
        'class' => 'yuncms\oauth2\backend\Module'
    ],
    'frontend' => [
        'class' => 'yuncms\oauth2\frontend\Module'
    ],
];