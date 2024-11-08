<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Educational Status</h2>
      
      <form @submit.prevent="updateEducationalStatus">
        <select v-model="selectedStatus" class="w-full mb-4 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <option value="" disabled>Select your educational status</option>
          <option v-for="status in educationalStatuses" :key="status.id" :value="status.id">
            {{ status.name }}
          </option>
        </select>
  
        <button
          type="submit"
          :disabled="isLoading"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
        >
          <span v-if="isLoading">Updating...</span>
          <span v-else>Update Status</span>
        </button>
  
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const educationalStatuses = ref([]);
  const selectedStatus = ref(null);
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  // Fetch available educational statuses
  const fetchEducationalStatuses = async () => {
    try {
      const response = await this.$axios.get('/educational-status');
      educationalStatuses.value = response.data;
    } catch (error) {
      console.error("Failed to load educational statuses:", error);
    }
  };
  
  // Update user's educational status
  const updateEducationalStatus = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.put('/profile/educational-status', { educational_status_id: selectedStatus.value });
      successMessage.value = "Educational status updated successfully!";
    } catch (error) {
      console.error("Failed to update educational status:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to update educational status. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchEducationalStatuses);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  