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

/**
 * Populates the "code_language" select field with all languages
 * known to highlight.php plus an "auto detect" entry.
 */
final class CodeLanguages
{
    public function __construct(
        private readonly Highlighter $highlighter
    ) {
    }

    /**
     * itemsProcFunc callback for the "code_language" TCA select field.
     */
    public function getAll(array &$config): void
    {
        $config['items'][] = [
            'label' => 'LLL:EXT:codeblock/Resources/Private/Language/locallang_db.xlf:tt_content.code_language.detect_automatically',
            'value' => '',
        ];

        foreach ($this->highlighter->listLanguages() as $language) {
            $config['items'][] = [
                'label' => $language,
                'value' => $language,
            ];
        }
    }
}
