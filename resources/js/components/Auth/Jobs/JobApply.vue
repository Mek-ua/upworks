<template>
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-4">Apply for {{ job.title }}</h2>
      <form @submit.prevent="submitApplication">
        <textarea
          v-model="cover_letter"
          placeholder="Cover Letter"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          rows="4"
          required
        ></textarea>
        <input
          v-model="proposed_rate"
          type="number"
          placeholder="Proposed Rate"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          required
        />
        <button
          type="submit"
          :disabled="isLoading"
          class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
        >
          <span v-if="isLoading">Submitting...</span>
          <span v-else>Submit Application</span>
        </button>
        <p v-if="errorMessage" class="text-red-500 mt-4">{{ errorMessage }}</p>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const job = ref({});
  const cover_letter = ref('');
  const proposed_rate = ref('');
  const isLoading = ref(false);
  const errorMessage = ref('');
  const route = useRoute();
  const router = useRouter();
  
  const fetchJobTitle = async () => {
    try {
      const response = await this.$axios.get(`/job-posts/${route.params.id}`);
      job.value = response.data;
    } catch (error) {
      console.error("Failed to load job details:", error);
      alert("Failed to load job details.");
      router.push('/freelancer-dashboard'); // Redirect if job details cannot be loaded
    }
  };
  
  const submitApplication = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    try {
      await this.$axios.post(`/jobs/${route.params.id}/apply`, {
        cover_letter: cover_letter.value,
        proposed_rate: proposed_rate.value,
      });
      alert("Application submitted successfully.");
      router.push('/freelancer-dashboard'); // Redirect back to dashboard after submission
    } catch (error) {
      console.error("Failed to submit application:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to submit application. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchJobTitle);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  