<?php

$EM_CONF['codeblock'] = [
    'title' => 'Content Type "Code Block"',
    'description' => 'Content type for displaying source code with syntax highlighting.',
    'category' => 'fe',
    'author' => 'Andreas Hämmerl, David Steeb',
    'author_email' => 'typo3@b13.com',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author_company' => 'b13 GmbH, Stuttgart',
    'version' => '1.2.0',
    'constraints' => [
            'depends' => [
                'typo3' => '9.5.99-10.99.99',
            ],
        ],
];
