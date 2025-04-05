<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ProgressViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('completed', 'int', 'Number of completed items', true);
        $this->registerArgument('total', 'int', 'Total number of items', true);
    }

    public function render(): string
    {
        $completed = (int)$this->arguments['completed'];
        $total = (int)$this->arguments['total'];

        if ($total > 0) {
            $progress = ($completed / $total) * 100;
            return round($progress, 2) . '%';
        }

        return LocalizationUtility::translate('progress.none', 'equed_lms') ?? '0%';
    }
}