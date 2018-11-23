<?php

namespace Woeler\DiscordPhp\Webhook;

use Woeler\DiscordPhp\Exception\DiscordInvalidResponseException;
use Woeler\DiscordPhp\Exception\DiscordNoContentException;
use Woeler\DiscordPhp\Message\DiscordMessageInterface;

class DiscordWebhook
{
    /**
     * @var string
     */
    protected $webhookUrl;

    /**
     * @var DiscordMessageInterface
     */
    protected $message;

    /**
     * DiscordWebhook constructor.
     *
     * @param string                  $webhookUrl
     * @param DiscordMessageInterface $message
     */
    public function __construct(string $webhookUrl, DiscordMessageInterface $message = null)
    {
        $this->webhookUrl = $webhookUrl;
        $this->message    = $message;
    }

    /**
     * @return int
     *
     * @throws DiscordNoContentException
     * @throws DiscordInvalidResponseException
     */
    public function send(): int
    {
        if (null === $this->message) {
            throw new DiscordNoContentException('Discord Webhook object does not have a message.');
        }

        $content = $this->message->formatForDiscord();

        if (empty($content['content']) && empty($content['embed'])) {
            throw new DiscordNoContentException('Discord Message object has no content.');
        }

        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code < 200 || $code >= 400) {
            throw new DiscordInvalidResponseException('Discord Webhook returned invalid response: '.$code.'.');
        }

        return $code;
    }

    /**
     * @return DiscordMessageInterface
     */
    public function getMessage(): DiscordMessageInterface
    {
        return $this->message;
    }

    /**
     * @param DiscordMessageInterface $message
     */
    public function setMessage(DiscordMessageInterface $message)
    {
        $this->message = $message;
    }
}
