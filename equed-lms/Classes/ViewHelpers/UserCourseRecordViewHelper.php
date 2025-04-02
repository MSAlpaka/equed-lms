<?php

namespace Equed\EquedLms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class UserCourseRecordViewHelper extends AbstractViewHelper
{
    /**
     * @param int $userId
     * @param int $courseId
     * @return string
     */
    public function render(int $userId, int $courseId): string
    {
        // Fetch user course record data
        $courseRecord = $this->getUserCourseRecord($userId, $courseId);
        return $courseRecord ? 'Completed: ' . ($courseRecord->getValidated() ? 'Yes' : 'No') : 'No record found';
    }

    /**
     * Fetch user course record by userId and courseId
     *
     * @param int $userId
     * @param int $courseId
     * @return \Equed\EquedLms\Domain\Model\UserCourseRecord|null
     */
    protected function getUserCourseRecord(int $userId, int $courseId)
    {
        $repository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Equed\EquedLms\Domain\Repository\UserCourseRecordRepository::class);
        return $repository->findByUserAndCourse($userId, $courseId);
    }
}