<?php

namespace Woeler\DiscordPhp\Message;

use JsonSerializable;

abstract class AbstractDiscordMessage implements JsonSerializable
{
    abstract public function toArray(): array;

    abstract public function jsonSerialize();
}
