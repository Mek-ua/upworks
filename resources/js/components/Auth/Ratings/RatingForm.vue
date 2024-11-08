<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">Submit a Rating</h2>
      <form @submit.prevent="submitRating">
        <label class="block mb-4">
          <span class="text-gray-700">Rating (1-5):</span>
          <input
            v-model="rating"
            type="number"
            min="1"
            max="5"
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required
          />
        </label>
        <label class="block mb-6">
          <span class="text-gray-700">Feedback:</span>
          <textarea
            v-model="feedback"
            rows="4"
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Write your feedback here..."
            required
          ></textarea>
        </label>
        <button
          type="submit"
          :disabled="isLoading"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400"
        >
          <span v-if="isLoading">Submitting...</span>
          <span v-else>Submit Rating</span>
        </button>
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  
  const rating = ref(5);
  const feedback = ref('');
  const isLoading = ref(false);
  const successMessage = ref('');
  const errorMessage = ref('');
  const router = useRouter();
  const route = useRoute();
  
  const submitRating = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.post(`/contracts/${route.params.contractId}/rate`, {
        rating: rating.value,
        feedback: feedback.value,
      });
      successMessage.value = 'Rating submitted successfully!';
      setTimeout(() => router.push('/client-dashboard'), 2000); // Redirect after success
    } catch (error) {
      console.error('Failed to submit rating:', error);
      errorMessage.value = error.response?.data?.message || 'Failed to submit rating. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  