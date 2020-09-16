<?php
defined('TYPO3_MODE') or die();

call_user_func(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['codeblock'] =
        \B13\Codeblock\Hooks\CodeblockPreviewRenderer::class;

    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'content-codeblock',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:codeblock/Resources/Public/Icons/content-codeblock.svg',
        ]
    );
});
