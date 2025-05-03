<template>
    <div class="container">
        <h2 class="my-4 text-center">Quiz Results</h2>
        <!-- Show score summary -->
        <div class="text-center mt-4">
            <h4>Your Score: {{ score }} / {{ questions.length }}</h4>
        </div>

        <!-- Display each question with its user answer and the correct answer -->
        <div v-for="(question, index) in questions" :key="index" class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ question.text }}</h5>
                <p>
                    Your Answer:
                    <span :class="{ 'text-success': isCorrect(index), 'text-danger': !isCorrect(index) }">
                        {{ userAnswers[index] || 'No Answer' }}
                    </span>
                </p>
                <p v-if="!isCorrect(index)">
                    Correct Answer: <strong class="text-success">{{ question.correct_answer }}</strong>
                </p>
            </div>
        </div>

        <button class="btn btn-primary mt-4 mx-auto" @click="restartQuiz">Restart Quiz</button>
    </div>
</template>

<script setup>
import { ref, computed, watchEffect } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()

const userAnswers = ref(JSON.parse(route.query.answers || '[]'))
const questions = ref([])

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

// Calculate the score
const score = computed(() => {
    if (!questions.value.length) return 0
    return userAnswers.value.filter((answer, index) =>
        answer.toLowerCase().trim() === questions.value[index].correct_answer.toLowerCase().trim()
    ).length
})

// Check if the user's answer is correct
const isCorrect = (index) => {
    const correct = questions.value[index]?.correct_answer?.toString().toLowerCase().trim()
    const answer = userAnswers.value[index]?.toString().toLowerCase().trim()
    return correct === answer
}

// Restart the quiz
const restartQuiz = () => {
    router.push({ name: 'quiz' })
}
</script>

<style scoped>
.card-body {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
}

.text-success {
    color: green;
}

.text-danger {
    color: red;
}

button {
    margin-top: 20px;
}
</style>