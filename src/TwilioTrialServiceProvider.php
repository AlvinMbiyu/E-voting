<?php

namespace Dotunj\TwilioTrial;

use Exception;
use Twilio\Rest\Client;
use Dotunj\TwilioTrial\TwilioTrial;
use Illuminate\Support\ServiceProvider;

class TwilioTrialServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/TwilioTrial.php', 'twiliotrial');

        $this->app->bind('twiliotrial', function () {
            $this->ensureConfigValuesAreSet();
            $client = new Client(config('twiliotrial.account_sid'), config('twiliotrial.auth_token'));
            return new TwilioTrial($client);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    protected function ensureConfigValuesAreSet()
    {
        $mandatoryAttributes = config('twiliotrial');

        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw new Exception("Please provide a value for ${key}");
            }
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/TwilioTrial.php' => config_path('twiliotrial.php'),
        ], 'twiliotrial-config');
    }
}