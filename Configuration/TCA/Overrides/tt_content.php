<?php

declare(strict_types=1);

defined('TYPO3') or die();

use B13\Codeblock\Backend\Preview\ContentPreviewRenderer;
use B13\Codeblock\DataProvider\CodeLanguages;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Register the CType, its showitem layout, the typeicon and the wizard entry
// in a single call. addRecordType() supersedes the older combination of
// addPlugin() / addTcaSelectItem() plus a manual $GLOBALS['TCA'][...]['types']
// assignment. The General, Language, Access, Notes and Extended tabs (plus
// their underlying system palettes) are added automatically based on the
// ctrl section since v13.3 (Feature #104814) — we only declare element-
// specific fields and any non-system tabs we actually want.
ExtensionManagementUtility::addRecordType(
    [
        'label' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.CType',
        'description' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.wizard.description',
        'value' => 'codeblock',
        'icon' => 'content-codeblock',
        'group' => 'default',
    ],
    '
        --palette--;;headers,
        code_language,
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
    ',
    [
        'previewRenderer' => ContentPreviewRenderer::class,
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'fixedFont' => true,
                ],
            ],
        ],
    ],
    'after:html'
);

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
