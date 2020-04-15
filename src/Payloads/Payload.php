<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;

abstract class Payload implements Arrayable
{
    abstract public function getTo();

    abstract public function setTo($to);
}