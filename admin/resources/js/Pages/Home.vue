<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h3 class="mb-0">Welcome to the Dashboard</h3>
              <button class="btn btn-outline-danger btn-sm" @click="logout">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
              </button>
            </div>

            <div class="row mt-4">
              <div class="col-md-12 mb-4">
                <div class="card h-100 shadow-sm">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><button class="btn btn-primary mt-auto" @click="goToQuiz">
                      EXAM-1
                    </button></h5>
                    
                  </div>
                </div>
              </div>
            </div>

            <p class="text-center text-muted mt-4">
              Today is {{ today }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const logout = () => {
  localStorage.removeItem('auth_token')
  router.push({ name: 'login' })
}

const today = new Date().toLocaleDateString('en-US', {
  weekday: 'long',
  day: 'numeric',
  month: 'long',
})
const goToQuiz = () => {
  router.push({ name: 'quiz' })
}
</script>
