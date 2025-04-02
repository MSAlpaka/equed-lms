<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class FormatFileSizeViewHelper extends AbstractViewHelper
{
    /**
     * @param int $fileSize
     * @return string
     */
    public function render(int $fileSize): string
    {
        // Format file size to a readable string (KB, MB, GB)
        if ($fileSize >= 1073741824) {
            return round($fileSize / 1073741824, 2) . ' GB';
        } elseif ($fileSize >= 1048576) {
            return round($fileSize / 1048576, 2) . ' MB';
        } elseif ($fileSize >= 1024) {
            return round($fileSize / 1024, 2) . ' KB';
        } else {
            return $fileSize . ' bytes';
        }
    }
}