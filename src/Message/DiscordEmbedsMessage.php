<?php

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
     * @var \DateTime
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
     *
     * @throws \Exception
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
        $embeds                       = [];
        $embeds['title']              = $this->title;
        $embeds['description']        = $this->description;
        $embeds['url']                = $this->url;
        $embeds['color']              = $this->color;
        $embeds['timestamp']          = $this->timestamp->getTimestamp();
        $embeds['footer']['icon_url'] = $this->footer_icon;
        $embeds['footer']['text']     = $this->footer_text;
        $embeds['thumbnail']['url']   = $this->thumbnail;
        $embeds['image']['url']       = $this->image;
        $embeds['author']['name']     = $this->author_name;
        $embeds['author']['url']      = $this->author_url;
        $embeds['author']['icon_url'] = $this->author_icon;
        $embeds['fields']             = $this->fields;

        $return               = [];
        $return['content']    = $this->content;
        $return['avatar_url'] = $this->avatar;
        $return['username']   = $this->username;
        $return['embed']      = $embeds;

        return $return;
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
     */
    public function addField(string $title, string $value, bool $inLine = false)
    {
        $this->fields[] = [
            'name'   => $title,
            'value'  => $value,
            'inline' => $inLine,
        ];
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
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
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
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
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
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
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
     */
    public function setColor(int $color)
    {
        $this->color = $color;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
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
     */
    public function setFooterIcon(string $footer_icon)
    {
        $this->footer_icon = $footer_icon;
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
     */
    public function setFooterText(string $footer_text)
    {
        $this->footer_text = $footer_text;
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
     */
    public function setThumbnail(string $thumbnail)
    {
        $this->thumbnail = $thumbnail;
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
     */
    public function setImage(string $image)
    {
        $this->image = $image;
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
     */
    public function setAuthorName(string $author_name)
    {
        $this->author_name = $author_name;
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
     */
    public function setAuthorUrl(string $author_url)
    {
        $this->author_url = $author_url;
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
     */
    public function setAuthorIcon(string $author_icon)
    {
        $this->author_icon = $author_icon;
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
