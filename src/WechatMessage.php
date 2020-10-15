<?php
namespace Huozi\LaravelWechatNotification;

use Overtrue\LaravelWeChat\Facade;
use Huozi\LaravelWechatNotification\Messages\OfficateAccountTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\MiniProgramTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\WechatPlatform;

class WechatMessage
{

    public static function officialAccount($name = null)
    {
        return new OfficateAccountTemplateMessage(Facade::officialAccount($name));
    }

    public static function miniProgram($name = null)
    {
        return new MiniProgramTemplateMessage(Facade::miniProgram($name));
    }

    public static function openFlatform($name = null)
    {
        return new WechatPlatform(Facade::openPlatform($name));
    }
}

