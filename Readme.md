# Discord-PHP
A PHP library that makes sending Discord webhooks easier. Supports plain-text messages and Discord embeds messages.

## Installation
```sh
composer require woeler/phpdiscord
```

## Usage
Sending a text message
```php
$message = new DiscordTextMessage();
$message->setContent('Hello World');
$message->setAvatar('https://example.com/avatar.png');
$message->setUsername('Webhook Test');

$webhook =  new DiscordWebhook(
    'https://discordapp.com/api/webhooks/SomeWebHook',
    $message
);
$webhook->send();
```