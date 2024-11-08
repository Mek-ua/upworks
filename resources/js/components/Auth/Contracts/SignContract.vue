<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Contracts</h2>
  
      <!-- Contract List View -->
      <div v-if="!selectedContract">
        <ul>
          <li v-for="contract in contracts" :key="contract.id" class="border-b py-4">
            <div class="flex justify-between items-center">
              <div>
                <p class="font-semibold">Job Title: {{ contract.job_title }}</p>
                <p>Status: <span :class="statusColor(contract.status)">{{ contract.status }}</span></p>
                <p>Client: {{ contract.client_name }}</p>
                <p>Freelancer: {{ contract.freelancer_name }}</p>
              </div>
              <button @click="viewDetails(contract)" class="text-indigo-600 hover:underline">View Details</button>
            </div>
          </li>
        </ul>
      </div>
  
      <!-- Contract Details View -->
      <div v-else>
        <button @click="selectedContract = null" class="text-indigo-600 mb-4">← Back to Contracts</button>
        <h3 class="text-xl font-semibold mb-2">Contract Details</h3>
        <p><strong>Job Title:</strong> {{ selectedContract.job_title }}</p>
        <p><strong>Status:</strong> <span :class="statusColor(selectedContract.status)">{{ selectedContract.status }}</span></p>
        <p><strong>Terms:</strong> {{ selectedContract.terms }}</p>
  
        <!-- Complete Contract Button -->
        <button
          v-if="selectedContract.status === 'active'"
          @click="completeContract(selectedContract.id)"
          :disabled="isLoading"
          class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Completing...</span>
          <span v-else>Complete Contract</span>
        </button>
  
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const contracts = ref([]);
  const selectedContract = ref(null);
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  const fetchContracts = async () => {
    try {
      const response = await this.$axios.get('/contracts');
      contracts.value = response.data;
    } catch (error) {
      console.error("Failed to load contracts:", error);
    }
  };
  
  const viewDetails = (contract) => {
    selectedContract.value = contract;
  };
  
  const completeContract = async (contractId) => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.put(`/contracts/${contractId}/complete`);
      successMessage.value = "Contract completed successfully!";
      selectedContract.value.status = 'completed';
    } catch (error) {
      console.error("Failed to complete contract:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to complete contract.';
    } finally {
      isLoading.value = false;
    }
  };
  
  const statusColor = (status) => {
    return {
      'completed': 'text-green-600',
      'active': 'text-blue-600',
      'canceled': 'text-red-600'
    }[status] || 'text-gray-600';
  };
  
  onMounted(fetchContracts);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  