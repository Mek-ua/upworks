// import './bootstrap';
// import { createApp } from 'vue';
// import App from './App.vue';
// import router from './router';
// import axios from 'axios';

// // Set up Axios globally
// axios.defaults.baseURL = '/api';

// const app = createApp(App);
//  app.config.globalProperties.$axios = axios;
// app.use(router);

// // Mount App.vue as the main entry point
// app.mount('#app');
import './bootstrap';
import axios from 'axios';
import { createApp } from 'vue';
import router from './router';
import App from './App.vue';

axios.defaults.baseURL = 'http://localhost:8000/api'; // Your API base URL
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;


const app = createApp(App);
app.config.globalProperties.$axios = axios; // Optional but useful for consistency
app.use(router);
app.mount('#app');
