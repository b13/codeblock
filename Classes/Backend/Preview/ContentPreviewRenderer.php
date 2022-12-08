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

use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;

class ContentPreviewRenderer extends \TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer
{
    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $record = $item->getRecord();
        if (trim($record['bodytext'] ?? '') !== '') {
            return $this->linkEditContent(nl2br(htmlentities($record['bodytext'])), $record) . '<br />';
        }
        return parent::renderPageModulePreviewContent($item);
    }
}
