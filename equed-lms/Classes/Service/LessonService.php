<?php
namespace EquedLms\Service;

class LessonService {
    public function getLessonData(int $lessonId): array {
        return [
            'lesson' => [
                'id' => $lessonId,
                'title' => 'Test Lesson via Service',
                'pages' => []
            ]
        ];
    }
}