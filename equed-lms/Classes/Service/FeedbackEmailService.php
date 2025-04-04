<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

/**
 * Service to handle sending feedback request emails
 */
class FeedbackEmailService
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    /**
     * Send a feedback request email to the user
     *
     * @param string $userEmail
     * @param string $courseName
     */
    public function sendFeedbackRequestEmail(string $userEmail, string $courseName): void
    {
        $subject = "Feedback Request for $courseName";
        $message = "Dear user,\n\nWe would appreciate your feedback for the course: $courseName.\n\nThank you!";

        $this->notificationService->sendEmail($userEmail, $subject, $message);
    }
}