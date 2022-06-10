<?php

declare(strict_types=1);

namespace Woeler\DiscordPhp\Exception;

class DiscordInvalidResponseException extends \Exception
{
    private array $errorData;

    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null, array $errorData = [])
    {
        parent::__construct($message, $code, $previous);
        $this->errorData = $errorData;
    }

    public function getErrorData(): array
    {
        return $this->errorData;
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }
}
