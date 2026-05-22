<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Content Type "Code Block"',
    'description' => 'Content type for displaying source code with syntax highlighting.',
    'category' => 'fe',
    'author' => 'Andreas Hämmerl, David Steeb',
    'author_email' => 'typo3@b13.com',
    'author_company' => 'b13 GmbH',
    'state' => 'stable',
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
            'php' => '8.2.0-8.99.99',
        ],
    ],
];
