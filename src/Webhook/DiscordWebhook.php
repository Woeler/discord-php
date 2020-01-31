<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Webhook;

use Woeler\DiscordPhp\Exception\DiscordInvalidResponseException;
use Woeler\DiscordPhp\Message\AbstractDiscordMessage;

class DiscordWebhook
{
    /**
     * The url prefix for Discord webhooks. In case you use want to use the identifier.
     */
    public const DISCORD_WEBHOOK_URL_PREFIX = 'https://discordapp.com/api/webhooks/';

    /**
     * @var string
     */
    private $webhookUrl;

    public function __construct(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    /**
     * @throws DiscordInvalidResponseException
     */
    public function send(AbstractDiscordMessage $message): int
    {
        $sent = false;

        while (!$sent) {
            $ch = curl_init($this->webhookUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type: application/json']);
            $response = curl_exec($ch);
            $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if (429 === $code) {
                $response = json_decode($response, false);
                usleep($response->retry_after * 1000);
            } else {
                $sent = true;
                if ($code < 200 || $code >= 400) {
                    throw new DiscordInvalidResponseException('Discord Webhook returned invalid response: '.$code.'.', $code);
                }
            }
        }

        return $code;
    }
}
