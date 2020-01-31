<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

use DateTimeInterface;

class DiscordEmbedMessage extends AbstractDiscordMessage
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
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $color;

    /**
     * @var DateTimeInterface
     */
    private $timestamp;

    /**
     * @var string
     */
    private $footer_icon;

    /**
     * @var string
     */
    private $footer_text;

    /**
     * @var string
     */
    private $thumbnail;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $author_name;

    /**
     * @var string
     */
    private $author_url;

    /**
     * @var string
     */
    private $author_icon;

    /**
     * @var array
     */
    private $fields = [];

    /**
     * @var bool
     */
    private $tts = false;

    public function toArray(): array
    {
        return [
            'username'   => $this->username,
            'content'    => $this->content,
            'avatar_url' => $this->avatar,
            'tts'        => $this->tts,
            'embeds'     => [[
                'title'       => $this->title,
                'description' => $this->description,
                'timestamp'   => null === $this->timestamp ? null : $this->timestamp->format(\DateTime::ATOM),
                'url'         => $this->url,
                'color'       => $this->color,
                'author'      => [
                    'name'     => $this->author_name,
                    'url'      => $this->author_url,
                    'icon_url' => $this->author_icon,
                ],
                'image' => [
                    'url' => $this->image,
                ],
                'thumbnail' => [
                    'url' => $this->thumbnail,
                ],
                'fields' => $this->fields,
                'footer' => [
                    'text'     => $this->footer_text,
                    'icon_url' => $this->footer_icon,
                ],
            ]],
        ];
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTimestamp(): ?DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getFooterIcon(): ?string
    {
        return $this->footer_icon;
    }

    public function setFooterIcon(string $footer_icon): self
    {
        $this->footer_icon = $footer_icon;

        return $this;
    }

    public function getFooterText(): ?string
    {
        return $this->footer_text;
    }

    public function setFooterText(string $footer_text): self
    {
        $this->footer_text = $footer_text;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->author_name;
    }

    public function setAuthorName(string $author_name): self
    {
        $this->author_name = $author_name;

        return $this;
    }

    public function getAuthorUrl(): ?string
    {
        return $this->author_url;
    }

    public function setAuthorUrl(string $author_url): self
    {
        $this->author_url = $author_url;

        return $this;
    }

    public function getAuthorIcon(): ?string
    {
        return $this->author_icon;
    }

    public function setAuthorIcon(string $author_icon): self
    {
        $this->author_icon = $author_icon;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
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

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function addField(string $title, string $value, bool $inLine = false): self
    {
        $this->fields[] = [
            'name'   => $title,
            'value'  => $value,
            'inline' => $inLine,
        ];

        return $this;
    }

    public function removeField(string $title): bool
    {
        foreach ($this->fields as $key => $field) {
            if ($field['name'] === $title) {
                unset($this->fields[$key]);

                return true;
            }
        }

        return false;
    }

    public function getField(string $title): array
    {
        return $this->findFieldByTitle($title);
    }

    public function setColorWithHexValue(string $hexValue): self
    {
        $hexValue    = str_replace('#', '', $hexValue);
        $this->color = hexdec($hexValue);

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    protected function findFieldByTitle(string $title): array
    {
        foreach ($this->fields as $field) {
            if ($field['name'] === $title) {
                return $field;
            }
        }

        return [];
    }
}
