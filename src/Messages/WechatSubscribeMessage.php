<?php
namespace Huozi\LaravelWechatNotification\Messages;

abstract class WechatSubscribeMessage
{

    /**
     * @var \EasyWeChat\OfficialAccount\Application|\EasyWeChat\MiniProgram\Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $message;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function send()
    {
        return $this->app->subscribe_message->send($this->message);
    }

    public function to($openid)
    {
        $this->message['touser'] = $openid;
        return $this;
    }

    public function template($templateId)
    {
        $this->message['template_id'] = $templateId;
        return $this;
    }

    public function data(array $data)
    {
        $this->message['data'] = $data;
        return $this;
    }
}

