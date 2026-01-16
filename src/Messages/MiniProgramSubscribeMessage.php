<?php

namespace Huozi\LaravelWechatNotification\Messages;

class MiniProgramSubscribeMessage extends WechatSubscribeMessage
{

    /**
     * @var array
     */
    protected $message = [
        'miniprogram_state' => 'formal',
        'lang' => 'zh_CN',
    ];

    public function page($page)
    {
        $this->message['page'] = $page;
        return $this;
    }

    /**
     * developer为开发版；trial为体验版；formal为正式版
     */
    public function state($state = 'formal')
    {
        $this->message['miniprogram_state'] = $state;
        return $this;
    }

    public function lang($lang)
    {
        $this->message['lang'] = $lang;
        return $this;
    }

}