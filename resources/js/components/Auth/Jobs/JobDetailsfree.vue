<template>
    <div class="p-6 max-w-4xl mx-auto bg-white rounded shadow-md">
      <h2 class="text-2xl font-semibold mb-6">{{ job.title }}</h2>
      <p class="text-gray-700 mb-4">{{ job.description }}</p>
      <p class="mb-2"><strong>Budget:</strong> {{ job.budget }}</p>
      <p class="mb-2"><strong>Category:</strong> {{ job.category.name }}</p>
      <div class="mb-6">
        <strong>Skills Required:</strong>
        <ul class="list-disc pl-5">
          <li v-for="skill in job.skills" :key="skill.id">{{ skill.name }}</li>
        </ul>
      </div>
  
      <h3 class="text-lg font-semibold mb-4">Apply for This Job</h3>
      <form @submit.prevent="applyForJob">
        <textarea
          v-model="application.cover_letter"
          placeholder="Cover Letter"
          class="mb-4 w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
          rows="4"
          required
        ></textarea>
        <input
          v-model="application.proposed_rate"
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
        <p v-if="successMessage" class="text-green-500 mt-4">{{ successMessage }}</p>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const job = ref({});
  const application = ref({
    cover_letter: '',
    proposed_rate: ''
  });
  const isLoading = ref(false);
  const errorMessage = ref('');
  const successMessage = ref('');
  const route = useRoute();
  const router = useRouter();
  
  const fetchJobDetails = async () => {
    try {
      const response = await this.$axios.get(`/job-posts/${route.params.id}`);
      job.value = response.data;
    } catch (error) {
      console.error("Failed to load job details:", error);
      router.push('/jobs'); // Redirect if job not found
    }
  };
  
  const applyForJob = async () => {
    isLoading.value = true;
    errorMessage.value = '';
    successMessage.value = '';
  
    try {
      await this.$axios.post(`/jobs/${route.params.id}/apply`, application.value);
      successMessage.value = "Application submitted successfully!";
      router.push({
        path: '/freelancer-dashboard',
        query: { success: 'Application submitted successfully!' }
      });
    } catch (error) {
      console.error("Failed to submit application:", error);
      errorMessage.value = error.response?.data?.message || 'Failed to submit application. Please try again.';
    } finally {
      isLoading.value = false;
    }
  };
  
  onMounted(fetchJobDetails);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  