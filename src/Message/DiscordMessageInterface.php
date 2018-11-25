<?php
declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

interface DiscordMessageInterface
{
    /**
     * @return array
     */
    public function formatForDiscord(): array;
}
