<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\oauth2;

use yii\base\BaseObject;
use yuncms\oauth2\models\AccessToken;
use yuncms\oauth2\models\AuthorizationCode;
use yuncms\oauth2\models\RefreshToken;

/**
 * Class Cron
 * @package yuncms\oauth2
 */
class Cron extends BaseObject
{
    public static function clear()
    {
        AuthorizationCode::deleteAll(['<', 'expires', time()]);
        RefreshToken::deleteAll(['<', 'expires', time()]);
        AccessToken::deleteAll(['<', 'expires', time()]);
    }
}