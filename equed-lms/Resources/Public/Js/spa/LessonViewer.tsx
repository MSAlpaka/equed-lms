import React, { useEffect, useState } from 'react'
import axios from 'axios'

type Props = {
  lessonId: number
  labels?: {
    loading?: string
    title?: string
    progress?: string
    quizAvailable?: string
  }
}

export default function LessonViewer({ lessonId, labels = {} }: Props) {
  const [data, setData] = useState<any>(null)

  useEffect(() => {
    axios.get(`/api/lesson/${lessonId}`).then(res => setData(res.data))
  }, [lessonId])

  if (!data) return <div>{labels.loading ?? 'Loading...'}</div>

  const { lesson, progress, quiz } = data

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-4">{lesson.title}</h1>

      <div className="mb-6 text-sm text-gray-600">
        {labels.progress ?? 'Progress'}: {progress.percent}% – {progress.seenCount} / {progress.total}
      </div>

      {lesson.pages.map((page: any) => (
        <div key={page.id} className="mb-6">
          <h2 className="text-lg font-semibold">{page.title}</h2>
          <div dangerouslySetInnerHTML={{ __html: page.content }} />
        </div>
      ))}

      {quiz.exists && (
        <div className="mt-8 p-4 bg-yellow-100 rounded">
          <strong>{labels.quizAvailable ?? 'Quiz available'}:</strong> {quiz.questionCount}
        </div>
      )}
    </div>
  )
}