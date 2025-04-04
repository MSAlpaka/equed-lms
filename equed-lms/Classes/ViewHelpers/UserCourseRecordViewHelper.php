<?php

declare(strict_types=1);

namespace EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use EquedLms\Domain\Repository\UserCourseRecordRepository;

class UserCourseRecordViewHelper extends AbstractViewHelper
{
    /**
     * Gibt den Status einer Kursbuchung für einen User und ein Programm zurück
     *
     * @param int $userId
     * @param int $programId
     * @return string one of: 'none', 'completed', 'open'
     */
    public function render(int $userId, int $programId): string
    {
        $repo = GeneralUtility::makeInstance(UserCourseRecordRepository::class);
        $records = $repo->findByUserAndProgram($userId, $programId);

        if (empty($records)) {
            return 'none';
        }

        foreach ($records as $record) {
            if ($record->getStatus() === 'completed' && $record->isCertificateIssued()) {
                return 'completed';
            }
        }

        return 'open';
    }
}