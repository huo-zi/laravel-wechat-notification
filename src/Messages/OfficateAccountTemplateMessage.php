<?php
namespace Huozi\LaravelWechatNotification\Messages;

class OfficateAccountTemplateMessage extends WechatTemplateMessage
{
    public function miniprogram($appId, $pagePath)
    {
        $this->message['miniprogram'] = [
            'appid' => $appId,
            'pagepath' => $pagePath
        ];
        return $this;
    }
}

