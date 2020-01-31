<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Webhook;

use Woeler\DiscordPhp\Exception\DiscordInvalidResponseException;
use Woeler\DiscordPhp\Message\DiscordMessageInterface;

class DiscordWebhook
{
    /**
     * The url prefix for Discord webhooks. In case you use want to use the identifier.
     */
    public const DISCORD_WEBHOOK_URL_PREFIX = 'https://discordapp.com/api/webhooks/';

    /**
     * @var string
     */
    protected $webhookUrl;

    public function __construct(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    /**
     * @throws DiscordInvalidResponseException
     */
    public function send(DiscordMessageInterface $message): int
    {
        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message->toJson());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type: application/json']);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code < 200 || $code >= 400) {
            throw new DiscordInvalidResponseException('Discord Webhook returned invalid response: '.$code.'.', $code);
        }

        return $code;
    }
}
