<?php

namespace Notification\SDK;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'notification');

        $this->app->singleton('notification.client', function ($app) {
            $options = $app['config']->get('notification');

            if (!isset($options['api_url'])) {
                throw new \InvalidArgumentException('Not found api_url config');
            }

            if (!isset($options['oauth']['url'])) {
                throw new \InvalidArgumentException('Not found oauth.url config');
            }

            if (!isset($options['oauth']['client_id'])) {
                throw new \InvalidArgumentException('Not found oauth.client_id config');
            }

            if (!isset($options['oauth']['client_secret'])) {
                throw new \InvalidArgumentException('Not found oauth.client_secret config');
            }

            return new NotificationClient($options['api_url']);
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('notification_service', function () {
                return new NotificationChannel();
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
