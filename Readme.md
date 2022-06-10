# Discord-PHP
A PHP library that makes sending Discord webhooks easier. Supports plain-text messages and Discord embeds messages.

## Installation
```sh
composer require woeler/phpdiscord
```

## Usage
Sending a text message
```php
$message = (new DiscordTextMessage())
    ->setContent('Hello World')
    ->setAvatar('https://example.com/avatar.png')
    ->setUsername('Webhook Test');

$webhook = new DiscordWebhook('https://discordapp.com/api/webhooks/SomeWebHook');
$messageData = $webhook->send($message);
```

Sending an embed message
```php
$message = (new DiscordEmbedMessage())
    ->setContent('Hello World')
    ->setAvatar('https://example.com/avatar.png')
    ->setUsername('Webhook Test')
    ->setTitle('Hello Title')
    ->setDescription('Some nice description')
    ->addField('Field name', 'Field value')
    ->setImage('https://example.com/someimage.png');

$webhook = new DiscordWebhook('https://discordapp.com/api/webhooks/SomeWebHook');
$messageData = $webhook->send($message);
```

Updating a message
```php
$messageId = '12345';
$message = (new DiscordTextMessage())
    ->setContent('Hello World')
    ->setAvatar('https://example.com/avatar.png')
    ->setUsername('Webhook Test');

$webhook = new DiscordWebhook('https://discordapp.com/api/webhooks/SomeWebHook');
$messageData = $webhook->update($messageId, $message);
```

Deleting a message
```php
$messageId = '12345';

$webhook = new DiscordWebhook('https://discordapp.com/api/webhooks/SomeWebHook');
$webhook->delete($messageId);
```

Getting a message
```php
$messageId = '12345';

$webhook = new DiscordWebhook('https://discordapp.com/api/webhooks/SomeWebHook');
$messageData = $webhook->get($messageId);
```

Ratelimits are automatically handled for all calls.
