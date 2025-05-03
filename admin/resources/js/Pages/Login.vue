<template>
    <div class="container">
        <h2>Login</h2>
        <form @submit.prevent="login">
            @csrf
            <input v-model="email" placeholder="Email" type="email" required />
            <input v-model="password" placeholder="Password" type="password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const email = ref('')
const password = ref('')
const router = useRouter()

const login = async () => {
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value,
        })

        localStorage.setItem('auth_token', response.data.token)
        router.push({ name: 'home' })
    } catch (err) {
        alert('Invalid credentials')
    }
}
</script>