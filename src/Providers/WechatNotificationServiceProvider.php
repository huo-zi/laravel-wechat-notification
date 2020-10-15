<?php
namespace Huozi\LaravelWechatNotification\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use Huozi\LaravelWechatNotification\Channels\WechatTemplateChannel;

class WechatNotificationServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $channels = [
            'officate_template',
            'miniprogram_template',
            'open_platform'
        ];

        foreach ($channels as $channel){
            Notification::extend($channel, function ($app) use ($channel) {
                return new WechatTemplateChannel($channel);
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
