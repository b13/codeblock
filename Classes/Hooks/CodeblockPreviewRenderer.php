<?php
declare(strict_types=1);

namespace B13\Codeblock\Hooks;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use Highlight\Highlighter;
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Contains a preview rendering for the page module of CType="codeblock"
 */
class CodeblockPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{
    /**
     * Preprocesses the preview rendering of a content element of type "codeblock"
     *
     * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
     * @param bool $drawItem Whether to draw the item using the default functionality
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     */
    public function preProcess(
        PageLayoutView &$parentObject,
        &$drawItem,
        &$headerContent,
        &$itemContent,
        array &$row
    )
    {
        if ($row['CType'] === 'codeblock' && $row['bodytext']) {
            $highlight = GeneralUtility::makeInstance(Highlighter::class);

            if (!$row['code_language']) {
                $languages = $highlight->listLanguages();
                $highlight->setAutodetectLanguages($languages);
                $highlighted = $highlight->highlightAuto($row['bodytext']);
            } else {
                $highlighted = $highlight->highlight($row['code_language'], $row['bodytext']);
            }

            $bodytext = '<pre style="padding:2px;"><code class="hljs ' . $highlighted->language . '">' . $highlighted->value . '</code></pre>';
            $itemContent .= $parentObject->linkEditContent((($bodytext)), $row);

            $styles = $this->getStyles();
            if ($styles) {
                $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
                $pageRenderer->addCssInlineBlock('ext-codeblock', $styles);
            }
        }

        $drawItem = false;
    }

    protected function getStyles(): string
    {
        $previewFile = '';
        try {
            $previewFile = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('codeblock', 'backendPreviewStyles');
        } catch (\Exception $e) {
            // do nothing
        }
        $previewFile = GeneralUtility::getFileAbsFileName($previewFile);

        if (!is_file($previewFile)) {
            $previewFile = GeneralUtility::getFileAbsFileName('EXT:codeblock/Resources/Public/Styles/GitHub.css');
        }

        return file_get_contents($previewFile);
    }
}
