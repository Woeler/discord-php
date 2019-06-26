<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

class DiscordEmbedsMessage extends AbstractDiscordMessage
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $color;

    /**
     * @var \DateTimeInterface
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $footer_icon;

    /**
     * @var string
     */
    protected $footer_text;

    /**
     * @var string
     */
    protected $thumbnail;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var string
     */
    protected $author_name;

    /**
     * @var string
     */
    protected $author_url;

    /**
     * @var string
     */
    protected $author_icon;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * DiscordEmbedsMessage constructor.
     */
    public function __construct()
    {
        $this->timestamp = new \DateTime();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'username'   => $this->username,
            'content'    => $this->content,
            'avatar_url' => $this->avatar,
            'embeds'     => [[
                'title'       => $this->title,
                'description' => $this->description,
                'timestamp'   => $this->timestamp->format(\DateTime::ATOM),
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

        return $data;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @param string $title
     * @param string $value
     * @param bool   $inLine
     *
     * @return DiscordEmbedsMessage
     */
    public function addField(string $title, string $value, bool $inLine = false): self
    {
        $this->fields[] = [
            'name'   => $title,
            'value'  => $value,
            'inline' => $inLine,
        ];

        return $this;
    }

    /**
     * @param string $title
     *
     * @return bool
     */
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

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param string $title
     *
     * @return array
     */
    public function getField(string $title): array
    {
        return $this->findFieldByTitle($title);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return DiscordEmbedsMessage
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return DiscordEmbedsMessage
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return DiscordEmbedsMessage
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getColor(): int
    {
        return $this->color;
    }

    /**
     * @param int $color
     *
     * @return DiscordEmbedsMessage
     */
    public function setColor(int $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @param string $hexValue
     *
     * @return DiscordEmbedsMessage
     */
    public function setColorWithHexValue(string $hexValue): self
    {
        $hexValue    = str_replace('#', '', $hexValue);
        $this->color = hexdec($hexValue);

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTimestamp(): \DateTimeInterface
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTimeInterface $timestamp
     *
     * @return DiscordEmbedsMessage
     */
    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooterIcon(): string
    {
        return $this->footer_icon;
    }

    /**
     * @param string $footer_icon
     *
     * @return DiscordEmbedsMessage
     */
    public function setFooterIcon(string $footer_icon): self
    {
        $this->footer_icon = $footer_icon;

        return $this;
    }

    /**
     * @return string
     */
    public function getFooterText(): string
    {
        return $this->footer_text;
    }

    /**
     * @param string $footer_text
     *
     * @return DiscordEmbedsMessage
     */
    public function setFooterText(string $footer_text): self
    {
        $this->footer_text = $footer_text;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     *
     * @return DiscordEmbedsMessage
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return DiscordEmbedsMessage
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->author_name;
    }

    /**
     * @param string $author_name
     *
     * @return DiscordEmbedsMessage
     */
    public function setAuthorName(string $author_name): self
    {
        $this->author_name = $author_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorUrl(): string
    {
        return $this->author_url;
    }

    /**
     * @param string $author_url
     *
     * @return DiscordEmbedsMessage
     */
    public function setAuthorUrl(string $author_url): self
    {
        $this->author_url = $author_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorIcon(): string
    {
        return $this->author_icon;
    }

    /**
     * @param string $author_icon
     *
     * @return DiscordEmbedsMessage
     */
    public function setAuthorIcon(string $author_icon): self
    {
        $this->author_icon = $author_icon;

        return $this;
    }

    /**
     * @return array
     */
    public function formatForDiscord(): array
    {
        return $this->toArray();
    }

    /**
     * @param string $title
     *
     * @return array
     */
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
