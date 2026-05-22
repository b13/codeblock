<?php

declare(strict_types=1);

namespace B13\Codeblock\Backend\Preview;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Domain\RecordInterface;

/**
 * Renders a preview of the "codeblock" content element for the page module.
 *
 * Shows a truncated version of the entered code (rather than the default
 * "no preview available" placeholder) so editors can recognize the element
 * at a glance.
 */
final class ContentPreviewRenderer extends StandardContentPreviewRenderer
{
    private const PREVIEW_MAX_LENGTH = 1000;

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $record = $item->getRecord();
        $bodytext = $record instanceof RecordInterface
            ? (string)($record->get('bodytext') ?? '')
            : (string)($record['bodytext'] ?? '');

        if (trim($bodytext) === '') {
            return parent::renderPageModulePreviewContent($item);
        }

        $bodytext = mb_strimwidth($bodytext, 0, self::PREVIEW_MAX_LENGTH, '…');

        return $this->linkEditContent(nl2br(htmlentities($bodytext)), $record) . '<br />';
    }
}
