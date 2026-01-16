<?php
namespace Huozi\LaravelWechatNotification\Channels;

use Huozi\LaravelWechatNotification\Messages\WechatSubscribeMessage;
use Huozi\LaravelWechatNotification\Messages\WechatTemplateMessage;
use Huozi\LaravelWechatNotification\Messages\WechatWorkMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class WechatTemplateChannel
{

    private $channel;

    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    public function send($notifiable, Notification $notification)
    {
        $methodName = 'to' .  Str::studly($this->channel);
        $user = $notifiable->routeNotificationFor($this->channel, $notification);
        if (!method_exists($notification, $methodName) || !$user) {
            return;
        }

        /**
         * @var WechatTemplateMessage|WechatSubscribeMessage|WechatWorkMessage $message
         */
        $message = call_user_func([$notification, $methodName], $notifiable);;
        if (($message instanceof WechatTemplateMessage || $message instanceof WechatSubscribeMessage)) {
            $message->to($user);
        } elseif ($message instanceof WechatWorkMessage) {
            $message->toUser($user);
        }

        return $message->send();
    }
}
