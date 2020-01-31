<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

class DiscordTextMessage extends AbstractDiscordMessage
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $username;

    /**
     * @var bool
     */
    private $tts = false;

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function setUsername(string $username): self
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

    public function setTts(bool $tts): self
    {
        $this->tts = $tts;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'content'    => $this->content,
            'avatar_url' => $this->avatar,
            'username'   => $this->username,
            'tts'        => $this->tts,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
