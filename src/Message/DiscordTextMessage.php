<?php
declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

class DiscordTextMessage extends AbstractDiscordMessage
{
    /**
     * @return array
     */
    public function formatForDiscord(): array
    {
        $return               = [];
        $return['content']    = $this->content;
        $return['avatar_url'] = $this->avatar;
        $return['username']   = $this->username;

        return $return;
    }
}
