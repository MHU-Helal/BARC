<template>
    <div class="d-flex align-items-center justify-content-center vh-100 bg-light">
      <div class="card shadow-lg p-4" style="min-width: 350px; max-width: 400px; width: 100%;">
        <h3 class="text-center mb-4">Login</h3>
  
        <div v-if="errorMessage" class="alert alert-danger">
          {{ errorMessage }}
        </div>
  
        <form @submit.prevent="submit">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
              type="email"
              id="email"
              v-model="email"
              class="form-control"
              placeholder="Enter email"
              required
            />
          </div>
  
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
              type="password"
              id="password"
              v-model="password"
              class="form-control"
              placeholder="Enter password"
              required
            />
          </div>
  
          <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              id="remember"
              v-model="remember"
            />
            <label class="form-check-label" for="remember">
              Remember me
            </label>
          </div>
  
          <button
            type="submit"
            class="btn btn-primary w-100"
            :disabled="loading"
          >
            {{ loading ? 'Logging in...' : 'Login' }}
          </button>
        </form>
  
        <div class="mt-3 text-center">
          <router-link to="/forgot-password" class="text-decoration-none">
            Forgot your password?
          </router-link>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  import { useRouter } from 'vue-router'
  
  const email = ref('')
  const password = ref('')
  const remember = ref(false)
  const loading = ref(false)
  const errorMessage = ref('')
  const router = useRouter()
  
  const submit = async () => {
    errorMessage.value = ''
    loading.value = true
  
    try {
      const res = await axios.post('http://localhost:8000/api/login', {
        email: email.value,
        password: password.value,
        remember: remember.value,
      })
  
      // Fake token handling (replace with real auth if needed)
      localStorage.setItem('auth_token', res.data.token)
      router.push({ name: 'home' })
    } catch (err) {
      errorMessage.value =
        err.response?.data?.message || 'Login failed. Please try again.'
    } finally {
      loading.value = false
    }
  }
  </script>
  