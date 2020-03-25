<?php

namespace Notification\SDK;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('notification.client', function ($app) {
            $options = $app['config']->get('notification');

            if (!isset($options['api_url'])) {
                throw new \InvalidArgumentException('Not found api_urL config');
            }

            if (!isset($options['access_token'])) {
                throw new \InvalidArgumentException('Not found access_token config');
            }

            return new NotificationClient($options['api_url'], $options['access_token']);
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('notification_service', function () {
                return new NotificationChannel(config('notification.channel_background'));
            });
        });
    }

    public function boot()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$this->configPath() => config_path('notification.php')], 'notification');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('notification');
        }
    }

    protected function configPath()
    {
        return __DIR__ . '/../config/notification.php';
    }
}
