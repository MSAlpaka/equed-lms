<?php

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Equed\EquedLms\Domain\Repository\FeedbackRepository;
use Equed\EquedLms\Domain\Model\Feedback;
use Equed\EquedLms\Service\QmsCaseService;

class FeedbackController extends ActionController
{
    protected FeedbackRepository $feedbackRepository;
    protected QmsCaseService $qmsCaseService;

    public function __construct(
        FeedbackRepository $feedbackRepository,
        QmsCaseService $qmsCaseService
    ) {
        $this->feedbackRepository = $feedbackRepository;
        $this->qmsCaseService = $qmsCaseService;
    }

    public function submitFeedbackAction(): void
    {
        // Holen der POST-Daten vom Feedbackformular
        $postData = $this->request->getArguments();

        // Feedback-Modell anlegen
        $feedback = new Feedback();
        $feedback->setUser($postData['user']);
        $feedback->setCourse($postData['course']);

        // Dynamische Fragen zum Kursstandard verarbeiten
        foreach ($postData['standards'] as $standardUid => $answer) {
            $feedback->addStandardAnswer($standardUid, $answer);
        }

        // Bewertung des Instructors und des Ausbildungsorts
        $feedback->setInstructorRating($postData['instructorRating']);
        $feedback->setLocationRating($postData['locationRating']);

        // Zusätzliche Anfragen und Kursziele
        $feedback->setFutureCourses($postData['futureCourses']);
        $feedback->setAdditionalRequests($postData['additionalRequests']);

        // Feedback an den Instructor senden
        $feedback->setSendToInstructor(isset($postData['sendToInstructor']) ? true : false);

        // Speichern des Feedbacks
        $this->feedbackRepository->add($feedback);

        // Prüfen, ob QMS-Fall ausgelöst werden muss
        $this->qmsCaseService->checkForQmsCase($feedback);

        // Bestätigung und Weiterleitung
        $this->addFlashMessage('Feedback erfolgreich abgegeben!');
        $this->redirect('dashboard', 'ServiceCenter');
    }
}