<?php
/**
 * Created by PhpStorm.
 * User: woeler
 * Date: 22.11.18
 * Time: 18:55
 */

namespace Woeler\DiscordPhp\Message;


interface DiscordMessageInterface
{
    /**
     * @return array
     */
    public function formatForDiscord(): array;
}