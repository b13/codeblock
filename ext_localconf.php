<?php

/*
 * This file is part of the package b13/codeblock.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Include TsConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import \'EXT:codeblock/Configuration/PageTs/PageTs.tsconfig\'');
