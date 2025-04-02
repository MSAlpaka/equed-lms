<?php

namespace Equed\EquedLms\Service;

use Equed\EquedLms\Domain\Model\Feedback;
use Equed\EquedLms\Domain\Model\QmsCase;
use Equed\EquedLms\Domain\Repository\QmsCaseRepository;

class QmsCaseService
{
    protected QmsCaseRepository $qmsCaseRepository;

    public function __construct(QmsCaseRepository $qmsCaseRepository)
    {
        $this->qmsCaseRepository = $qmsCaseRepository;
    }

    public function checkForQmsCase(Feedback $feedback)
    {
        // Prüfen, ob Abweichungen von den Standards vorliegen
        foreach ($feedback->getStandardAnswers() as $standardAnswer) {
            if ($standardAnswer->getAnswer() === 'no') {
                // Ein QMS-Fall wird erstellt, wenn es eine Abweichung gibt
                $qmsCase = new QmsCase();
                $qmsCase->setFeedback($feedback);
                $qmsCase->setStatus('open');  // QMS-Fall ist offen
                $this->qmsCaseRepository->add($qmsCase);

                // Benachrichtigung an ServiceCenter oder Certifier (je nach Fall)
                // Hier könnte eine E-Mail oder eine interne Benachrichtigung erfolgen.
            }
        }
    }
}