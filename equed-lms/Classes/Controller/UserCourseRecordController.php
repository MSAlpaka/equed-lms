<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\UserCourseRecordRepository;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;

class UserCourseRecordController extends ActionController
{
    protected UserCourseRecordRepository $userCourseRecordRepository;

    public function __construct(UserCourseRecordRepository $userCourseRecordRepository)
    {
        $this->userCourseRecordRepository = $userCourseRecordRepository;
    }

    /**
     * Zeigt eine Liste aller Kursdatensätze eines Benutzers.
     * Nur angemeldete Benutzer dürfen ihre eigenen Datensätze sehen.
     */
    public function indexAction(int $userId): Response
    {
        $loggedInUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        
        if ($loggedInUserId !== $userId) {
            return $this->htmlResponse('Access denied', 403);
        }

        $courseRecords = $this->userCourseRecordRepository->findByUser($userId);
        $this->view->assign('courseRecords', $courseRecords);

        return $this->htmlResponse();
    }

    /**
     * Zeigt die Detailansicht eines bestimmten Kursdatensatzes.
     * Prüft die Berechtigung des Benutzers auf den angefragten Datensatz.
     */
    public function showAction(int $userCourseRecordId): Response
    {
        $loggedInUserId = (int)($GLOBALS['TSFE']->fe_user->user['uid'] ?? 0);
        $courseRecord = $this->userCourseRecordRepository->findByIdentifier($userCourseRecordId);

        if (!$courseRecord) {
            return $this->htmlResponse('Record not found', 404);
        }

        if ($courseRecord->getUser()->getUid() !== $loggedInUserId) {
            return $this->htmlResponse('Access denied', 403);
        }

        $this->view->assign('courseRecord', $courseRecord);

        return $this->htmlResponse();
    }

    /**
     * Hilfsmethode für standardisierte HTML-Responses.
     */
    private function htmlResponse(string $message = '', int $statusCode = 200): Response
    {
        $response = new Response();
        $response = $response->withStatus($statusCode);

        if (!empty($message)) {
            $response->getBody()->write($message);
            throw new StopActionException();
        }

        return $response;
    }
}