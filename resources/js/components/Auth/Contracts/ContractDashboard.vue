<template>
    <div class="min-h-screen bg-gray-100" style="background-image: url('/images/background.jpg'); background-size: cover; background-repeat: no-repeat;">
      <!-- Navbar -->
      <nav class="bg-blue-600 text-white py-4 px-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
          <h1 class="text-2xl font-semibold">Freelance-Hub</h1>
          <div class="flex space-x-6">
            <router-link to="/dashboard" class="hover:text-gray-300">Dashboard</router-link>
            <router-link to="/contracts" class="hover:text-gray-300">Contracts</router-link>
            <router-link to="/profile" class="hover:text-gray-300">Profile</router-link>
            <button @click="logout" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">Logout</button>
          </div>
        </div>
      </nav>
  
      <!-- Contract List -->
      <div class="p-6 max-w-4xl mx-auto bg-white bg-opacity-90 rounded shadow-md mt-10">
        <h2 class="text-2xl font-semibold mb-6">My Contracts</h2>
        <div v-if="contracts.length">
          <ul>
            <li v-for="contract in contracts" :key="contract.id" class="border-b py-4">
              <div class="flex justify-between items-center">
                <div>
                  <p class="font-semibold">Job Title: {{ contract.job_post.title }}</p>
                  <p>Status: <span :class="statusColor(contract.is_complete)">{{ contract.is_complete ? 'Completed' : 'Active' }}</span></p>
                  <p>Client: {{ contract.client.name }}</p>
                  <p>Freelancer: {{ contract.freelancer.name }}</p>
                </div>
                <router-link :to="`/contracts/${contract.id}`" class="text-indigo-600 hover:underline">View Details</router-link>
              </div>
            </li>
          </ul>
        </div>
        <div v-else>
          <p class="text-gray-600">No contracts available.</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const contracts = ref([]);
  const statusColor = (isComplete) => (isComplete ? 'text-green-600' : 'text-blue-600');
  
  const fetchContracts = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/contracts', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      contracts.value = response.data;
    } catch (error) {
      console.error("Failed to load contracts:", error);
    }
  };
  
  const logout = () => {
    localStorage.removeItem('token');
    window.location.href = '/login';
  };
  
  onMounted(fetchContracts);
  </script>
  
  <style scoped>
  /* Custom styles if needed */
  </style>
  