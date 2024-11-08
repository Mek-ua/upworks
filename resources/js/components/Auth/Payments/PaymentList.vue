<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Payments</h2>
  
      <div v-if="payments.length">
        <ul>
          <li v-for="payment in payments" :key="payment.id" class="border-b py-4">
            <div class="flex justify-between">
              <div>
                <p class="font-semibold">Contract: {{ payment.contract_title }}</p>
                <p class="text-gray-600">Amount: {{ payment.amount }}</p>
                <p class="text-gray-600">Status: {{ payment.status }}</p>
                <p class="text-gray-500">Date: {{ payment.date }}</p>
              </div>
              <router-link
                :to="`/payments/${payment.id}`"
                class="text-indigo-600 hover:underline"
              >View Details</router-link>
            </div>
          </li>
        </ul>
      </div>
      <div v-else>
        <p class="text-gray-600">No payments found.</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  
  const payments = ref([]);
  const router = useRouter();
  
  const fetchPayments = async () => {
    try {
      const response = await this.$axios.get('/payments/user');
      payments.value = response.data;
    } catch (error) {
      console.error("Failed to load payments:", error);
      router.push('/login');
    }
  };
  
  onMounted(fetchPayments);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  