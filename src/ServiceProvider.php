<?php
namespace Huozi\LaravelWechatNotification;

use Illuminate\Support\ServiceProvider AS LaravelServiceProvider;
use Illuminate\Support\Facades\Notification;
use Huozi\LaravelWechatNotification\Channels\WechatTemplateChannel;


class ServiceProvider extends LaravelServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $channels = [
            'official_account',
            'mini_program',
//             'open_platform'
        ];

        foreach ($channels as $channel) {
            Notification::extend($channel, function ($app) use ($channel) {
                return new WechatTemplateChannel($channel);
            });
        }
    }
}
