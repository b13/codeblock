<?php
declare(strict_types=1);

namespace B13\Codeblock\DataProvider;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use Highlight\Highlighter;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class which provides a function to get all languages known by highlight.php.
 */
class CodeLanguages
{
    /**
     * @param array $config
     * @return array
     */
    public function getAll($config): array
    {
        // Get all languages from highlight.php.
        $highlight = GeneralUtility::makeInstance(Highlighter::class);
        $languages = $highlight->listLanguages();

        // Add default to items as the highlight processor can handle the automatic detection of the language.
        $config['items'][] = ['LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.code_language.detect_automatically', ''];

        // Add all languages to dropdown.
        foreach ($languages as $language) {
            $config['items'][] = [$language, $language];
        }

        return $config;
    }
}
