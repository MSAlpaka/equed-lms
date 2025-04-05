<?php

declare(strict_types=1);

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;

class UserCourseRecordViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('userId', 'int', 'User ID', true);
        $this->registerArgument('programId', 'int', 'Course Program ID', true);
    }

    public function render(): string
    {
        $userId = (int)$this->arguments['userId'];
        $programId = (int)$this->arguments['programId'];

        $repo = GeneralUtility::makeInstance(UserCourseRecordRepository::class);
        $records = $repo->findByUserAndProgram($userId, $programId);

        if (empty($records)) {
            return LocalizationUtility::translate('usercourse.status.none', 'equed_lms') ?? 'none';
        }

        foreach ($records as $record) {
            if ($record->getStatus() === 'completed' && $record->isCertificateIssued()) {
                return LocalizationUtility::translate('usercourse.status.completed', 'equed_lms') ?? 'completed';
            }
        }

        return LocalizationUtility::translate('usercourse.status.open', 'equed_lms') ?? 'open';
    }
}