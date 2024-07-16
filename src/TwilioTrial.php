<?php

namespace Dotunj\TwilioTrial;

use Twilio\Rest\Client;

class TwilioTrial
{
    /** @var Twilio\Rest\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create($number, [
            'from' => config('twiliotrial.sms_from'),
            'body' => $message
        ]);
    }
}