<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

interface DiscordMessageInterface
{
    public function formatForDiscord(): array;

    public function toArray(): array;

    public function toJson(): string;
}
