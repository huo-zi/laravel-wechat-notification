<?php
namespace Huozi\LaravelWechatNotification;

use Overtrue\LaravelWeChat\Facade;
use Huozi\LaravelWechatNotification\Messages\OfficateAccountTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\MiniProgramTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\WechatWorkMessage;

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

    public static function work($name)
    {
        /**
         * @var \EasyWeChat\work\Application $app
         */
        $work = $name ? app('wechat.open_work.'.$name) : app('wechat.open_work');
        return new WechatWorkMessage($work->message);
    }

    public static function openWork($name)
    {
        return new WechatOpenWork($name ? app('wechat.open_work.'.$name) : app('wechat.open_work'));
    }
}

