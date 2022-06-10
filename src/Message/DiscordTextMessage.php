<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

class DiscordTextMessage extends AbstractDiscordMessage
{
    public function jsonSerialize(): array
    {
        return [
            'content' => $this->content,
            'avatar_url' => $this->avatar,
            'username' => $this->username,
            'tts' => $this->tts,
        ];
    }
}
