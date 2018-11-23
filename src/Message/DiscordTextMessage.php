<?php
/**
 * Created by PhpStorm.
 * User: woeler
 * Date: 22.11.18
 * Time: 19:02
 */

namespace Woeler\DiscordPhp\Message;


class DiscordTextMessage extends AbstractDiscordMessage
{
    public function formatForDiscord(): array
    {
        $return = [];
        $return['content'] = $this->content;
        $return['avatar_url'] = $this->avatar;
        $return['username'] = $this->username;

        return $return;
    }
}