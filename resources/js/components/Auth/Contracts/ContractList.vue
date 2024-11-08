<template>
  <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-6">My Contracts</h2>

    <!-- Contract List View -->
    <div v-if="!selectedContract">
      <ul>
        <li v-for="contract in contracts" :key="contract.id" class="border-b py-4">
          <div class="flex justify-between items-center">
            <div>
              <p class="font-semibold">Job Title: {{ contract.job_post.title }}</p>
              <p>Status: <span :class="statusColor(contract.is_complete)">{{ contract.is_complete ? 'Completed' : 'Active' }}</span></p>
              <p>Client: {{ contract.client.name }}</p>
              <p>Freelancer: {{ contract.freelancer.name }}</p>
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
      <p><strong>Job Title:</strong> {{ selectedContract.job_post.title }}</p>
      <p><strong>Status:</strong> <span :class="statusColor(selectedContract.is_complete)">{{ selectedContract.is_complete ? 'Completed' : 'Active' }}</span></p>
      <p><strong>Terms:</strong> {{ selectedContract.terms }}</p>
      <p><strong>Service Fee:</strong> {{ selectedContract.service_fee }}</p>

      <!-- Complete Contract Button -->
      <button
        v-if="!selectedContract.is_complete"
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
import axios from 'axios';

const contracts = ref([]);
const selectedContract = ref(null);
const isLoading = ref(false);
const successMessage = ref('');
const errorMessage = ref('');

// Fetch Contracts for the User
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
    if (error.response && error.response.status === 403) {
      errorMessage.value = "Unauthorized access. Please login again.";
    } else {
      errorMessage.value = "Failed to fetch contracts. Please try again.";
    }
  }
};

// View Contract Details
const viewDetails = (contract) => {
  selectedContract.value = contract;
};

// Complete Contract
const completeContract = async (contractId) => {
  isLoading.value = true;
  successMessage.value = '';
  errorMessage.value = '';

  try {
    await axios.put(`http://127.0.0.1:8000/api/contracts/${contractId}/complete`, {}, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    });
    successMessage.value = "Contract completed successfully!";
    selectedContract.value.is_complete = true;
  } catch (error) {
    console.error("Failed to complete contract:", error);
    errorMessage.value = error.response?.data?.message || 'Failed to complete contract.';
  } finally {
    isLoading.value = false;
  }
};

// Helper function to set status color based on contract completion
const statusColor = (isComplete) => {
  return isComplete ? 'text-green-600' : 'text-blue-600';
};

// Load contracts on component mount
onMounted(fetchContracts);
</script>

<style scoped>
/* Add additional styling if needed */
</style>
