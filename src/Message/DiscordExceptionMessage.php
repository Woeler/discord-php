<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Message;

/**
 * Class DiscordExceptionMessage.
 */
class DiscordExceptionMessage extends DiscordEmbedsMessage
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var bool
     */
    private $wasFormatted = false;

    /**
     * DiscordExceptionMessage constructor.
     *
     * @param \Exception $e
     *
     * @throws \Exception
     */
    public function __construct(\Exception $e)
    {
        $this->exception = $e;
        parent::__construct();
    }

    /**
     * @return array
     */
    public function formatForDiscord(): array
    {
        if (!$this->wasFormatted) {
            $this->setTitle('New '.get_class($this->exception));
            $this->setDescription('```'.$this->exception->getMessage().'```');
            $this->addField('File', $this->exception->getFile());
            $this->addField('Line', $this->exception->getLine());
            $this->wasFormatted = true;
        }

        return parent::formatForDiscord();
    }
}
