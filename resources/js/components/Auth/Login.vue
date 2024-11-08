<template>
  <div style="background-image: url('/images/hero/bg3.jpg');" class="relative w-full h-screen bg-cover bg-center">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-black opacity-60 backdrop-blur-sm"></div>

    <!-- Adjusted Login Form to the Left -->
    <div class="relative flex items-start p-28 justify-start h-full z-10 pl-12">
      <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">
        <!-- Logo and Title -->
        <div class="flex items-center justify-center mb-6">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white">
            <span class="text-lg font-bold">F</span>
          </div>
          <h2 class="ml-2 text-2xl font-semibold">Freelance-Hub</h2>
        </div>
        <h2 class="text-md font-semibold text-gray-800 mb-4 ">PLEASE SIGN IN</h2>
        <form @submit.prevent="login">
          <label class="block mb-2 text-sm font-medium text-gray-700" for="email">Your Email</label>
          <input
            v-model="email"
            type="email"
            placeholder="example@website.com"
            class="mb-4 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          <label class="block mb-2 text-sm font-medium text-gray-700" for="password">Password</label>
          <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="mb-6 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          <div class="flex items-center justify-between mb-4">
            <label class="inline-flex items-center">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
          </div>
          <button
            type="submit"
            :disabled="isLoading"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
          >
            <span v-if="isLoading">Logging in...</span>
            <span v-else>SIGN IN</span>
          </button>
          <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
          <p class="mt-4 text-center text-sm text-gray-600">
            Don’t have an account? <router-link to="/role-selection" class="text-blue-600 hover:underline">Sign Up</router-link>
          </p>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const isLoading = ref(false);
const errorMessage = ref('');
const router = useRouter();

const login = async () => {
  isLoading.value = true;
  errorMessage.value = '';
  
  try {
    const response = await axios.post('/auth/login', {
      email: email.value,
      password: password.value,
    });

    // Save the token in localStorage
    localStorage.setItem('token', response.data.token);

    // Fetch user details to check the role
    const userResponse = await axios.get('/api/user', {
      headers: {
        Authorization: `Bearer ${response.data.token}`,
      },
    });

    console.log('Login successful:', userResponse.data);
    
    // Check role and redirect
    if (userResponse.data.role_id === 1) {
      router.push('/admin'); // Redirect to the admin dashboard
    } else if (userResponse.data.role_id === 2) {
      router.push('/client-dashboard'); // Redirect to the client dashboard
    } else if (userResponse.data.role_id === 3) {
      router.push('/freelancer-dashboard'); // Redirect to the freelancer dashboard
    } else {
      errorMessage.value = 'Unauthorized access';
    }
  } catch (error) {
    console.error('Login failed:', error);
    errorMessage.value = 'Login failed. Please check your credentials.';
  } finally {
    isLoading.value = false;
  }
};

</script>

<style scoped>
/* Additional styles can be added if needed */
</style>
