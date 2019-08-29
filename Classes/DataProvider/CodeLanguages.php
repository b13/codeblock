<?php

namespace B13\Codeblock\DataProvider;

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
    public function getAll($config)
    {
        // Get all languages from highlight.php.
        $highlight = GeneralUtility::makeInstance(Highlighter::class);
        $languages = $highlight->listLanguages();

        // Add default to items as in the highlight processor can handle the automatic detection of the language.
        $config['items'][] = ['detect automatically', ''];

        // Add all languages to dropdown.
        foreach ($languages as $language) {
            $config['items'][] = [$language, $language];
        }
        #
        return $config;
    }
}
