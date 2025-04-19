<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use Equed\EquedLms\Domain\Repository\CourseAccessMapRepository;
use Equed\EquedLms\Domain\Model\CourseAccessMap;

class CourseAccessMapController extends ActionController
{
    protected CourseAccessMapRepository $accessMapRepository;
    protected PersistenceManager $persistenceManager;

    public function __construct(
        CourseAccessMapRepository $accessMapRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->accessMapRepository = $accessMapRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Zeigt alle Berechtigungen für eine bestimmte Kursart
     */
    public function listForCourseProgramAction(int $courseProgramId): ResponseInterface
    {
        $entries = $this->accessMapRepository->findByCourseProgram($courseProgramId);
        return $this->jsonResponse($entries);
    }

    /**
     * Zeigt alle Berechtigungen eines Users
     */
    public function listForUserAction(int $userId): ResponseInterface
    {
        $entries = $this->accessMapRepository->findByFrontendUser($userId);
        return $this->jsonResponse($entries);
    }

    /**
     * Neue Berechtigung anlegen
     */
    public function createAction(array $data): ResponseInterface
    {
        $entry = GeneralUtility::makeInstance(CourseAccessMap::class);
        $entry->setFrontendUserUid((int)$data['frontendUserUid']);
        $entry->setCourseProgramUid((int)$data['courseProgramUid']);
        $entry->setCanTeach((bool)($data['canTeach'] ?? false));
        $entry->setCanValidate((bool)($data['canValidate'] ?? false));
        $entry->setCanBook((bool)($data['canBook'] ?? false));
        $entry->setCanManage((bool)($data['canManage'] ?? false));

        $this->accessMapRepository->add($entry);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true, 'id' => $entry->getUid()]);
    }

    /**
     * Bestehende Berechtigung updaten
     */
    public function updateAction(int $mapId, array $data): ResponseInterface
    {
        $entry = $this->accessMapRepository->findByIdentifier($mapId);
        if (!$entry) {
            return $this->jsonResponse(['error' => 'Entry not found'], 404);
        }

        $entry->setCanTeach((bool)($data['canTeach'] ?? $entry->isCanTeach()));
        $entry->setCanValidate((bool)($data['canValidate'] ?? $entry->isCanValidate()));
        $entry->setCanBook((bool)($data['canBook'] ?? $entry->isCanBook()));
        $entry->setCanManage((bool)($data['canManage'] ?? $entry->isCanManage()));

        $this->accessMapRepository->update($entry);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Berechtigung löschen
     */
    public function deleteAction(int $mapId): ResponseInterface
    {
        $entry = $this->accessMapRepository->findByIdentifier($mapId);
        if ($entry) {
            $this->accessMapRepository->remove($entry);
            $this->persistenceManager->persistAll();
        }

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * JSON-Antwort für SPA/API
     */
    protected function jsonResponse($data, int $status = 200): ResponseInterface
    {
        $view = GeneralUtility::makeInstance(JsonView::class);
        $view->assign('value', $data);
        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}

