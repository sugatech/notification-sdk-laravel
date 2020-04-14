<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;

abstract class Payload implements Arrayable
{
    abstract public function setTo($notifiable, $notification);
}