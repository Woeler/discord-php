<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src');
return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'binary_operator_spaces' => [
            'align_double_arrow' => true,
            'align_equals' => true
        ],
        'ordered_imports' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'ordered_class_elements' => ['use_trait', 'constant_public', 'constant_protected', 'constant_private', 'property_public', 'property_protected', 'property_private', 'construct', 'destruct', 'magic', 'phpunit', 'method_public', 'method_protected', 'method_private'],
    ])
    ->setFinder($finder);