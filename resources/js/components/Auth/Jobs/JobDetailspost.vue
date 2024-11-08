<template>
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-4">{{ job.title }}</h2>
      <p class="mb-2 text-gray-600">{{ job.description }}</p>
      <p class="mb-2"><strong>Budget:</strong> {{ job.budget }}</p>
      <!-- <p class="mb-6"><strong>Location:</strong> {{ job.location }}</p> -->
  
      <button
        @click="openApplicationForm"
        class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
      >
        Apply for This Job
      </button>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  
  const job = ref({});
  const route = useRoute();
  const router = useRouter();
  
  const fetchJobDetails = async () => {
    try {
      const response = await this.$axios.get(`/job-posts/${route.params.id}`);
      job.value = response.data;
    } catch (error) {
      console.error("Failed to load job details:", error);
      alert("Failed to load job details.");
      router.push('/freelancer-dashboard'); // Redirect if job details cannot be loaded
    }
  };
  
  const openApplicationForm = () => {
    router.push(`/jobs/${route.params.id}/apply`);
  };
  
  onMounted(fetchJobDetails);
  </script>
  
  <style scoped>
  /* Additional styling if needed */
  </style>
  