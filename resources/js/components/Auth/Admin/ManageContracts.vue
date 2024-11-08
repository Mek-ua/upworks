<template>
    <div class="p-6 max-w-7xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Manage Contracts</h2>
  
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-4 text-left">Contract ID</th>
            <th class="border p-4 text-left">Client</th>
            <th class="border p-4 text-left">Freelancer</th>
            <th class="border p-4 text-left">Job Title</th>
            <th class="border p-4 text-left">Status</th>
            <th class="border p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="contract in contracts" :key="contract.id">
            <td class="border p-4">{{ contract.id }}</td>
            <td class="border p-4">{{ contract.client_name }}</td>
            <td class="border p-4">{{ contract.freelancer_name }}</td>
            <td class="border p-4">{{ contract.job_title }}</td>
            <td class="border p-4">
              <span :class="statusClasses(contract.status)">{{ contract.status }}</span>
            </td>
            <td class="border p-4">
              <button @click="completeContract(contract)" class="bg-green-500 text-white px-4 py-1 rounded mr-2" v-if="contract.status === 'active'">Complete</button>
              <button @click="deleteContract(contract.id)" class="bg-red-500 text-white px-4 py-1 rounded">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
      <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  
  const contracts = ref([]);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  const fetchContracts = async () => {
    try {
      const response = await axios.get('/api/admin/contracts');
      contracts.value = response.data;
    } catch (error) {
      console.error("Failed to load contracts:", error);
    }
  };
  
  const completeContract = async (contract) => {
    try {
      await axios.patch(`/api/admin/contracts/${contract.id}/complete`);
      contract.status = 'completed';
      successMessage.value = 'Contract completed successfully!';
    } catch (error) {
      console.error("Failed to complete contract:", error);
      errorMessage.value = 'Failed to complete contract. Please try again.';
    }
  };
  
  const deleteContract = async (contractId) => {
    try {
      await axios.delete(`/api/admin/contracts/${contractId}`);
      contracts.value = contracts.value.filter(contract => contract.id !== contractId);
      successMessage.value = 'Contract deleted successfully!';
    } catch (error) {
      console.error("Failed to delete contract:", error);
      errorMessage.value = 'Failed to delete contract. Please try again.';
    }
  };
  
  const statusClasses = (status) => {
    return status === 'completed' ? 'text-green-600 font-semibold' : 'text-yellow-600 font-semibold';
  };
  
  onMounted(fetchContracts);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  