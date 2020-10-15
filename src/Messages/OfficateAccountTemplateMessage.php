<?php
namespace Huozi\LaravelWechatNotification\Messages;

class OfficateAccountTemplateMessage extends WechatTemplateMessage
{
    public function miniprogram()
    {
        return $this;
    }
}

