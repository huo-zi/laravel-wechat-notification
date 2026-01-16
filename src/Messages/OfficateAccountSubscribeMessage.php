<?php
namespace Huozi\LaravelWechatNotification\Messages;

class OfficateAccountSubscribeMessage extends WechatSubscribeMessage
{

    public function miniprogram($appId, $pagePath)
    {
        $this->message['miniprogram'] = compact('appid','pagepath');
        return $this;
    }

    public function url($url)
    {
        $this->message['url'] = $url;
        return $this;
    }

    public function title($title)
    {
        $this->message['title'] = $title;
        return $this;
    }

    public function content($content)
    {
        $this->message['data'] = compact('content');
        return $this;
    }

    public function scene($scene)
    {
        $this->message['scene'] = $scene;
        return $this;
    }

}

