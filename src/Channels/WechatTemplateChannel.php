<?php
namespace Huozi\LaravelWechatNotification\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class WechatTemplateChannel
{

    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    public function send($notifiable, Notification $notification)
    {
        /**
         * @var \Huozi\LaravelWechatNotification\Messages\WechatTemplateMessage $message
         */
        $message = $notification->{'to' . Str::studly($this->channel)}($notifiable);

        if (! Arr::get($message->getMessage(), 'touser')) {
            $message->to($notifiable->routeNotificationFor($this->channel, $notification));
        }
        $res = $message->send();
        if ($res['errcode'] != 0) {
            throw new \Exception($res['errmsg'], $res['errcode']);
        }
    }
}
