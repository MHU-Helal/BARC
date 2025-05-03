<script setup>
import { ref, computed, onBeforeUnmount, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const quizStarted = ref(false)
const loading = ref(false)
const time = ref(600)
const interval = ref(null)
const questions = ref([])
const userAnswers = ref([])
const showResults = ref(false)

onMounted(() => {
  fetch('http://127.0.0.1:8000/api/quiz-questions')
    .then(res => res.json())
    .then(data => {
      questions.value = data.map(q => ({
        ...q,
        options: q.options || [],
      }))
      userAnswers.value = Array(data.length).fill('')
    })
})

const logout = () => {
  localStorage.removeItem('auth_token')
  router.push({ name: 'login' })
}

const timer = computed(() => {
  const minutes = Math.floor(time.value / 60).toString().padStart(2, '0')
  const seconds = (time.value % 60).toString().padStart(2, '0')
  return `${minutes}:${seconds}`
})

const today = computed(() => {
  const options = { weekday: 'long', day: 'numeric', month: 'long' }
  return new Date().toLocaleDateString('en-US', options)
})

const answeredCount = computed(() =>
  userAnswers.value.filter((ans) => ans).length
)

const startQuiz = () => {
  quizStarted.value = true
  loading.value = true

  setTimeout(() => {
    questions.value = [
      { text: 'What is the capital of France?', type: 'multiple_choice', options: ['Paris', 'London', 'Berlin', 'Madrid'], correct_answer: 'Paris' },
      { text: 'What is the solution to the equation: 5 + 7?', type: 'short_answer', correct_answer: '12' },
      { text: 'Which planet is known as the Red Planet?', type: 'multiple_choice', options: ['Earth', 'Mars', 'Jupiter', 'Saturn'], correct_answer: 'Mars' },
      { text: 'What is the capital of Canada?', type: 'multiple_choice', options: ['Toronto', 'Vancouver', 'Ottawa', 'Montreal'], correct_answer: 'Ottawa' },
      { text: 'What is the main cause of global warming?', type: 'multiple_choice', options: ['Deforestation', 'Burning of fossil fuels', 'Increase in livestock farming', 'All of the above'], correct_answer: 'All of the above' },
      { text: 'What is the largest ocean on Earth?', type: 'multiple_choice', options: ['Atlantic Ocean', 'Indian Ocean', 'Southern Ocean', 'Pacific Ocean'], correct_answer: 'Pacific Ocean' },
      { text: 'Solve: 12 * 8', type: 'short_answer', correct_answer: '96' },
      { text: 'Which of the following is an example of a renewable energy source?', type: 'multiple_choice', options: ['Coal', 'Wind energy', 'Oil', 'Natural gas'], correct_answer: 'Wind energy' },
      { text: 'What is the most common language spoken in the world?', type: 'multiple_choice', options: ['English', 'Mandarin', 'Spanish', 'Hindi'], correct_answer: 'Mandarin' },
      { text: 'Solve: 144 ÷ 12', type: 'short_answer', correct_answer: '12' }
    ];

    userAnswers.value = Array(questions.value.length).fill('')
    loading.value = false
    startTimer()
  }, 1500)
}

const startTimer = () => {
  interval.value = setInterval(() => {
    if (time.value > 0) {
      time.value--
    } else {
      clearInterval(interval.value)
      submitQuiz()
    }
  }, 1000)
}

const submitQuiz = () => {
  clearInterval(interval.value)
  showResults.value = true
  router.push({ name: 'result', query: { answers: JSON.stringify(userAnswers.value) } })
}


const isCorrect = (index) => {
  const correct = questions.value[index].correct_answer?.toString().toLowerCase().trim()
  const answer = userAnswers.value[index]?.toString().toLowerCase().trim()
  return correct === answer
}

const restartQuiz = () => {
  quizStarted.value = false
  loading.value = false
  time.value = 600
  questions.value = []
  userAnswers.value = []
  showResults.value = false
  clearInterval(interval.value)
}

onBeforeUnmount(() => {
  clearInterval(interval.value)
})
</script>


<template>
  <link href="https://fonts.cdnfonts.com/css/seven-segment" rel="stylesheet">

  <div class="container-fluid p-0" style="height: 100vh; overflow: hidden;">
    <!-- Start Card -->
    <div v-if="!quizStarted && !loading" class="d-flex justify-content-center align-items-center h-100">
      <div class="card shadow-lg p-4 text-center" style="max-width: 400px;">
        <h3>EXAM-1</h3>
        <p>Type: Multiple Choice / Short Answer<br>Reason: Final Term Assessment</p>
        <button class="btn btn-primary mt-3" @click="startQuiz">Start Exam</button>
      </div>
    </div>

    <!-- Loading Spinner -->
    <div v-else-if="loading" class="d-flex justify-content-center align-items-center h-100">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Starting Exam...</span>
      </div>
    </div>



    <!-- Quiz Layout -->
    <div v-else-if="questions.length > 0" class="row h-100 g-0">
      <!-- Header -->
      <!-- <div class="text-center bg-secondary pt-3 text-white position-relative z-10">
                <h4>EXAM-1</h4>
                <p>Type: Multiple Choice / Short Answer | Reason: Final Term Assessment</p>
                <button @click="logout">Logout</button>
            </div> -->
      <!-- Left Panel (Timer + Date) -->
      <div class="col-md-3 bg-primary text-white d-flex align-items-center  justify-content-center p-3"
        style="position: sticky; top: 0;">
        <div>
          <h5 class="text-center">Time Left</h5>
          <h2 style="font-family: 'Seven Segment';" class="text-center text-[84px]">{{ timer }}</h2>
          <p class="text-center font-bold text-gray-200">{{ today }}</p>
        </div>
      </div>

      <!-- Right Panel (Questions) -->
      <div class="col-md-9 overflow-auto p-4" style="height: 100%;">


        <!-- Questions -->
        <form @submit.prevent="submitQuiz">
          <div v-for="(question, index) in questions" :key="index" class="card mb-4 shadow-sm p-3">
            <h5>Q{{ index + 1 }}. {{ question.text }}</h5>

            <!-- Multiple Choice -->
            <div v-if="question.type === 'multiple_choice'">
              <div v-for="(option, optIndex) in question.options" :key="optIndex" class="form-check mt-2">
                <input class="form-check-input" type="radio" :name="'question_' + index" :value="option"
                  v-model="userAnswers[index]" />
                <label class="form-check-label">
                  {{ option }}
                </label>
              </div>
            </div>

            <!-- Short Answer -->
            <div v-else-if="question.type === 'short_answer'">
              <input type="text" class="form-control mt-2" v-model="userAnswers[index]" placeholder="Your Answer"
                 />
            </div>

          </div>

          <div class="d-flex justify-content-center w-100 align-items-center mt-4 bg-secondary">
            <small>Answered: {{ answeredCount }}/{{ questions.length }}</small>
            <button class="btn btn-success rounded p-1 ms-2" type="submit">Submit Quiz</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Result Screen -->
    <div v-else class="d-flex flex-column justify-content-center align-items-center h-100 p-4">
      <h2 class="mb-4">Quiz Results</h2>
      <div v-for="(question, index) in questions" :key="index" class="card w-100 mb-3 shadow-sm p-3"
        style="max-width: 700px;">
        <h5>Q{{ index + 1 }}. {{ question.text }}</h5>
        <p>Your Answer: <strong :class="{ 'text-success': isCorrect(index), 'text-danger': !isCorrect(index) }">
            {{ userAnswers[index] || 'No Answer' }}
          </strong></p>
        <p v-if="!isCorrect(index)">Correct Answer: <strong class="text-success">{{ question.correct_answer
        }}</strong></p>
      </div>
      <button class="btn btn-primary mt-4" @click="restartQuiz">Restart</button>
    </div>
  </div>
</template>

<style scoped>
/* @import url('https://fonts.cdnfonts.com/css/seven-segment');   */
/* Styling to enhance look */
body {
  background-color: #f0f4f8;
}

.card {
  border-radius: 1rem;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-success {
  background-color: #28a745;
  border-color: #28a745;
}

.bg-primary {
  background-color: #0d6efd !important;
}
</style>