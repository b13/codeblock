<?php

defined('TYPO3') or die();

call_user_func(static function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        ['LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.CType', 'codeblock', 'content-codeblock'],
        'html',
        'after'
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['codeblock'] = 'content-codeblock';

    $GLOBALS['TCA']['tt_content']['types']['codeblock'] = [
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

    $additionalColumns = [
        'code_language' => [
            'label' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.code_language',
            'config' => [
                'type' => 'select',
                'default' => '',
                'itemsProcFunc' => \B13\Codeblock\DataProvider\CodeLanguages::class . '->getAll',
                'renderType' => 'selectSingle',
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        'code_language',
        'codeblock',
        'before:bodytext'
    );

    // for fluidBasedPageModule enabled (always for TYPO3 > 11)
    $GLOBALS['TCA']['tt_content']['types']['codeblock']['previewRenderer'] = \B13\Codeblock\Backend\Preview\ContentPreviewRenderer::class;
});
