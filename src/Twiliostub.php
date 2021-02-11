<?php

namespace Robs007\Twiliostub;

use Twilio\Rest\Client;

class Twiliostub
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create($number, [
            'from' => config('twiliostub.sms_from'),
            'body' => $message,
        ]);
    }

}
