<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Application Details</h2>
  
      <div v-if="application">
        <!-- Job Information -->
        <h3 class="text-lg font-semibold">Job Title:</h3>
        <p class="text-gray-700 mb-4">{{ application.job.title }}</p>
  
        <!-- Application Information -->
        <h3 class="text-lg font-semibold">Cover Letter:</h3>
        <p class="text-gray-700 mb-4">{{ application.cover_letter }}</p>
  
        <h3 class="text-lg font-semibold">Proposed Rate:</h3>
        <p class="text-gray-700 mb-4">{{ application.proposed_rate }}</p>
  
        <h3 class="text-lg font-semibold">Status:</h3>
        <p class="text-gray-700 mb-4">{{ application.status }}</p>
  
        <!-- Withdraw Application Button -->
        <button
          v-if="application.status === 'pending'"
          @click="withdrawApplication"
          :disabled="isLoading"
          class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Withdrawing...</span>
          <span v-else>Withdraw Application</span>
        </button>
  
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </div>
      <div v-else>
        <p>Loading application details...</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const application = ref(null);
  const isLoading = ref(false);
  const errorMessage = ref('');
  const successMessage = ref('');
  const route = useRoute();
  const router = useRouter();
  
  const fetchApplicationDetails = async () => {
    try {
      const response = await this.$axios.get(`/applications/${route.params.id}`);
      application.value = response.data;
    } catch (error) {
      console.error("Failed to load application details:", error);
      router.push('/freelancer-dashboard'); // Redirect if application not found
    }
  };
  
  const withdrawApplication = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.delete(`/applications/${route.params.id}/withdraw`);
      successMessage.value = "Application withdrawn successfully!";
      application.value.status = 'withdrawn';
    } catch (error) {
      console.error("Failed to withdraw application:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to withdraw application. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchApplicationDetails);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  