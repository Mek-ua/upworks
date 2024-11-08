<template>
    <div class="p-6 max-w-7xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Manage Payments</h2>
  
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border p-4 text-left">Payment ID</th>
            <th class="border p-4 text-left">Contract ID</th>
            <th class="border p-4 text-left">Amount</th>
            <th class="border p-4 text-left">Status</th>
            <th class="border p-4 text-left">Date</th>
            <th class="border p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="payment in payments" :key="payment.id">
            <td class="border p-4">{{ payment.id }}</td>
            <td class="border p-4">{{ payment.contract_id }}</td>
            <td class="border p-4">{{ payment.amount }}</td>
            <td class="border p-4">
              <span :class="statusClasses(payment.status)">{{ payment.status }}</span>
            </td>
            <td class="border p-4">{{ payment.date }}</td>
            <td class="border p-4">
              <button 
                v-if="payment.status === 'completed'" 
                @click="requestRefund(payment.id)" 
                :disabled="isLoading"
                class="bg-red-500 text-white px-4 py-1 rounded"
              >
                <span v-if="isLoading">Processing...</span>
                <span v-else>Request Refund</span>
              </button>
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
  
  const payments = ref([]);
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  
  const fetchPayments = async () => {
    try {
      const response = await axios.get('/api/admin/payments');
      payments.value = response.data;
    } catch (error) {
      console.error("Failed to load payments:", error);
    }
  };
  
  const requestRefund = async (paymentId) => {
    isLoading.value = true;
    successMessage.value = '';
    errorMessage.value = '';
  
    try {
      await axios.post(`/api/admin/payments/${paymentId}/refund`);
      successMessage.value = 'Refund requested successfully!';
      const payment = payments.value.find((p) => p.id === paymentId);
      if (payment) payment.status = 'refund_requested';
    } catch (error) {
      console.error("Failed to request refund:", error);
      errorMessage.value = 'Failed to request refund. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  const statusClasses = (status) => {
    return {
      completed: 'text-green-600 font-semibold',
      pending: 'text-yellow-600 font-semibold',
      refund_requested: 'text-red-500 font-semibold',
    }[status] || 'text-gray-600';
  };
  
  onMounted(fetchPayments);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  