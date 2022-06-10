<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

use DateTimeInterface;

class DiscordEmbedMessage extends AbstractDiscordMessage
{
    private ?string $title = null;
    private ?string $description = null;
    private ?string $url = null;
    private ?int $color = null;
    private ?\DateTimeInterface $timestamp = null;
    private ?string $footer_icon = null;
    private ?string $footer_text = null;
    private ?string $thumbnail = null;
    private ?string $image = null;
    private ?string $author_name = null;
    private ?string $author_url = null;
    private ?string $author_icon = null;
    private array $fields = [];

    public function jsonSerialize(): array
    {
        return [
            'username' => $this->username,
            'content' => $this->content,
            'avatar_url' => $this->avatar,
            'tts' => $this->tts,
            'embeds' => [[
                'title' => $this->title,
                'description' => $this->description,
                'timestamp' => $this->timestamp?->format('Y-m-d\TH:i:sP'),
                'url' => $this->url,
                'color' => $this->color,
                'author' => [
                    'name' => $this->author_name,
                    'url' => $this->author_url,
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
                    'text' => $this->footer_text,
                    'icon_url' => $this->footer_icon,
                ],
            ]],
        ];
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(int $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getTimestamp(): ?DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getFooterIcon(): ?string
    {
        return $this->footer_icon;
    }

    public function setFooterIcon(string $footer_icon): static
    {
        $this->footer_icon = $footer_icon;

        return $this;
    }

    public function getFooterText(): ?string
    {
        return $this->footer_text;
    }

    public function setFooterText(string $footer_text): static
    {
        $this->footer_text = $footer_text;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->author_name;
    }

    public function setAuthorName(string $author_name): static
    {
        $this->author_name = $author_name;

        return $this;
    }

    public function getAuthorUrl(): ?string
    {
        return $this->author_url;
    }

    public function setAuthorUrl(string $author_url): static
    {
        $this->author_url = $author_url;

        return $this;
    }

    public function getAuthorIcon(): ?string
    {
        return $this->author_icon;
    }

    public function setAuthorIcon(string $author_icon): static
    {
        $this->author_icon = $author_icon;

        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): static
    {
        $this->fields = $fields;

        return $this;
    }

    public function addField(string $title, string $value, bool $inLine = false): static
    {
        $this->fields[] = [
            'name' => $title,
            'value' => $value,
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

    public function setColorWithHexValue(string $hexValue): static
    {
        $hexValue = str_replace('#', '', $hexValue);
        $this->color = hexdec($hexValue);

        return $this;
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
