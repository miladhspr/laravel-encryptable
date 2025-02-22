<?php

namespace MiladHspr\Encryptable;

use Illuminate\Support\ServiceProvider;

class EncryptableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/encryptable.php' => config_path('encryptable.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/encryptable.php', 'encryptable');
    }
}