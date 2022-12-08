<?php

declare(strict_types=1);

namespace B13\Codeblock\Listener;

/*
 * This file is part of TYPO3 CMS-extension codeblock by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageContentPreviewRendering
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $record = $event->getRecord();
        if (($record['CType'] ?? '') === 'codeblock' && trim($record['bodytext'] ?? '') !== '') {
            $record['bodytext'] = GeneralUtility::fixed_lgd_cs($record['bodytext'], 1000);
            $event->setRecord($record);
        }
    }
}
