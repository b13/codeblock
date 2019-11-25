<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['codeblock'] =
\B13\Codeblock\Hooks\CodeblockPreviewRenderer::class;

// add our own icons to the icon registry
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

$iconRegistry->registerIcon(
    'content-codeblock',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    array(
        'source' => 'EXT:codeblock/Resources/Public/Icons/content-codeblock.svg',
    )
);
