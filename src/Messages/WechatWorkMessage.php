<?php
namespace Huozi\LaravelWechatNotification\Messages;

use EasyWeChat\Work\Message\Messenger;

class WechatWorkMessage extends Messenger
{

    protected $to = [];

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function getToUser()
    {
        return $this->to;
    }
}

