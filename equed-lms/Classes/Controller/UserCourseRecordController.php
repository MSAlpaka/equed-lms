<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;

class UserCourseRecordController extends ActionController
{
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(UserCourseRecordRepository $userCourseRecordRepository)
    {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    public function indexAction(int $userId): Response
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        if ($currentUserId !== $userId) {
            return $this->htmlResponse('', 403);
        }

        $records = $this->userCourseRecordRepository->findByUser($userId);
        $this->view->assign('courseRecords', $records);

        return $this->htmlResponse();
    }

    public function showAction(int $userCourseRecordId): Response
    {
        $currentUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        $record = $this->userCourseRecordRepository->findByIdentifier($userCourseRecordId);

        if (!$record || $record->getUser()?->getUid() !== $currentUserId) {
            return $this->htmlResponse('', $record ? 403 : 404);
        }

        $this->view->assignMultiple([
            'record' => $record,
            'program' => $record->getCourseInstance()?->getProgram(),
            'center' => $record->getCourseInstance()?->getCenter(),
        ]);

        return $this->htmlResponse();
    }

    private function htmlResponse(string $message = '', int $statusCode = 200): Response
    {
        $response = new Response();
        return $response->withStatus($statusCode);
    }
}