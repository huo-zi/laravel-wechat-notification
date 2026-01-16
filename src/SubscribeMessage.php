<?php
namespace Huozi\LaravelWechatNotification;

use Overtrue\LaravelWeChat\Facade;
use Huozi\LaravelWechatNotification\Messages\OfficateAccountSubscribeMessage;
use Huozi\LaravelWechatNotification\Messages\MiniProgramSubscribeMessage;

class SubscribeMessage
{

    public static function officialAccount($name = null)
    {
        return new OfficateAccountSubscribeMessage(Facade::officialAccount($name));
    }

    public static function miniProgram($name = null)
    {
        return new MiniProgramSubscribeMessage(Facade::miniProgram($name));
    }

}

