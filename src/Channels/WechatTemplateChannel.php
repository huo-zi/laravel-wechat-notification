<?php
namespace Huozi\LaravelWechatNotification\Channels;

use Huozi\LaravelWechatNotification\Messages\WechatTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\WechatWorkMessage;
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
         * @var WechatTemplateMessage|WechatWorkMessage $message
         */
        $message = $notification->{'to' . Str::studly($this->channel)}($notifiable);
        if ($message instanceof WechatTemplateMessage && ! Arr::get($message->getMessage(), 'touser')) {
            $message->to($notifiable->routeNotificationFor($this->channel, $notification));
        } elseif ($message instanceof WechatWorkMessage && empty($message->to)) {
            $message->toUser($notifiable->routeNotificationFor($this->channel, $notification));
        }
        return $message->send();
    }
}
