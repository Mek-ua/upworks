<template>
  <div style="background-image: url('/images/hero/bg3.jpg');" class="relative w-full h-screen bg-cover bg-center">
    <div class="absolute inset-0 bg-black opacity-60 backdrop-blur-sm"></div>

    <div class="relative flex items-start justify-start h-full z-10 pl-20 pt-8">
      <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center justify-center mb-4">
          <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-500 text-white">
            <span class="text-lg font-bold">F</span>
          </div>
          <h2 class="ml-2 text-2xl font-semibold">Freelance-Hub</h2>
        </div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2 text-center">REGISTER YOUR ACCOUNT</h2>
        <form @submit.prevent="register">
          <label class="block mb-2 text-sm font-medium text-gray-700" for="name">Your Name</label>
          <input v-model="name" type="text" placeholder="Calvin Carlo" class="mb-3 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          
          <label class="block mb-2 text-sm font-medium text-gray-700" for="email">Your Email</label>
          <input v-model="email" type="email" placeholder="example@website.com" class="mb-3 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          
          <label class="block mb-2 text-sm font-medium text-gray-700" for="password">Password</label>
          <input v-model="password" type="password" placeholder="Password" class="mb-3 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          
          <label class="block mb-2 text-sm font-medium text-gray-700" for="password_confirmation">Confirm Password</label>
          <input v-model="password_confirmation" type="password" placeholder="Confirm Password" class="mb-3 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          
          <div class="flex items-center mb-4">
            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" required />
            <label class="ml-2 text-sm text-gray-600">I accept <a href="#" class="text-blue-600 hover:underline">Terms And Conditions</a></label>
          </div>

          <button type="submit" :disabled="isLoading" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
            <span v-if="isLoading">Registering...</span>
            <span v-else>REGISTER</span>
          </button>
          <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
          <p class="mt-4 text-center text-sm text-gray-600">Already have an account? <router-link to="/login" class="text-blue-600 hover:underline">Sign in</router-link></p>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const role_id = ref(null);
const isLoading = ref(false);
const errorMessage = ref('');
const router = useRouter();
const route = useRoute();

onMounted(() => {
  // Retrieve role_id from query parameters
  role_id.value = route.query.role_id;
  if (!role_id.value) {
    // Redirect to role selection page if role_id is not provided
    router.push('/role-selection');
  }
});

const register = async () => {
  isLoading.value = true;
  errorMessage.value = '';
  try {
    const response = await axios.post('/auth/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
      role_id: role_id.value, // Ensure role_id is being sent
    });

    if (response.data.token) {
      alert('Registration successful!');
      localStorage.setItem('token', response.data.token);
      localStorage.setItem('user_id', response.data.user.id);
      localStorage.setItem('role', response.data.user.role_id);

      axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

      if (role_id.value == 2) {
        router.push('/RegisterClientDetails');
      } else if (role_id.value == 3) {
        router.push('/RegisterFreelancerDetails');
      }
    } else {
      throw new Error('Token missing in response');
    }
  } catch (error) {
    console.error('Registration failed:', error);
    errorMessage.value = error.response?.data?.message || 'Registration failed. Please try again.';
  } finally {
    isLoading.value = false;
  }
};
</script>

<style scoped>
/* Additional styles if needed */
</style>
