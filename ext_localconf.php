<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['codeblock'] =
\B13\Codeblock\Hooks\CodeblockPreviewRenderer::class;
