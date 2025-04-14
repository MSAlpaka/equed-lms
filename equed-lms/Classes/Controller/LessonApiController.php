<?php
namespace EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

use EquedLms\Domain\Repository\LessonRepository;
use EquedLms\Domain\Repository\UserLessonProgressRepository;
use EquedLms\Domain\Repository\QuizQuestionRepository;

class LessonApiController extends ActionController
{
    protected LessonRepository $lessonRepository;
    protected UserLessonProgressRepository $progressRepository;
    protected QuizQuestionRepository $quizQuestionRepository;
    protected Context $context;

    public function __construct(
        LessonRepository $lessonRepository,
        UserLessonProgressRepository $progressRepository,
        QuizQuestionRepository $quizQuestionRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->progressRepository = $progressRepository;
        $this->quizQuestionRepository = $quizQuestionRepository;
        $this->context = GeneralUtility::makeInstance(Context::class);
    }

    public function showAction(int $lessonId): ResponseInterface
    {
        $userId = (int) $this->context->getPropertyFromAspect('frontend.user', 'id');
        if (!$userId) {
            return new JsonResponse(['error' => 'User not authenticated'], 403);
        }

        $lesson = $this->lessonRepository->findByUid($lessonId);
        if (!$lesson) {
            return new JsonResponse(['error' => 'Lesson not found'], 404);
        }

        // Seiten der Lesson sortieren
        $pages = [];
        $sortedPages = $lesson->getPages()->toArray();
        usort($sortedPages, fn($a, $b) => $a->getSorting() <=> $b->getSorting());

        foreach ($sortedPages as $page) {
            $pages[] = [
                'id' => $page->getUid(),
                'title' => $page->getTitle(),
                'content' => $page->getContent(),
                'uploadEnabled' => method_exists($page, 'isUploadEnabled') ? $page->isUploadEnabled() : false,
            ];
        }

        // Fortschritt des Users laden
        $progressRecords = $this->progressRepository->findByUserAndLesson($userId, $lesson);
        $seenPageIds = array_map(fn($progress) => $progress->getPage()->getUid(), $progressRecords);
        $seenCount = count($seenPageIds);
        $total = count($pages);
        $progressPercent = $total > 0 ? round(($seenCount / $total) * 100) : 0;

        // Quiz prüfen: Existiert für die Lesson?
        $quizQuestions = $this->quizQuestionRepository->findByLesson($lesson);
        $quizExists = count($quizQuestions) > 0;

        return new JsonResponse([
            'lesson' => [
                'id' => $lesson->getUid(),
                'title' => $lesson->getTitle(),
                'pages' => $pages,
            ],
            'progress' => [
                'seenPageIds' => $seenPageIds,
                'seenCount' => $seenCount,
                'total' => $total,
                'percent' => $progressPercent,
            ],
            'quiz' => [
                'exists' => $quizExists,
                'questionCount' => count($quizQuestions),
            ]
        ]);
    }
}