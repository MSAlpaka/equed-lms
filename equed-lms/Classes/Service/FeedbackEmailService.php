<?php

namespace Equed\EquedLms\Service;

class FeedbackEmailService
{
    /**
     * Send a feedback request email to the user
     */
    public function sendFeedbackRequestEmail(string $userEmail, string $courseName): void
    {
        $subject = "Feedback Request for $courseName";
        $message = "Dear user, we would appreciate your feedback for the course: $courseName.";

        // Use the NotificationService to send the email
        $notificationService = new NotificationService();
        $notificationService->sendEmail($userEmail, $subject, $message);
    }
}