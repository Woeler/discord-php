<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

use JsonSerializable;

abstract class AbstractDiscordMessage implements JsonSerializable
{
    protected ?string $content = null;
    protected ?string $avatar = null;
    protected ?string $username = null;
    protected bool $tts = false;

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function setAvatar(string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function isTts(): bool
    {
        return $this->tts;
    }

    public function setTts(bool $tts): static
    {
        $this->tts = $tts;

        return $this;
    }

    abstract public function jsonSerialize(): array;
}
