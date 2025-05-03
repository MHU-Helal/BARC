import '../css/app.css';  // Your custom styles (if any)
import 'bootstrap/dist/css/bootstrap.min.css';  // Bootstrap CSS (if used)
import 'bootstrap-icons/font/bootstrap-icons.css';  // Bootstrap Icons (if used)
import './bootstrap';  // Laravel's default JS setup (like Axios)

import { createApp } from 'vue';  // Vue 3
import axios from 'axios';  // Axios for API calls
import { ZiggyVue } from '../../vendor/tightenco/ziggy';  // Optional: for Laravel routes in Vue
import App from './Pages/App.vue';
import router from './router';

// Configure Axios (to include CSRF token automatically in all requests)
axios.defaults.baseURL = 'http://127.0.0.1:8000';  // Set your API base URL
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Create and mount the Vue app
const app = createApp(App);

// Use Vue Router for routing
app.use(router);

// Optional: Use Ziggy for Laravel route helpers (if needed)
app.use(ZiggyVue);

// Mount the app to the DOM
app.mount('#app');
