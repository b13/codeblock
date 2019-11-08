<?php
namespace B13\Codeblock\DataProcessing;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use Highlight\Highlighter;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * This processor passes the given text through highlight.php.
 */
class HighlightProcessor implements DataProcessorInterface
{
    /**
     * @var ContentDataProcessor
     */
    protected $contentDataProcessor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
    }

    /**
     * Fetches records from the database as an array
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     *
     * @return array the processed data as key/value store
     */
    public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
    {
        $fieldName = $processorConfiguration['field'];
        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'bodytext_formatted');
        $highlight = GeneralUtility::makeInstance(Highlighter::class);

        // Let highlight.php decide which code language to use from all registered if "detect automatically" is selected.
        if (!$processedData['data']['code_language']) {
            $languages = $highlight->listLanguages();
            $highlight->setAutodetectLanguages($languages);
            $highlighted = $highlight->highlightAuto($processedData['data'][$fieldName]);
        } else {
            $highlighted = $highlight->highlight($processedData['data']['code_language'], $processedData['data'][$fieldName]);
        }

        $processedData[$targetVariableName]['code'] = $highlighted->value;
        $processedData[$targetVariableName]['language'] = $highlighted->language;
        $processedData[$targetVariableName]['lines'] = preg_split('/\r\n|\r|\n/', $highlighted->value);
        return $processedData;
    }
}
