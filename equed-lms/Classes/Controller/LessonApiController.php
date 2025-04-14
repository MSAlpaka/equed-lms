<?php
namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use EquedLms\Service\LessonService;

class LessonApiController extends ActionController
{
    protected LessonService $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function showAction(int $lessonId): ResponseInterface
    {
        $data = $this->lessonService->getLessonData($lessonId);
        return new JsonResponse($data);
    }
}