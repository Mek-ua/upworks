<template>
  <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
    <button @click="goBack" class="text-indigo-600 mb-4">← Back to Contracts</button>
    <h2 class="text-2xl font-semibold mb-4">Contract Details</h2>
    <div v-if="contract">
      <p><strong>Job Title:</strong> {{ contract.job_post.title }}</p>
      <p><strong>Status:</strong> <span :class="statusColor(contract.is_complete)">{{ contract.is_complete ? 'Completed' : 'Active' }}</span></p>
      <p><strong>Terms:</strong> {{ contract.terms }}</p>
      <p><strong>Service Fee:</strong> {{ contract.service_fee }}</p>
      <p><strong>Start Date:</strong> {{ contract.start_date }}</p>
      <p><strong>End Date:</strong> {{ contract.end_date || 'N/A' }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const contract = ref(null);
const route = useRoute();
const router = useRouter();

const fetchContract = async () => {
  try {
    const response = await axios.get(`http://127.0.0.1:8000/api/contracts/${route.params.id}`, {
      headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
    });
    contract.value = response.data;
  } catch (error) {
    console.error("Failed to load contract:", error);
    router.push('/contracts'); // Redirect back to contract list on error
  }
};

const goBack = () => {
  router.push('/contracts');
};

const statusColor = (isComplete) => (isComplete ? 'text-green-600' : 'text-blue-600');

onMounted(fetchContract);
</script>

<style scoped>
/* Add additional styling if needed */
</style>
