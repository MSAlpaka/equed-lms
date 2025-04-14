import React from 'react'
import ReactDOM from 'react-dom/client'
import LessonViewer from './LessonViewer'

const rootEl = document.getElementById('lesson-viewer')
if (rootEl) {
  const lessonId = parseInt(rootEl.dataset.lessonId ?? '0')
  const labels = JSON.parse(rootEl.dataset.labels ?? '{}')
  ReactDOM.createRoot(rootEl).render(<LessonViewer lessonId={lessonId} labels={labels} />)
}