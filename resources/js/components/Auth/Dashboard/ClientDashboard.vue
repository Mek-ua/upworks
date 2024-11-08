<template>
  <div class="relative bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="text-white fixed top-0 w-full py-4 z-50 shadow-lg">
      <div class="container mx-auto lg:px-16 flex justify-between items-center">
        <!-- Brand Logo -->
        <div class="flex items-center space-x-4">
          <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 text-white">
            <span class="text-md font-bold">F</span>
          </div>
          <router-link to="/client-dashboard" class="text-3xl font-bold text-white hover:text-blue-400">Freelance-Hub</router-link>
        </div>
        <!-- Navigation Links -->
        <div class="flex space-x-6 ml-96 -mr-24">
          <router-link to="/all-jobs" class="hover:text-blue-400">All Job Posts</router-link>
          <router-link to="/contracts" class="hover:text-blue-400">All Contracts</router-link>
          <router-link to="/chat" class="hover:text-blue-400">Chat</router-link>
          <router-link to="/notifications" class="hover:text-blue-400">Notifications</router-link>
        </div>
        <!-- Logout Button -->
        <div class="flex space-x-4 items-center">
          <button @click="logout" class="bg-red-400 -mr-24 rounded-3xl text-white px-4 py-3 hover:bg-red-700 transition duration-300">Logout</button>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('/images/hero/bg.jpg');">
      <div class="absolute inset-0 bg-black bg-opacity-60"></div>
      <div class="relative text-center mt-4 -top-16">
        <h1 class="text-5xl font-extrabold text-white">Welcome, <span class="text-yellow-400">{{ clientName }}</span>!</h1>
        <p class="mt-4 text-2xl text-white">Let's start with your first job post! It's the fastest way to meet top talent.</p>
      </div>
      <div class="relative container mx-auto text-center -mr-4 pt-32">
        <h1 class="text-4xl font-bold mt-48 mr-96 text-white mb-4">Create a Job</h1>
        <div class="text-white text-sm flex justify-center items-center space-x-2 mt-4 mr-96">
          <span class="text-slate-500">Freelance-Hub</span>
          <span class="text-gray-400">→</span>
          <span class="text-gray-100">JOB POST</span>
        </div>
      </div>
    </section>

    <!-- Main Form Content -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="flex flex-wrap lg:flex-nowrap bg-white rounded-lg shadow-lg overflow-hidden max-w-5xl w-full">
        <!-- Left side: Image -->
        <!-- <div class="hidden lg:flex items-center justify-center bg-blue-100 w-1/2 p-8">
          <img src="/images/contact-illustration.svg" alt="Contact Illustration" class="max-w-xs">
        </div> -->
        <!-- Right side: Form -->
        <div class="w-full lg:w-1/2 p-6 lg:p-8">
          <h2 class="text-3xl font-bold text-blue-600 mb-6 text-center">Create a Job Post</h2>
          <form @submit.prevent="submitJobPost" class="space-y-4">
            <div>
              <label for="jobTitle" class="block text-sm font-medium text-gray-700">Job Title</label>
              <input type="text" id="jobTitle" v-model="jobTitle" placeholder="Enter job title"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring focus:ring-blue-300">
            </div>
            <div>
              <label for="jobCategory" class="block text-sm font-medium text-gray-700">Job Category</label>
              <select id="jobCategory" v-model="jobCategory"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring focus:ring-blue-300">
                <option value="" disabled>Select category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>
            <div>
              <label for="jobSkill" class="block text-sm font-medium text-gray-700">Job Skills</label>
              <select id="jobSkill" v-model="jobSkill"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring focus:ring-blue-300">
                <option value="" disabled>Select skills</option>
                <option v-for="skill in skills" :key="skill.id" :value="skill.id">
                  {{ skill.name }}
                </option>
              </select>
            </div>
            <div>
              <label for="jobBudget" class="block text-sm font-medium text-gray-700">Budget</label>
              <input type="number" id="jobBudget" v-model="jobBudget" placeholder="Enter budget"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring focus:ring-blue-300">
            </div>
            <div>
              <label for="jobDescription" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea id="jobDescription" v-model="jobDescription" placeholder="Describe the job" rows="3"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 focus:border-blue-500 focus:ring focus:ring-blue-300"></textarea>
            </div>
            <div class="mt-6">
              <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Post Job
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
      <div class="max-w-7xl mx-auto text-center">
        <p class="mb-4">Explore a job now! Search all open positions on the web. Get your own personalized salary estimate.</p>
        <div class="flex justify-center space-x-4">
          <button class="px-4 py-2 bg-indigo-500 rounded hover:bg-indigo-600">Apply Now</button>
          <button class="px-4 py-2 bg-green-500 rounded hover:bg-green-600">Contact Us</button>
        </div>
        <p class="mt-4">&copy; 2024 Freelance-Hub. Design with ❤️ by Shreethemes.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const clientName = ref('Guest');
const jobTitle = ref('');
const jobCategory = ref('');
const jobSkill = ref('');
const jobBudget = ref('');
const jobDescription = ref('');
const categories = ref([]);  
const skills = ref([]);  // Added for storing skills


// Fetch categories, skills, and user data on component mount
onMounted(async () => {
  console.log('Token:', localStorage.getItem('token'));
  try {
    
    const categoryResponse = await axios.get('http://127.0.0.1:8000/api/categories');
    categories.value = categoryResponse.data;

    const skillResponse = await axios.get('http://127.0.0.1:8000/api/skills');
    skills.value = skillResponse.data;  // Corrected typo and variable name

    const userResponse = await axios.get('http://127.0.0.1:8000/api/user', {
      headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
    });
    clientName.value = userResponse.data.name || 'Guest';
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

// Submit job post form data to the backend
const submitJobPost = async () => {
  
  try {
    console.log('Token:', localStorage.getItem('token')); 
    await axios.post('http://127.0.0.1:8000/api/job-posts', {
      title: jobTitle.value,
      category_id: jobCategory.value,
      skill_id: jobSkill.value,
      budget: jobBudget.value,
      description: jobDescription.value
    }, {
      headers: { Authorization: `Bearer ${localStorage.getItem('token')}` }
    });
    alert('Job post created successfully');
  } catch (error) {
    console.error('Error submitting job post:', error);
    alert('Failed to create job post');
  }
};

// Logout function to clear token and redirect to login
const logout = () => {
  localStorage.removeItem('token');
  window.location.href = '/login';
};
</script>

<style scoped>
/* Add any custom styles if needed */
</style>
