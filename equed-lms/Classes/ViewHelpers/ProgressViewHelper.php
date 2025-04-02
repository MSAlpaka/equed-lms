<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class ProgressViewHelper extends AbstractViewHelper
{
    /**
     * @param int $completed
     * @param int $total
     * @return string
     */
    public function render(int $completed, int $total): string
    {
        // Calculate the progress percentage
        if ($total > 0) {
            $progress = ($completed / $total) * 100;
            return round($progress, 2) . '%';
        }

        return '0%';
    }
}