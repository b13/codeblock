<?php

declare(strict_types=1);

defined('TYPO3') or die();

use B13\Codeblock\Backend\Preview\ContentPreviewRenderer;
use B13\Codeblock\DataProvider\CodeLanguages;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.CType',
        'value' => 'codeblock',
        'icon' => 'content-codeblock',
        'group' => 'default',
        'description' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.wizard.description',
    ],
    'html',
    'after'
);

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['codeblock'] = 'content-codeblock';

$GLOBALS['TCA']['tt_content']['types']['codeblock'] = [
    'previewRenderer' => ContentPreviewRenderer::class,
    'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;;general,
                --palette--;;headers,
                bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;;frames,
                --palette--;;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'fixedFont' => true,
            ],
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    [
        'code_language' => [
            'label' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.code_language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => '',
                'itemsProcFunc' => CodeLanguages::class . '->getAll',
            ],
        ],
    ]
);

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'code_language',
    'codeblock',
    'before:bodytext'
);
