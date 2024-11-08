<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-4">Payment Details</h2>
  
      <div v-if="payment">
        <h3 class="text-lg font-semibold">Contract:</h3>
        <p class="text-gray-700 mb-4">{{ payment.contract_title }}</p>
  
        <h3 class="text-lg font-semibold">Amount:</h3>
        <p class="text-gray-700 mb-4">{{ payment.amount }}</p>
  
        <h3 class="text-lg font-semibold">Status:</h3>
        <p class="text-gray-700 mb-4">{{ payment.status }}</p>
  
        <h3 class="text-lg font-semibold">Date:</h3>
        <p class="text-gray-700 mb-4">{{ payment.date }}</p>
  
        <!-- Refund Button -->
        <button
          v-if="payment.status === 'completed'"
          @click="requestRefund"
          :disabled="isLoading"
          class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Requesting Refund...</span>
          <span v-else>Request Refund</span>
        </button>
  
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </div>
      <div v-else>
        <p>Loading payment details...</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const payment = ref(null);
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  const route = useRoute();
  const router = useRouter();
  
  const fetchPaymentDetails = async () => {
    try {
      const response = await this.$axios.get(`/payments/${route.params.id}`);
      payment.value = response.data;
    } catch (error) {
      console.error("Failed to load payment details:", error);
      router.push('/client-dashboard');
    }
  };
  
  const requestRefund = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.post(`/payments/${route.params.id}/refund`);
      successMessage.value = "Refund request submitted successfully!";
      payment.value.status = 'refund_requested';
    } catch (error) {
      console.error("Failed to request refund:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to request refund. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchPaymentDetails);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  