<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// add our own icons to the icon registry
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

$iconRegistry->registerIcon(
    'content-codeblock',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    array(
        'source' => 'EXT:codeblock/Resources/Public/Icons/content-codeblock.svg',
    )
);


