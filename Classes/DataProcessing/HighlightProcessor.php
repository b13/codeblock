<?php

declare(strict_types=1);

namespace B13\Codeblock\DataProcessing;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use Highlight\Highlighter;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Runs the configured field's value through highlight.php and returns
 * the rendered HTML plus the detected language for use in Fluid.
 */
final class HighlightProcessor implements DataProcessorInterface
{
    public function __construct(
        private readonly Highlighter $highlighter
    ) {
    }

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $fieldName = (string)($processorConfiguration['field'] ?? 'bodytext');
        $targetVariableName = (string)$cObj->stdWrapValue('as', $processorConfiguration, 'bodytext_formatted');

        $source = (string)($processedData['data'][$fieldName] ?? '');
        $language = (string)($processedData['data']['code_language'] ?? '');

        if ($language === '') {
            // Let highlight.php pick the language from all registered ones.
            $this->highlighter->setAutodetectLanguages($this->highlighter->listLanguages());
            $highlighted = $this->highlighter->highlightAuto($source);
        } else {
            $highlighted = $this->highlighter->highlight($language, $source);
        }

        $processedData[$targetVariableName] = [
            'code' => $highlighted->value,
            'language' => $highlighted->language,
            'lines' => preg_split('/\r\n|\r|\n/', $highlighted->value) ?: [],
        ];

        return $processedData;
    }
}
